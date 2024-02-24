<p>
    {{ Arr::get($user, 'name') }} 様より会員登録の申請がありました。<br>
    下記よりご確認ください。
</p>
<p>
    ============================<br>
    <a href="{{ route('admin.show.list') }}">会員登録申請のご確認はこちら</a><br>
    ============================
</p>
<p>
    【送信内容】<br>
    お名前：{{ Arr::get($user, 'name') }}<br>
    メールアドレス：{{ Arr::get($user, 'email') }}<br>
    過去のIIMS活動参加歴：{{ Arr::get($user, 'past-join') }}
</p>
<br>
<br>
<p>
    {{ __('mails.only_send') }}
</p>