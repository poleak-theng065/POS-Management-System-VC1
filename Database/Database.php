<?php

class Database
{
    private $db;

    /**
     * Constructor to initialize the database connection.
     *
     * @param string $host The hostname of the database server.
     * @param string $dbname The name of the database.
     * @param string $username The username for the database connection.
     * @param string $password The password for the database connection.
     */
    public function __construct($host, $dbname, $username, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Executes a SQL query with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return PDOStatement|false The result of the executed query.
     */
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo "❌ Query error: " . $e->getMessage();
            return false;
        }
    }
}

// Database credentials
$host = "localhost"; // Change if using a remote server
$dbname = "inventorydb"; // Replace with your database name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password


