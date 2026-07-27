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
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name'=>'Super Admin']);

        $user = User::updateOrCreate([
            'name' => 'dmy',
            'email'=>'daruosh.mehdipour@gmail.com',
            'phone' => '09149001840',
            'password' => Hash::make('cilense'),
            'is_active' => 1,
            'avatar' => '',
        ]);

        $user->assignRole(1);
    }
}
