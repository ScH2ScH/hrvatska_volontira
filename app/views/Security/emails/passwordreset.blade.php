<h1>{{ Lang::get('confide.email.password_reset.subject') }}</h1>

<p>{{ Lang::get('confide.email.password_reset.greetings', array( 'name' => $user['username'])) }},</p>

<p>{{ Lang::get('confide.email.password_reset.body') }}</p>
<a href='{{ URL::route('User.ResetPassword.Get', $token) }}'>
    {{ URL::route('User.ResetPassword.Get', $token) }}
</a>

<p>{{ Lang::get('confide.email.password_reset.farewell') }}</p>
<hr>