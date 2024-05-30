<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Create New Task</h2>
    <form action="/easytask/public/createTask" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="desc" placeholder="Description" required></textarea>
        <select name="priority" required>
            <option value="low">Low</option>
            <option value="med">Medium</option>
            <option value="urgent">Urgent</option>
        </select>
        <input type="number" name="user_id" placeholder="User ID" required>
        <button type="submit">Create</button>
    </form>
    <a href="/easytask/public/admin">Back to Admin</a>
</body>
</html>
