<?php
// Database connection
include '../db/db_connect.php'; // Include your database connection file

$status = '2';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_id = $_POST['form_id'];
    $departmentName = $_POST['departmentName'];
    $store_id = $_POST['store_id'];
    $manualLayupBussWD = $_POST['manualLayupBussWD'];
    $repairingStringWD = $_POST['repairingStringWD'];
    $repairingModuleWD = $_POST['repairingModuleWD'];
    $evaGlassWD = $_POST['evaGlassWD'];
    $stringerL1WD = $_POST['stringerL1WD'];
    $stringerL2WD = $_POST['stringerL2WD'];
    $stringerL3WD = $_POST['stringerL3WD'];
    $stringerMS40WD = $_POST['stringerMS40WD'];
    $bussTapingWD = $_POST['bussTapingWD'];
    $evaBacksheetWD = $_POST['evaBacksheetWD'];
    $elRepairWD = $_POST['elRepairWD'];
    $lamination1WD = $_POST['lamination1WD'];
    $lamination2WD = $_POST['lamination2WD'];

    // Update query
    $sql = "UPDATE form_detailsinput SET manualLayupBussWD=?, repairingStringWD=?, repairingModuleWD=?, evaGlassWD=?, stringerL1WD=?, stringerL2WD=?, stringerL3WD=?, stringerMS40WD=?, bussTapingWD=?, evaBacksheetWD=?, elRepairWD=?, lamination1WD=?, lamination2WD=?, status=? WHERE form_id=? AND store_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssiis", $manualLayupBussWD, $repairingStringWD, $repairingModuleWD, $evaGlassWD, $stringerL1WD, $stringerL2WD, $stringerL3WD, $stringerMS40WD, $bussTapingWD, $evaBacksheetWD, $elRepairWD, $lamination1WD, $lamination2WD, $status, $form_id, $store_id);

    if ($stmt->execute()) {
        $message = "Work Done Added successfully";
    } else {
        $message = "Error updating record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();

    // Redirect with message
    header("Location: home.php?message=" . urlencode($message));
    exit();
}
?>