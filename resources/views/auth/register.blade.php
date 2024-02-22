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

    <form action="/auth/register" method="post">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="password_confirmation">
        </div>
        <div>
            <input type="submit" value="Register">
            <button><a href="/auth">Login</a></button>
        </div>
    </form>
</html>