<?php
// Assuming you have a database connection established
include 'connection.php';
// Fetch data from the database
$result = mysqli_query($conn, "SELECT blood_type FROM donors");


// Count total donors
$donorsQuery = mysqli_query($conn, "SELECT COUNT(donor_id) AS totalDonors FROM donors");
$totalDonorsResult = mysqli_fetch_assoc($donorsQuery);
$totalDonors = $totalDonorsResult['totalDonors'];

// Count total requests and approved requests
$requestsQuery = mysqli_query($conn, "SELECT COUNT(*) AS totalRequests, SUM(CASE WHEN status = 'approved' THEN 1 ELSE 0 END) AS approvedRequests FROM bloodrequests");
$totalRequestsResult = mysqli_fetch_assoc($requestsQuery);
$totalRequests = $totalRequestsResult['totalRequests'];
$approvedRequests = $totalRequestsResult['approvedRequests'];

// Initialize counters
$bloodTypeCounts = array(
    'a+' => 0,
    'b+' => 0,
    'o+' => 0,
    'ab+' => 0,
    'a-' => 0,
    'b-' => 0,
    'o-' => 0,
    'ab-' => 0,
);

// Count occurrences of each blood type
while ($row = mysqli_fetch_assoc($result)) {
    $bloodType = $row['blood_type'];
    if (isset($bloodTypeCounts[$bloodType])) {
        $bloodTypeCounts[$bloodType]++;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/adminui.css">

</head>
<body>




<header class="announcement-header">
    <img src="css/images/Announcement-Logo.jpg" alt="">
    <p>Online Blood Donation: Blood Bank Management System</p>
    <ul class="admin-ddown"></ul>
    <li class="dropdown">
      <button>Administrator ↓</button>
      <div class="content">
          <!-- HTML code with a logout link -->
<a href="#" onclick="confirmLogout()">LOGOUT</a>

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
</header>






<div class="main--content">



    <div class="sidebar">
          <ul >
            <li><a href="admin.php"><i class="fa-solid fa-house"></i>Home</a></li>
            <li><a href="donors.php"><i class="fa-solid fa-person"></i>Donors</a></li>
            <li><a href="bloodrequests.php"><i class="fa-solid fa-list"></i>Requests</a></li>
            <li><a href="handedover.php"><i class="fa-solid fa-briefcase"></i>Handed Over</a></li>
            <li><a href="users.php"><i class="fa-solid fa-user"></i>Users</a></li>
          </ul>
      </div>




      <div class="side-content">


                        
              <div class="head">
                <h1>Welcome back, Administrator!</h1> 
                <h2>Available Blood per group in Liters</h2>
              </div> 

            <div class="container1">

                <?php foreach ($bloodTypeCounts as $type => $count): ?>
                  <div class="type-blood">
                      <p><?= strtoupper($type) ?> <i class="fa-solid fa-droplet"></i></p>
                      <span><?= $count ?></span>
                  </div>
              <?php endforeach; ?>

              

                <div class="total-donors">
        <p>Total Donors <span><?= $totalDonors ?></span></p>
              </div>

              <div class="total-requests">
                  <p>Total Requests <span><?= $totalRequests ?></span></p>
              </div>

              <div class="approved-requests">
                  <p>Approved Requests <span><?= $approvedRequests ?></span></p>
              </div>
              



            </div>




      </div>





</div>









</body>


</html>