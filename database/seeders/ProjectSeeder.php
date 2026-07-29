<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'member_id'=>1,
            'name_fa'=>'تست',
            'name_en'=>'Test',
            'technique_id'=>1,
            'image'=>'images/projects/1.png',
            'thumbnail'=>'images/projects/thumbnails/1.png',
            'height'=>'60',
            'width'=>'40',
            'year'=>'1405',
            'style_id'=>1,
            'subject_id'=>1,
            'member_description'=>'گل مریم، تنها یک گل خوش عطر نیست؛ روایتی است از آرامشی که در هیاهوی زندگی کمتر دیده می شود. در این اثر، تلاش شده است تا لحظه ای از شکفتن، جایی میان غنچه و گل کامل، ثبت، شود؛ لحظه ای که زندگی در اوج امید و انتظار جریان دارد.
انتخاب پس زمینه ای تیره و آرام، آگاهانه بوده است تا سفیدی گل ها نه صرفا به عنوان یک رنگ تیره، بلکه به عنوان نمادی از خلوص، روشنی و تداوم حیات جلوه کند. هر غنچه نوید فرداست و هر گل شکفته، یادآور کوتاهی و ارزش لحظه اکنون.
این تابلو دعوتی است به مکث؛ به تماشای زیبایی هایی که اغلب در شتاب زندگی از کنار آن ها عبور می کنیم.',
            'description'=>'تجلی سکوت، پاکی و تداوم زندگی',
            'about_project'=>'گل مریم (Polianthes Tuberose) از خوش عطرترین گل های جهان است و خاستگاه آن مکزیک است. عطر نافذ و ماندگار آن قرن هاست در فرهنگ های مختلف نماد پاکی، عشق، وقار و امید شناخته می شود و از ارزشمندترین گل ها در صنعت عطرسازی به شمار می آید.
گل های این گیاه به صورت تدریجی از پایین به بالا شکوفا می شوند؛ ویژگی ای که آن را به نمادی از رشد، استمرار و تکامل تبدیل کرده است.',
            'signature'=>'images/projects/signatures/1.png',
            'theme'=>'green',
        ]);
    }
}
