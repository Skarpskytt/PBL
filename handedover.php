<?php 


include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM bloodrequests WHERE status = 'Completed'";
$result = $conn->query($sql);




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
    <link rel="stylesheet" href="css/handedover.css">

        <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<!-- Include xlsx library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script >
   
   $(document).ready(function() {
    $('#export-members').click(function () {
        // Get the table headers
        var tableHeaders = [];
        $('#myTable thead th').each(function () {
            tableHeaders.push($(this).text());
        });

        // Get the table data excluding the action column
        var tableData = [];
        $('#myTable tbody tr').each(function () {
            var rowData = [];
            $(this).find('td:not(.button-action)').each(function () {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        // Create a worksheet
        var ws = XLSX.utils.aoa_to_sheet([tableHeaders, ...tableData]);

        // Create a workbook
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'MembersData');

        // Save the workbook as an Excel file
        XLSX.writeFile(wb, 'RecipientsList.xlsx');
    });
});

</script>
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
  <h1>RECIPIENT'S INFORMATION</h1> 
</div>

<div class="container1">
  <table  id="myTable">

  <thead>
    <tr>
    <th>User ID</th>
                <th>Name</th>
                <th>Blood Type</th>
                <th>Blood Type Requested</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Status</th>
             
                
    </tr>

    </thead>

    <tbody>
    <tr>

      <?php if ($result->num_rows > 0) {
    // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['requester_name'] . "</td>";
                echo "<td>" . $row['blood'] . "</td>";
                echo "<td>" . $row['request_blood'] . "</td>";
                echo "<td>" . $row['contact_number'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
     
                echo "</tr>";
            }
        } else {
          echo "<tr><td colspan='7'>No records found with Confirmed Status</td></tr>";
        
        }

    $conn->close();
          
          
      
      
      
      
      ?>
   
    </tr>

    </tbody>
  </table>


  <button class="export-member" id="export-members">Export Recipients Information (Excel)</button>
</div>