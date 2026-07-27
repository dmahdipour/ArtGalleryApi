<?php

namespace Database\Seeders;

use App\Models\Sell;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sell::create([
            'project_id'=>1,
            'price'=>'3 میلیون تومان',
            'count'=>1,
            'location'=>'',
            'address'=>'تبریز-گالری شاهد',
            'phone'=>'+989149001840',
            'description'=>'', 
        ]);
    }
}
