@component('mail::message')
{{ $mailData['title'] }}

Fullname: {{ $mailData['name'] }}<br>
Email: {{ $mailData['email'] }}<br>
Phone: {{ $mailData['phone'] }}<br>

{{ $mailData['body'] }}
@endcomponent