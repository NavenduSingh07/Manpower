<?php
// Database connection
include '../db/db_connect.php'; // Include your database connection file

$status = '2';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id = $_POST['form_id'];
    $departmentName = $_POST['departmentName'];
    $store_id = $_POST['store_id'];
    $workdone = $_POST['workdone'];

    // Update query
    $sql = "UPDATE form_detailspd SET workdone=?, status=? WHERE form_id=? AND store_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $workdone, $status, $form_id, $store_id);

    if ($stmt->execute()) {
        $message = "Work Done Added successfully";
    } else {
        $message = "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect with message
    header("Location: home.php?message=" . urlencode($message));
    exit();
}
?>