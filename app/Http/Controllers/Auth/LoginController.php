<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return $this->cacheControlledView('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role_id == 1) {
                return $this->cacheControlledRedirect(route('produits'));
            } elseif ($user->role_id == 2) {
                return $this->cacheControlledRedirect(route('userdashboard'));
            }

            return $this->cacheControlledRedirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->cacheControlledRedirect('/login');
    }

    // ✅ Reusable method for setting no-cache headers on views
    private function cacheControlledView($view)
    {
        return response()
            ->view($view)
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // ✅ Reusable method for setting no-cache headers on redirects
    private function cacheControlledRedirect($url)
    {
        return redirect($url)
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
