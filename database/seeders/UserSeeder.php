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
        Role::firstOrCreate(['name' => 'super_admin']); 
        Role::firstOrCreate(['name' => 'public']);
        Role::firstOrCreate(['name' => 'Owener']);

        $user = User::updateOrCreate([
            'name' => 'dmy',
            'email'=>'daruosh.mehdipour@gmail.com',
            'phone' => '09149001840',
            'password' => Hash::make('cilense1365'),
            'is_active' => 1,
            'avatar' => '',
        ]);
        $user->assignRole(1);

        $user1 = User::updateOrCreate([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'phone' => '09339981840',
            'password' => Hash::make('cilense1365'),
            'is_active' => 1,
            'avatar' => '',
        ]);
        $user1->assignRole(2);
    }
}
