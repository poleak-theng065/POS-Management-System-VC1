<?php
require_once "Database/Database.php";

class CreateUserModels {
    private $db;

    public function __construct() {
        try {
            $this->db = new Database("localhost", "pos-system", "root", "");
            $this->db->query("SELECT 1");
            error_log("Database connection test successful");
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getUsers() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($user_id) {
        $result = $this->db->query("SELECT * FROM users WHERE user_id = :user_id", ['user_id' => $user_id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $result = $this->db->query($query, ['email' => $email]);
        $count = $result->fetchColumn();
        error_log("emailExists($email): Count = $count");
        return $count > 0;
    }

    public function addUser($username, $password_hash, $role, $email, $image) {
        try {
            $query = "INSERT INTO users (username, password_hash, role, email, image) VALUES (:username, :password_hash, :role, :email, :image)";
            $params = [
                ':username' => $username,
                ':password_hash' => $password_hash,
                ':role' => $role,
                ':email' => $email,
                ':image' => $image
            ];
            error_log("Executing query: $query with params: " . print_r($params, true));
            $this->db->query($query, $params);
            error_log("User inserted successfully into database");
        } catch (PDOException $e) {
            error_log("Error in addUser(): " . $e->getMessage());
            throw new Exception("Error adding user: " . $e->getMessage());
        }
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($query, ['email' => $email]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        error_log("getUserByEmail($email): " . print_r($user, true));
        return $user;
    }

    public function setUserStatusActive($userId) {
        try {
            $query = "UPDATE users SET status = :status WHERE user_id = :user_id";
            $params = [
                ':status' => 'Active',
                ':user_id' => $userId
            ];
            $this->db->query($query, $params);
            error_log("User status set to Active: user_id=$userId");
        } catch (PDOException $e) {
            error_log("Error in setUserStatusActive(): " . $e->getMessage());
            throw new Exception("Error updating status: " . $e->getMessage());
        }
    }
}