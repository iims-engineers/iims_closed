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
 * ユーザー会員登録申請完了時のメール送信 - ユーザーへの送信
 */

class MailApplyUser extends Mailable
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
            from: env('MAIL_FROM_ADDRESS'),
            subject: __('mails.apply.user.subject'),
        );
    }

    /**
     * Get the message content definition.
     * メール本文の設定
     */
    public function content(): Content
    {
        // テキストメールなので 'text': 'メールviewファイルのパス' の形式で設定
        return new Content(
            view: 'mails.apply.user',
            with: [
                'user' => $this->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     * ※メールに添付ファイルがある場合に使用するため、不要
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
