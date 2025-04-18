<?php
require_once "Models/auth/AuthModel.php";

class ChangePasswordController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    private function validatePassword($password) {
        if (empty($password)) return 'Password is required';
        if (strlen($password) < 8) return 'Password must be at least 8 characters long';
        if (!preg_match('/[A-Z]/', $password)) return 'Must include one uppercase letter';
        if (!preg_match('/[a-z]/', $password)) return 'Must include one lowercase letter';
        if (!preg_match('/[0-9]/', $password)) return 'Must include one number';
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) return 'Must include one special character';
        return null;
    }

    public function change_password_page() {
        session_start();
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $data = [
            'title' => 'Change Password',
            'errors' => [],
            'csrf_token' => $_SESSION['csrf_token']
        ];
        $this->view('account/change_password', $data);
    }

    public function update_password() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /change-password');
            exit();
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $data = [
                'title' => 'Change Password',
                'errors' => ['general' => 'Invalid CSRF token'],
                'csrf_token' => $_SESSION['csrf_token']
            ];
            $this->view('account/change_password', $data);
            return;
        }

        $user_id = $_SESSION['user_id'] ?? null; // Assumes user_id is stored in session
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        $errors = [];

        if (!$user_id) {
            $errors['general'] = 'User not logged in';
        } elseif (!$this->authModel->verifyPassword($user_id, $current_password)) {
            $errors['current_password'] = 'Current password is incorrect';
        }

        $passwordError = $this->validatePassword($new_password);
        if ($passwordError) {
            $errors['new_password'] = $passwordError;
        }

        if ($new_password !== $confirm_password) {
            $errors['confirm_password'] = 'New password and confirm password do not match';
        }

        if (!empty($errors)) {
            $data = [
                'title' => 'Change Password',
                'errors' => $errors,
                'csrf_token' => $_SESSION['csrf_token']
            ];
            $this->view('account/change_password', $data);
            return;
        }

        // Everything validated, change password
        if ($this->authModel->changePassword($user_id, $new_password)) {
            header('Location: /user_account?success=Password changed successfully');
            exit();
        } else {
            $data = [
                'title' => 'Change Password',
                'errors' => ['general' => 'Failed to update password. Please try again.'],
                'csrf_token' => $_SESSION['csrf_token']
            ];
            $this->view('account/change_password', $data);
        }
    }

    private function view($view, $data) {
        extract($data);
        require_once "views/$view.php"; // Same view system as your CreateAccountController
    }
}
?>
