<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;

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

        $user = Auth::user();

        // Verifica se l'utente ha il 2FA abilitato
        if ($user && $user->google2fa_enabled) {

            if(!$request->input('2fa_code')) {
                // Se il codice 2FA non è valido, logout utente
                Auth::guard('web')->logout();
                return back()->withErrors(['2fa_code' => 'Codice 2FA obbligatorio per questo utente.'])->withInput();
            }

            // Crea un'istanza di Google2FA
            $google2fa = new Google2FA();

            // Verifica il codice 2FA
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('2fa_code'));

            info($valid);

            if (!$valid) {

                // Se il codice 2FA non è valido, logout utente
                Auth::guard('web')->logout();

                // Se il codice 2FA non è valido, ritorna con un errore
                return back()->withErrors(['2fa_code' => 'Codice 2FA non valido.']);
            }
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
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
