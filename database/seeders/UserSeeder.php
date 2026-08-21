<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
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
        Role::firstOrCreate(['name' => 'public']);
        Role::firstOrCreate(['name' => 'Owener']);

        $user = User::updateOrCreate([
            'name' => 'yilmazam',
            'email'=>'daruosh.mehdipour@gmail.com',
            'password' => Hash::make('cilense1365'),
            'is_active' => 1,
            'avatar' => 'images/avatars/1.png',
        ]);
        $user->assignRole(1);
    }
}
