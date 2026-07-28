<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Craete system admin user*/
        $this->call([
            MemberTypeSeeder::class,
            MemberSeeder::class,
            PositionSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
            TechniqueSeeder::class,
            SubjectSeeder::class,
            StyleSeeder::class,
            ProjectSeeder::class,
            SellSeeder::class,
            UserSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
