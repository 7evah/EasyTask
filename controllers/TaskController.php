<?php
require_once '../config/database.php';
require_once '../models/Task.php';

class TaskController {
    private $db;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
    }
    public function edit() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /easytask/public/login');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $task_id = $_GET['id'];
            // Retrieve the task details from the database
            $this->task->id = $task_id;
            $taskDetails = $this->task->readOne(); // Implement readOne method in Task model to fetch task details by ID
    
            if ($taskDetails) {
                require_once '../views/admin/edit.php'; // Create the edit view file to display the form
            } else {
                echo "Error: Task not found.";
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->task->id = $_POST['id'];
            $this->task->title = $_POST['title'];
            $this->task->desc = $_POST['desc'];
            $this->task->priority = $_POST['priority'];
            $this->task->status = $_POST['status'];
            $this->task->user_id = $_POST['user_id'];
    
            if ($this->task->update()) {
                header('Location: /easytask/public/admin');
                exit();
            } else {
                echo "Error: Could not update task.";
            }
        } else {
            echo "Invalid request.";
        }
    }
    
    

    public function admin() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /easytask/public/login');
            exit();
        }

        $result = $this->task->readAll();

        require_once '../views/admin/tasks.php';
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /easytask/public/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['priority']) && isset($_POST['user_id'])) {
            $this->task->title = $_POST['title'];
            $this->task->desc = $_POST['desc'];
            $this->task->priority = $_POST['priority'];
            $this->task->status = 'inprogress';  // Default status
            $this->task->user_id = $_POST['user_id'];

            if ($this->task->create()) {
                header('Location: /easytask/public/admin');
                exit();
            } else {
                echo "Error: Could not create task.";
            }
        } else {
            require_once '../views/admin/create.php';
        }
    }

    public function delete() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /easytask/public/login');
            exit();
        }

        if (isset($_GET['id'])) {
            $this->task->id = $_GET['id'];

            if ($this->task->delete()) {
                header('Location: /easytask/public/admin');
                exit();
            } else {
                echo "Error: Could not delete task.";
            }
        }
    }


    public function userTasks() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /easytask/public/login');
            exit();
        }

        $this->task->user_id = $_SESSION['user_id'];
        $result = $this->task->readByUser();
        require_once '../views/users/tasks.php';
    }
    public function userTasksWithSearchAndFilter() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /easytask/public/login');
            exit();
        }
    
        $this->task->user_id = $_SESSION['user_id'];
    
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $priority = isset($_GET['priority']) ? $_GET['priority'] : '';
    
        $result = $this->task->searchAndFilter($search, $priority);
        require_once '../views/users/tasks.php';
    }
    

    public function updateTaskStatus() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /easytask/public/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id']) && isset($_POST['status'])) {
            $this->task->id = $_POST['task_id'];
            $this->task->status = $_POST['status'];

            if ($this->task->updateStatus()) {
                header('Location: /easytask/public/tasks');
                exit();
            } else {
                echo "Error: Could not update task status.";
            }
        }
    }
    
}

?>
