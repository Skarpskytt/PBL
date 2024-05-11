<?php

include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT * FROM bloodrequests WHERE status <> 'Completed'";
$result = $conn->query($sql);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestId = $_POST['requestId'];
    $newStatus = $_POST['status'];

    // Update the status in the database
    $updateSql = "UPDATE bloodrequests SET status = '$newStatus' WHERE request_id = '$requestId'";
    if ($conn->query($updateSql) === TRUE) {
        header("Location: bloodrequests.php"); // Redirect back to your page
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Requests</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/bloodrequests.css">
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
                <h1>BLOOD REQUESTS APPOINTMENT</h1>
            </div>

            <div class="container1">
        <table>
            <tr>
            <th>Request ID</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Blood Type</th>
                <th>Blood Type Requested</th>
                <th>Phone Number</th>
                <th>Email</th>
            
                <th>Action</th>
                
            </tr>

            <?php
            // Display data in the table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['request_id'] . "</td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['requester_name'] . "</td>";
                    echo "<td>" . $row['blood'] . "</td>";
                    echo "<td>" . $row['request_blood'] . "</td>";
                    echo "<td>" . $row['contact_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";

                    echo "<td>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='requestId' value='" . $row['request_id'] . "'>";
                    echo "<button type='submit' name='status' class='view-button' value='Completed'>Accept</button>";
                    echo "<button type='submit' name='status'  class= 'delete-button' value='Cancelled'>Cancel</button>";
                    echo "</form>";
                    echo "</td>";


                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data available</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </table>
    </div>

    <!-- Your existing HTML content -->

</body>

</html>

<script>
$(document).ready(function() {
    $(".accept-btn").on("click", function() {
        var userId = $(this).data("userid");
        updateStatus(userId, "Accepted");
    });

    $(".cancel-btn").on("click", function() {
        var userId = $(this).data("userid");
        updateStatus(userId, "Cancelled");
    });

    function updateStatus(userId, newStatus) {
        // Send an AJAX request to update the status
        $.ajax({
            type: "POST",
            url: "update_status.php", // Replace with your actual PHP file handling the update
            data: { userId: userId, newStatus: newStatus },
            success: function(response) {
                // Handle the response from the server (if needed)
                console.log(response);
            },
            error: function(error) {
                // Handle errors (if any)
                console.error(error);
            }
        });
    }
});
</script>