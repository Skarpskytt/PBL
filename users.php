<?php
// Include your database connection file or establish a connection here
include 'connection.php';

// Query to retrieve information for all users, excluding those with the role 'admin'
$sql = "SELECT i.id, i.fname, i.lname, i.phone_number, i.birth_date, i.email, i.address 
        FROM info i 
        WHERE i.role <> 'admin'";

$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error fetching data: " . $conn->error);
}


// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/users.css">
</head>
<body>

<header class="site-header">



<div class="announcement-header">
    <img src="css/images/Announcement-Logo.jpg" alt="">
    <p>Online Blood Donation: Blood Bank Management System</p>
    <ul class="admin-ddown"></ul>
    <li class="dropdown">
      <button>Administrator ↓</button>
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
            <li><a href="admin.php"><i class="fa-solid fa-house"></i>Home</a></li>         
            <li><a href="donors.php"><i class="fa-solid fa-person"></i>Donors</a></li>
            <li><a href="bloodrequests.php"><i class="fa-solid fa-list"></i>Requests</a></li>
            <li><a href="handedover.php"><i class="fa-solid fa-briefcase"></i>Handed Over</a></li>
            <li><a href="users.php"><i class="fa-solid fa-user"></i>Users</a></li>
</ul>
</div>


<div class="head">
  <h1>USER'S INFORMATION</h1> 
</div>


<!-- Your existing HTML code -->

<div class="container1">
        <table id="myTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Address</th>
              
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $userId = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $birthdate = $row['birth_date'];
                    $phone_number = $row['phone_number'];
                    $email = $row['email'];
                    $address = $row['address'];

                    echo '<tr>';
                    echo '<td>' . $userId . '</td>';
                    echo '<td>' . $fname . ' ' . $lname . '</td>';
                    echo '<td>' . $birthdate . '</td>';
                    echo '<td>' . $email . '</td>';
                    echo '<td>' . $phone_number . '</td>';
                    echo '<td>' . $address . '</td>';
                   
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Include DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Your existing JavaScript code -->
    <script>
    

    function confirmDelete(userId) {
        var confirmDelete = confirm("Are you sure you want to delete this user?");
        if (confirmDelete) {
            window.location.href = 'deleteuser.php?user_id=' + userId;
        }
        // If the user cancels, do nothing or provide alternative actions
    }
</script>