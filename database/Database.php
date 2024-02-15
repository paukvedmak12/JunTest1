<?php
class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        require_once 'db_config.php';  

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($this->connection->connect_error) {
            die('Database connection failed: ' . $this->connection->connect_error);
        }
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function query($sql, $params = []) {

        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            die('Error in prepared statement: ' . $this->connection->error);
        }
        
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); 
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die('Error executing query: ' . $this->connection->error);
        }

        return $result;
    }
}
