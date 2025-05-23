<?php
require_once "Database/Database.php";

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "pos-system", "root", "PassWord@123!");
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
        return $result->fetchColumn() > 0;
    }

    public function verifyPassword($user_id, $password) {
        try {
            // Prepare and execute the query to get the password hash
            $query = "SELECT password_hash FROM users WHERE user_id = :user_id";
            $result = $this->db->query($query, ['user_id' => $user_id]);
            
            // Check if the user exists
            $user = $result->fetch(PDO::FETCH_ASSOC);
            
            if ($user === false) {
                // If no user is found, handle this gracefully
                return false; // User doesn't exist
            }
    
            // Verify the password using the hash from the database
            if (password_verify($password, $user['password_hash'])) {
                return true; // Password is correct
            }
    
            return false; // Password is incorrect
        } catch (PDOException $e) {
            // Log the error if the query fails
            error_log("Error verifying password: " . $e->getMessage());
            return false; // Return false in case of an exception
        }
    }
    

    public function updateUser($user_id, $username, $password, $role, $email, $image) {
        try {
            $params = [
                ':user_id' => $user_id,
                ':username' => $username,
                ':role' => $role,
                ':email' => $email,
                ':image' => $image
            ];
    
            if (!empty($password)) {
                $params[':password_hash'] = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE users 
                          SET username = :username, password_hash = :password_hash, role = :role, email = :email, image = :image 
                          WHERE user_id = :user_id";
            } else {
                $query = "UPDATE users 
                          SET username = :username, role = :role, email = :email, image = :image 
                          WHERE user_id = :user_id";
            }
    
            $this->db->query($query, $params);
            return true;
        } catch (PDOException $e) {
            echo "Error updating user: " . $e->getMessage();
            return false;
        }
    }


// Method to delete a user by ID
public function deleteUser($id) {
    $id = (int)$id; // Cast to integer for safety
    $result = $this->db->query("DELETE FROM users WHERE user_id = $id");
    return $result !== false;
}




    public function getUserByEmail($email) {
        $result = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $email]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getDeletedUsers() {
        $query = "SELECT user_id, username, email, role, deleted_by, deleted_at FROM deleted_users ORDER BY deleted_at ASC";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setUserStatusActive($userId) {
        try {
            $query = "UPDATE users SET status = :status WHERE user_id = :user_id";
            $params = [
                ':status' => 'Active',
                ':user_id' => $userId
            ];
            $this->db->query($query, $params);
            return true;
        } catch (PDOException $e) {
            echo "Error setting status to Active: " . $e->getMessage();
            return false;
        }
    }

    public function setUserStatusInactive($userId) {
        try {
            $query = "UPDATE users SET status = :status WHERE user_id = :user_id";
            $params = [
                ':status' => 'Inactive',
                ':user_id' => $userId
            ];
            $this->db->query($query, $params);
            return true;
        } catch (PDOException $e) {
            echo "Error setting status to Inactive: " . $e->getMessage();
            return false;
        }
    }

    public function getAllUserIds() {
        try {
            $query = "SELECT user_id FROM users ORDER BY user_id ASC";
            $result = $this->db->query($query);
            $userIds = $result->fetchAll(PDO::FETCH_COLUMN, 0);
            return array_map('strval', $userIds); // Convert to strings for array_search
        } catch (PDOException $e) {
            echo "Error fetching user IDs: " . $e->getMessage();
            return [];
        }
    }

    public function changePassword($user_id, $new_password) {
        try {
            // Hash the new password
            $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
            
            // Update the password hash in the database
            $query = "UPDATE users SET password_hash = :password_hash WHERE user_id = :user_id";
            $params = [
                ':password_hash' => $hashedPassword,
                ':user_id' => $user_id
            ];
            $this->db->query($query, $params);
            
            return true;
        } catch (PDOException $e) {
            echo "Error updating password: " . $e->getMessage();
            return false;
        }
    }
    
}
