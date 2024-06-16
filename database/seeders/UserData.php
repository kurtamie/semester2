<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'nama' => 'Administrator',
                'nik' => 12345,
                'nim' => '',
                'username' => 'admin',
                'password' => bcrypt('12345'),
                'level' => 'admin',
                'email' => 'admin@gmail.com'
            ],

            [
                'nama' => 'Suep',
                'nik' => '',
                'nim' => 4342201033,
                'username' => 'mahasiswa',
                'password' => bcrypt('12345'),
                'level' => 'mahasiswa',
                'email' => 'mahasiswa@gmail.com'
            ]
        ];

        foreach ($user as $key => $value) {
            user::create($value);
        }
    }
}
