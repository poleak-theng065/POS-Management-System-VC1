<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #e6f0fa 0%, #d0e3ff 100%);
            justify-content: center;
            align-items: center;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            border-right: 1px solid #dfe6e9;
        }

        .sidebar h2 {
            font-size: 22px;
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
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 24px;
            max-width: 100%;
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
            color: #2980b9;
        }

        .breadcrumb span {
            color: #2c3e50;
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 24px;
            color: #2c3e50;
            display: flex;
            /* align-items: center; */
            /* justify-content: center; */
            gap: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 500;
            font-size: 14px;
            color: #2c3e50;
        }

        .form-group input,
        .form-group select {
            padding: 12px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            font-size: 14px;
            background: #f8f9fa;
            color: #2c3e50;
            transition: border-color 0.2s;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
        }

        .form-group input[type="file"] {
            padding: 8px;
            background: none;
            border: none;
        }

        .image-preview {
            margin-top: 12px;
            max-width: 120px;
            max-height: 120px;
            object-fit: cover;
            border: 2px solid #3498db;
            border-radius: 50%;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 16px;
        }

        .form-actions button {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }

        .form-actions .update-btn {
            background-color: #3498db;
            color: white;
        }

        .form-actions .update-btn:hover {
            background-color: #2980b9;
        }

        .form-actions .cancel-btn {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #dfe6e9;
        }

        .form-actions .cancel-btn:hover {
            background-color: #dfe6e9;
        }

        /* Styles for requested buttons, not present in current HTML */
        .change-password {
            background: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #dfe6e9;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .change-password:hover {
            background: #dfe6e9;
        }

        .edit-profile {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .edit-profile:hover {
            background: #2980b9;
        }

        .back-btn {
            background: #dfe6e9;
            color: #2c3e50;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background: #c4ced4;
        }

        .next-btn {
            background: #2ecc71;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .next-btn:hover {
            background: #27ae60;
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            font-size: 14px;
            margin-bottom: 16px;
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #dfe6e9;
                padding: 16px;
            }

            .main-content {
                padding: 10px;
            }

            .container {
                padding: 16px;
                border-radius: 12px;
            }

            .form-group input,
            .form-group select {
                padding: 10px;
                font-size: 13px;
            }

            .form-actions {
                flex-direction: column;
                gap: 10px;
            }

            .form-actions button {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
   
    <div class="main-content">
        <div class="container">
            <!-- <div class="breadcrumb">
                <a href="/dashboard">Dashboard</a> > 
                <a href="/user_account">User Account</a> > 
                <span>Edit</span> > 
                <span><?= htmlspecialchars($user['user_id']) ?></span>
            </div> -->

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
                        <?php foreach (['admin', 'cashier', 'employee'] as $role): ?>
                            <option value="<?= $role ?>" <?= $user['role'] === $role ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Upload Profile Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <img id="imagePreview" src="<?= !empty($user['image']) ? htmlspecialchars($user['image']) : '' ?>" 
                        alt="Image Preview" class="image-preview" 
                        style="<?= empty($user['image']) ? 'display:none;' : '' ?>">
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

<script>
function previewImage(event) {
    const input = event.target;
    const imgPreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imgPreview.src = e.target.result;
            imgPreview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>