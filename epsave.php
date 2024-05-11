<?php

session_start();
include 'connection.php';


// Check if the user is logged in
if (!isset($_SESSION["userID"])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit;
}



// Retrieve user ID from the session
$userID = $_SESSION["userID"];

// Fetch user information from the database based on user_id
$sql = "SELECT * FROM info WHERE id = $userID";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Display user information
    $fname = $row['fname'];
    $lname = $row['lname'];
    $address = $row['address'];
    $email = $row['email'];
    $birth_date = $row['birth_date'];
    // Add more fields as needed

    // Now you can use these variables in your HTML
} else {
    // Handle the case where the query fails
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFP | VIRTUAL LIFESAVER</title>
    <link rel="stylesheet" href="css/epsave.css">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8ad42b07a6.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
        <a href="homepage2.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h2>Your Profile</h2>
        <img src="css/images/default-profile.jpg" class="pic">
        <br><br>
        <label for="Name">
            <a class="save">Name: <?php echo $fname . ' ' . $lname; ?></a>
        </label> <br>
        <label for="Birthdate">
            <a class="save">Birthdate: <?php echo $birth_date; ?></a>
        </label> <br>
        <label for="Address">
            <a class="save">Address: <?php echo $address; ?></a>
        </label> <br>
        <label for="Email">
            <a class="save">Email: <?php echo $email; ?></a>
        </label> <br>
        <!-- Add more fields as needed -->
    </div>
</body>
</html>