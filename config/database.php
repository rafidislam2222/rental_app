<?php
class Database {
    private $host = "localhost";
    private $db_name = "rental_system";
    private $username = "root"; // change if needed
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
