<!-- views/admin/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="/easytask/public/css/styles.css">
</head>
<body>
    <h2>Edit Task</h2>
    <form action="/easytask/public/editTask" method="post">
        <input type="hidden" name="id" value="<?php echo $taskDetails['id']; ?>">
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $taskDetails['title']; ?>"><br><br>
        
        <label for="desc">Description:</label><br>
        <textarea id="desc" name="desc"><?php echo $taskDetails['descp']; ?></textarea><br><br>
        
        <label for="priority">Priority:</label>
        <select id="priority" name="priority">
            <option value="low" <?php echo $taskDetails['priority'] == 'low' ? 'selected' : ''; ?>>Low</option>
            <option value="med" <?php echo $taskDetails['priority'] == 'med' ? 'selected' : ''; ?>>Medium</option>
            <option value="urgent" <?php echo $taskDetails['priority'] == 'urgent' ? 'selected' : ''; ?>>Urgent</option>
        </select><br><br>
        
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="inprogress" <?php echo $taskDetails['status'] == 'inprogress' ? 'selected' : ''; ?>>In Progress</option>
            <option value="completed" <?php echo $taskDetails['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
        </select><br><br>
        
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" value="<?php echo $taskDetails['user_id']; ?>"><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
