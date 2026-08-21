<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        if (!$user) {
            return;
        }

        $memberData = [
            'uuid' => '3dfaf4a3-75d2-4bd2-995d-548fbe95f1d9', // ✅ 36 کاراکتر
            'user_id' => 1,
            'name_fa' => 'داریوش مهدی پور یقینی',
            'name_en' => 'Daryoush Mahdipour Yaghini',
            'birthday' => '1987-02-17', 
            'place' => 'تبریز',
            'major' => 'کارشناسی ارشد مهندسی کامپیوتر',
            'university' => 'نبی اکرم (ص) تبریز',
            'activities' => 'طراحی , برنامه نویسی',
            'phone' => '+989149001840',
            'instagram' => 'yilmazam',
            'linkedin' => 'dmahdipour',
            'website' => 'https://topon.ir',
            'member_type_id' => 1, 
            'about' => 'علاقه مند به هنر',
            'signature' => 'images/signatures/1.png',
            'verification_code' => 1234,
            'is_email_verified' => 1, 
        ];

        // بروزرسانی یا ایجاد
        $member = Member::updateOrCreate(
            ['user_id' => 1], // شرط پیدا کردن
            $memberData // داده‌های جدید
        );
    }
}