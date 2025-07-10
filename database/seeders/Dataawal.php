<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Dataawal extends Seeder
{
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@sbd.com';
        $user->password = bcrypt('12345678');
        $user->peran = 'admin';
        $user->save();
    }
}
