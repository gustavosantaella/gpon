<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class LoginUser
{
    use PasswordValidationRules;

    /**
     * @return \App\Models\User
     */
    public static function login()
    {
        $request = request();
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $prefix = '@cantv.com.ve';
        $containPrefix = Str::contains($request->email, Str::lower($prefix));
        $email = $containPrefix ? $request->email : "$request->email$prefix";
        $user = User::where('email', Str::lower($email))->first();

        if($user && Hash::check($request->password, $user->password))
        {
            return $user;
        }

    }
}
