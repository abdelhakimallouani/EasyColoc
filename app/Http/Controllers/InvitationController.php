<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function show($token)
    {
        $invitation = Invitation::where('token', $token)->where('status', 'pending')->where('expires_at', '>', now())->firstOrFail();

        return view('invitations.show', compact('invitation'));
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->where('status', 'pending')->where('expires_at', '>', now())->firstOrFail();

        $user = Auth::user();

        // if ($user->email !== $invitation->email) {
        //     abort(403);
        // }

        if ($user->colocations()->wherePivotNull('left_at')->exists()) {
            abort(403);
        }

        $invitation->colocation()->members()->attach($user->id, ['role' => 'membre', 'joined_at' => now()]);

        $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.show', $invitation->colocation_id)->with('success', 'Invitation accepted!');
    }

    public function reject($token)
    {
        $invitation = Invitation::where('token', $token)->where('status', 'pending')->where('expires_at', '>', now())->firstOrFail();

        $invitation->update(['status' => 'rejected']);

        return redirect('/')->with('info', 'Invitation rejected.');
    }

    public function handle($token)
    {
        $invitation = Invitation::where('token', $token)->where('status', 'pending')->where('expires_at', '>', now())->firstOrFail();

        if (!Auth::check()) {
            session(['invitation_token' => $token]);
            // dd($info);
            return redirect()->route('register');
        }

        $invitation->colocation->users()->attach(Auth::id(), ['role' => 'membre', 'joined_at' => now()]);
        // $invitation->update(['status' => 'accepted']);

        return redirect()->route('colocations.show', $invitation->colocation_id)->with('success', 'Invitation accepted!');

    }
}
