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
            error_log("Database connection successful to: $dbname");
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            die("Connection failed: " . $e->getMessage());
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

    /**
     * Begins a database transaction.
     */
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    /**
     * Commits the current transaction.
     */
    public function commit()
    {
        return $this->db->commit();
    }

    /**
     * Rolls back the current transaction.
     */
    public function rollBack()
    {
        return $this->db->rollBack();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * Fetches a single row from the result set.
     *
     * @return array|null The fetched row as an associative array, or null if no row is found.
     */
    public function single($stmt)
    {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetches all rows from the result set.
     *
     * @return array The fetched rows as an array of associative arrays.
     */
    public function resultSet($stmt)
    {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}