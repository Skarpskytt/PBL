<?php
// Include your database connection file or establish a connection here
include 'connection.php';

// Check if the user_id parameter is set in the URL
if (isset($_GET['user_id'])) {
    $userIdToDelete = $_GET['user_id'];

    // Perform the deletion query
    $deleteQuery = "DELETE FROM info WHERE id = $userIdToDelete";

    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect back to the users.php page after successful deletion
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Handle the case when user_id parameter is not set
    echo "User ID not specified.";
}

// Close the database connection
$conn->close();
?>
