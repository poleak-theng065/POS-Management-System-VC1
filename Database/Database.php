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
        $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Executes a SQL query with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params The parameters to bind to the query.
     * @return PDOStatement The result of the executed query.
     */
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    
}
// class Database
// {
//     private $pdo;

//     public function __construct($host, $dbname, $username, $password)
//     {
//         try {
//             $this->pdo = new PDO(
//                 "mysql:host=$host;dbname=$dbname;charset=utf8",
//                 $username,
//                 $password,
//                 [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//             );
//         } catch (PDOException $e) {
//             error_log("Database Connection Error: " . $e->getMessage());
//             throw new Exception("Failed to connect to the database: " . $e->getMessage());
//         }
//     }

//     public function query($sql, $params = [])
//     {
//         try {
//             $stmt = $this->pdo->prepare($sql);
//             $stmt->execute($params);
//             return $stmt;
//         } catch (PDOException $e) {
//             error_log("PDO Query Error: " . $e->getMessage());
//             throw $e;
//         }
//     }
// }