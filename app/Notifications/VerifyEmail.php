<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends BaseNotification implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('تأیید آدرس ایمیل - سمفونی رنگ')
            ->greeting('سلام ' . ($notifiable->name ?? '') . '!')
            ->line('برای تکمیل ثبت‌نام در سمفونی رنگ، لطفاً آدرس ایمیل خود را تأیید کنید.')
            ->action(
                'تأیید آدرس ایمیل',
                $this->verificationUrl($notifiable)
            )
            ->line('اگر شما این حساب کاربری را ایجاد نکرده‌اید، نیازی به انجام هیچ کاری نیست.')
            ->salutation('با احترام، سمفونی رنگ');
    }
}