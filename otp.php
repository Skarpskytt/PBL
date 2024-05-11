<?php


include 'connection.php';
require 'config.php';
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Fetch user input
    $enteredOTP = $_POST['otp'];

    // Retrieve user information from the database based on the session or any other identifier
    session_start();

    if (isset($_SESSION['userID'])) {
        $userId = $_SESSION['userID'];

        echo "User ID: " . $userId;

    // Fetch OTP and OTP expiration from the database
    $stmt = $conn->prepare("SELECT OTP, OTP_Expiration, Role, OTP_activated FROM info WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($otpFromDb, $otpExpiration, $userRole, $otpActivated);
    $stmt->fetch();
    $stmt->close();





        // Verify the entered OTP
        if (!empty($otpFromDb) && time() <= strtotime($otpExpiration) && $enteredOTP == $otpFromDb) {
            // OTP is correct and not expired
            // You can update the user status, clear the OTP, or perform other actions as needed
            echo "<script>alert('OTP verification successful.');</script>";

            // Update OTP_activated to 1 in the database
            $updateStmt = $conn->prepare("UPDATE info SET OTP_activated = 1 WHERE id = ?");
            $updateStmt->bind_param("i", $userId);
            $updateStmt->execute();
            $updateStmt->close();

            // Redirect based on the user's role
            if ($userRole == 'admin') {
                echo "<script>alert('Admin login successfully'); window.location.href = 'admin.php';</script>";
            } elseif ($userRole == 'user') {
                echo "<script>alert('User login successfully'); window.location.href = 'homepage2.php';</script>";
            } else {
                // Handle other roles as needed
                echo "<script>alert('Unknown role.');</script>";
            }
            exit();
        } else {
            // OTP verification failed
            echo "<script>alert('Invalid OTP. Please try again.');</script>";
        }
    } else {
        // User is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP | Virtual Lifesaver</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Forgot Password?</title>
</head>
   <body>
   <header class="site-header">
    <div class="announcement">
        <img src="images/Announcement-Logo.jpg" alt="">
        <p>Online Blood Donation: Share, Save, Support</p>
        <p></p>
    </div>
    <nav class="nav">
        <img src="images/Logo.png" alt="">
        <ul class="nav_list">
        <li class="nav_list-item"><a href="homepage.php" class="nav_link">HOME</a></li>
            <li class="nav_list-item"><a href="about.php" class="nav_link">ABOUT</a></li>
            <li class="nav_list-item"><a href="contact.php" class="nav_link">CONTACT</a></li>
            <li class="nav_list-item"><a href="index.php" class="nav_link">SIGN IN</a></li>
            <li class="nav_list-item"><a href="signup_process.php" class="nav_link">SIGN UP</a></li>
        </ul>
    </nav>
  </header>
  </div>
  <div class="wrapper">
        <form action="" method="post">
            <h2>OTP VERIFICATION</h2>
            <div class="input-box">
                <input type="text" name="otp" placeholder="Enter your OTP" required>
                <i class='bx bx-user'></i>
            </div>
        
         

            <div class="input-box button">
        <input type="submit" name="Submit" value="Submit">
        </div>
           
    
        <div id="success-message" style="display: none; color: green;">Password Successfully changed!</div>
    </div>
</form>

</body>
</html>

