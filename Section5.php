<?php
session_start(); // Start the session to retrieve data stored across sections

// If the form is submitted, store the Project/Publication data in the session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store Section E data in session for future use
    $_SESSION['project_publications'] = $_POST['project_publications'];

    // Redirect to the resume generation page (generate_resume.php)
    header("Location: generate_resume.php");
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

    <h3>Section E: Projects or Publications</h3>

    <!-- Form for Project or Publication -->
    <form action="Section5.php" method="POST" enctype="multipart/form-data" class="form-container">
        <label for="project_publications">Project/Publication Details</label>
        <textarea name="project_publications" placeholder="Include your projects or publications (optional)"></textarea>

        <button type="submit">Generate Resume</button>
    </form>

</body>
</html>
