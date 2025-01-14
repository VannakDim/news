<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class UserAuthController extends Controller
{
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')-> logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function show(){
        return view('admin.profile.profile');
    }
}
