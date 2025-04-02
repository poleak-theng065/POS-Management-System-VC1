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

    // Handle form submission and redirect to user_account
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input data
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password_hash = $_POST['password_hash']; // Ensure this matches your input field name
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            // Handle file upload
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/users/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
                }
                $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                $imagePath = $uploadDir . $imageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = $imagePath;
                }
            }

            // Validation
            $errors = [];
            if (empty($username)) $errors['username'] = 'Name is required';
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            } elseif ($this->authModel->emailExists($email)) {
                $errors['email'] = 'Email already exists';
            }
            if (empty($password_hash) || strlen($password_hash) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            if (empty($role)) $errors['role'] = 'Role is required';

            if (!empty($errors)) {
                $data = [
                    'title' => 'User Accounts',
                    'users' => $this->authModel->getUsers(),
                    'errors' => $errors,
                    'form_data' => [
                        'username' => $username,
                        'email' => $email,
                        'role' => $role
                    ],
                    'success' => null
                ];
                $this->view('account/user_account', $data);
                return;
            }

            // Hash password
            $hashedPassword = password_hash($password_hash, PASSWORD_DEFAULT);

            // Add user to the database
            $this->authModel->addUser($username, $hashedPassword, $role, $email, $image);

            // Redirect to user_account page with success message
            header('Location: /user_account?success=User created successfully');
            exit();
        }
    }
}
