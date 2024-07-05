<?php
session_start();

include '../db/db_connect.php'; // Include your database connection file

$username = $_SESSION['username'];
$store_id = $_SESSION['store_id'];

$status = '1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $departmentName = htmlspecialchars($_POST['departmentName']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $shift = htmlspecialchars($_POST['shift']);

    // Convert arrays to strings using implode
    $supervisors = implode(', ', $_POST['supervisor_s']);
    $manualLayupBussingOperators = implode(', ', $_POST['operator_manual_layup_and_bussings']);
    $manualLayupBussingLabours = implode(', ', $_POST['labour_manual_layup_and_bussings']);
    $repairingStringOperators = implode(', ', $_POST['operator_repairing_strings']);
    $repairingStringLabours = implode(', ', $_POST['labour_repairing_strings']);
    $RepairingModuleOperators = implode(', ', $_POST['operator_repairing_modules']);
    $RepairingModuleLabours = implode(', ', $_POST['labour_repairing_modules']);
    $evaGlassLoadersOperators = implode(', ', $_POST['operator_eva_and_glass_loaders']);
    $evaGlassLoadersLabours = implode(', ', $_POST['labour_eva_and_glass_loaders']);
    $stringerLayup1Operators = implode(', ', $_POST['operator_stringer_and_layup_1s']);
    $stringerLayup1Labours = implode(', ', $_POST['labour_stringer_and_layup_1s']);
    $stringerLayup2Operators = implode(', ', $_POST['operator_stringer_and_layup_2s']);
    $stringerLayup2Labours = implode(', ', $_POST['labour_stringer_and_layup_2s']);
    $stringerLayup3Operators = implode(', ', $_POST['operator_stringer_and_layup_3s']);
    $stringerLayup3Labours = implode(', ', $_POST['labour_stringer_and_layup_3s']);
    $stringerMS40Operators = implode(', ', $_POST['operator_stringer_ms-40s']);
    $stringerMS40Labours = implode(', ', $_POST['labour_stringer_ms-40s']);
    $bussingTappingOperators = implode(', ', $_POST['operator_bussing_and_tappings']);
    $bussingTappingLabours = implode(', ', $_POST['labour_bussing_and_tappings']);
    $evaBacksheetOperators = implode(', ', $_POST['operator_eva_and_backsheets']);
    $evaBacksheetLabours = implode(', ', $_POST['labour_eva_and_backsheets']);
    $elRepairingOperators = implode(', ', $_POST['operator_el_and_repairings']);
    $elRepairingLabours = implode(', ', $_POST['labour_el_and_repairings']);
    $lamination1Operators = implode(', ', $_POST['operator_lamination_1s']);
    $lamination1Labours = implode(', ', $_POST['labour_lamination_1s']);
    $lamination2Operators = implode(', ', $_POST['operator_lamination_2s']);
    $lamination2Labours = implode(', ', $_POST['labour_lamination_2s']);

    // Prepare an insert statement
    $sql = "INSERT INTO form_detailsinput (departmentName, date, time, shift, supervisors, manual_layup_and_bussing_operators, manual_layup_and_bussing_labours, repairing_string_operators, repairing_string_labours, repairing_module_operators, repairing_module_labours, eva_glass_loader_operators, eva_glass_loader_labours, stringer_layup1_operators, stringer_layup1_labours, stringer_layup2_operators, stringer_layup2_labours, stringer_layup3_operators, stringer_layup3_labours, stringer_ms40_operators, stringer_ms40_labours, bussing_tapping_operators, bussing_tapping_labours, eva_backsheet_operators, eva_backsheet_labours, el_repairing_operators, el_repairing_labours, lamination1_operators, lamination1_labours, lamination2_operators, lamination2_labours, status, username, store_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssss", $departmentName, $date, $time, $shift, $supervisors, $manualLayupBussingOperators, $manualLayupBussingLabours, $repairingStringOperators, $repairingStringLabours, $RepairingModuleOperators, $RepairingModuleLabours, $evaGlassLoadersOperators, $evaGlassLoadersLabours, $stringerLayup1Operators, $stringerLayup1Labours, $stringerLayup2Operators, $stringerLayup2Labours, $stringerLayup3Operators, $stringerLayup3Labours, $stringerMS40Operators, $stringerMS40Labours, $bussingTappingOperators, $bussingTappingLabours, $evaBacksheetOperators, $evaBacksheetLabours, $elRepairingOperators, $elRepairingLabours, $lamination1Operators, $lamination1Labours, $lamination2Operators, $lamination2Labours, $status, $username, $store_id);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Record inserted successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    $message = "Invalid request method.";
}

// Close connection
mysqli_close($conn);

// Redirect with message
header("Location: home.php?message=" . urlencode($message));
exit();
?>