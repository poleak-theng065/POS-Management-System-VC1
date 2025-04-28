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

                /* Style the delete button inside the form */
        form.delete-form button {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 10px 15px;
            color: #e74c3c; /* Red color for delete */
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        /* Style the trash icon inside the button */
        form.delete-form button i {
            margin-right: 8px; /* Space between icon and text */
        }

        /* Hover effect for the button */
        form.delete-form button:hover {
            background-color: #f8d7da; /* Light red background on hover */
            color: #c0392b;
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
                    <?php foreach ($data['users'] as $user): ?>
                            <tr class="user <?= htmlspecialchars($user['role']) ?>" data-id="<?= htmlspecialchars($user['user_id']) ?>">
                                <td>
                                    <div class="user-info">
                                        <img src="<?= htmlspecialchars($user['image'] ?: 'https://via.placeholder.com/50') ?>" 
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
                                            <?php if ($user['role'] === 'admin'): ?>
                                                <i class="fa-solid fa-user-shield"></i>
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
                                                    <i class="fa-solid fa-pen"></i> Edit Account
                                                </div>
                                                <form class="delete-form" action="/user-account/delete" method="POST">
                                                    <input type="hidden" name="id" value="<?= $user['user_id']; ?>">
                                                    <button type="submit">
                                                        <i class="fa-solid fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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

        </script>

<!-- Edit -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Initialize the filter dropdown
        updateFilterDropdown();

        // Dropdown menu toggle functionality
        const dots = document.querySelectorAll('.dots');
        console.log('Dots elements found:', dots.length); // Debug: Check if .dots elements are found
        dots.forEach(dot => {
            dot.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.querySelector('.dropdown-menu');
                if (dropdown) {
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== dropdown) {
                            menu.classList.remove('active');
                        }
                    });
                    // Toggle the clicked dropdown
                    dropdown.classList.toggle('active');
                } else {
                    console.error('Dropdown menu not found for dot:', dot);
                }
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

        // View Profile
        const viewItems = document.querySelectorAll('.dropdown-item.view');
        console.log('View items found:', viewItems.length); // Debug: Check if .dropdown-item.view elements are found
        viewItems.forEach(item => {
            item.addEventListener('click', function () {
                const row = this.closest('tr');
                const userId = row.getAttribute('data-id');
                if (userId) {
                    window.location.href = `/user_account/view/${userId}`;
                } else {
                    console.error('User ID not found for row:', row);
                }
            });
        });

        // Edit
        const editItems = document.querySelectorAll('.dropdown-item.edit');
        console.log('Edit items found:', editItems.length); // Debug: Check if .dropdown-item.edit elements are found
        editItems.forEach(item => {
            item.addEventListener('click', function () {
                const row = this.closest('tr');
                const userId = row.getAttribute('data-id');
                if (userId) {
                    window.location.href = `/user_account/edit/${userId}`;
                } else {
                    console.error('User ID not found for row:', row);
                }
            });
        });


    });
        // Delete
    // Wait until page is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            const row = this.closest('tr');
            const username = row ? row.querySelector('.name')?.textContent.trim() : 'this user';

            const confirmed = confirm(`Are you sure you want to delete ${username}?`);

            if (!confirmed) {
                e.preventDefault();  // 🛑 Stop form from submitting if cancel
                console.log('Delete cancelled.');
            }
        });
    });
});



</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Make each user row clickable
    const userRows = document.querySelectorAll('.user');

    userRows.forEach(row => {
        row.style.cursor = 'pointer'; // Change cursor on hover
        row.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            if (userId) {
                window.location.href = `/user_account/view/${userId}`;
            } else {
                console.error('User ID not found for this row');
            }
        });
    });
});
</script>


</body>
</html>