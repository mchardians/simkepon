<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Services\Contracts\UserService;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        return view('pages.auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($this->userService->login($credentials)) {
            $request->session()->regenerate();

            switch(Auth::user()->role->name) {
                case "admin":
                    return redirect()->intended(route('admin.dashboard'));
                case "bendahara":
                    return redirect()->intended(route('bendahara.dashboard'));
                case "walisantri":
                    return redirect()->intended(route('walisantri.dashboard'));
                case "kepalapondok":
                    return redirect()->intended(route('kepalapondok.dashboard'));
            }
        }

        return back()->withInput($request->except('password'))->withErrors([
            'userInvalid' => 'Login gagal, data tidak ditemukan!',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
