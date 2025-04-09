<?php
ob_start();
require_once "Models/auth/CreateUserModels.php";

class CreateAccountController { // Assuming BaseController is not needed if not provided
    private $userModel;

    public function __construct() {
        $this->userModel = new CreateUserModels();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    public function create_account() {
        session_start();
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $data = [
            'title' => 'Create Account',
            'errors' => [],
            'form_data' => [],
            'csrf_token' => $_SESSION['csrf_token']
        ];
        $this->view('account/create_account', $data);
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

    public function store() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /create-account');
            exit();
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $data = [
                'title' => 'Create Account',
                'errors' => ['general' => 'Invalid CSRF token'],
                'form_data' => []
            ];
            $this->view('account/create_account', $data);
            return;
        }

        $username = htmlspecialchars(trim($_POST['username'] ?? ''));
        $password = $_POST['password'] ?? '';
        $role = htmlspecialchars(trim($_POST['role'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $errors = [];
        $image = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/users/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024;

            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                $errors['image'] = 'Only JPEG, PNG, and GIF files are allowed';
            } elseif ($_FILES['image']['size'] > $maxSize) {
                $errors['image'] = 'Image must be less than 5MB';
            } else {
                if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
                $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $errors['image'] = 'Failed to upload image';
                } else {
                    $image = $imagePath;
                }
            }
        } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $errors['image'] = 'Error uploading image: ' . $_FILES['image']['error'];
        }

        if (empty($username)) $errors['username'] = 'Username is required';
        $passwordError = $this->validatePassword($password);
        if ($passwordError) $errors['password'] = $passwordError;
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required';
        } elseif ($this->userModel->emailExists($email)) {
            $errors['email'] = 'Email already exists';
        }
        $validRoles = ['admin', 'cashier', 'employee']; // Match form options
        if (empty($role) || !in_array($role, $validRoles)) $errors['role'] = 'Please select a valid role';

        if (!empty($errors)) {
            $data = [
                'title' => 'Create Account',
                'errors' => $errors,
                'form_data' => [
                    'username' => $username,
                    'role' => $role,
                    'email' => $email
                ],
                'csrf_token' => $_SESSION['csrf_token']
            ];
            $this->view('account/create_account', $data);
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $userId = $this->userModel->addUser($username, $hashedPassword, $role, $email, $image);
            $newUser = $this->userModel->getUserByEmail($email);
            if ($newUser && isset($newUser['user_id'])) {
                $this->userModel->setUserStatusActive($newUser['user_id']);
            }
            header('Location: /user_account?success=Account created successfully');
            exit();
        } catch (Exception $e) {
            error_log("Exception in store(): " . $e->getMessage());
            $data = [
                'title' => 'Create Account',
                'errors' => ['general' => 'Error creating account: ' . $e->getMessage()],
                'form_data' => [
                    'username' => $username,
                    'role' => $role,
                    'email' => $email
                ],
                'csrf_token' => $_SESSION['csrf_token']
            ];
            $this->view('account/create_account', $data);
        }
    }

    // Placeholder for view method (assuming it renders a template)
    private function view($view, $data) {
        extract($data);
        require_once "views/$view.php"; // Adjust path as needed
    }
}
?>