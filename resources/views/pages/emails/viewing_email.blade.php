@component('mail::message')
<h2>Dear {{ $mailData['name'] }},</h2>

Your request for a viewing of Unit {{ $mailData['unit_id'] }} at {{ $mailData['property'] }}, scheduled on {{ $mailData['date'] }} at {{ $mailData['time'] }} was {{ $mailData['status'] }}.

<h2>Sincerely,</h2>
<h2>RLC Residences</h2>
@endcomponent