<?php
session_start();

// Secret key for admin login
$secret_key = "admin";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_key = $_POST['secret_key'];

    if ($entered_key === $secret_key) {
        // Grant access and redirect to admin panel
        $_SESSION['admin_logged_in'] = true;
        header("Location: view_clients.php");
        exit();
    } else {
        // Show error message for incorrect key
        $error_message = "Invalid secret key! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #57c1eb, #c76cc5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 430px;
            padding: 20px;
            text-align: center;
        }
        .form-header {
            margin-bottom: 20px;
        }
        .user-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #ddd;
            display: inline-block;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
            padding-right: 10px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
        }
        input[type="text"]:focus {
            border-color: #57c1eb;
            box-shadow: 0 0 5px rgba(87, 193, 235, 0.5);
        }
        .button-group {
            display: flex;
            justify-content: space-around;
        }
        .submit-button {
            background: linear-gradient(to right, #57c1eb, #c76cc5);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            width: 100px;
            height: 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .error {
            color: red;
        }
        @media (max-width: 768px) {
            .container {
                width: 70%;
                height:40%;
                padding: 15px;
            }
            .user-icon {
                width: 60px;
                height: 60px;
            }
            h2 {
                font-size: 20px;
            }
            .input-group input {
                font-size: 13px;
                padding: 8px;
            }
            .submit-button {
                width: 100%;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 95%;
            }
            h2 {
                font-size: 18px;
            }
            .input-group input {
                font-size: 12px;
                padding: 6px;
            }
            .submit-button {
                width: 100%;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <img src="https://via.placeholder.com/100" alt="User Icon" class="user-icon">
        </div>
        <h2>Admin Login</h2>
        <p>Please enter the secret key to access the admin panel.</p>
        
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <form method="POST" action="admin_login.php">
            <div class="input-group">
                <label for="secret_key">Secret Key:</label>
                <input type="text" name="secret_key" placeholder="Enter secret key" required>
            </div>
            <div class="button-group">
                <input type="submit" value="Login" class="submit-button">
            </div>
        </form>
    </div>
</body>
</html>
