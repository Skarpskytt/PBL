<?php
include 'connection.php';

require 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email
    $email = $_POST['email'];

    // Validate the email (you may want to add more validation)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generate a unique token (you can use a library for this)
        $token = uniqid();

        // Store the token in the database along with the user's email
        // This is a simplified example; you should secure this process
        // and probably include an expiration time for the token
        $sql = "UPDATE info SET reset_token = '$token' WHERE email = '$email'";
        
        // Execute the SQL query and handle errors
        if ($conn->query($sql) === TRUE) {
            // Construct the reset link
            $resetLink = "http://localhost/dashboard/VIRTUAL-LIFESAVERS/reset-password.php?token=$token";

            // Send the email with the reset link
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to DEBUG_SERVER for debugging
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Username = SMTP_USERNAME; // Use the constant
                $mail->Password = SMTP_PASSWORD; // Use the constant

                // Recipients
                $mail->setFrom(SMTP_USERNAME, 'Reset Password Link');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

                $mail->send();

               echo '<script>alert("Password reset link sent successfully!");</script>';
            } catch (Exception $e) {
                echo "Error sending email: {$mail->ErrorInfo}";
            }
        } else {
            // If there is an error with the SQL query
             echo '<script>alert("Error updating reset token: ' . $conn->error . '");</script>';
        }
    } else {
        echo "Invalid email format";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Virtual Lifesaver</title>
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
        <form action="forgot.php" method="post">
            <h2>Forgot Password?</h2>
            <div class="input-box">
                <input type="email" name="email" placeholder="Enter your email" required>
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