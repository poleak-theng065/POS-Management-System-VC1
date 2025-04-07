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

}