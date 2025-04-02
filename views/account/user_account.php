
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .container {
            width: 96%;
            max-width: 250vh;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            position: relative;
            left: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #2c3e50;
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
        p{
            margin: 10px;
        }

        .user-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .user:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #3498db;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .name {
            font-weight: 600;
            font-size: 18px;
            color: #2c3e50;
        }

        .email {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 4px;
        }

        .user-role {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .role-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 14px;
        }

        .admin .role-badge {
            background: #ffeaa7;
            color: #e67e22;
        }

        .employee .role-badge {
            background: #dfe6e9;
            color: #636e72;
        }

        .user-role i {
            font-size: 16px;
        }

        .git-icon {
            color: #333;
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .git-icon:hover {
            color: #f05033; /* Git's brand color */
        }

        .dots {
            font-size: 20px;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.2s;
        }

        .dots:hover {
            color: #3498db;
        }

        .admin{
            background-color:rgb(208, 253, 223);
        }

        .no-admin{
            background-color: rgb(214, 234, 248);
        }

        @media (max-width: 600px) {
            .user {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .user-info {
                flex-direction: column;
            }
        }
    </style>

<div class="container">
    <h1>User Accounts</h1>
    <div class="user-list">
        <?php if (!empty($data['users'])): ?>
            <?php foreach ($data['users'] as $user): ?>
                <div class="user <?= $user['role'] === 'admin' ? 'admin' : 'no-admin' ?>">
                    <div class="user-info">
                        <img src="<?= htmlspecialchars($user['image'] ? $user['image'] : 'https://via.placeholder.com/50') ?>" alt="Profile picture of <?= htmlspecialchars($user['username']) ?>">
                        <div class="user-details">
                            <p class="name"><?= htmlspecialchars($user['username']) ?></p>
                            <p class="email"><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                    </div>
                    <div class="user-role <?= $user['role'] === 'admin' ? 'admin' : 'no-admin' ?>"> <!-- Fixed consistency -->
                        <div class="role-badge">
                            <i class="fas fa-<?= $user['role'] === 'admin' ? 'crown' : 'user' ?>"></i>
                        </div>
                        <p><?= htmlspecialchars($user['role']) ?></p>
                        <span class="dots" aria-label="User options menu"><i class="fa-solid fa-bars"></i></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
    </div>
</div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->