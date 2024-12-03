<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'utilisateurs fictifs
        $user1 = User::create([
            'first_name' => 'Heather',
            'last_name' => 'Whteman',
            // 'pseudo' => 'Plume noire',
            'email' => 'heather@gmail.com',
            'password' => Hash::make('password'), 
            'status' => true,
        ]);
        $user1->assignRole('Admin'); 
    }   
}
