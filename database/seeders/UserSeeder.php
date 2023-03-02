<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // admin user
        $admin                    = new User();
        $admin->name              = 'Admin';
        $admin->email             = 'admin@admin.com';
        $admin->password          = Hash::make( 'admin@123' );
        $admin->remember_token    = Str::random( 10 );
        $admin->role              = 'admin';
        $admin->email_verified_at = now();
        $admin->save();

        $user                    = new User();
        $user->name              = 'Dhananjay';
        $user->email             = 'dhananjaykyada@gmail.com';
        $user->password          = Hash::make( 'password' );
        $user->remember_token    = Str::random( 10 );
        $user->role              = 'user';
        $user->email_verified_at = now();
        $user->save();
    }
}
