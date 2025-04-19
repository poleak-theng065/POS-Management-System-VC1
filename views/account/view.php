<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar-link {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            transform: translateX(5px);
        }
        .profile-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50 flex min-h-screen font-['Inter',sans-serif]">
    <!-- <aside class="w-64 bg-gray-900 text-white p-6 fixed h-full shadow-xl">
        <div class="flex items-center gap-3 mb-8">
            <i class="fa-solid fa-shield-halved text-2xl text-blue-400"></i>
            <h2 class="text-xl font-bold">Admin Panel</h2>
        </div>
        <ul class="space-y-2">
            <li>
                <a href="/dashboard" class="sidebar-link flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white">
                    <i class="fa-solid fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="/user_account" class="sidebar-link flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white">
                    <i class="fa-solid fa-users"></i> User Accounts
                </a>
            </li>
            <li>
                <a href="/settings" class="sidebar-link flex items-center gap-3 p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white">
                    <i class="fa-solid fa-cog"></i> Settings
                </a>
            </li>
        </ul>
    </aside> -->

    <main class="flex-1 ml-64 p-8">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 profile-card">
            <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
                <a href="/dashboard" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <i class="fa-solid fa-angle-right text-xs"></i>
                <a href="/user_account" class="hover:text-blue-600 transition-colors">User Account</a>
                <i class="fa-solid fa-angle-right text-xs"></i>
                <span class="text-gray-700">Profile</span>
            </nav>

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fa-solid fa-user text-blue-600"></i> User Profile
                </h1>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    <?php if ($user['role'] === 'superadmin'): ?> bg-red-100 text-red-800
                    <?php elseif ($user['role'] === 'admin'): ?> bg-yellow-100 text-yellow-800
                    <?php elseif ($user['role'] === 'manager'): ?> bg-purple-100 text-purple-800
                    <?php elseif ($user['role'] === 'cashier'): ?> bg-blue-100 text-blue-800
                    <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                    <?php if ($user['role'] === 'superadmin'): ?>
                        <i class="fa-solid fa-crown mr-1"></i>
                    <?php elseif ($user['role'] === 'admin'): ?>
                        <i class="fa-solid fa-user-shield mr-1"></i>
                    <?php elseif ($user['role'] === 'manager'): ?>
                        <i class="fa-solid fa-user-tie mr-1"></i>
                    <?php elseif ($user['role'] === 'cashier'): ?>
                        <i class="fa-solid fa-cash-register mr-1"></i>
                    <?php else: ?>
                        <i class="fa-solid fa-user mr-1"></i>
                    <?php endif; ?>
                    <?= htmlspecialchars($user['role']) ?>
                </span>
            </div>

            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <img src="<?= htmlspecialchars($user['image'] ?: 'https://via.placeholder.com/120') ?>" 
                         alt="Profile picture of <?= htmlspecialchars($user['username']) ?>" 
                         class="w-28 h-28 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4"><?= htmlspecialchars($user['username']) ?></h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-800 text-base"><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">User ID</label>
                            <p class="text-gray-800 text-base"><?= htmlspecialchars($user['user_id']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <button class="btn px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700"
                        onclick="window.location.href='/user_account/change_password/<?= htmlspecialchars($user['user_id']) ?>'">
                    <i class="fa-solid fa-key mr-2"></i> Change Password
                </button>
                <button class="btn px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700"
                        onclick="window.location.href='/user_account/edit/<?= htmlspecialchars($user['user_id']) ?>'">
                    <i class="fa-solid fa-edit mr-2"></i> Edit Profile
                </button>
                <button class="btn px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700"
                        onclick="window.location.href='/user_account'">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back
                </button>
                <button class="btn px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 <?= is_null($nextUserId) ? 'opacity-50 cursor-not-allowed' : '' ?>"
                        onclick="window.location.href='/user_account/view/<?= $nextUserId ?>'"
                        <?= is_null($nextUserId) ? 'disabled' : '' ?>>
                    <i class="fa-solid fa-arrow-right mr-2"></i> Next
                </button>
            </div>
        </div>
    </main>

    <script>
        // Add smooth scroll for sidebar links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const href = link.getAttribute('href');
                window.location.href = href;
            });
        });
    </script>
</body>
</html>