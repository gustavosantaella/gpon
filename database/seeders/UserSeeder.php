<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        'name'=>'gustavo santaella',
        'email'=>'gsanta01@cantv.com.ve',
        'password'=> Hash::make('password')
                ]);

        $user->assignRole('SUPER USUARIO');
    }
}
