<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

/*
 * ユーザー会員登録申請完了時のメール送信 - 管理者への送信
 */

class MailApplyAdmin extends Mailable
{
    use Queueable, SerializesModels;

    private $user = [];

    /**
     * Create a new message instance.
     */
    public function __construct(array $user_data)
    {
        $this->user = $user_data;
    }

    /**
     * Get the message envelope.
     * 送信元アドレス、送信元名
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'admin@test.test',
            subject: __('mails.apply.admin.subject'),
        );
    }

    /**
     * Get the message content definition.
     * メール本文の設定
     */
    public function content(): Content
    {
        return new Content(
            text: 'mails.apply.admin',
            with: [
                'user' => $this->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
