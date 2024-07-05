<?php
session_start();
// Include the database connection file
include '../db/db_connect.php';

$username = $_SESSION['username'];
$store_id = $_SESSION['store_id'];

$status = '2';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $supervisors = implode(', ', $_POST['supervisors']);
    $operators = implode(', ', $_POST['operators']);
    $labours = implode(', ', $_POST['labours']);
    $shift = $_POST['shift'];
    $departmentName = $_POST['departmentName'];
    $date = $_POST['date'];
    $time = $_POST['time'];


    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO form_details (supervisors, operators, labours, shift, departmentName, status, username, date, time, store_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $supervisors, $operators, $labours, $shift, $departmentName, $status, $username, $date, $time, $store_id);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Record inserted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Redirect with message
header("Location: home.php?message=" . urlencode($message));
exit();

?>