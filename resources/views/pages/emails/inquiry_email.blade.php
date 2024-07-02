@component('mail::message')
<h1>{{ $mail_data['title'] }}</h1>

Fullname: {{ $mail_data['name'] }}<br>
Email: {{ $mail_data['email'] }}<br>
Phone: {{ $mail_data['phone'] }}<br>

Message: {{ $mail_data['body'] }}
@endcomponent