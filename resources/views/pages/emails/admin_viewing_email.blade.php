@component('mail::message')
<h2>Request Viewing</h2>
{{ $mail_data['name'] }} has requested a viewing of Unit {{ $mail_data['unit_id'] }} at {{ $mail_data['property'] }} on {{ $mail_data['date'] }} at {{ $mail_data['time'] }}. <br><br>

<h2>Message</h2>
{{ $mail_data['message'] }}

<div style="display:flex;">
@component('mail::button', ['url' => "https://rlccorp.online/admin/viewings/approve/" . $mail_data['id'], 'color' => 'green'])
Accept
@endcomponent

@component('mail::button', ['url' => "https://rlccorp.online/admin/viewings/decline/" . $mail_data['id'], 'color' => 'red'])
Decline
@endcomponent
</div>

@endcomponent