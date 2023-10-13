<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'username' => 'Admin',
                'fullname' => 'Admin',
                'email' => 'admin@gmail',
                'phone_number' => '081334105643',
                'birth_date'=> '2023-01-01',
                'roles_id' => 1,
                'password' => 'admin123',
            ],

        ];

        foreach ($data as $key => $value) {
            $hashPassword = Hash::make($value['password']);
            $user = User::create([
                'username' => $value['username'],
                'fullname' => $value['fullname'],
                'phone_number' => $value['phone_number'],
                'email' => $value['email'],
                'birth_date' => $value['birth_date'],
                'roles_id' => $value['roles_id'],
                'password' => $hashPassword,
            ]);
            $users[] = $user;
        }
    }
}