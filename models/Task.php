<?php
class Task {
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $title;
    public $desc;
    public $priority;
    public $status;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, descp=:desc, priority=:priority, status=:status, user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":desc", $this->desc);
        $stmt->bindParam(":priority", $this->priority);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row
    }
    
    public function readByUser() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function updateStatus() {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
   
    
    
    

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title = :title, descp = :desc, priority = :priority, status = :status, user_id = :user_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':desc', $this->desc);
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':id', $this->id);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
    
    public function searchAndFilter($search, $priority) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        
        if (!empty($search)) {
            $query .= " AND title LIKE :search";
        }
        if (!empty($priority)) {
            $query .= " AND priority = :priority";
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
    
        if (!empty($search)) {
            $search = "%$search%";
            $stmt->bindParam(':search', $search);
        }
        if (!empty($priority)) {
            $stmt->bindParam(':priority', $priority);
        }
    
        $stmt->execute();
        return $stmt;
    }
    

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
