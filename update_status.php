<?php
// update_status.php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection already established

    $userId = $_POST['id'];
    $newStatus = $_POST['newStatus'];

    // Perform the update query
    $updateQuery = "UPDATE bloodrequests SET status = '$newStatus' WHERE id = $userId";
    
    if ($conn->query($updateQuery) === TRUE) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
