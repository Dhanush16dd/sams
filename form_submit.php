<?php

// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "sams";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Step 1 form data
    $firstName = clean_input($_POST['first_name']);
    $lastName = clean_input($_POST['last_name']);
    $phoneNo = clean_input($_POST['phone_no']);
    $email = clean_input($_POST['email']);
    $dob = clean_input($_POST['dob']);
    $gender = clean_input($_POST['gender']);
    $maritalStatus = clean_input($_POST['marital_status']);
    $bloodGroup = clean_input($_POST['blood_group']);
    $state = clean_input($_POST['state']);
    $city = clean_input($_POST['city']);
    
    // Handle Step 2 form data
    $fatherName = clean_input($_POST['father_name']);
    $fatherPhone = clean_input($_POST['father_phone']);
    $fatherEmail = clean_input($_POST['father_email']);
    $motherName = clean_input($_POST['mother_name']);
    $motherPhone = clean_input($_POST['mother_phone']);
    $motherEmail = clean_input($_POST['mother_email']);
    
    // Handle Step 3 form data
    // Handle uploaded files
    
    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO your_table_name (first_name, last_name, phone_no, email, dob, gender, marital_status, blood_group, state, city, father_name, father_phone, father_email, mother_name, mother_phone, mother_email)
            VALUES ('$firstName', '$lastName', '$phoneNo', '$email', '$dob', '$gender', '$maritalStatus', '$bloodGroup', '$state', '$city', '$fatherName', '$fatherPhone', '$fatherEmail', '$motherName', '$motherPhone', '$motherEmail')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success page after successful submission
        header("Location: success.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to sanitize input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close database connection
$conn->close();

?>
