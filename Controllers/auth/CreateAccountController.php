<?php
require_once "Models/auth/AuthModel.php";

class CreateAccountController extends BaseController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    public function create_account() {
        $data = [
            'title' => 'Create Account',
            'errors' => [],
            'form_data' => []
        ];
        $this->view('account/create_account', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input data
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = $_POST['password_hash']; // Correct: Match the form field name
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            // Initialize errors array
            $errors = [];

            // Handle file upload for image
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/users/';
                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                    $errors['image'] = 'Failed to create upload directory';
                } else {
                    $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                    $imagePath = $uploadDir . $imageName;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                        $image = $imagePath;
                    } else {
                        $errors['image'] = 'Failed to upload image';
                    }
                }
            }

            // Validation
            if (empty($username)) {
                $errors['username'] = 'Username is required';
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            } elseif ($this->authModel->emailExists($email)) {
                $errors['email'] = 'Email already exists';
            }

            // Strong password validation
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters long';
            } elseif (!preg_match('/[A-Z]/', $password)) { // Fixed: Use $password
                $errors['password'] = 'Password must contain at least one uppercase letter';
            } elseif (!preg_match('/[a-z]/', $password)) { // Fixed: Use $password
                $errors['password'] = 'Password must contain at least one lowercase letter';
            } elseif (!preg_match('/[0-9]/', $password)) { // Fixed: Use $password
                $errors['password'] = 'Password must contain at least one number';
            } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) { // Fixed: Use $password
                $errors['password'] = 'Password must contain at least one special character';
            }

            if (empty($role)) {
                $errors['role'] = 'Role is required';
            }

            // If there are errors, return to form with error messages
            if (!empty($errors)) {
                $data = [
                    'title' => 'Create Account',
                    'errors' => $errors,
                    'form_data' => [
                        'username' => $username,
                        'role' => $role,
                        'email' => $email
                    ]
                ];
                $this->view('account/create_account', $data);
                return;
            }

            // Hash the password before storing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Add the user to the database
            try {
                $this->authModel->addUser($username, $hashedPassword, $role, $email, $image);

                // Set user status to active
                $newUser = $this->authModel->getUserByEmail($email);
                if ($newUser && is_array($newUser) && isset($newUser['user_id'])) {
                    $this->authModel->setUserStatusActive($newUser['user_id']);
                }

                // Redirect to user_account
                header('Location: /user_account?success=Account created successfully');
                exit();
            } catch (Exception $e) {
                $data = [
                    'title' => 'Create Account',
                    'errors' => ['general' => 'Error creating account: ' . $e->getMessage()],
                    'form_data' => [
                        'username' => $username,
                        'role' => $role,
                        'email' => $email
                    ]
                ];
                $this->view('account/create_account', $data);
            }
        } else {
            // If not POST, redirect to create account form
            header('Location: /create-account');
            exit();
        }
    }
}