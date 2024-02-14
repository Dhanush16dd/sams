<?php
// Database connection parameters
$servername = "localhost"; // Replace with your MySQL server name
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "sams"; // Replace with your MySQL database name

// Initialize variables to store error messages
$errors = [];

// Attempt to establish a connection to the database
$conn = new mysqli($servername, $username, $password, $database);
try {
    
    
    // Check if connection was successful
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Handle database connection errors
    $errors[] = $e->getMessage();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $name = $_POST["name"];
    $phoneNum = $_POST["phone_num"];
    $email = $_POST["email"];
    $insta = $_POST["insta"];
    $courses = $_POST["courses"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $fatherName = $_POST["father_name"];
    $fatherPhone = $_POST["father_phone_num"];
    $motherName = $_POST["mother_name"];
    $motherPhone = $_POST["mother_phone_num"];
    $highestQualification = $_POST["highest_qualification"];

    // Validate form data
    if (empty($name) || empty($phoneNum) || empty($email) || empty($insta) || empty($courses) || empty($state) || empty($city) || empty($fatherName) || empty($fatherPhone) || empty($motherName) || empty($motherPhone) || empty($highestQualification)) {
        $errors[] = "All fields are required.";
    }

    // If there are no errors, proceed with data insertion
    if (empty($errors)) {
        try {
            // Insert data into database
            $sql = "INSERT INTO admission_applications (name, phone_num, email, insta, courses, state, city, father_name, father_phone_num, mother_name, mother_phone_num, highest_qualification)
                    VALUES ('$name', '$phoneNum', '$email', '$insta', '$courses', '$state', '$city', '$fatherName', '$fatherPhone', '$motherName', '$motherPhone', '$highestQualification')";

            if ($conn->query($sql) === TRUE) {
                echo '
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
    <title>Success page</title>
    <link href="./styles/thankyou.css" rel="stylesheet" />
</head>
<body>
<div class=content>
  <div class="wrapper-1">
    <div class="wrapper-2">
      <h1>Thank you !</h1>
      <p>Thanks for Applaying in  SAMS Marine College  </p>
      <p>you should receive a confirmation email soon  </p>
    </div>
    <div class="footer-like">
      <p>
       <a href="/">Click here to send again</a>
      </p>
    </div>
</div>
</div>
</body>
</html>
                ';
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $conn->error);
            }
        } catch (Exception $e) {
            // Handle database insertion errors
            $errors[] = $e->getMessage();
        }
    }
}

// Close connection
$conn->close();

// Display error messages
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}
?>






