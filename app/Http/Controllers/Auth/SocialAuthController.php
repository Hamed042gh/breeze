<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{

    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('email', $socialUser->getEmail())->first();
            if ($user) {

                Auth::login($user);
            } else {

                $user = $this->createNewUser($socialUser, $provider);
                Auth::login($user);
            }
            return redirect('/dashboard')->with('success', 'you are loging in...');
        } catch (\Exception $e) {
            Log::error('Authentication error with provider ' . $provider . ': ' . $e->getMessage());
            return redirect('/login')->withErrors('Unable To Authenticate with ' . $provider);
        }
    }

    protected function createNewUser($socialUser, $provider)
    {
        return User::create([
            'name' => $socialUser->getName() ?: $socialUser->getNickname(),
            'email' => $socialUser->getEmail(),
            'provider_id' => $socialUser->getId(),
            'provider_name' => $provider,
            'password' => bcrypt(Str::random(16))
        ]);
    }
}
