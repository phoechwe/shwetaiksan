<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Http\Responses\LoginResponse;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $request->validate([
            Fortify::username() => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            session()->flash('message', 'Successfully logged in!');
            session()->flash('type', 'success');

            return redirect()->intended(route('admin.dashboard'));
        }

        // Flash error message
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
