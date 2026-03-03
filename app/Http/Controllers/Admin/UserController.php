<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    } 
    
    public function toggleBan(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return back();
        }

        $user->update([ 'is_banned' => !$user->is_banned ]);

        return back()->with('success', 'User status updated successfully.');
    }
}
