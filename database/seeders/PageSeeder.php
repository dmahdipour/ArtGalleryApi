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
        Page::create([
            'name'=>'slider',
            'slug'=>'slider',
            'thumbnail'=>'01M023MEAZ67J1RE4RKKZWGQQ5.jpg',
            'description'=>'<p style="text-align: end;">هنر،<br>روایت نگاه است.</p>',
            'text'=>'<p style="text-align: end;">مجموعه ای از آثار هنری معاصر و کلاسیک،<br>جایی برای کشف رنگُ فرم و احساس.</p>',
            'status'=>true
        ]);
    }
}
