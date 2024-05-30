<?php
class User {
    private $conn;
    private $table_name = "user";

    public $id;
    public $email;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (Email, Password, Role) VALUES (:email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($password, $role) {
        $query = "SELECT ID, Email, Password, Role FROM " . $this->table_name . " WHERE Email = :email AND Role = :role LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['Password'] === $password) {  
                $this->id = $row['ID'];
                $this->role = $row['Role'];
                return true;
            }
        }
        return false;
    }
}
?>
