<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Settlement;

class SettlementController extends Controller
{
    public function generate(Colocation $colocation)
    {
        $colocation->settlements()->delete();

        $users = $colocation->users;
        $expenses = $colocation->expenses;

        if ($users->count() == 0 || $expenses->count() == 0) {
            return back()->with('error', 'No users or expenses');
        }

        $total = $expenses->sum('amount');
        $average = $total / $users->count();

        $balances = [];

        foreach ($users as $user) {
            $paid = $expenses
                ->where('payer_id', $user->id)
                ->sum('amount');

            $balances[$user->id] = $paid - $average;
        }

        $creditors = [];
        $debtors = [];

        foreach ($balances as $userId => $balance) {
            if ($balance > 0) {
                $creditors[$userId] = $balance;
            } elseif ($balance < 0) {
                $debtors[$userId] = abs($balance);
            }
        }

        foreach ($debtors as $debtorId => $debtAmount) {

            foreach ($creditors as $creditorId => $creditAmount) {

                if ($debtAmount <= 0) {
                    break;
                }
                if ($creditAmount <= 0) {
                    continue;
                }

                $amount = min($debtAmount, $creditAmount);

                $colocation->settlements()->create([
                    'from_user_id' => $debtorId,
                    'to_user_id' => $creditorId,
                    'amount' => $amount,
                    'status' => 'pending',
                ]);

                $debtAmount -= $amount;
                $creditors[$creditorId] -= $amount;
            }
        }

        return back()->with('success', 'Settlements generated successfully');
    }

    public function markAsPaid(Settlement $settlement)
    {
        $settlement->update([
            'status' => 'paid',
        ]);

        return back()->with('success', 'Settlement marked as paid.');
    }
}
