<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your existing styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #ddd;
        }
        .sidebar h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
        }
        .sidebar ul li {
            margin-bottom: 15px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #7f8c8d;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar ul li a:hover {
            color: #3498db;
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
            flex: 1;
            max-width: 600px;
            margin: 0 auto;
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
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .breadcrumb span {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #2c3e50;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
            gap: 8px;
        }
        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }
        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .form-actions .update-btn {
            background-color: #696cff;
            color: white;
        }
        .form-actions .update-btn:hover {
            background-color: #2980b9;
        }
        .form-actions .cancel-btn {
            background-color: #e74c3c;
            color: white;
        }
        .form-actions .cancel-btn:hover {
            background-color: #c0392b;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }
        @media (max-width: 600px) {
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }
            .main-content {
                padding: 10px;
            }
            .container {
                padding: 15px;
            }
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }
            .form-actions button {
                width: 100%;
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
                <span>Edit</span> > 
                <span><?= htmlspecialchars($user['user_id']) ?></span>
            </div>

            <h1><i class="fa-solid fa-user"></i> Edit User</h1>

            <!-- Display error message if old password is incorrect -->
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form action="/user-account/update" method="POST">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <?php foreach (['admin', 'cashier', 'employee', 'manager', 'superadmin'] as $role): ?>
                            <option value="<?= $role ?>" <?= $user['role'] === $role ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Profile Image URL:</label>
                    <input type="text" id="image" name="image" value="<?= htmlspecialchars($user['image']) ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="update-btn">Update User</button>
                    <button type="button" class="cancel-btn" onclick="window.location.href='/user_account'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    const oldPasswordInput = document.getElementById('old_password');
    const newPasswordInput = document.getElementById('password');

    oldPasswordInput.addEventListener('input', function() {
        newPasswordInput.disabled = !this.value;
    });
</script>