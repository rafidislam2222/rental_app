<?php
require_once "../config/database.php";

class Model {
    protected $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
}
?>
