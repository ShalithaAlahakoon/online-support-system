<?php

namespace App\Http\Controllers;

use Domain\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     */
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Create a new controller instance.
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'socialite_picture' => $user->getAvatar(),
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Create a new controller instance.
     */
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('fb_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'fb_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'socialite_picture' => $user->getAvatar(),
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Create a new controller instance.
     */
    public function handleLinkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();

            $finduser = User::where('linkedin_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'linkedin_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'socialite_picture' => $user->getAvatar(),
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
