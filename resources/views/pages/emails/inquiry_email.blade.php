@component('mail::message')
<h1>{{ $mailData['title'] }}</h1>

Fullname: {{ $mailData['name'] }}<br>
Email: {{ $mailData['email'] }}<br>
Phone: {{ $mailData['phone'] }}<br>

{{ $mailData['body'] }}
@endcomponent