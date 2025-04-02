<?php
ob_start();
require_once "Models/auth/CreateUserModels.php";

class CreateAccountController extends BaseController {
    private $CreateUserModels;

    public function __construct() {
        $this->CreateUserModels = new CreateUserModels();
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
            error_log("store() method called");

            // Sanitize input data
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = $_POST['password'] ?? '';
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            error_log("Input Data: " . print_r($_POST, true));
            error_log("File Data: " . print_r($_FILES, true));

            // Initialize errors array
            $errors = [];

            // Handle file upload for image (make it optional)
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/users/';
                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                    error_log("Failed to create upload directory: $uploadDir");
                } else {
                    $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                    $imagePath = $uploadDir . $imageName;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                        $image = $imagePath;
                        error_log("Image uploaded successfully: $imagePath");
                    } else {
                        error_log("Failed to upload image: " . print_r($_FILES['image'], true));
                    }
                }
            } else {
                error_log("No image uploaded or upload error: " . ($_FILES['image']['error'] ?? 'No image field'));
            }

            // Validation
            if (empty($username)) {
                $errors['username'] = 'Username is required';
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            } elseif ($this->CreateUserModels->emailExists($email)) {
                $errors['email'] = 'Email already exists';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 12) {
                $errors['password'] = 'Password must be at least 12 characters long';
            } elseif (preg_match('/\s/', $password)) {
                $errors['password'] = 'Password cannot contain spaces';
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors['password'] = 'Password must contain at least one uppercase letter';
            } elseif (!preg_match('/[a-z]/', $password)) {
                $errors['password'] = 'Password must contain at least one lowercase letter';
            } elseif (!preg_match('/[0-9]/', $password)) {
                $errors['password'] = 'Password must contain at least one number';
            } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
                $errors['password'] = 'Password must contain at least one special character (!@#$%^&*(),.?":{}|<>)';
            }

            if (empty($role)) {
                $errors['role'] = 'Role is required';
            }

            if (!empty($errors)) {
                error_log("Validation Errors: " . print_r($errors, true));
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
            error_log("Password hashed: $hashedPassword");

            // Add the user to the database
            try {
                error_log("Attempting to add user: username=$username, email=$email, role=$role, image=$image");
                $this->CreateUserModels->addUser($username, $hashedPassword, $role, $email, $image);
                error_log("User added successfully: $email");

                // Set user status to active
                $newUser = $this->CreateUserModels->getUserByEmail($email);
                if ($newUser && is_array($newUser) && isset($newUser['user_id'])) {
                    $this->CreateUserModels->setUserStatusActive($newUser['user_id']);
                    error_log("User status set to active: " . $newUser['user_id']);
                } else {
                    error_log("Failed to retrieve new user: " . print_r($newUser, true));
                }

                header('Location: /user_account?success=Account created successfully');
                exit();
            } catch (Exception $e) {
                error_log("Error in store(): " . $e->getMessage());
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
            error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
            header('Location: /create-account');
            exit();
        }
    }
}

ob_end_flush();