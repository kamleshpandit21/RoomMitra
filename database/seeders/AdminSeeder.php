<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Admin::create([
            'username'   => 'admin',
            'full_name'  => 'Atul Verma',
            'email'      => 'atul800498@gmail.com',
            'phone'      => '9305089318',
            'password'   => Hash::make('Roomitra@#12'), 
        ]);
    }
}
