<?php
include 'connection.php';

session_start();

if (!isset($_SESSION["userID"])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit;
}


// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = isset($_POST["requester_name"]) ? $_POST["requester_name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $contactnumber = isset($_POST["contactnumber"]) ? $_POST["contactnumber"] : '';
    $blood = isset($_POST["blood"]) ? $_POST["blood"] : '';
    $request_blood = isset($_POST["request_blood"]) ? $_POST["request_blood"] : '';
    $purpose = isset($_POST["purpose"]) ? $_POST["purpose"] : '';
    $message = isset($_POST["message"]) ? $_POST["message"] : '';


    $userID = $_SESSION["userID"];

    // Insert data into the database
    $sql = "INSERT INTO bloodrequests ( requester_name, id, email, contact_number, blood, request_blood, purpose, message) 
        VALUES ( '$fname', '$userID', '$email', '$contactnumber', '$blood', '$request_blood', '$purpose', '$message')";
    echo "SQL Query: " . $sql . "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Request Sent!'); window.location.href = 'homepage2.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close the database connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Form | Virtual Lifesaver</title>
    <link rel="stylesheet" href="css/requestform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <div class="wrapper">
    <a href="homepage2.php" ><i class="fa-solid fa-arrow-left"></i></a>
    <form action=" " method="post" class="form">
        <h2>Blood Request Appointment</h2>
      
        
            <div class="input-box">
                Full Name: <br>
                <input type="text" placeholder="Enter your name" name="requester_name" required>
            </div>
            <br>
            <div class="input-box">
                Email: <br>
                <input type="text" placeholder="Enter your email" name="email" required>
            </div>
            <br>
            <div class="input-box">
                Contact Number: <br>
                <input type="text" placeholder="Enter your Phone number" name="contactnumber" required>
            </div>
            <br>
            
            <label for="blood">Blood Type:</label>
            <select id="blood" name="blood">
                <option value="a+">A+</option>
                <option value="a-">A-</option>
                <option value="b+">B+</option>
                <option value="b-">B-</option>
                <option value="ab+">AB+</option>
                <option value="ab-">AB-</option>
                <option value="o+">O+</option>
                <option value="o-">O-</option>
            </select>
            <label for="request_blood">Request Blood Type:</label>
            <select id="request_blood" name="request_blood">
                <option value="a+">A+</option>
                <option value="a-">A-</option>
                <option value="b+">B+</option>
                <option value="b-">B-</option>
                <option value="ab+">AB+</option>
                <option value="ab-">AB-</option>
                <option value="o+">O+</option>
                <option value="o-">O-</option>
            </select>
            <div class="input-box">
                Purpose of Blood Request: <br>
                <input type="text" placeholder="Purpose of your request" name="purpose" required>
            </div>
           
            <br>
            Additional Message (Optional)<br>
            <textarea class="Message" name="message" rows="9" cols="49"></textarea>
            <div class="submit-container">
                <button name="submit" class="submit-button" type="submit"><span>Submit</span></button>
            </div>
        </form>
    </div>
</body>
</html>
