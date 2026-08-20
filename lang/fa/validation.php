<?php

return [

    'required' => 'وارد کردن :attribute الزامی است.',
    'string' => ':attribute باید از نوع متن باشد.',
    'email' => ':attribute باید یک ایمیل معتبر باشد.',

    'min' => [
        'string' => ':attribute باید حداقل :min کاراکتر باشد.',
        'numeric' => ':attribute باید حداقل :min باشد.',
        'array' => ':attribute باید حداقل :min مورد داشته باشد.',
        'file' => ':attribute باید حداقل :min کیلوبایت باشد.',
    ],

    'max' => [
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'array' => ':attribute نباید بیشتر از :max مورد داشته باشد.',
        'file' => ':attribute نباید بیشتر از :max کیلوبایت باشد.',
    ],

    'same' => ':attribute باید با :other یکسان باشد.',

    'confirmed' => 'تأیید :attribute با آن مطابقت ندارد.',

    'unique' => 'این :attribute قبلاً استفاده شده است.',

    'attributes' => [
        'name' => 'نام',
        'email' => 'ایمیل',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
    ],

];