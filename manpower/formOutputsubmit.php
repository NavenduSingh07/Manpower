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
    $trimmingOperators = implode(', ', $_POST['operator_trimmings']);
    $trimmingLabours = implode(', ', $_POST['labour_trimmings']);
    $visualOperators = implode(', ', $_POST['operator_visuals']);
    $visualLabours = implode(', ', $_POST['labour_visuals']);
    $framingOperators = implode(', ', $_POST['operator_framings']);
    $framingLabours = implode(', ', $_POST['labour_framings']);
    $junctionboxOperators = implode(', ', $_POST['operator_junction_boxs']);
    $junctionboxLabours = implode(', ', $_POST['labour_junction_boxs']);
    $pottingOperators = implode(', ', $_POST['operator_pottings']);
    $pottingLabours = implode(', ', $_POST['labour_pottings']);
    $curringOperators = implode(', ', $_POST['operator_currings']);
    $curringLabours = implode(', ', $_POST['labour_currings']);
    $cleaningOperators = implode(', ', $_POST['operator_cleanings']);
    $cleaningLabours = implode(', ', $_POST['labour_cleanings']);
    $hipotOperators = implode(', ', $_POST['operator_hipots']);
    $hipotLabours = implode(', ', $_POST['labour_hipots']);
    $sunsimulatorOperators = implode(', ', $_POST['operator_sunsimulators']);
    $sunsimulatorLabours = implode(', ', $_POST['labour_sunsimulators']);
    $elOperators = implode(', ', $_POST['operator_els']);
    $elLabours = implode(', ', $_POST['labour_els']);
    $shortingOperators = implode(', ', $_POST['operator_shortings']);
    $shortingLabours = implode(', ', $_POST['labour_shortings']);

    // Prepare an insert statement
    $sql = "INSERT INTO form_detailsoutput (departmentName, date, time, shift, supervisors, trimming_operators, trimming_labours, visual_operators, visual_labours, framing_operators, framing_labours, junctionbox_operators, junctionbox_labours, potting_operators, potting_labours, curring_operators, curring_labours, cleaning_operators, cleaning_labours, hipot_operators, hipot_labours, sunsimulator_operators, sunsimulator_labours, el_operators, el_labours, shorting_operators, shorting_labours, status, username, store_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssss", $departmentName, $date, $time, $shift, $supervisors, $trimmingOperators, $trimmingLabours, $visualOperators, $visualLabours, $framingOperators, $framingLabours, $junctionboxOperators, $junctionboxLabours, $pottingOperators, $pottingLabours, $curringOperators, $curringLabours, $cleaningOperators, $cleaningLabours, $hipotOperators, $hipotLabours, $sunsimulatorOperators, $sunsimulatorLabours, $elOperators, $elLabours, $shortingOperators, $shortingLabours, $status, $username, $store_id);

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