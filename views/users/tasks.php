<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tasks</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Your Tasks</h2>

    <form method="GET" action="/easytask/public/tasksy">
        <input type="text" name="search" placeholder="Search by title" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <select name="priority">
            <option value="">All Priorities</option>
            <option value="low" <?php if (isset($_GET['priority']) && $_GET['priority'] == 'low') echo 'selected'; ?>>Low</option>
            <option value="med" <?php if (isset($_GET['priority']) && $_GET['priority'] == 'med') echo 'selected'; ?>>Medium</option>
            <option value="urgent" <?php if (isset($_GET['priority']) && $_GET['priority'] == 'urgent') echo 'selected'; ?>>Urgent</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['descp']; ?></td>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <form action="/easytask/public/updateTaskStatus" method="POST">
                        <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                        <select name="status">
                            <option value="inprogress" <?php if ($row['status'] == 'inprogress') echo 'selected'; ?>>In Progress</option>
                            <option value="completed" <?php if ($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="/easytask/public/logout">Logout</a>
</body>
</html>
