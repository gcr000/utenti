<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

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
    public function manageTwoFactorAuthentication(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user->google2fa_enabled) {
            $user->google2fa_secret = null;
            $user->google2fa_enabled = false;
            $user->save();

            return Redirect::back()->with([
                'status' => 'two-factor-disabled',
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



        /*return Redirect::back()->with('status', 'two-factor-enabled', [
            'qrCode' => $qrCode,
            'secret' => $user->google2fa_secret,
        ]);*/

        return Redirect::back()->with([
            'status' => 'two-factor-enabled',
            'alert-type' => 'success',
            'qrCode' => $qrCode
        ]);
    }
}
