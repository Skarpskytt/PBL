<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the token from the URL
    $token = $_GET['token'];

    // Validate the token (you may want to add more validation)
    if (!empty($token)) {
        // Check if the token exists in the database
        $sql = "SELECT email FROM info WHERE reset_token = '$token'";
        
        // Execute the SQL query and handle errors
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            // Token is valid, update the password
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validate password (you may want to add more validation)
            if ($password === $confirmPassword) {
                // Hash the password before storing it in the database for security
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $updateSql = "UPDATE info SET password = '$hashedPassword', reset_token = NULL WHERE reset_token = '$token'";
                
                // Execute the SQL query and handle errors
                if ($conn->query($updateSql) === TRUE) {
                    echo '<script>alert("Password successfully changed!!");</script>';
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "Passwords do not match";
            }
        } else {
            echo "Invalid token";
        }
    } else {
        echo "Token not provided";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Virtual Lifesaver</title>
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
            <h2>Reset password?</h2>
          


         

            <div class="input-box">
                <input type="password" id="password" class="emailinput" name="password" placeholder="Password" >
                <i class="fa fa-eye-slash toggle" id="eye-password" onclick="togglePasswordVisibility('password', 'eye-password')"></i>
            </div>

            <div id="password-strength" class="password-strength"></div>


            <div class="input-box">               
                <input type="password" id="confirm-password" class="emailinput" name="confirm_password" placeholder="Confirm Password" >
                <i class="fa fa-eye-slash toggle" id="eye-confirm-password" onclick="togglePasswordVisibility('confirm-password', 'eye-confirm-password')"></i>
            </div>


        
         

            <div class="input-box button">
        <input type="submit" name="Submit" value="Submit">
        </div>
           
    
        <div id="success-message" style="display: none; color: green;">Password Successfully changed!</div>
    </div>
</form>

</body>
</html>

