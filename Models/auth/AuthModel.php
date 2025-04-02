<?php
require_once "Database/Database.php";
class AuthModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "");
    }

    public function getUsers() {
        $result = $this->db->query("SELECT * FROM users");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($user_id ) {
        $result = $this->db->query("SELECT * FROM users WHERE user_id  = :user_id ", ['user_id ' => $user_id ]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Check if the email already exists
    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $result = $this->db->query($query, ['email' => $email]);
        return $result->fetchColumn() > 0; // Return true if count is greater than 0
    }

    public function addUser($username, $password_hash, $role, $email, $image) {
        try {
            $this->db->query(
                "INSERT INTO users (username, password_hash, role, email, image) VALUES (:username, :password_hash, :role, email, :image)",
                [
                    ':username' => $username,
                    ':password_hash' => $password_hash,
                    ':role' => $role,
                    ':email' => $email,
                    ':image' => $image
                ]
            );
        } catch (PDOException $e) {
            echo "Error adding user: " . $e->getMessage();
        }
    }

    public function updateUser($user_id , $username, $password_hash, $role,$email, $image) {
        try {
            // Prepare the SQL update statement
            $query = "UPDATE users SET username = :username, password_hash = :password_hash, role = :role, email = :email,image = :image WHERE user_id  = :user_id ";
            $params = [
                ':user_id ' => $user_id,
                ':username' => $username,
                ':password_hash' => $password_hash,
                ':role' => $role,
                ':email' => $email,
                ':image' => $image
            ];

            // Only update the password if provided
            if (!empty($password_hash)) {
                $query = "UPDATE users SET username = :username, password_hash = :password_hash, role = :role, image = :image WHERE user_id  = :user_id ";
                $params[':password_hash'] = password_hash($password_hash, PASSWORD_DEFAULT); // Hash the password
            }

            // Execute the query
            $this->db->query($query, $params);
        } catch (PDOException $e) {
            echo "Error updating user: " . $e->getMessage();
        }
    }

    public function deleteUser($user_id ) {
        $result = $this->db->query("DELETE FROM users WHERE user_id  = :user_id ", ['user_id ' => $user_id ]);
        return $result;
    }

        // get user's email
    public function getUserByEmail($email) {
        $result = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getDeletedUsers() {
        $query = "SELECT user_id , username, email, role, deleted_by, deleted_at FROM deleted_users ORDER BY deleted_at ASC";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function setUserStatusActive($userId) {
        try {
            $query = "UPDATE users SET status = :status WHERE user_id  = :user_id ";
            $params = [
                ':status' => 'Active',
                ':user_id ' => $userId
            ];
            $this->db->query($query, $params);
        } catch (PDOException $e) {
            echo "Error updating status: " . $e->getMessage();
        }
    }


    public function setUserStatusInactive($userId) {
        try {
            $query = "UPDATE users SET status = :status WHERE user_id  = :user_id ";
            $params = [
                ':status' => 'Inactive',
                ':user_id ' => $userId
            ];
            $this->db->query($query, $params);
        } catch (PDOException $e) {
            echo "Error updating status: " . $e->getMessage();
        }
    }

}