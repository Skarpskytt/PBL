<?php
// Start the session
session_start();

if (!isset($_SESSION["userID"])) {
  // Redirect to the login page if not logged in
  header("Location: index.php");
  exit;
}

// Include your database connection file or establish a connection here
include 'connection.php';

$userID = $_SESSION["userID"];

// Query to retrieve information for blood donations of the logged-in user
$sql = "SELECT i.fname, i.mname , i.lname, i.blood_type, i.phonenumber, i.donor_id, i.day, i.time, i.id, i.status
        FROM donors i
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
    <link rel="stylesheet" href="css/userdashboard-donation.css">
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
                <li><a href="userdashboard-donation.php"><i class="fa-solid fa-droplet"></i>Your Donations</a></li>
                <li><a href="userdashboard-request.php"><i class="fa-solid fa-hand-holding-dollar"></i>Your Requests</a></li>
            </ul>
        </div>

        <div class="head">
            <h1>USER'S CURRENT DONATION</h1>
        </div>

        <div class="container1">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Blood Type</th>
                    <th>Date & Time</th>
                    <th>Status</th>
             
                </tr>

                <?php
                if ($result && $result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $fname = ucwords($row['fname']);
                        $mname = ucwords($row['mname']);
                        $lname = ucwords($row['lname']);
                        $time = $row['time'];
                        $day = $row['day'];
                        $formatted_date = date("F j, Y", strtotime($day));
                        $bloodtype = $row['blood_type'];
                        $status = $row['status'];

                        echo '<tr>';
                        echo '<td>' . $fname . ' ' . $mname . ' ' . $lname . '</td>';
                        echo '<td>' . $bloodtype . '</td>';
                        echo '<td>' . $formatted_date . ', ' . $time . '</td>';
                        echo '<td>' . $status . '</td>';
                       
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="donation_id" value="' . $id . '">';
                       
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>
        </div>
    </div>
</header>
</body>
</html>
