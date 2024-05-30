<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Tasks</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Admin Task Management</h2>
    <a href="/easytask/public/createTask">Add New Task</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>User ID</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['descp']; ?></td>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td>
                    <a href="/easytask/public/editTask?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="/easytask/public/deleteTask?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="/easytask/public/logout">Logout</a>
</body>
</html>
