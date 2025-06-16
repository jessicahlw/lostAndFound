<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Admin 1',
            'email'=> 'admin1@telkomuniversity.ac.id',
            'phone'=> '088212210090',
            'password' => Hash::make('passAdmin1'),
            'email_verified_at'=> now(),
            'role'=>'admin',
        ]);
    }

}
