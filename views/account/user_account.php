<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            padding: 20px;
            background-color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .user-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .name {
            font-weight: bold;
            font-size: 16px;
        }

        .email {
            font-size: 14px;
            color: #555;
        }

        .user-role {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .user-role i {
            font-size: 20px;
            color: #333;
        }

        .user-role p {
            font-size: 14px;
        }

        .dots {
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Account</h1>
        <div class="user-list">
            <!-- User 1 -->
            <div class="user">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">POLEAK</p>
                        <p class="email">poleak@gamil.com</p>
                    </div>
                </div>
                <div class="user-role">
                    <!-- Using Font Awesome crown icon for admin -->
                    <i class="fas fa-crown"></i>
                    <p>admin</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                </div>
            </div>
            <!-- User 2 -->
            <div class="user">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">SOKHA</p>
                        <p class="email">sokha@gamil.com</p>
                    </div>
                </div>
                <div class="user-role">
                    <!-- Using Font Awesome user icon for employee -->
                    <i class="fas fa-user"></i>
                    <p>employee</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                </div>
            </div>
            <!-- User 3 -->
            <div class="user">
                <div class="user-info">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="user-details">
                        <p class="name">NEANG</p>
                        <p class="email">neang@gamil.com</p>
                    </div>
                </div>
                <div class="user-role">
                    <!-- Using Font Awesome user icon for employee -->
                    <i class="fas fa-user"></i>
                    <p>employee</p>
                    <span class="dots"><i class="fa-solid fa-bars"></i></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>