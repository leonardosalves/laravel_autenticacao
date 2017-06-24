<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handle()
    {
        $user = Socialite::driver('github')->user();
        dd($user);
    }
}
