@component('mail::message')
<h1>RLC Announcement</h1>
<h2>{{ $mail_data['title'] }}</h2>
{{ $mail_data['body'] }}
@endcomponent