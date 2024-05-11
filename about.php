<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us | Virtual Lifesaver</title>



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="css/about.css">

</head>
<body>


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

    <section class="about-main-section">
        <div class="about-section">
            <p><span>A</span>bout <span>U</span>s</p>
          </div>
  
        
      
      
      
        
      </section>
      <section class="second-section">
       
            <div class="about-second-content">
                <img src="css/images/blood-donor.jpg" alt="">
              </div>

            <div class="abt-first-content">
                
            
                <h1>VIRTUAL <br>
                    LIFESAVER <br>
                </h1>
                <p>A Website that is an accessible and user-friendly <br>
                    online platform that encourages individuals to <br>
                    register as blood donors. <br>
                    </p>
            
                    <div class="donate-btn">
          
          <a href="index.php">DONATE BLOOD NOW</a>
              <a href="index.php">REQUEST BLOOD NOW</a>
          </div>
      
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
                    <textarea type="text" name="g-msg" class="g-inp h-40 resize-none" id="g-msg"
                        placeholder='Message...'></textarea>
                    <button type="submit" class='f-btn'>Submit</button>
                </form>
            </div>
        </div>

        <div class='cr-con'>Copyright &copy; 2024 | Made by Group 3</div>
    </footer>

<script>
    // HEADER 

// Get the header element
const header = document.querySelector('.site-header');

// Add an event listener to the window's scroll event
window.addEventListener('scroll', () => {
    // Check if the scroll position is greater than a certain value (e.g., 100px)
    if (window.scrollY > 100) {
        // Add the class to change the background color
        header.classList.add('scrolled');
    } else {
        // Remove the class to revert the background color
        header.classList.remove('scrolled');
    }
});
</script>

      </body>
    <style>
        
            </style>
