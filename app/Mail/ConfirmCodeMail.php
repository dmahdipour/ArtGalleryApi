<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $confirm_code;

    public function __construct($confirm_code)
    {
        $this->confirm_code = $confirm_code;
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
            view: 'emails.confirmcode',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}