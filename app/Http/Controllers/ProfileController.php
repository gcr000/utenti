<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $user = Auth::user();

        if($user->google2fa_enabled){
            $google2fa = new Google2FA();
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $user->google2fa_secret
            );
            $qrCode = QrCode::size(200)->generate($qrCodeUrl);
        } else {
            $qrCode = null;
        }
        return view('profile.edit', [
            'user' => $request->user(),
            'qrCode' => $qrCode
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with([
            'status' => 'profile-information-updated',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Enable or disable two-factor authentication for the user.
     */
    public function manageTwoFactorAuthentication(Request $request)
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            $user->google2fa_secret = null;
            $user->google2fa_enabled = false;
            $user->save();

            return Redirect::back()->with([
                'status' => __('profilo.2fa.disabled_message'),
                'alert-type' => 'success',
            ]);
        }

        $google2fa = new Google2FA();
        $user->google2fa_secret = $google2fa->generateSecretKey();
        $user->google2fa_enabled = true;
        $user->save();

        // Generate a QR code for the user to scan with their 2FA app
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        // Generate the QR code as an image
        $qrCode = QrCode::size(200)->generate($qrCodeUrl);

        return Redirect::back()->with([
            'status' => __('profilo.2fa.enabled_message'),
            'alert-type' => 'success',
            'qrCode' => $qrCode
        ]);
    }

    public function setLocale($locale){
        $user = Auth::user();
        $user->locale = $locale;
        $user->save();

        return Redirect::back()->with([
            'status' => __('profilo.controller.update_lang'),
            'alert-type' => 'success',
        ]);
    }

    public function showVerifyForm(): View
    {
        return view('auth.two-factor-verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            '2fa_code' => 'required|numeric',
        ]);

        // Recupera l'utente dalla sessione
        $userId = session('2fa:user:id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['2fa_code' => 'Sessione 2FA non valida.']);
        }

        $user = User::find($userId);

        if (!$user)
            return redirect()->route('login')->withErrors(['2fa_code' => 'Utente non trovato.']);


        // Verifica il codice 2FA
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('2fa_code'));

        if (!$valid) {
            return back()->withErrors(['2fa_code' => 'Codice 2FA non valido.']);
        }

        // Se il codice 2FA è valido, rigenera la sessione e accedi
        Auth::login($user);
        session()->forget('2fa:user:id');

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
