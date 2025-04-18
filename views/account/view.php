<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
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
            max-width: 800px;
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

        .profile-details {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            /* border: solid 1px; */
            margin-left: 200px;
        }

        .profile-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .img {
            width: 100px;
            height: 100px;
            border-radius: 50%; /* Circular like screenshot */
            object-fit: cover;
            margin-top: 50px;
            border: solid 1px blue;
        }

        .img img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-item div {
            display: flex;
            flex-direction: column;
        }

        .profile-item label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .profile-item span {
            color: #7f8c8d;
            font-size: 16px;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
        }

        .admin .role-badge {
            background: #ffeaa7;
            color: #e67e22;
        }

        .cashier .role-badge {
            background: #74b9ff;
            color: white;
        }

        .employee .role-badge {
            background: #dfe6e9;
            color: #636e72;
        }

        .superadmin .role-badge {
            background: #ff6f61;
            color: white;
        }

        .manager .role-badge {
            background: #a29bfe;
            color: white;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .actions .edit-btn {
            background-color: #696cff;
            color: white;
        }

        .actions .edit-btn:hover {
            background-color: #2980b9;
        }

        .actions .back-btn {
            background-color: #e74c3c;
            color: white;
        }

        .actions .back-btn:hover {
            background-color: #c0392b;
        }

        .actions .nav-btn {
            background-color: #3498db;
            color: white;
        }

        .actions .nav-btn:hover {
            background-color: #2980b9;
        }

        .actions .nav-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
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

            .profile-item img {
                width: 60px;
                height: 60px;
            }

            .actions {
                flex-direction: column;
                gap: 10px;
            }

            .actions button {
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
                <span>View Profile</span> > 
                <span><?= htmlspecialchars($user['user_id']) ?></span>
            </div>

            <h1><i class="fa-solid fa-user"></i> User Profile</h1>

            <div class="profile-details">
                <div class="img">
                    <img src="<?= htmlspecialchars($user['image'] ?: 'https://via.placeholder.com/80') ?>" 
                    alt="Profile picture of <?= htmlspecialchars($user['username']) ?>">
                </div>
                
                <div class="email_role">
                    <div class="profile-item">
                        <div>
                            <!-- <label>Username</label> -->
                            <span style="font-weight: bold; font-size:32px;"><?= htmlspecialchars($user['username']) ?></span>
                        </div>
                    </div>
                    <div class="profile-item">
                        <div>
                            <label>Email</label>
                            <span style="flex-direction: column; display:flex;"><?= htmlspecialchars($user['email']) ?></span>
                        </div>
                    </div>

                    <div class="profile-item">
                        <div>
                            <label>Role</label>
                            <span class="role-badge <?= htmlspecialchars($user['role']) ?>">
                                <?php if ($user['role'] === 'superadmin'): ?>
                                    <i class="fa-solid fa-crown"></i>
                                <?php elseif ($user['role'] === 'admin'): ?>
                                    <i class="fa-solid fa-user-shield"></i>
                                <?php elseif ($user['role'] === 'manager'): ?>
                                    <i class="fa-solid fa-user-tie"></i>
                                <?php elseif ($user['role'] === 'cashier'): ?>
                                    <i class="fa-solid fa-cash-register"></i>
                                <?php else: ?>
                                    <i class="fa-solid fa-user"></i>
                                <?php endif; ?>
                                <?= htmlspecialchars($user['role']) ?>
                            </span>
                        </div>
                    </div>
            </div>
        </div>

            <div class="actions">
            <button class="nav-btn" onclick="window.location.href='/user_account/change_password/<?= htmlspecialchars($user['user_id']) ?>'">Change Password</button>
                <button class="edit-btn" onclick="window.location.href='/user_account/edit/<?= htmlspecialchars($user['user_id']) ?>'">Edit Profile</button>
                <button class="back-btn" onclick="window.location.href='/user_account'">Back</button>
                <button class="nav-btn" onclick="window.location.href='/user_account/view/<?= $nextUserId ?>'" <?= is_null($nextUserId) ? 'disabled' : '' ?>>Next</button>
            </div>
        </div>
    </div>
</body>
</html>