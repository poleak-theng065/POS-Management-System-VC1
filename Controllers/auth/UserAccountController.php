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
            'success' => isset($_GET['success']) ? $_GET['success'] : null // Get success message if exists
        ];
        $this->view('account/user_account', $data);
    }

        // In UserAccountController.php
    public function delete_user($id) {
        if ($this->authModel->deleteUser($id)) {
            header("Location: /user_account?success=User+deleted+successfully");
            exit();
        } else {
            header("Location: /user_account?error=Failed+to+delete+user");
            exit();
        }
    }

    public function edit_user_form($id) {
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
        $image = $_POST['image']; // Assuming image is passed as URL or handled via file upload
        $password = $_POST['password'] ?? ''; // Optional

        $this->authModel->updateUser($user_id, $username, $password, $role, $email, $image);

        header("Location: /user_account?success=User+updated+successfully");
        exit();
    }


}