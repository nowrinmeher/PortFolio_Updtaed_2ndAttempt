<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }
    
    // Check if user already exists
    $check_user = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_user);
    
    if ($result->num_rows > 0) {
        echo "Email already registered.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Full page styling to center the form */
        body {
            background-image: url('pic/registerback.jpeg'); /* Set background image */
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
        .register-form {
            width: 100%;
            max-width: 400px;  /* Limit the width */
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for the form */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Form input and button styling */
        input, button {
            width: 100%; /* Set width to 100% for inputs */
            padding: 14px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box; /* Ensures padding is included within width */
        }

        /* Button specific styling */
        button {
            background-color: rgb(122, 72, 72);
            color: white;
            cursor: pointer;
            border: none;
            font-size: 18px;
        }

        button:hover {
            background-color: rgb(122, 72, 72);
        }

        /* Label and placeholder styling */
        label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        input::placeholder, textarea::placeholder {
            font-size: 16px;
            color: #777;
        }

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
    <div class="register-form">
        <h2>Create an Account</h2>
        <form action="register.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
