<?php

declare(strict_types=1);

return [
    'only_send' => '※本メールは配信専用のアドレスで配信されています。<br>本メールに返信いただいても内容の確認及び返答はできませんので、ご了承ください。',
    /* ユーザー会員登録申請 */
    'apply' => [
        'user' => [
            'subject' => '【MOT2】会員登録申請を承りました。',

        ],
        'admin' => [
            'subject' => '【MOT2】会員登録申請が届いています。'
        ],
        'approved' => [
            'subject' => '【MOT2】会員登録申請が承認されました。'
        ]
    ],
];
