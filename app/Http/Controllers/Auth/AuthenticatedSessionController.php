<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        $identifier = $request->identifier;

        if (is_numeric($identifier)) {
            // Login pasien pakai guard pasien
            if (Auth::guard('pasien')->attempt(['nik' => $identifier, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        } else {
            // Login bidan pakai guard default (web)
            if (Auth::attempt(['email' => $identifier, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'identifier' => 'Kredensial tidak valid.',
        ]);
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd("masuk ke logout");
        if (Auth::guard('pasien')->check()) {
            Auth::guard('pasien')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
