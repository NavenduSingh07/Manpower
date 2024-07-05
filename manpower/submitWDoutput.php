<?php
// Database connection
include '../db/db_connect.php'; // Include your database connection file

$status = '2';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id = $_POST['form_id'];
    $departmentName = $_POST['departmentName'];
    $store_id = $_POST['store_id'];
    $trimmingWD = $_POST['trimmingWD'];
    $visualWD = $_POST['visualWD'];
    $shortingWD = $_POST['shortingWD'];
    $framingWD = $_POST['framingWD'];
    $junctionBoxWD = $_POST['junctionBoxWD'];
    $pottingWD = $_POST['pottingWD'];
    $curringWD = $_POST['curringWD'];
    $cleaningWD = $_POST['cleaningWD'];
    $hipotWD = $_POST['hipotWD'];
    $sunsimulatorWD = $_POST['sunsimulatorWD'];
    $elWD = $_POST['elWD'];

    // Update query
    $sql = "UPDATE form_detailsoutput SET trimmingWD=?, visualWD=?, shortingWD=?, framingWD=?, junctionBoxWD=?, pottingWD=?, curringWD=?, cleaningWD=?, hipotWD=?, sunsimulatorWD=?, elWD=?, status=? WHERE form_id=? AND store_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssisi", $trimmingWD, $visualWD, $shortingWD, $framingWD, $junctionBoxWD, $pottingWD, $curringWD, $cleaningWD, $hipotWD, $sunsimulatorWD, $elWD, $status, $form_id, $store_id);

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