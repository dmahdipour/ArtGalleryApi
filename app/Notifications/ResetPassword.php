<?php

namespace App\Notifications;

use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $token
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $expire = config(
            'auth.passwords.' . config('auth.defaults.passwords') . '.expire'
        );

        return (new MailMessage)
            ->subject('بازیابی رمز عبور - سمفونی رنگ')
            ->greeting('سلام ' . ($notifiable->name ?? 'کاربر گرامی') . '!')
            ->line('درخواست بازیابی رمز عبور حساب کاربری شما در سمفونی رنگ ثبت شده است.')
            ->action(
                'بازیابی رمز عبور',
                Filament::getResetPasswordUrl($this->token, $notifiable)
            )
            ->line("این لینک تا {$expire} دقیقه معتبر است.")
            ->line('اگر شما این درخواست را ثبت نکرده‌اید، این ایمیل را نادیده بگیرید.')
            ->salutation('با احترام، سمفونی رنگ');
    }
}
