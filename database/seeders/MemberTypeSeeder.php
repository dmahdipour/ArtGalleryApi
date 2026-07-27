<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberType;
class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberType::create(['name'=>'Public', 'thumbnail'=>'', 'description'=>'عادی']);
        MemberType::create(['name'=>'Owener', 'thumbnail'=>'', 'description'=>'صاحب کسب و کار']);
    }
}
