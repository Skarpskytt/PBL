    <?php
    include 'connection.php';
    

    // Start the session
session_start();


if (!isset($_SESSION["userID"])) {
  // Redirect to the login page if not logged in
  header("Location: index.php");
  exit;
}


    function processForm() {
        // Include the connection variable
        global $conn;

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form is submitted
        if (isset($_POST['submit'])) {

            $userID = $_SESSION["userID"];
            // Retrieve form data
            $blood_type = $_POST['blood_type'];
            $firstName = $_POST['fname'];
            $middleName = $_POST['mname'];
            $lastName = $_POST['lname'];
            $houseNumber = $_POST['house_number'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $zipcode = $_POST['zipcode'];
            $birthdate = $_POST['birthdate'];
            $email = $_POST['email'];
            $occupation = $_POST['occupation']; 
            $phoneNumber = $_POST['phonenumber'];
            $gender = $_POST['gender'];
            $weight = $_POST['weight'];
            $pulse = $_POST['pulse'];
            $bloodPressure = $_POST['bp'];
            $temperature = $_POST['temp'];
            $lastDonationDate = $_POST['last_donation_date'];
        
           
            $donationDay = $_POST['date'];
            $donationTime = $_POST['time'];

            $stmt = $conn->prepare("INSERT INTO donors (id, blood_type, fname, mname, lname, house_number, street, barangay, zipcode, birthdate, email, occupation, phonenumber, gender, weight, pulse, bp, temp,  last_donation_date, day, time)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
        $stmt->bind_param("issssssssssssssssssss", $userID, $blood_type, $firstName, $middleName, $lastName, $houseNumber, $street, $barangay, $zipcode, $birthdate, $email, $occupation, $phoneNumber, $gender, $weight, $pulse, $bloodPressure, $temperature,  $lastDonationDate, $donationDay, $donationTime);

            if ($stmt->execute()) {
                echo "<script>alert('Donation Sent!'); window.location = 'homepage2.php';</script>";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Call the function to process the form data
    processForm();
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Form | Virtual Lifesaver</title>
    <link rel="stylesheet" href="css/bdform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <section class="container">
    <a href="homepage2.php" ><i class="fa-solid fa-arrow-left"></i></a>
        <h2>Blood Donation Form</h2>


    <form action="" method="post" class="form">
            What is your blood type? <br>
            <div class="blood-type-container">               
                <div class="form-check">
                    <div class="radio-box">
                        <input class="form-check-input" type="radio" name="blood_type" id="a+"value="a+">
                        <label class="form-check-label" for="a+">A+</label>
                    </div>
                    <div class="flexRadioDefault">
                        <input class="form-check-input" type="radio" name="blood_type" id="a-"value="a-">
                        <label class="form-check-label" for="a-">A-</label>
                    </div>
            <div class="radio-box">
                <input class="form-check-input" type="radio" name="blood_type" id="b+"value="b+">
                <label class="form-check-label" for="b+">B+</label>
            </div>
            <div class="radio-box">
                <input class="form-check-input" type="radio" name="blood_type" id="b-"value="b-">
                <label class="form-check-label" for="b-">B-</label>
            </div>
              </div>
              <div class="form-check">
                <div class="radio-box">
                    <input class="form-check-input" type="radio" name="blood_type" id="ab+"value="ab+">
                    <label class="form-check-label" for="ab+">AB+</label>
                </div>
                <div class="radio-box">
                    <input class="form-check-input" type="radio" name="blood_type" id="ab-"value="ab-">
                    <label class="form-check-label" for="ab-">AB-</label>
                </div>
                <div class="radio-box">
                    <input class="form-check-input" type="radio" name="blood_type" id="o+"value="o+">
                    <label class="form-check-label" for="o+">O+</label>
                </div>
                <div class="radio-box">
                    <input class="form-check-input" type="radio" name="blood_type" id="o-"value="o-">
                    <label class="form-check-label" for="o-">O-</label>
                </div>
              </div>
            </div>
            <!-- NAME -->
            <div class="column">
                <div class="input-box">
                <label>First Name</label>
                <input type="text" placeholder="Enter first name" name="fname" required>
            </div>
            <div class="input-box">
                <label>Middle Name</label>
                <input type="text" placeholder="Enter middle name" name="mname" required>
            </div>
            <div class="input-box">
                <label>Last Name</label>
                <input type="text" placeholder="Enter last name" name="lname" required>
            </div>
            </div>
            <!-- NAME -->
            <div class="column">
            <div class="input-box">
                <label>House Number</label>
                <input type="text" placeholder="" name="house_number" required>
            </div>
            <div class="input-box">
                <label>Street</label>
                <input type="text" placeholder="" name="street" required>
            </div>
            <div class="input-box">
                <label>Barangay</label>
                <input type="text" placeholder="" name="barangay" required>
            </div>
            <div class="input-box">
                <label>Zip code</label>
                <input type="text" placeholder="" name="zipcode" required>
            </div>
            </div>
            <!-- ADDRESS -->
            <div class="column">
                <div class="input-box">
                <label>Birthdate</label>
                <input type="date" placeholder="Birthday" name="birthdate" required>
                </div>
                <div class="input-box">
                <label>Email</label>
                <input type="text" placeholder="Enter email" name="email" required>
                </div>
            </div>
             <!-- Birth and email -->
             <div class="column">
                <div class="input-box">
                <label>Occupation (optional)</label>
                <input type="text" id="occupation" name="occupation" placeholder="Enter occupation">
                </div>
                <div class="input-box">
                    <label>Mobile Number</label>
                    <input type="tel" name="phonenumber" placeholder="Enter your phone number" required>
                    </div>
            </div>
            <!-- Occupation and Mobile Num -->
           <div class="gender-box">
            <h3>Gender</h3>
            <div class="gender-option">
                <div class="gender">
                    <input  type="radio" id="check-male" name="gender"value="male" />
                    <label for="check-male">Male</label>
                </div>
                <div class="gender">
                    <input  type="radio" id="check-female" name="gender" value="female" />
                    <label for="check-female">Female</label>
                </div>
                <div class="gender">
                    <input  type="radio" id="check-other" name="gender"value="prefer not to say" />
                    <label for="check-other">Prefer not to say</label>
                </div>
            </div>
           </div>
           <!-- Gender Checkbox -->
           <div class="column">
            <div class="input-box">
            <label>Weight</label>
            <input type="text" placeholder="Enter weight" name="weight">
        </div>
        <div class="input-box">
            <label>Pulse</label>
            <input type="text" placeholder="Enter pulse" name="pulse">
        </div>
        </div>
        <div class="column">
            <div class="input-box">
            <label>Blood Pressure</label>
            <input type="text" placeholder="Enter BP" name="bp">
        </div>
        <div class="input-box">
            <label>Temperature</label>
            <input type="text" placeholder="Enter temperature" name="temp">
        </div>
        </div>
            <!-- TEST -->
        <div class="donate-box">
            
            <div class="divcolumn">
                <div class="input-box">
                <label>When was the last time you donated blood?</label>
                <input type="date" placeholder="Donation Date" name="last_donation_date" >
            </div>
        </div>
  

        <div class="input-box">
                <label>Select date </label>
                <input type="date" placeholder="date" name="date" required>
            </div>

        
      

              <br>
              <br>
  
              <label for="time">Select time to donate:</label>
              <select id="time" name="time" class="pftime">
              <option value=" 9:00 AM - 10:30 AM ">9:00 AM - 10:30 AM</option>
              <option value=" 10:30 AM - 12:00 PM ">10:30 AM - 12:00 PM</option>
              <option value=" 12:00 PM - 1:30 PM ">12:00 PM - 1:30 PM</option>
              <option value=" 1:30 PM - 3:00 PM ">1:30 PM - 3:00 PM</option>
              <option value=" 3:00 PM - 4:30 PM ">3:00 PM - 4:30 PM </option>
            </select>
        <div class="submit-container">
             <button name="submit" class="submit-button" type="submit"><span>Submit</span></button>
        </div>

        
    </form>





    </section>

    
</body>
</html>