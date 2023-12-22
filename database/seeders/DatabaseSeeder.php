<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Role::create([
            'name' => 'Admin',
            'status' => 'active'
        ]);
        Role::create([
            'name' => 'Client',
            'status' => 'active'
        ]);

        User::create([
            'names' => 'Turf',
            'document_number' => '12345678',
            'email' => 'turf@turf.com',
            'credit' => '00.00',
            'password' => bcrypt(123456),
            'status' => 'active',
            'clave' => '123456',
            'role_id' => 1
        ]);

        User::create([
            'names' => 'Nadal Gabriel',
            'document_number' => '12345678',
            'email' => 'nadal@turf.com',
            'credit' => '00.00',
            'password' => bcrypt(123456),
            'clave' => '123456',
            'status' => 'active',
            'role_id' => 2
        ]);
    }
}
