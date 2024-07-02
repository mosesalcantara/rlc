@component('mail::message')
<h1 style="text-align: center">{{ $mail_data['title'] }}</h1>
<p style="text-align: center">{{ $mail_data['body'] }}</p>
@endcomponent