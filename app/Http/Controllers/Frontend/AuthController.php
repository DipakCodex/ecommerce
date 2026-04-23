<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.login');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $old_user = User::where('email', $user->email)->first();
        if ($old_user) {
            Auth::login($old_user);
            return redirect()->route('home');
        } else {
            $new_user = new User;
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->password = Hash::make(rand(10000, 99999));
            $new_user->save();
            Auth::login($new_user);
            return redirect()->route('home');
        }
    }

    public function logout()
        {
            Auth::logout();
            return redirect()->route('login');
        }
}
