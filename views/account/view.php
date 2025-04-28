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
            background: #ffffff;
            border-radius: 1rem;
            width: 80%; /* Increased the width */
            max-width: 900px; /* Limit maximum width */
            /* min-height: 650px; Increased the height */
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn {
            transition: all 0.3s ease;
            padding: 0.5rem 2rem; /* Smaller but long buttons */
            font-size: 0.875rem; /* Smaller font size */
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .profile-header {
            background-color: #F3F4F6;
            padding: 1.5rem 1rem; /* Reduced padding */
            border-radius: 1rem;
        }
    </style>
</head>
<body class="bg-gray-50 flex min-h-screen font-['Inter', sans-serif]">

    <main class="flex-1 flex justify-center items-center p-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 profile-card">
            <div class="profile-header mb-8">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                        <i class="fa-solid fa-user text-blue-600"></i> User Profile
                    </h1>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        <?php if ($user['role'] === 'admin'): ?> bg-yellow-100 text-yellow-800
                        <?php elseif ($user['role'] === 'cashier'): ?> bg-blue-100 text-blue-800
                        <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                        <?php if ($user['role'] === 'admin'): ?>
                            <i class="fa-solid fa-user-shield mr-1"></i>
                        <?php elseif ($user['role'] === 'cashier'): ?>
                            <i class="fa-solid fa-cash-register mr-1"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-user mr-1"></i>
                        <?php endif; ?>
                        <?= htmlspecialchars($user['role']) ?>
                    </span>
                </div>
            </div>

            <div class="flex items-start gap-6 mb-8">
                <div class="flex-shrink-0">
                    <img src="<?= htmlspecialchars($user['image'] ?: 'https://via.placeholder.com/120') ?>" 
                         alt="Profile picture of <?= htmlspecialchars($user['username']) ?>" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow-sm">
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4"><?= htmlspecialchars($user['username']) ?></h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <!-- Made the label "Email" bold and black -->
                            <label class="text-sm font-bold text-black">Email</label>
                            <p class="text-gray-800 text-base"><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                        <div>
                            <!-- Made the label "User ID" bold and black -->
                            <label class="text-sm font-bold text-black">User ID</label>
                            <p class="text-gray-800 text-base"><?= htmlspecialchars($user['user_id']) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <button class="btn bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700"
                        onclick="window.location.href='/user_account/change_password/<?= htmlspecialchars($user['user_id']) ?>'">
                    <i class="fa-solid fa-key mr-2"></i> Change Password
                </button>
                <button class="btn bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700"
                        onclick="window.location.href='/user_account/edit/<?= htmlspecialchars($user['user_id']) ?>'">
                    <i class="fa-solid fa-edit mr-2"></i> Edit Profile
                </button>
                <button class="btn bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700"
                        onclick="window.location.href='/user_account'">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back
                </button>
                <button class="btn bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 <?= is_null($nextUserId) ? 'opacity-50 cursor-not-allowed' : '' ?>"
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
