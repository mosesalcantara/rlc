@component('mail::message')
<h2>Request Viewing</h2>
{{ $mailData['name'] }} has requested a viewing of Unit {{ $mailData['unit_id'] }} at {{ $mailData['property'] }} on {{ $mailData['date'] }} at {{ $mailData['time'] }}. <br><br>

<h2>Message</h2>
{{ $mailData['message'] }}

<div style="display:flex;">
@component('mail::button', ['url' => "https://rlccorp.online/admin/viewings/approve/" . $mailData['id'], 'color' => 'green'])
Accept
@endcomponent

@component('mail::button', ['url' => "https://rlccorp.online/admin/viewings/decline/" . $mailData['id'], 'color' => 'red'])
Decline
@endcomponent
</div>

@endcomponent