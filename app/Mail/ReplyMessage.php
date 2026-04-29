<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class ReplyMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $replyContent;
    public $originalMessage;
    public $customSenderEmail; // Add dynamic sender property

    public function __construct($replyContent, Message $originalMessage)
    {
        $this->replyContent = $replyContent;
        $this->originalMessage = $originalMessage;
    }

    public function envelope(): Envelope
    {
        // If dynamic sender is set, use it. Otherwise fallback to global config.
        $fromEmail = $this->customSenderEmail ?? config('mail.from.address');
        
        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($fromEmail, config('app.name')),
            subject: 'Re: Your Message on Portfolio',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reply',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
