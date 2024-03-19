<!DOCTYPE html>
<html>
<head>
    <title>RLC Leasing</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1><br>
    <h3>Fullname: {{ $mailData['fullname'] }}</h3>
    <h3>Email: {{ $mailData['email'] }}</h3>
    <h3>Contact Number: {{ $mailData['number'] }}</h3><br>
    <p>{{ $mailData['body'] }}</p>
</body>
</html>