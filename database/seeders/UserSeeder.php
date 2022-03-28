<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'role' => '1',
            ],
            [
                'name' => 'Erik Rahim',
                'email' => 'erik@gmail.com',
                'password' => 'password',
                'role' => '2',
            ],
        ];

        foreach ($users as $row) {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
            ]);

            $user = User::where('email', $row['email'])->first();
            $user->assignRole($row['role']);
        }
    }
}
