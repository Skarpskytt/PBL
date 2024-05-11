<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit;
}

// Retrieve user ID from the session
$userID = $_SESSION["userID"];

// Now you can use $userID in your dashboard page
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage2</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="css/homepage2.css">

</head>
<body>

<header class="site-header2">


<div class="announcement2">

    <img src="css/images/Announcement-Logo.jpg" alt="">

    <p>Online Blood Donation: Share, Save, Support</p>

    <p></p>

</div>


<nav class="nav2">
    
    <img src="css/images/Logo.png" alt="">

    <ul class="nav_list2">
    <li class="nav_list-item"><a href="homepage2.php" class="nav_link2">HOME</a></li>
            <li class="dropdown">
                <button>MORE ↓</button>
                <div class="content">
                    <a href="epsave.php">PROFILE</a>
                    <a href="editprofile.php">EDIT PROFILE</a>
                    <a href="userdashboard-donation.php">USER DASHBOARD</a>
                    <a href="htdprograms.php">HOW TO DONATE</a>
                    <!-- HTML code with a logout link -->
<a href="#" onclick="confirmLogout()">LOGOUT</a>
</header>

<!-- JavaScript code -->
<script>
    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to logout?");
        if (confirmLogout) {
            window.location.href = 'homepage.php'; // Redirect if the user confirms
        }
        // If the user cancels, do nothing or provide alternative actions
    }
</script>

                  </div>
           </li>
                
          
            
            </ul>
        </nav>
        
        
        <section class="main-section2">
            <div class="first-content2">
              <h1>Every drop of blood <br>
                  you give is a lifeline <br>
                  for someone in need.</h1>
              <p>The river of life that sustains, protects, <br>
                   and nurtures our existence. 
                  </p>
          
              <span>"BLOOD"</span>
          
              <div class="donate-btn2">
          
                  <a href="confirmation-donate.php">DONATE BLOOD NOW</a> 
                  <a href="confirmation-request.php">REQUEST BLOOD NOW</a>
              </div>
          
           
          
            </div>
          
          
          
            <div class="second-content2">
             
              <img src="css/images/second-content.png" alt="">
            </div>
          
          

   





</section>

<footer>
        <div class="f-item-con">
            <div class="app-info">
                <span class='app-name'>
                    <span class='app-initial'>V</span>irtual Lifesaver
                </span>
                <p> Every drop of blood <strong>you give is a lifeline
for someone in need.</strong> The river of life that sustains, protects,
and nurtures our existence.</p>
              



            </div>
            <div class="useful-links">
                <div class="footer-title">Useful Links</div>
                <ul>
                    <li>Home</li>
                    <li>Sign In</li>
                    <li>About Us</li>
                    <li>Become an Affiliate</li>
                    <li>Advertise with Us</li>
                    <li>Terms and Conditions</li>
                </ul>
            </div>
            <div class="help-sec">
                <div class="footer-title">Help</div>
                <ul>
                    <li>Help Me</li>
                    <li>Feedback</li>
                    <li>Report a Issue / Bug</li>
                </ul>
            </div>
            <div class="g-i-t">
                <div class="footer-title">Get in Touch</div>
                <form action="/" method="post" class="space-y-2">
                    <input type="text" name="g-name" class="g-inp" id="g-name" placeholder='Name' />
                    <input type="email" name="g-email" class="g-inp" id="g-email" placeholder='Email' />
                    <textarea type="text" name="g-msg" class="g-inp h-40 resize-none" id="g-msg" rows="4" cols="50"
                        placeholder='Message...'></textarea>
                    <button type="submit" class='f-btn'>Submit</button>
                </form>
            </div>
        </div>

        <div class='cr-con'>Copyright &copy; 2024 | Made by Group 3</div>
    </footer>


    
</body>
</html>