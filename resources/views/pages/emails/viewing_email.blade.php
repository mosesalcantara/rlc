@component('mail::message')
<h2>Dear {{ $mail_data['name'] }},</h2>

Your request for a viewing of Unit {{ $mail_data['unit_id'] }} at {{ $mail_data['property'] }}, scheduled on {{ $mail_data['date'] }} at {{ $mail_data['time'] }} was {{ $mail_data['status'] }}.

<h2>Sincerely,</h2>
<h2>RLC Residences</h2>
@endcomponent