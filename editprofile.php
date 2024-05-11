<?php


include 'connection.php';

session_start();

if (!isset($_SESSION["userID"])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit;
}


$userID = $_SESSION["userID"]; // Get userID from the session

// Fetch user information from the database
$sql_select = "SELECT * FROM info WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $userID);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows > 0) {
    // Fetch the user details
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $address = $row["address"];
    $phone_number = $row["phone_number"];
    $email = $row["email"];
} else {
    // Handle the case where user details are not found
    echo "User details not found.";
    exit;
}

$stmt_select->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    $userID = $_SESSION["userID"]; // Get userID from the session

    $sql = "UPDATE info SET fname='$fname', lname='$lname', address='$address', phone_number='$phone_number', email='$email' WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        // Display success message using JavaScript prompt
        echo "<script>alert('Profile updated successfully'); window.location.href = 'homepage2.php';</script>";
    } else {
        // Display error message using JavaScript prompt
        echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
    }

    

}



$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="wrapper">
        <a href="homepage2.php"><i class="fa-solid fa-arrow-left"></i></a>
        
            <h2>Edit Profile</h2>
            <form method="POST" enctype='multipart/form-data'>
                <div class="input-box">
                    <p>First Name:</p>
                    <input class="editinput" type="text" placeholder="Enter your name" name="fname" value="<?php echo $fname ?>"required>
                </div>
                <br>
                <div class="input-box">
                    <p>Last Name:</p>
                    <input class="editinput" type="text" placeholder="Enter your name" name="lname" value="<?php echo $lname ?>" required>
                </div>
                <br>
                <div class="input-box">
                    <p>Address:</p>
                    <input class="editinput" type="text" placeholder="Enter your address" name="address" value="<?php echo $address ?>" required>
                </div>
                <br>
                <div class="input-box">
                    <p>Contact Number:</p>
                    <input class="editinput" type="text" placeholder="Enter your contact number" name="phone_number"  value="<?php echo $phone_number ?>" required>
                </div>
                <br>
                <div class="input-box">
                    <p>Email Address:</p>
                    <input class="editinput" type="text" placeholder="Enter your contact number" name="email" value="<?php echo $email ?>" required>
                </div>
                
                <br>
                <br>
                <button class="save-btn">
                   <input type="submit" value="Save Changes">
                </button>
            </form>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>