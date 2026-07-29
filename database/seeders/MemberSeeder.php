<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::updateOrCreate([
            'name' => 'داریوش مهدی پور یقینی',
            'user_name' => 'DMY',
            'birthday' => '1987/02/17',
            'place' => 'تبریز',
            'major' => 'کارشناسی ارشد مهندسی کامپیوتر',
            'university' => 'نبی اکرم (ص) تبریز',
            'activities' => 'طراحی , برنامه نویسی',
            'phone' => '+989149001840',
            'email'=>'daruosh.mehdipour@gmail.com',
            'instagram' => 'yilmazam',
            'linkedin' => 'dmahdipour',
            'website' => 'https://topon.ir',
            'password' => Hash::make('cilense'),
            'member_type_id' => 1,
            'about' => 'علاقه مند به هنر',
            'avatar'=>'images/avatars/1.png',
            'signature'=>'images/signatures/1.png',
            'verification_code'=>1234,
            'is_email_verified'=>1,
        ]);
    }
}
