<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;

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
        $containPrefix = \Str::contains($request->email, \Str::upper($prefix));
        $email = $containPrefix ? $request->email : "$request->email$prefix";
        $user = User::where('email', \Str::upper($email))->first();

        if($user && Hash::check($request->password, $user->password))
        {
            return $user;
        }

    }
}
