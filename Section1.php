<?php
session_start(); // Start the session to store data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store Section A data in session for future use
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['bio'] = $_POST['bio'];

    // Handle file upload for profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $upload_dir = "uploads/"; // Folder where the profile picture will be stored
        $file_name = basename($_FILES['profile_picture']['name']);
        $target_file = $upload_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image (png, jpg, jpeg)
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check !== false && ($file_type == "png" || $file_type == "jpg" || $file_type == "jpeg")) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                $_SESSION['profile_picture'] = $target_file; // Store the image path in session
            }
        }
    }

    // Redirect to Section B (Soft & Technical Skills)
    header("Location: Section2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Resume Builder</title>
	<style>
        /* Full page styling to center the form */
        body {
            background-image: url('pic/section1.jpg'); /* Set background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Stack heading and form vertically */
        }

        /* Form container style with cherry color for background and box shadow */
        .form-container {
            width: 95%;
            max-width: 480px; /* Set max-width */
            background: rgb(8, 99, 91); /* Cherry red background for the form */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgb(8, 99, 91); /* Reddish box shadow */
            text-align: center;
        }

        /* Increase font size for inputs, textareas, and button */
        input, textarea, button {
            width: 100%; /* Full width of form */
            padding: 14px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 18px; /* Increased font size for inputs and button */
            box-sizing: border-box; /* Ensures padding is included within width */
        }

        /* Placeholder text styling */
        input::placeholder, textarea::placeholder {
            font-size: 18px; /* Increased font size for placeholders */
            color: #ddd; /* Lighter placeholder text color for better readability */
        }

        button {
            background: linear-gradient(90deg, rgb(85, 255, 241) 0%, rgb(31, 138, 129) 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 50px; /* Rounded corners */
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            margin-top: 10px;
            margin-left: auto; /* Center the button */
            margin-right: auto; /* Center the button */
        }

        button:hover {
            background: linear-gradient(90deg, rgb(203, 190, 206) 0%, rgb(68, 53, 62) 100%);
        }

        /* Label style */
        label {
            font-size: 20px; /* Larger font size for labels */
            font-weight: bold;
            text-align: left;
            display: block;
            margin-bottom: 5px;
            color: #fff; /* White color for labels for better contrast */
        }

        /* Heading styling */
        h3 {
            font-size: 25px;
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            font-weight: bold;
            margin-bottom: 15px; /* Add space between heading and form */
        }
    </style>
</head>
<body>

<h3>Section A: Personal Information</h3>

<!-- Form to handle Section A Data -->
<form action="section1.php" method="POST" enctype="multipart/form-data" class="form-container">
    <label for="name">Full Name</label>
    <input type="text" name="name" required placeholder="Enter your full name">
    <label for="email">Email</label>
    <input type="email" name="email" required placeholder="Enter your email">
    <label for="phone">Phone Number</label>
    <input type="text" name="phone" required placeholder="Enter your phone number">
    <label for="address">Address</label>
    <input type="text" name="address" required placeholder="Enter your address">
    <label for="photo">Upload Profile Picture</label>
    <input type="file" name="profile_picture" required>
    <label for="bio">Short Bio</label>
    <textarea name="bio" placeholder="Write a short bio..." required></textarea>
    <button type="submit">Next: Soft & Technical Skills</button>
</form>

</body>
</html>
