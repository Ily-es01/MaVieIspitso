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
        public function store(LoginRequest $request): RedirectResponse
        {
            $request->authenticate();

            $request->session()->regenerate();

            $user = Auth::user();
            \Log::info('User login attempt', [
                'user_id' => $user->id,
                'email' => $user->email,
                'roles' => $user->getRoleNames(),
                'has_role_etudiant' => $user->hasRole('etudiant'),
                'has_role_enseignant' => $user->hasRole('enseignant'),
                'has_role_admin' => $user->hasRole('admin')
            ]);

            if ($user->hasRole('enseignant')) {
                return redirect()->intended(route('enseignant.index'));
            }
            else if($user->hasRole('admin')) {
                 return redirect()->intended(route('responsable.index'));
            }
            else {
                return redirect()->intended(route('etudiant.index'));
            }
        }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
