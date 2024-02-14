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
                echo "New record created successfully";
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
