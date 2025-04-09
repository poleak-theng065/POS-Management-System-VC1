<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reuse your styles */
        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 25px;
            max-width: 600px;
            margin: auto;
        }
        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
            color: #7f8c8d;
        }
        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
        }
        .breadcrumb span {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            position: relative;
        }
        h1::after {
            content: '';
            width: 5%;
            height: 3px;
            background: #3498db;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .form-group label {
            font-weight: 600;
            color: #2c3e50;
        }
        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .update-btn {
            background-color: #696cff;
            color: white;
        }
        .update-btn:hover {
            background-color: #2980b9;
        }
        .cancel-btn {
            background-color: #e74c3c;
            color: white;
        }
        .cancel-btn:hover {
            background-color: #c0392b;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
        }
        .success-message {
            color: green;
            text-align: center;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
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
                    <input type="password" id="old_password" name="old_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="update-btn">Update Password</button>
                    <button type="button" class="cancel-btn" onclick="window.location.href='/user_account'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
