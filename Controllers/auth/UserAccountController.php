<?php
require_once ("Models/auth/AuthModel.php");

class UserAccountController extends BaseController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel(); // Assuming AuthModel is available
    }

    // Display the user account page (form + user list)
    public function user_account() {
        
        $data = [
            'title' => 'User Accounts',
            'users' => $this->authModel->getUsers(), // Fetch all users
            'errors' => [],
            'form_data' => [],
            'success' => isset($_GET['success']) ? $_GET['success'] : null, // Get success message if exists
        ];
        $this->view('account/user_account', $data);
    }

        // Delete UserAccount
        public function delete_user() {
            $id = $_POST['id'] ?? null;
        
            if (!$id) {
                header("Location: /user_account?error=No+User+ID+Provided");
                exit();
            }
        
            $user = $this->authModel->getUserById($id);
        
            if (!$user) {
                header("Location: /user_account?error=User+not+found");
                exit();
            }
        
            if ($this->authModel->deleteUser($id)) {
                header("Location: /user_account?success=User+deleted+successfully");
            } else {
                header("Location: /user_account?error=Failed+to+delete+user");
            }
            exit();
        }
        
        

    public function edit_user_form($id) {
        if (empty($id) || !is_numeric($id)) {
            header("Location: /user_account?error=Invalid+user+ID");
            exit();
        }
    
        $user = $this->authModel->getUserById($id);
        if (!$user) {
            header("Location: /user_account?error=User+not+found");
            exit();
        }
    
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];
    
        $this->view('account/edit_user', $data);
    }

    

    public function update_user() {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $image = $_POST['image'];
        $new_password = $_POST['password'] ?? '';
        $old_password = $_POST['old_password'] ?? '';
    
        // Get current user data from the DB
        $user = $this->authModel->getUserById($user_id);
    
        if (!$user) {
            header("Location: /user_account?error=User+not+found");
            exit();
        }
    
        // Password change logic
        if (!empty($new_password)) {
            if (empty($old_password)) {
                header("Location: /user_account?error=Old+password+is+required+to+change+password");
                exit();
            }
    
            if (!password_verify($old_password, $user['password'])) {
                header("Location: /user_account?error=Old+password+is+incorrect");
                exit();
            }
    
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $user['password']; // keep existing
        }
    
        // Proceed with update
        $this->authModel->updateUser($user_id, $username, $hashed_password, $role, $email, $image);
    
        header("Location: /user_account?success=User+updated+successfully");
        exit();
    }
    

    public function view_user($id) {
        if (empty($id) || !is_numeric($id)) {
            header("Location: /user_account?error=Invalid+user+ID");
            exit();
        }
    
        $user = $this->authModel->getUserById($id);
        if (!$user) {
            header("Location: /user_account?error=User+not+found");
            exit();
        }
    
        // Fetch all user IDs for navigation
        $allUserIds = $this->authModel->getAllUserIds();
        $currentIndex = array_search($id, $allUserIds);
    
        // Determine previous and next user IDs
        $prevUserId = $currentIndex > 0 ? $allUserIds[$currentIndex - 1] : null;
        $nextUserId = $currentIndex < count($allUserIds) - 1 ? $allUserIds[$currentIndex + 1] : null;
    
        $data = [
            'title' => 'User Profile',
            'user' => $user,
            'prevUserId' => $prevUserId,
            'nextUserId' => $nextUserId
        ];
    
        $this->view('account/view', $data);
    }

    
    
    
    
    
}