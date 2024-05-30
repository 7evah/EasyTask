<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Login</h2>
    <form action="/easytask/public/login" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <button type="submit">Login</button>
    </form>
    <a href="/easytask/public/register">Don't have an account? Register</a>
</body>
</html>
