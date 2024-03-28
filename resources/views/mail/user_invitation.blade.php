<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>Password: {{ $password }}</p>
    <h1>Password Reset</h1>
    <p>Click the following link to reset your password:</p>
    <p><a href="{{ route('users.resetpasswordform', ['email' => $user->email]) }}">Reset Password</a></p>
    <p>If you didn't request this, please ignore this email.</p>
</body>
</html>
