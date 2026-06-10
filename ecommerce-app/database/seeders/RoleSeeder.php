<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'customer']);
        Role::firstOrCreate(['name' => 'editor']);

        $testUser = User::where('email', 'test@example.com')->first();

        if ($testUser) {
            $testUser->roles()->syncWithoutDetaching([$admin->id]);
        }
    }
}
