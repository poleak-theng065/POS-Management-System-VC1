<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
</head>
<body>
    <div class="container">
        <h1>User Accounts</h1>
        <div class="user-list">
            <!-- User 1 -->
            <div class="user admin">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">POLEAK</p>
                        <p class="email">poleak@gmail.com</p>
                    </div>
                </div>
                <div class="user-role admin">
                    <div class="role-badge">
                        <i class="fas fa-crown"></i>
                    </div>
                    <p>admin</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                    <!-- <span class="git-icon"><i class="fab fa-git-alt"></i></span> -->
                </div>
            </div>
            <!-- User 2 -->
            <div class="user employee no-admin">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">SOKHA</p>
                        <p class="email">sokha@gmail.com</p>
                    </div>
                </div>
                <div class="user-role ">
                    <div class="role-badge">
                        <i class="fas fa-user"></i>
                    </div>
                    <p>employee</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                    <!-- <span class="git-icon"><i class="fab fa-git-alt"></i></span> -->
                </div>
            </div>
            <!-- User 3 -->
            <div class="user employee no-admin">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">NEANG</p>
                        <p class="email">neang@gmail.com</p>
                    </div>
                </div>
                <div class="user-role no-admin">
                    <div class="role-badge">
                        <i class="fas fa-user"></i>
                    </div>
                    <p>employee</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                    <!-- <span class="git-icon"><i class="fab fa-git-alt"></i></span> -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>