<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "Both fields are required.";
        exit;
    }
    
    // Check user credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: Section1.php");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found with this email.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Full page styling to center the form */
        body {
            background-image: url('pic/loginback.jpeg'); /* Set background image */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Centered form styling */
        .login-form {
            width: 100%;
            max-width: 400px;  /* Limit the width */
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for the form */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Form input and button styling */
        input {
            width: 95%; /* Set width to 100% for inputs */
            padding: 14px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        /* Button specific styling */
        input[type="submit"] {
            background-color: rgb(122, 72, 72);
            color: white;
            cursor: pointer;
            border: none;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: rgb(122, 72, 72); /* Keep the same color on hover */
        }

        /* Label and placeholder styling */
        label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        input::placeholder {
            font-size: 16px;
            color: #777;
        }

        /* Styling for the 'Register here' link */
        p {
            margin-top: 20px;
            font-size: 14px;
        }

        p a {
            color: rgb(122, 72, 72);
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
