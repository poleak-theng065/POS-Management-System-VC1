<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reset some basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            background: linear-gradient(135deg, #f0f4f8, #e1e8f0);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 20px;
        }

        .container {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            padding: 40px 40px 25px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
            position: relative;
        }

        h1::after {
            content: '';
            width: 50px;
            height: 3px;
            background: #3498db;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .breadcrumb {
            text-align: left;
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #2980b9;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-group input {
            padding: 12px 15px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        .form-group input:focus {
            border-color: #3498db;
        }

        .password-container {
            position: relative;
        }

        .show-password-btn {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.3s;
        }

        .show-password-btn:hover {
            color: #3498db;
        }

        /* Button Styling */
        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .form-actions button {
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            width: 48%;
            transition: all 0.3s ease;
        }

        .update-btn {
            background-color: #3498db;
            color: #fff;
        }

        .update-btn:hover {
            background-color: #2980b9;
        }

        .cancel-btn {
            background-color: #e74c3c;
            color: #fff;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }

        /* Error & Success Message */
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success-message {
            color: #2ecc71;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* Responsive Styling */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions button {
                width: 100%;
                margin-bottom: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            <a href="/dashboard">Dashboard</a> > 
            <a href="/user_account">User Account</a> > 
            <span>Change Password</span>
        </div>

        <h1><i class="fa-solid fa-lock"></i> Change Password</h1>

        <!-- Display messages based on the result of the form submission -->
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <form action="/account/change_password" method="POST">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <div class="password-container">
                    <input type="password" id="old_password" name="old_password" required>
                    <button type="button" class="show-password-btn" onclick="togglePassword('old_password')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <div class="password-container">
                    <input type="password" id="new_password" name="new_password" required>
                    <button type="button" class="show-password-btn" onclick="togglePassword('new_password')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <div class="password-container">
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <button type="button" class="show-password-btn" onclick="togglePassword('confirm_password')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="update-btn">Update Password</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='/user_account'">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(passwordId) {
            var passwordField = document.getElementById(passwordId);
            var passwordBtn = passwordField.nextElementSibling;
            
            // Toggle the password visibility
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordField.type = "password";
                passwordBtn.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
    </script>
</body>
</html>
