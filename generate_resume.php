<?php
session_start(); // Start the session to retrieve stored data
require('config.php');
require('fpdf/fpdf.php');

// Directory to store the uploaded profile picture
$upload_dir = "uploads/";
$profile_picture = '';

// Retrieve session data (data stored from previous sections)
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Not Provided';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Not Provided';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Not Provided';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : 'Not Provided';
$summary = isset($_SESSION['bio']) ? $_SESSION['bio'] : 'Not Provided'; // Personal summary (Section A)
$soft_skills = isset($_SESSION['soft_skills']) ? $_SESSION['soft_skills'] : 'Not provided'; // Soft skills (Section B)
$technical_skills = isset($_SESSION['technical_skills']) ? $_SESSION['technical_skills'] : 'Not provided'; // Technical skills (Section B)
$institute = isset($_SESSION['institute']) ? $_SESSION['institute'] : 'Not provided'; // Institute name (Section C)
$degree = isset($_SESSION['degree']) ? $_SESSION['degree'] : 'Not provided'; // Degree (Section C)
$year = isset($_SESSION['year']) ? $_SESSION['year'] : 'Not provided'; // Graduation year (Section C)
$grade = isset($_SESSION['grade']) ? $_SESSION['grade'] : 'Not provided'; // Grade/CGPA (Section C)
$work_experience = isset($_SESSION['work_experience']) ? $_SESSION['work_experience'] : 'Not provided'; // Work experience (Section D)
$project_publications = isset($_SESSION['project_publications']) ? $_SESSION['project_publications'] : 'Not provided'; // Projects/Publication (Section E)

// Handle file upload for profile picture if a new one is uploaded
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $file_name = basename($_FILES['profile_picture']['name']);
    $target_file = $upload_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image (png, jpg, jpeg)
    $check = getimagesize($_FILES['profile_picture']['tmp_name']);
    if ($check !== false && ($file_type == "png" || $file_type == "jpg" || $file_type == "jpeg")) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = $target_file;
            $profile_picture = $_SESSION['profile_picture'];
        }
    }
} else {
    // If no new profile picture uploaded, use the stored one
    $profile_picture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : '';
}

// PDF class for generating the resume
class PDF extends FPDF {
    function Header() {
        global $profile_picture;
        if (!empty($profile_picture)) {
            $this->Image($profile_picture, 10, 10, 25); // Set profile picture
            $this->SetXY(10, 40);
        }
    }

    function addTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, $title, 0, 1, 'L');
        $this->Ln(2);
    }

    function addContent($content) {
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 6, $content);
        $this->Ln(2);
    }
}

// Create PDF document
$pdf = new PDF();
$pdf->AddPage();

// Set name and email as the title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, $name, 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Email: $email", 0, 1);
$pdf->Cell(0, 10, "Phone: $phone", 0, 1);
$pdf->Cell(0, 10, "Address: $address", 0, 1);
$pdf->Ln(5);

// Add profile summary
$pdf->addTitle("Profile Summary");
$pdf->addContent($summary);

// Add soft skills
$pdf->addTitle("Soft Skills");
$pdf->addContent($soft_skills);

// Add technical skills
$pdf->addTitle("Technical Skills");
$pdf->addContent($technical_skills);

// Add education background (optional)
$pdf->addTitle("Education");
$pdf->addContent("Institute: $institute");
$pdf->addContent("Degree: $degree");
$pdf->addContent("Year: $year");
$pdf->addContent("Grade: $grade");

// Add work experience
$pdf->addTitle("Work Experience");
$pdf->addContent($work_experience);

// Add projects/publications (optional)
$pdf->addTitle("Projects/Publication");
$pdf->addContent($project_publications);

// Output PDF to browser
$pdf->Output();
?>
