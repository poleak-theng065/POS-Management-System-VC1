
<!-- Improved Create Account Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #696cff;
            --primary-hover: #595cd9;
            --secondary: #566a7f;
            --error: #ff3e1d;
            --border: #d9dee3;
            --background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        body {
            background: var(--background);
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .content-wrapper {
            padding: 2rem;
            min-height: calc(100vh - 56px);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 1.5rem;
            color: #2c3e50;
            font-size: 1.5rem;
            position: relative;
        }

        .card-header::after {
            content: '';
            width: 5%;
            height: 3px;
            background: var(--primary);
            position: absolute;
            bottom: 0;
            left: 1.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .avatar-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .avatar-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .button-wrapper .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-outline-secondary {
            border-color: var(--border);
            color: var(--secondary);
        }

        .btn-outline-secondary:hover {
            background: #f8f9fa;
        }

        .text-muted {
            color: var(--secondary);
            font-size: 0.875rem;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
        }

        .error {
            display: block;
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .form-actions .btn {
            padding: 0.75rem 2rem;
        }

        .btn-exit {
            background: #dc3545;
            border: none;
        }

        .btn-exit:hover {
            background: #c82333;
        }

        @media (max-width: 576px) {
            .content-wrapper {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .avatar-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .button-wrapper {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Create New Account</h5>
                        <div class="card-body">
                            <div class="avatar-section">
                                <img src="../assets/img/avatars/1.png" alt="user-avatar" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2">
                                        <span>Upload new photo</span>
                                        <input type="file" id="upload" name="image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset">
                                        Reset
                                    </button>
                                    <p class="text-muted mb-0">Allowed JPG or PNG. Max size of 5MB</p>
                                </div>
                            </div>
                            <form method="POST" action="/create-account/store" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="<?= htmlspecialchars($form_data['username'] ?? '') ?>">
                                        <?php if (isset($errors['username'])): ?>
                                            <span class="error"><?= $errors['username'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">
                                        <?php if (isset($errors['email'])): ?>
                                            <span class="error"><?= $errors['email'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password">
                                        <p class="text-muted mb-0">Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.</p>
                                        <?php if (isset($errors['password'])): ?>
                                            <span class="error"><?= $errors['password'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role">
                                            <option value="">Select Role</option>
                                            <option value="admin" <?= ($form_data['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="cashier" <?= ($form_data['role'] ?? '') === 'cashier' ? 'selected' : '' ?>>Cashier</option>
                                            <option value="employee" <?= ($form_data['role'] ?? '') === 'employee' ? 'selected' : '' ?>>Employee</option>
                                        </select>
                                        <?php if (isset($errors['role'])): ?>
                                            <span class="error"><?= $errors['role'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if (isset($errors['general'])): ?>
                                    <span class="error"><?= $errors['general'] ?></span>
                                <?php endif; ?>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Create Account</button>
                                    <a href="/user_account" class="btn btn-exit">Exit</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>