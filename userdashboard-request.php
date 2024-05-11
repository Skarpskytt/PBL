<?php
// Start the session
session_start();

include 'connection.php';



if (!isset($_SESSION["userID"])) {
  // Redirect to the login page if not logged in
  header("Location: index.php");
  exit;
}



// Include your database connection file or establish a connection here

$userID = $_SESSION["userID"];

// Query to retrieve information for blood requests of the logged-in user
$sql = "SELECT i.requester_name, i.request_blood, i.contact_number, i.message, i.id, i.status
        FROM bloodrequests i
        WHERE i.id = $userID";

$result = $conn->query($sql);
// Check if the query was successful




// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Recipient</title>


    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/userdashboard-requests.css">
</head>
<body>

<header class="site-header">


<div class="announcement-header">
    <img src="css/images/Announcement-Logo.jpg" alt="">
    <p>Online Blood Donation: Blood Bank Management System</p>
    <ul class="admin-ddown"></ul>
    <li class="dropdown">
      <button>User ↓</button>
      <div class="content">
        
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
</div>

<div class="og-container">
<div class="sidebar">
<ul>
<li><a href="homepage2.php"><i class="fa-solid fa-house"></i>Home</a></li>

  <li><a href="userdashboard-donation.php"><i class="fa-solid fa-droplet"></i></i>Your Donations</a></li>
  <li><a href="userdashboard-request.php"><i class="fa-solid fa-hand-holding-dollar"></i></i></i>Your Requests</a></li>
  
</ul>
</div>



<div class="head">
  <h1>USER'S CURRENT REQUEST</h1> 
</div>

<div class="container1">
    <table>
        <tr>
            <th>Name</th>
            <th>Blood Type Request</th>
            <th>Phone Number</th>
            <th>Message</th>
            <th>Status</th>
            
        </tr>

        <?php
        if ($result && $result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
              $id = $row['id'];
              $requesterName = $row['requester_name'];
              $bloodType = $row['request_blood'];
              $phoneNumber = $row['contact_number'];
              $message = $row['message'];
              $status = $row ['status'];
          
              echo '<tr>';
              // Exclude the line below to avoid displaying the user ID
              // echo '<td>' . $id . '</td>';
              echo '<td>' . $requesterName . '</td>';
              echo '<td>' . $bloodType . '</td>';
              echo '<td>' . $phoneNumber . '</td>';
              echo '<td>' . $message . '</td>';
              echo '<td>' . $status. '</td>';
          
              echo '<form method="post" action="">';
              echo '<input type="hidden" name="request_id" value="' . $id . '">';
          
              echo '</form>';
              echo '</td>';
              echo '</tr>';
          }
        }
?>





  </table>

</div>
