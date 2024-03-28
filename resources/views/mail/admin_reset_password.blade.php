<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello {{ $user->first_name }},</p>
    <p>You have requested a password reset. Your new password is: {{ $password }}</p>
    <p>Please log in and change your password after logging in.</p>
</body>
</html>
