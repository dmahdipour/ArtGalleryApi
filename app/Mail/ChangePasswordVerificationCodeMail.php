<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChangePasswordConfirmCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $change_password_verification_code;

    public function __construct($change_password_verification_code)
    {
        $this->change_password_verification_code = $change_password_verification_code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ارسال کد تایید تغییر رمز کاربری Human Cipher',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.passwordverificationcode',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}