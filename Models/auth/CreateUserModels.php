<?php
require_once "Database/Database.php";

class CreateUserModels {
    private $db;

    public function __construct() {
        try {
            // Use environment variables or config file in production
            $this->db = new Database("localhost", "pos-system", "root", "");
            $this->db->query("SELECT 1");
            error_log("Database connection test successful");
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getUsers() {
        try {
            $result = $this->db->query("SELECT * FROM users");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getUsers(): " . $e->getMessage());
            throw new Exception("Error fetching users: " . $e->getMessage());
        }
    }

    public function getUserById($user_id) {
        try {
            $result = $this->db->query("SELECT * FROM users WHERE user_id = :user_id", ['user_id' => $user_id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getUserById($user_id): " . $e->getMessage());
            throw new Exception("Error fetching user: " . $e->getMessage());
        }
    }

    public function emailExists($email) {
        try {
            $query = "SELECT COUNT(*) FROM users WHERE email = :email";
            $result = $this->db->query($query, ['email' => $email]);
            $count = $result->fetchColumn();
            error_log("emailExists($email): Count = $count");
            return $count > 0;
        } catch (PDOException $e) {
            error_log("Error in emailExists($email): " . $e->getMessage());
            throw new Exception("Error checking email: " . $e->getMessage());
        }
    }

    public function addUser($username, $hashedPassword, $role, $email, $image) {
        try {
            if (empty($username) || empty($hashedPassword) || empty($email)) {
                throw new Exception("Required fields cannot be empty");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format");
            }
            $query = "INSERT INTO users (username, password_hash, role, email, image) 
                      VALUES (:username, :password_hash, :role, :email, :image)";
            $params = [
                ':username' => $username,
                ':password_hash' => $hashedPassword,
                ':role' => $role,
                ':email' => $email,
                ':image' => $image
            ];
            $result = $this->db->query($query, $params);
            error_log("User inserted successfully into database");
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error in addUser(): " . $e->getMessage());
            throw new Exception("Error adding user: " . $e->getMessage());
        }
    }

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $result = $this->db->query($query, ['email' => $email]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
            error_log("getUserByEmail($email): " . print_r($user, true));
            return $user;
        } catch (PDOException $e) {
            error_log("Error in getUserByEmail($email): " . $e->getMessage());
            throw new Exception("Error fetching user by email: " . $e->getMessage());
        }
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
?>