<!DOCTYPE html>
<html>
<head>
    <title>RLC Leasing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        .card {
            border: 0.15rem solid black;
            border-radius: 0.7rem;
            width: 20vw;
            padding: 0 3rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card">
                    <h1>{{ $mailData['title'] }}</h1>
                    <h3>Fullname: {{ $mailData['fullname'] }}</h3>
                    <h3>Email: {{ $mailData['email'] }}</h3>
                    <h3>Contact Number: {{ $mailData['contact_number'] }}</h3>
                    <p>{{ $mailData['body'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>