<p>
    会員よりメッセージが届きました。<br>
    下記よりご確認ください。
</p>
<p>
    ============================<br>
    <a href="{{ route('admin.show.list') }}">会員登録申請のご確認はこちら</a><br>
    ============================
</p>
<p>
    【送信内容】<br>
    {!! nl2br(htmlspecialchars(Arr::get($support, 'message'))) !!}
</p>
<br>
<br>
<p>
    {{ __('mails.only_send_first') }}<br>
    {{ __('mails.only_send_second') }}
</p>