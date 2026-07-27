<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create(['name'=>'info',
                      'slug'=>'info',
                      'thumbnail'=>'',
                      'description'=>'info',
                      'text'=>'info',
                      'status'=>true]);
        Page::create(['name'=>'incomes',
                      'slug'=>'incomes',
                      'thumbnail'=>'',
                      'description'=>'incomes',
                      'text'=>'incomes',
                      'status'=>true]);
        Page::create(['name'=>'basicprinciple',
                      'slug'=>'basicprinciple',
                      'thumbnail'=>'',
                      'description'=>'basicprinciple',
                      'text'=>'basicprinciple',
                      'status'=>true]);
    }
}
