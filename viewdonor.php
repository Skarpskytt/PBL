<?php 

session_start();

// Include your database connection file or establish a connection here
include 'connection.php';




// Check if the patient ID is provided in the URL
if (!isset($_GET['donor_id'])) {
    header("Location: donors.php");
    exit();
}

$donor_id= $_GET['donor_id'];

// Fetch appointment details based on the patient ID
$sqlDonors = "SELECT * FROM donors WHERE donor_id = $donor_id";
$resultDonors = $conn->query($sqlDonors);
$donorDetails = $resultDonors->fetch_assoc();



// Close the database connection
$conn->close();












?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Donor</title>


    
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="css/viewdonors.css">
</head>

<body>
<header class="site-header">
        <div class="announcement">

            <img src="css/images/Announcement-Logo.jpg" alt="">

            <p>Online Blood Donation: Share, Save, Support</p>

            <p></p>

        </div>
</header>

<div class="container1">


            <div class="profile-view">

                        <img src="https://i.pinimg.com/564x/63/53/d9/6353d9fff14cc31af369dd0254fd8c97.jpg" alt="" width="80px" height="80px">

                        <p class="name"> <?php echo 'Donor ID: ' . $donorDetails['donor_id'] ; ?>  </p>


            </div>


            <div class="information-view">


            <p class="text-view">Email: <span class="information"> <?php echo $donorDetails['email']; ?></span></p>
<p class="text-view">Full Name: <span class="information"> <?php echo $donorDetails['lname'] . ', ' .$donorDetails['fname']; ?></span></p>
<p class="text-view">Blood Type: <span class="information"> <?php echo $donorDetails['blood_type']; ?></span></p>
<p class="text-view">Gender: <span class="information"> <?php echo $donorDetails['gender']; ?></span></p>
<p class="text-view">Occupation: <span class="information"> <?php echo $donorDetails['occupation']; ?></span></p>
<p class="text-view">Phone Number: <span class="information"> <?php echo $donorDetails['phonenumber']; ?></span></p>
<p class="text-view">Weight: <span class="information"> <?php echo $donorDetails['weight']; ?></span></p>
<p class="text-view">Pulse: <span class="information"> <?php echo $donorDetails['pulse']; ?></span></p>
<p class="text-view">Blood Pressure: <span class="information"> <?php echo $donorDetails['bp']; ?></span></p>
<p class="text-view">Temperature: <span class="information"> <?php echo $donorDetails['temp']; ?></span></p>
<p class="text-view">Last Donation Date: <span class="information"> <?php echo date('F j, Y', strtotime($donorDetails['last_donation_date'])); ?></span></p>
<p class="text-view">Address: <span class="information"> <?php echo $donorDetails['house_number'] . ' ' . $donorDetails['street'] . ', ' . $donorDetails['barangay'] . ', ' . $donorDetails['zipcode']; ?></span></p>
<p class="text-view">Birthdate: <span class="information"> <?php echo date('F j, Y', strtotime($donorDetails['birthdate'])); ?></span></p>






                    <p class="text-view"><span class="information"></span></p>

            <button class="list">
            <a href="donors.php">Back to List of Donors</a>
            </button>

                   


            </div>


     

   
</div>
    

    
</body>
</html>