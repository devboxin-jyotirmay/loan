<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'mobile' => 1234567890,
                'pan_card' => 'ABCD123456',
                'aadhar_card' => 123456789012,
                'address' => 'jdekdslfjoihdskjfn',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
        ]);
    }
}
