<?php

return [

    'title' => 'تایید آدرس ایمیل ثبت نامی',

    'heading' => 'تایید آدرس ایمیل ثبت نامی',

    'actions' => [

        'resend_notification' => [
            'label' => 'ارسال مجدد',
        ],

    ],

    'messages' => [
        'notification_not_received' => 'اگر ایمیلی که فرستادیم را دریافت نکردید؟<br /> ممکن است به پوشه اسپم در ایمیلتان رفته باشد.<br />',
        'notification_sent' => 'یک ایمیل حاوی لینکی برای تایید ایمیل ثبت نامی به :email فرستاده شد.',
    ],

    'notifications' => [

        'notification_resent' => [
            'title' => 'ما ایمیل را دوباره فرستادیم.',
        ],

        'notification_resend_throttled' => [
            'title' => 'شما بیش از حد مجاز درخواست ارسال مجدد ایمیل داشته‌اید.',
            'body' => 'لطفاً :seconds ثانیه دیگر تلاش کنید.',
        ],

    ],

];
