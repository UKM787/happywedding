@component('mail::message')
# Dear {{$key}},

We invite you wholeheartedly at the marriage of our daughter.

The login credentials are given as below:<br><br>
username: {{$value}}<br>
password: 123<br>

Request to change your password after login.<br>

@component('mail::button', ['url' => $link])
click to see invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
