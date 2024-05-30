<?php
require_once '../controllers/UserController.php';
require_once '../controllers/TaskController.php';

// Simple router
$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?'); // Remove query string if exists

$userController = new UserController();

switch ($request) {
    case '/easytask/public/':
    case '/easytask/public/index.php':
        require __DIR__ . '/../views/home.php'; // Adjust as needed for your home page
        break;
    case '/easytask/public/login':
    case '/easytask/public/login.php':
        $controller = new UserController();
        $controller->login();
        break;
    case '/easytask/public/register':
    case '/easytask/public/register.php':
        $controller = new UserController();
        $controller->register();
        break;
    case '/easytask/public/tasks':
        $userController->requireAuth();
        $controller = new TaskController();
        $controller->userTasks();
        break;
    case '/easytask/public/updateTaskStatus':
        $userController->requireAuth();
        $controller = new TaskController();
        $controller->updateTaskStatus();
        break;
    case '/easytask/public/admin':
        $userController->requireAuth('admin');
        $controller = new TaskController();
        $controller->admin();
        break;
    case '/easytask/public/editTask':
        $userController->requireAuth('admin');
        $controller = new TaskController();
        $controller->edit();
        break;
        
    case '/easytask/public/createTask':
        $userController->requireAuth('admin');
        $controller = new TaskController();
        $controller->create();
        break;
    case '/easytask/public/deleteTask':
        $userController->requireAuth('admin');
        $controller = new TaskController();
        $controller->delete();
        break;
    case '/easytask/public/logout':
        $controller = new UserController();
        $controller->logout();
        break;
        case '/easytask/public/tasksy':
            $userController->requireAuth();
            $controller = new TaskController();
            $controller->userTasksWithSearchAndFilter();
            break;
        
    
    default:
        http_response_code(404);
        require __DIR__ . '/../views/404.php'; 
        break;
}
?>
