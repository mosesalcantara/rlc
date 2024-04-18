@component('mail::message')
Dear {{ $mailData['name'] }},

Your request for a viewing of Unit {{ $mailData['unit_id'] }} at {{ $mailData['property'] }}, scheduled on {{ $mailData['date'] }} at {{ $mailData['time'] }} was {{ $mailData['status'] }}.

Sincerely,<br>
RLC Residences
@endcomponent