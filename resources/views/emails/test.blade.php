<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Created</title>
</head>

<body>
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc;">
        <h2>Welcome to Medlog's Tranport Manager System!</h2>
        <p>Hello {{ $user->name }},</p>
        <p>Your account has been successfully created by the administrator.</p>
        <p> Here are your login credentials:</p>
        <ul>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Password:</strong> password </li>
        </ul>

        <p>Please login using the provided credentials and consider changing your password after the first login for
            security reasons.</p>

        <p>If you have any questions or concerns, feel free to contact our support team.</p>

        <p>Best regards.</p>
    </div>
</body>

</html>
