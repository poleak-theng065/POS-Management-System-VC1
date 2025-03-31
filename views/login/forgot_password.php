<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>This is the Forgot Password Page</h1>
        <p>Please enter your email to reset your password.</p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
      var navbar = document.getElementById("layout-navbar");
      var sidebar = document.getElementById("layout-menu");
      if (navbar) navbar.style.display = "none"; // Hide navbar if it exists
      if (sidebar) sidebar.style.display = "none"; // Hide sidebar if it exists
    });
</script>
</body>
</html>