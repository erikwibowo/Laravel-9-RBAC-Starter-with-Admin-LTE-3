<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name'      => 'Superadmin',
            'email'     => 'superadmin@superadmin.com',
            'password'  => bcrypt('superadmin')
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('admin')
        ]);
        $admin->assignRole('admin');

        $operator = User::create([
            'name'      => 'Operator',
            'email'     => 'operator@operator.com',
            'password'  => bcrypt('operator')
        ]);
        $operator->assignRole('operator');
    }
}
