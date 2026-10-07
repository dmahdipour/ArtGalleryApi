<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class MeliPayamakService
{
    /**
     * ارسال پیامک با الگوی ملی پیامک
     *
     * @param string $text مقدار متغیر {0}
     * @param string $phone شماره گیرنده
     * @param int $bodyId کد الگو
     */
    public function sendPattern(
        string $text,
        string $phone,
        int $bodyId
    ): bool {
        $response = Http::asForm()
            ->timeout(15)
            ->post(
                'https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber',
                [
                    'username' => config('services.melipayamak.username'),
                    'password' => config('services.melipayamak.password'),
                    'text'     => $text,
                    'to'       => $phone,
                    'bodyId'   => $bodyId,
                ]
            );

        if (! $response->successful()) {
            throw new RuntimeException(
                'خطا در اتصال به سرویس ملی پیامک.'
            );
        }

        $result = $response->json();

        $value = (string) ($result['Value'] ?? '');

        if ($value !== '1') {
            throw new RuntimeException(
                $this->getErrorMessage($value)
            );
        }

        return true;
    }

    /**
     * تبدیل کد خطای ملی پیامک به پیام قابل فهم
     */
    protected function getErrorMessage(string $value): string
    {
        return match ($value) {
            '-7' => 'خطایی در شماره فرستنده پیامک رخ داده است.',
            '-6' => 'خطای داخلی یا مشکل در الگوی پیامک رخ داده است.',
            '-5' => 'تعداد پارامترهای پیامک با الگو مطابقت ندارد.',
            '-4' => 'کد الگوی پیامک صحیح نیست یا تأیید نشده است.',
            '-3' => 'سرشماره فرستنده یا شماره گیرنده معتبر نیست.',
            '-2' => 'تعداد شماره‌های گیرنده مجاز نیست.',
            '-1' => 'دسترسی وب‌سرویس غیرفعال است.',
            '0'  => 'نام کاربری یا رمز عبور صحیح نیست.',
            '2'  => 'موجودی پنل پیامک کافی نیست.',
            '5'  => 'شماره فرستنده معتبر نیست.',
            '6'  => 'سامانه پیامکی در حال بروزرسانی است.',
            '7'  => 'متن پیامک شامل کلمه فیلترشده است.',
            '10' => 'پنل پیامک فعال نیست یا مسدود شده است.',
            '11' => 'شماره گیرنده در لیست سیاه مخابرات است.',
            '12' => 'مدارک پنل پیامک کامل نیست.',
            default => 'خطای نامشخص در ارسال پیامک.',
        };
    }
}