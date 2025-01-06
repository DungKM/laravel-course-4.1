<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            $user = User::updateOrCreate(
                [
                    'github_id' => $githubUser->id,
                ],
                [
                    'name' => $githubUser->name ?? $githubUser->nickname,
                    'email' => $githubUser->email,
                    'description' => "This is a Git user",
                    'github_token' => $githubUser->token,
                    'github_refresh_token' => $githubUser->refreshToken,
                ]
            );

            auth()->login($user, true);

            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            return redirect('login')->withErrors(['error' => 'Unable to login using Google. Please try again.']);
        }
    }
}
