<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Support;

class MailSupportAdmin extends Mailable
{
    use Queueable, SerializesModels;

    // サポートインスタンス格納用
    private $m_support;
    // メッセージデータ格納用
    private $message;
    /**
     * Create a new message instance.
     */
    public function __construct($tmp_message)
    {
        $this->m_support = new Support();
        $this->message = $tmp_message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: env('MAIL_FROM_ADDRESS'),
            subject: __('mails.support.subject_admin'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $message = $this->m_support->getMessageById($this->message->id);

        return new Content(
            view: 'mails.support.admin',
            with: [
                'message' => data_get($message, 'message'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
