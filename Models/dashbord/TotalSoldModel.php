<?php
require_once "Database/Database.php";

class TotalSoldModel
{
    private $db;

    public function __construct()
    {
        $host = getenv('DB_HOST') ?: "localhost";
        $dbname = getenv('DB_NAME') ?: "pos-system";
        $username = getenv('DB_USER') ?: "root";
        $password = getenv('DB_PASS') ?: "";

        try {
            $this->db = new Database($host, $dbname, $username, $password);
        } catch (Exception $e) {
            error_log("Failed to initialize database connection: " . $e->getMessage());
            throw new Exception("Unable to connect to database");
        }
    }

    
}
