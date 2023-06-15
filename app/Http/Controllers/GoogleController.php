<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
    
            $existingUser = UserModel::where('email', $user->email)->first();
    
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = new UserModel();
                $newUser->nome = $user->name;
                $newUser->email = $user->email;
                $newUser->password = bcrypt(Str::random(40));
                $newUser->save();
    
                Auth::login($newUser);
                return redirect('/dashboard'); 
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['login' => 'Erro ao efetuar login com Google, tente novamente']);
        }
    }
}
