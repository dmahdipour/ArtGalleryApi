<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verification_code;

    public function __construct($verification_code)
    {
        $this->verification_code = $verification_code;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ارسال کد تایید Human Cipher',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verificationcode',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}