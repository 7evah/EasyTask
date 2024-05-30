<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Register</h2>
    <form action="/easytask/public/register" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="/easytask/public/login">Already have an account? Login</a>
</body>
</html>
