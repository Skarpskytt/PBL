

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
    $username = $_POST['email'];
    $password = $_POST['password'];

    /// Prepare and execute the SQL statement
        $stmt = $conn->prepare("SELECT id, email, password, Role, OTP, OTP_Expiration, OTP_activated FROM info WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();


    // Check if a user with the given username exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $dbUsername, $dbPassword,  $userRole, $otpFromDb, $otpExpiration, $otpActivated);


        $stmt->fetch();

        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $dbPassword)) {
            // Password is correct, set up a session or redirect based on the role
            session_start();
      
            $_SESSION["userID"] = $userId;
            $_SESSION['email'] = $dbUsername;
         
                

            if ($otpExpiration > date('Y-m-d H:i:s')) {
                // OTP is still valid, proceed with the login
                if ($otpActivated == 0) {
                    // Generate a random OTP
                    $otp = mt_rand(100000, 999999);

                    // Set OTP, its expiration time, and mark OTP as not activated in the database
                    $otpExpiration = date('Y-m-d H:i:s', strtotime('+7 days')); // Change the expiration time as needed

                    $updateStmt = $conn->prepare("UPDATE info SET OTP = ?, OTP_Expiration = ?, OTP_activated = 0 WHERE id = ?");
                    $updateStmt->bind_param("ssi", $otp, $otpExpiration, $userId);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Send OTP to the user's email using PHPMailer
                    $mail = new PHPMailer(true);

                    try {

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->Username = SMTP_USERNAME; // Use the constant
                        $mail->Password = SMTP_PASSWORD; // Use the constant
    
                            $mail->setFrom(SMTP_USERNAME,  'OTP VERIFICATION');
                            $mail->addAddress($dbUsername); // User's email address
    
                            $mail->isHTML(true);
                            $mail->Subject = 'OTP for Login';
                            $mail->Body    = 'Your OTP is: ' . $otp;
    
                            $mail->send();
      

                        // Redirect the user to OTP.php
                        header("Location: otp.php");
                        exit();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            } else {
                // OTP has expired, send a new OTP
                echo "<script>alert('OTP has expired. Sending a new OTP.'); window.location.href = 'otp.php';</script>";

                // Generate a random OTP
                $otp = mt_rand(100000, 999999);

                // Set OTP, its expiration time, and mark OTP as not activated in the database
                $otpExpiration = date('Y-m-d H:i:s', strtotime('+7 days'));

                $updateStmt = $conn->prepare("UPDATE info SET OTP = ?, OTP_Expiration = ?, OTP_activated = 0 WHERE id = ?");
                $updateStmt->bind_param("ssi", $otp, $otpExpiration, $userId);
                $updateStmt->execute();
                $updateStmt->close();

                // Send OTP to the user's email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->Username = SMTP_USERNAME; // Use the constant
                    $mail->Password = SMTP_PASSWORD; // Use the constant

                        $mail->setFrom(SMTP_USERNAME,  'OTP VERIFICATION');
                        $mail->addAddress($dbUsername); // User's email address

                        $mail->isHTML(true);
                        $mail->Subject = 'OTP for Login';
                        $mail->Body    = 'Your OTP is: ' . $otp;

                        $mail->send();


                    // Redirect the user to OTP.php
                    header("Location: otp.php");
                    exit();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }

            if ($userRole == 'admin') {
                echo "<script>alert('Admin login successfully'); window.location.href = 'admin.php';</script>";
            } else {
                echo "<script>alert('User login successfully'); window.location.href = 'homepage2.php';</script>";
            }
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        // User with the given username does not exist
        echo "<script>alert('User not found. Please check your username.');</script>";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signin.css">
    <title>Sign in | Virtual Lifesaver</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8ad42b07a6.js" crossorigin="anonymous"></script>
    
</head>
<header class="site-header">
    <div class="announcement">
        <img src="css/images/Announcement-Logo.jpg" alt="">
        <p>Online Blood Donation: Share, Save, Support</p>
        <p></p>
    </div>
    <nav class="nav">
        <img src="css/images/Logo.png" alt="">
        <ul class="nav_list">
            <li class="nav_list-item"><a href="homepage.php" class="nav_link">HOME</a></li>
            <li class="nav_list-item"><a href="about.php" class="nav_link">ABOUT</a></li>
            <li class="nav_list-item"><a href="contact.php" class="nav_link">CONTACT</a></li>
            <li class="nav_list-item"><a href="index.php" class="nav_link">SIGN IN</a></li>
            <li class="nav_list-item"><a href="signup_process.php" class="nav_link">SIGN UP</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="wrapper">
        <h2>Sign In</h2>
        <form action="index.php" method="post">
            <div class="input-box">
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div>
                <a class="forgot" href="forgot.php">Forgot Password?</a>
            </div>
            <div class="input-box button">
                <input type="submit" name="submit" value="Sign in">
            </div>
            <div class="text">
                <h4>No account yet? <a href="signup_process.php">Sign up now</a></h4>
            </div>
</div>
        </form>
    
</body>
</html>




