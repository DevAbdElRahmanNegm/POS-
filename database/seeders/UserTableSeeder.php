<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@app.com',
            'password' =>  Hash::make('123456789')
        ]);

        $user->attachRole('super_admin');
    }
}
