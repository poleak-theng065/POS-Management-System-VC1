<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #3498db;
        }

        .show-password {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            font-size: 13px;
            color: #555;
        }

        .show-password input[type="checkbox"] {
            width: auto;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.submit-btn {
            background-color: #3498db;
            color: white;
        }

        button.submit-btn:hover {
            background-color: #2980b9;
        }

        button.cancel-btn {
            background-color: #e74c3c; /* Red for cancel, contrasting with blue */
            color: white;
        }

        button.cancel-btn:hover {
            background-color: #c0392b;
        }

        .error-messages {
            background-color: #ffefef;
            border: 1px solid #ff5a5a;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #d8000c;
            text-align: left;
        }

        .error-messages p {
            margin: 0;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            input[type="password"],
            input[type="text"] {
                padding: 10px;
                font-size: 13px;
            }

            .button-group {
                flex-direction: column;
                gap: 8px;
            }

            button {
                padding: 10px;
                font-size: 13px;
            }

            .show-password {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Change Password</h1>

    <?php if (!empty($errors)) : ?>
        <div class="error-messages">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/account/change_password" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <div class="form-group">
            <label>Current Password:</label>
            <input type="password" name="current_password" id="current_password" required>
            <div class="show-password">
                <input type="checkbox" id="show_current_password" onclick="togglePassword('current_password', 'show_current_password')">
                <label for="show_current_password">Show Password</label>
            </div>
        </div>

        <div class="form-group">
            <label>New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
            <div class="show-password">
                <input type="checkbox" id="show_new_password" onclick="togglePassword('new_password', 'show_new_password')">
                <label for="show_new_password">Show Password</label>
            </div>
        </div>

        <div class="form-group">
            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <div class="show-password">
                <input type="checkbox" id="show_confirm_password" onclick="togglePassword('confirm_password', 'show_confirm_password')">
                <label for="show_confirm_password">Show Password</label>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="submit-btn">Change Password</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='/user_account'">Cancel</button>
        </div>
    </form>
</div>

<script>
    function togglePassword(inputId, checkboxId) {
        const passwordInput = document.getElementById(inputId);
        const checkbox = document.getElementById(checkboxId);
        passwordInput.type = checkbox.checked ? 'text' : 'password';
    }
</script>

</body>
</html>