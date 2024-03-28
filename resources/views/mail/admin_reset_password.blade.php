<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your password has been reset successfully. Your new password is: {{ $password }}</p>
    <p><a href="{{ route('auth-login-basic') }}">Log In</a></p>
    <p>Thank you!</p>
</body>
</html>
