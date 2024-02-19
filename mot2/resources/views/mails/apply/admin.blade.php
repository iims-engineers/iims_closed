{{ Arr::get($user, 'name') }} 様より会員登録の申請がありました。
下記よりご確認ください。

{管理画面URL}

【送信内容】
お名前：{{ Arr::get($user, 'name') }}
メールアドレス：{{ Arr::get($user, 'email') }}
過去のIIMS活動参加歴：{{ Arr::get($user, 'past-join') }}