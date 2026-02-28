<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::all();
        return view('colocations.index', compact('colocations'));
    }

    public function create()
    {
        return view('colocations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        $hadActive = $user->colocations()->wherePivot('role', 'owner')->wherePivotNull('left_at')->exists();

        if ($hadActive) {
            return redirect()->back()->with('error', 'You already have an active colocation.');
        }

        $colocation = Colocation::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => $user->id,
        ]);

        $colocation->members()->attach($user->id, ['role' => 'owner', 'joined_at' => now()]);

        return redirect()->route('colocations.show', $colocation);
    }

    public function show(Colocation $colocation)
    {
        return view('colocations.show', compact('colocation'));
    }

    public function sendInvitaion(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $token = Str::random(40);
        Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => $token,
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);

        $link = url('/invitations/' . $token);
        
        Mail::to($request->email)->send(new InvitationMail($link));


        return back()->with('success', 'Invitation sent successfully.');
    }
}
