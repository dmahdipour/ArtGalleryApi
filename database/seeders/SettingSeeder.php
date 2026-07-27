<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['name'=>'site-title', 'description'=>'عنوان سایت', 'value'=>'سایت من']);
        Setting::create(['name'=>'site-email', 'description'=>'ایمیل ارتباطی سایت', 'value'=>'info@admin.com']);
        Setting::create(['name'=>'logo', 'description'=>'آدرس لوگوی اپ', 'value'=>'img', 'file_path'=>'https://api.chanceflip.com/storage/01JNNKB0MHV259KQBA04RP2YMS.png']);
        Setting::create(['name'=>'Welcome', 'description'=>'Welcome', 'value'=>'Hi, Welcome to HUCI Game.']);
    }
}
