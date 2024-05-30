<?php
require_once '../config/database.php';
require_once '../models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
            $this->user->email = $_POST['email'];
            $this->user->password = $_POST['password'];  
            $this->user->role = 'user';  // Default role

            if ($this->user->create()) {
                header('Location: /easytask/public/login');
                exit();
            } else {
                echo "Error: User could not be created.";
            }
        } else {
            require_once '../views/users/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
            $this->user->email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if ($this->user->login($password, $role)) {
                session_start();
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['user_role'] = $this->user->role;

                // Debug output
                echo "Session User ID: " . $_SESSION['user_id'] . "<br>";
                echo "Session User Role: " . $_SESSION['user_role'] . "<br>";

                if ($_SESSION['user_role'] === 'admin') {
                    header('Location: /easytask/public/admin');
                } else {
                    header('Location: /easytask/public/tasks');
                }
                exit();
            } else {
                echo "Invalid email, password, or role.";
            }
        } else {
            require_once '../views/users/login.php';
        }
    }

    public function requireAuth($requiredRole = null) {
        session_start();

        // Debug output
        echo "Require Auth Check<br>";
        echo "Session User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set') . "<br>";
        echo "Session User Role: " . (isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Not set') . "<br>";
        echo "Required Role: " . $requiredRole . "<br>";

        if (!isset($_SESSION['user_id'])) {
            header('Location: /easytask/public/login');
            exit();
        }

        if ($requiredRole && $_SESSION['user_role'] !== $requiredRole) {
            header('Location: /easytask/public/login');
            exit();
        }
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /easytask/public/login');
        exit();
    }
    
}
?>
