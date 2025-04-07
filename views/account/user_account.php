<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
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

        .plus-icon {
            color: #3498db;
            font-size: 32px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .plus-icon:hover {
            transform: scale(1.2);
            color: #2980b9;
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

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .controls select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            font-size: 14px;
        }

        .controls button {
            padding: 8px 16px;
            background-color: #696cff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .controls button:hover {
            background-color: #2980b9;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8f9fa;
            table-layout: fixed;
        }

        .user-table th, .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #696cff;
            color: white;
        }

        .user-table th:nth-child(1), .user-table td:nth-child(1) {
            width: 70%;
        }

        .user-table th:nth-child(2), .user-table td:nth-child(2) {
            width: 30%;
        }

        .user-table tr:hover {
            background-color: #f1f1f1;
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
            font-size: 16px;
            color: rgb(9, 12, 15);
        }

        .email {
            font-size: 12px;
            color: #7f8c8d;
        }

        .role-column {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
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

        .dots {
            font-size: 16px;
            cursor: pointer;
            color: #7f8c8d;
            transition: color 0.2s;
            position: relative;
            left: 50px;
        }

        .dots:hover {
            color: #3498db;
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 120px;
            z-index: 1000;
            display: none;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item.edit {
            color: #f1c40f;
        }

        .dropdown-item.delete {
            color: #e74c3c;
        }

        @media (max-width: 600px) {
            body {
                flex-direction: column;
            }

            .controls {
                flex-direction: column;
                gap: 10px;
            }

            .controls select {
                width: 100%;
            }

            .user-table th, .user-table td {
                font-size: 12px;
                padding: 10px;
            }

            .user-table th:nth-child(1), .user-table td:nth-child(1) {
                width: 60%;
            }

            .user-table th:nth-child(2), .user-table td:nth-child(2) {
                width: 40%;
            }

            .role-column {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .dots {
                left: 0;
            }

            .dropdown-menu {
                right: -10px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="container">
            <h1><i class="fa-solid fa-user"></i> User Account</h1>
            <div class="controls">
                <select id="filterSelect" onchange="filterAccounts()">
                    <option value="">All Roles</option>
                    <!-- Options will be dynamically added here -->
                </select>
                <button><a style="color: white; text-decoration: none;" href="/create_account">+ Add User</a></button>
            </div>
            <table class="user-table" id="userTable">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['users'])): ?>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr class="user <?= $user['role'] === 'superadmin' ? 'superadmin' : ($user['role'] === 'admin' ? 'admin' : ($user['role'] === 'manager' ? 'manager' : ($user['role'] === 'cashier' ? 'cashier' : 'employee'))) ?>">
                                <td>
                                    <div class="user-info">
                                        <img src="<?= htmlspecialchars($user['image'] ? $user['image'] : 'https://via.placeholder.com/50') ?>" 
                                            alt="Profile picture of <?= htmlspecialchars($user['username']) ?>">
                                        <div class="user-details">
                                            <p class="name"><?= htmlspecialchars($user['username']) ?></p>
                                            <p class="email"><?= htmlspecialchars($user['email']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="role-column">
                                        <span class="role-badge">
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
                                        <span class="dots" aria-label="User options menu">
                                            <i class="fa-solid fa-ellipsis"></i>
                                            <div class="dropdown-menu">
                                                <div class="dropdown-item edit">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </div>
                                                <div class="dropdown-item delete">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Function to update the filter dropdown with unique roles
        function updateFilterDropdown() {
            const filterSelect = document.getElementById('filterSelect');
            const users = document.getElementsByClassName('user');
            const roles = new Set();

            while (filterSelect.options.length > 1) {
                filterSelect.remove(1);
            }

            Array.from(users).forEach(user => {
                const role = user.querySelector('.role-badge').textContent.trim();
                roles.add(role);
            });

            roles.forEach(role => {
                const option = document.createElement('option');
                option.value = role;
                option.textContent = role;
                filterSelect.appendChild(option);
            });
        }

        // Function to filter accounts based on the selected role
        function filterAccounts() {
            const filterValue = document.getElementById('filterSelect').value;
            const users = document.getElementsByClassName('user');

            Array.from(users).forEach(user => {
                const role = user.querySelector('.role-badge').textContent.trim();
                
                if (filterValue === '' || role === filterValue) {
                    user.style.display = '';
                } else {
                    user.style.display = 'none';
                }
            });
        }

        // Function to add a new user (for testing purposes)
        function addUser() {
            const userTable = document.querySelector('#userTable tbody');
            const newUser = document.createElement('tr');
            newUser.className = 'user employee';
            
            const username = prompt('Enter username:');
            if (!username) return;

            const email = prompt('Enter email:');
            if (!email) return;

            const role = prompt('Enter role (superadmin/admin/manager/cashier/employee):', 'employee');
            if (!role || !['superadmin', 'admin', 'manager', 'cashier', 'employee'].includes(role)) {
                alert('Invalid role! Defaulting to employee.');
                newUser.className = 'user employee';
            } else {
                newUser.className = `user ${role}`;
            }

            newUser.innerHTML = `
                <td>
                    <div class="user-info">
                        <img src="https://via.placeholder.com/50" alt="Profile picture of ${username}">
                        <div class="user-details">
                            <p class="name">${username}</p>
                            <p class="email">${email}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="role-column">
                        <span class="role-badge">
                            ${role === 'superadmin' ? '<i class="fa-solid fa-crown"></i>' : 
                              role === 'admin' ? '<i class="fa-solid fa-user-shield"></i>' : 
                              role === 'manager' ? '<i class="fa-solid fa-user-tie"></i>' : 
                              role === 'cashier' ? '<i class="fa-solid fa-cash-register"></i>' : 
                              '<i class="fa-solid fa-user"></i>'} 
                            ${role || 'employee'}
                        </span>
                        <span class="dots" aria-label="User options menu">
                            <i class="fa-solid fa-ellipsis"></i>
                            <div class="dropdown-menu">
                                <div class="dropdown-item edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </div>
                                <div class="dropdown-item delete">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </div>
                            </div>
                        </span>
                    </div>
                </td>
            `;

            userTable.appendChild(newUser);
            
            updateFilterDropdown();
            filterAccounts();
        }

        // Dropdown menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            updateFilterDropdown();

            const dots = document.querySelectorAll('.dots');
            dots.forEach(dot => {
                dot.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.querySelector('.dropdown-menu');
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdown) {
                            menu.classList.remove('active');
                        }
                    });
                    // Toggle the clicked dropdown
                    dropdown.classList.toggle('active');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dots')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('active');
                    });
                }
            });

            // Add event listeners for Edit and Delete actions
            document.querySelectorAll('.dropdown-item.edit').forEach(item => {
                item.addEventListener('click', function() {
                    const username = this.closest('tr').querySelector('.name').textContent;
                    alert(`Edit user: ${username}`);
                    // Add your edit logic here (e.g., redirect to an edit page)
                });
            });

            document.querySelectorAll('.dropdown-item.delete').forEach(item => {
                item.addEventListener('click', function() {
                    const username = this.closest('tr').querySelector('.name').textContent;
                    if (confirm(`Are you sure you want to delete user: ${username}?`)) {
                        this.closest('tr').remove();
                        updateFilterDropdown();
                        filterAccounts();
                    }
                });
            });
        });
    </script>

    <!-- Edit -->

    <script>
        document.querySelectorAll('.dropdown-item.edit').forEach(item => {
            item.addEventListener('click', function () {
                const row = this.closest('tr');
                const userId = row.getAttribute('data-id'); // Add this attribute in your PHP foreach

                window.location.href = `/user_account/edit/${userId}`;
            });
        });

        document.querySelectorAll('.dropdown-item.delete').forEach(item => {
            item.addEventListener('click', function () {
                const row = this.closest('tr');
                const userId = row.getAttribute('data-id');
                const username = row.querySelector('.name').textContent;

                if (confirm(`Are you sure you want to delete user: ${username}?`)) {
                    window.location.href = `/user_account/delete/${userId}`;
                }
            });
        });

    </script>


</body>
</html>