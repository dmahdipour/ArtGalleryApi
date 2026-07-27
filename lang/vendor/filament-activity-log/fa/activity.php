<?php

return [
    'label' => 'گزارش فعالیت‌ها',
    'plural_label' => 'گزارش‌های فعالیت',
    
    'table' => [
        'column' => [
            'id' => 'شناسه',
            'log_name' => 'نام لاگ',
            'event' => 'رویداد',
            'subject_id' => 'شناسه موضوع',
            'subject_type' => 'نوع موضوع',
            'causer_id' => 'شناسه انجام‌دهنده',
            'causer_type' => 'نوع انجام‌دهنده',
            'properties' => 'خصوصیات',
            'created_at' => 'تاریخ ایجاد',
            'updated_at' => 'تاریخ به‌روزرسانی',
            'description' => 'توضیحات',
            'subject' => 'موضوع',
            'causer' => 'انجام‌دهنده',
            'ip_address' => 'آدرس IP',
            'browser' => 'مرورگر',
        ],
        'filter' => [
            'event' => 'رویداد',
            'created_at' => 'تاریخ ایجاد',
            'created_from' => 'از تاریخ',
            'created_until' => 'تا تاریخ',
            'causer' => 'انجام‌دهنده',
            'subject_type' => 'نوع موضوع',
            'batch' => 'شناسه دسته',
        ],
    ],
    
    'infolist' => [
        'section' => [
            'activity_details' => 'جزئیات فعالیت',
        ],
        'tab' => [
            'overview' => 'نمای کلی',
            'changes' => 'تغییرات',
            'raw_data' => 'داده‌های خام',
            'old' => 'قدیمی',
            'new' => 'جدید',
        ],
        'entry' => [
            'log_name' => 'نام لاگ',
            'event' => 'رویداد',
            'created_at' => 'تاریخ ایجاد',
            'description' => 'توضیحات',
            'subject' => 'موضوع',
            'causer' => 'انجام‌دهنده',
            'ip_address' => 'آدرس IP',
            'browser' => 'مرورگر',
            'attributes' => 'ویژگی‌ها',
            'old' => 'قدیمی',
            'key' => 'کلید',
            'value' => 'مقدار',
            'properties' => 'خصوصیات',
        ],
    ],
    
    'action' => [
        'timeline' => [
            'label' => 'خط زمانی',
            'empty_state_title' => 'هیچ گزارشی از فعالیت‌ها یافت نشد',
            'empty_state_description' => 'هنوز هیچ فعالیتی برای این رکورد ثبت نشده است.',
        ],
        'delete' => [
            'confirmation' => 'آیا از حذف این گزارش فعالیت اطمینان دارید؟ این عمل قابل بازگشت نیست.',
            'heading' => 'حذف گزارش فعالیت',
            'button' => 'حذف',
        ],
        'revert' => [
            'label' => 'بازگشت',
            'heading' => 'بازگشت تغییرات',
            'confirmation' => 'آیا از بازگشت این تغییر اطمینان دارید؟ این عمل مقادیر قدیمی را بازیابی می‌کند.',
            'button' => 'بازگشت',
            'success' => 'تغییرات با موفقیت بازگشت داده شدند',
            'no_old_data' => 'داده‌ای برای بازگشت وجود ندارد',
            'nothing_selected' => 'هیچ ویژگی برای بازگشت انتخاب نشده است.',
            'subject_not_found' => 'مدل موضوع پیدا نشد',
            'helper_text' => 'تغییر از \':old\' به \':new\'',
        ],
        'restore' => [
            'label' => 'بازیابی',
            'heading' => 'بازیابی رکورد',
            'confirmation' => 'آیا از بازیابی این رکورد حذف شده اطمینان دارید؟',
            'success' => 'رکورد با موفقیت بازیابی شد.',
        ],
        'prune' => [
            'label' => 'پاکسازی لاگ‌ها',
            'heading' => 'پاکسازی گزارش‌های فعالیت',
            'confirmation' => 'آیا از حذف لاگ‌های قدیمی‌تر از تاریخ انتخاب شده اطمینان دارید؟ این عمل قابل بازگشت نیست.',
            'success' => ':count گزارش فعالیت با موفقیت پاکسازی شد.',
            'date' => 'پاکسازی لاگ‌های قدیمی‌تر از',
        ],
        'export' => [
            'filename' => 'گزارش_فعالیت‌ها',
            'notification' => [
                'completed' => 'خروجی گزارش فعالیت‌ها با موفقیت کامل شد و :successful_rows :rows_label صادر شد.',
                'failed_rows' => ':count :rows با خطا مواجه شدند.',
            ],
        ],
        'batch' => [
            'label' => 'دسته',
        ],
        'bulk' => [
            'delete' => [
                'confirmation' => 'آیا از حذف گزارش‌های فعالیت انتخاب شده اطمینان دارید؟',
            ],
            'restore' => [
                'label' => 'بازیابی انتخاب‌شده‌ها',
                'confirmation' => 'آیا از بازیابی رکوردهای حذف شده انتخاب شده اطمینان دارید؟',
                'success' => ':count رکورد با موفقیت بازیابی شد.',
            ],
            'revert' => [
                'label' => 'بازگشت انتخاب‌شده‌ها',
                'confirmation' => 'آیا از بازگشت تغییرات برای تمام لاگ‌های انتخاب شده اطمینان دارید؟ فقط لاگ‌هایی که داده‌های قدیمی دارند پردازش می‌شوند.',
                'success' => ':count لاگ با موفقیت بازگشت داده شد.',
            ],
        ],
    ],
    
    'widgets' => [
        'latest_activity' => 'آخرین فعالیت‌ها',
        'activity_chart' => [
            'heading' => 'نمودار فعالیت‌ها در طول زمان',
            'label' => 'فعالیت‌ها',
        ],
        'heatmap' => [
            'heading' => 'نقشه حرارتی فعالیت‌ها',
            'less' => 'کمتر',
            'more' => 'بیشتر',
            'tooltip' => ':count فعالیت در :date',
        ],
        'stats' => [
            'total_activities' => 'همه فعالیت‌ها',
            'total_description' => 'تعداد کل لاگ‌ها در سیستم',
            'top_causer' => 'پرکارترین انجام‌دهنده',
            'top_causer_description' => ':count فعالیت',
            'top_subject' => 'پرکارترین موضوع',
            'top_subject_description' => ':count تغییر',
            'no_data' => 'داده‌ای وجود ندارد',
        ],
    ],
    
    'pages' => [
        'user_activities' => [
            'title' => 'فعالیت‌های کاربران',
            'heading' => 'فعالیت‌های کاربران',
            'description_title' => 'ردیابی اقدامات کاربران',
            'description' => 'همه فعالیت‌های انجام شده توسط کاربران در برنامه خود را مشاهده کنید. بر اساس کاربر، نوع رویداد یا موضوع فیلتر کنید تا خط زمانی کاملی از اقدامات را ببینید.',
        ],
        'audit_dashboard' => [
            'title' => 'داشبورد حسابرسی',
        ],
    ],
    
    'event' => [
        'created' => 'ایجاد',
        'updated' => 'به‌روزرسانی',
        'deleted' => 'حذف',
        'restored' => 'بازیابی',
    ],
    
    'filter' => [
        'causer' => 'کاربر',
        'event' => 'نوع رویداد',
        'subject_type' => 'نوع موضوع',
    ],
    
    'dashboard' => [
        'title' => 'داشبورد حسابرسی',
    ],
    
    'filters' => 'فیلترها',
    'system' => 'سیستم',
    'row' => 'ردیف',
    'rows' => 'ردیف‌ها',
];