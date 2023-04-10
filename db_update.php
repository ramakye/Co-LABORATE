<?php

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$data = json_decode(file_get_contents('php://input'), true);

// Prepare SQL statement
$stmt = $conn->prepare("UPDATE your_table SET name=?, email=?, phone=?, location=?, user_type=? WHERE id=?");
$stmt->bind_param("sssssi", $data['name'], $data['email'], $data['phone'], $data['location'], $data['user_type'], $id);

// Execute SQL statement
$id = 1; // Replace with the ID of the record you want to update
$stmt->execute();

// Check if the record was updated successfully
if ($stmt->affected_rows > 0) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}

$stmt->close();
$conn->close();

?>
