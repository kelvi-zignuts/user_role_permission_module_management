<!-- resources/views/emails/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    @dd($user);
    <h2>Forgot Password</h2>
    <p>You have requested to reset your password. Please follow the instructions provided by your administrator.</p>
    <p><a href="{{ route('users.resetpasswordform',['email' => $user->email]) }}">Reset Password</a></p>

</body>
</html>
