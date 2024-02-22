<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLC Residences | Leasing - Login</title>
</head>
<body>
    <h1>Register</h1>
</body>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/auth/login" method="post">
        @csrf
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Login">
            <button><a href="/auth/register">Register</a></button>
        </div>
    </form>
</html>