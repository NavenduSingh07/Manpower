<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /mrp-in/auth/login.php");
    exit;
}
?>

<?php
include '../db/db_connect.php'; // Include your database connection file

$username = $_SESSION['username'];
$store_id = $_SESSION['store_id'];

// Set the timezone to Indian Standard Time (IST)
$timezone = new DateTimeZone('Asia/Kolkata');

// Create a new DateTime object with the current time and set the timezone
$date = new DateTime('now', $timezone);

// Clone the date object to get yesterday's date
$yesterday = clone $date;
$yesterday->modify('-1 day');

// Format the dates
$todayFormatted = $date->format('Y-m-d');
$yesterdayFormatted = $yesterday->format('Y-m-d');

// Store the formatted dates in variables
$today = $todayFormatted;
$yesterday = $yesterdayFormatted;

// Query for incomplete Input reports
$sql_incompleteInput = "SELECT form_id, departmentName, shift, date FROM form_detailsinput WHERE status = 1 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today'";
$result_incompleteInput = $conn->query($sql_incompleteInput);

// Query for completed Input reports
$sql_completedInput = "SELECT form_id, departmentName, shift, date FROM form_detailsinput WHERE status = 2 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today' ORDER BY date ASC, time DESC";
$result_completedInput = $conn->query($sql_completedInput);

// Query for incomplete Output reports
$sql_incompleteOutput = "SELECT form_id, departmentName, shift, date FROM form_detailsoutput WHERE status = 1 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today'";
$result_incompleteOutput = $conn->query($sql_incompleteOutput);

// Query for completed Output reports
$sql_completedOutput = "SELECT form_id, departmentName, shift, date FROM form_detailsoutput WHERE status = 2 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today' ORDER BY date ASC, time DESC";
$result_completedOutput = $conn->query($sql_completedOutput);

// Query for incomplete PD reports
$sql_incompletePD = "SELECT form_id, departmentName, shift, date FROM form_detailspd WHERE status = 1 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today'";
$result_incompletePD = $conn->query($sql_incompletePD);

// Query for completed PD reports
$sql_completedPD = "SELECT form_id, departmentName, shift, date FROM form_detailspd WHERE status = 2 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today' ORDER BY date ASC, time DESC";
$result_completedPD = $conn->query($sql_completedPD);

// Query for completed QMSH reports
$sql_completed = "SELECT form_id, departmentName, shift, date FROM form_details WHERE status = 2 AND username = '$username' AND store_id = '$store_id' AND date BETWEEN '$yesterday' AND '$today' ORDER BY date ASC, time DESC";
$result_completed = $conn->query($sql_completed);

// Close the database connection
$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Record Manpower</title>
    <link rel="icon" href="/mrp-in/assets/images/title.png" type="image/icon">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="/mrp-in/styles/dashboard.css" rel="stylesheet">
    <link href="/mrp-in/styles/style.css" rel="stylesheet">
    <link href="/mrp-in/styles/tablestyles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .my-custom-class {
            background-color: #a20000;
        }

        .body {
            background-color: #f5f5dc;
        }
    </style>
</head>

<body class="body">
    <header class="navbar sticky-top flex-md-nowrap p-0 shadow my-custom-class">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 c-nav navbar" href="/mrp-in/manpower/home.php">
            <img src="/mrp-in/assets/images/Logo-white.png" alt="MRP Dashboard Logo" class="img-fluid"
                style="height:50px">
        </a>
        <h1 class="text-center text-white my-auto d-none d-md-block col-md-6" style="font-size:24px;">M.R.P. Software
        </h1>
        <div class="col-md-3 text-end">
            <div class="w-100 text-end" style="color:white;font-weight:500;">
                <div class="text-center text-white my-auto d-none d-md-block col-md-12">
                    Welcome,
                    <?php
                    echo $_SESSION['username'] . '&nbsp;Store: ';
                    if ($store_id == 1) {
                        echo "67";
                    } elseif ($store_id == 2) {
                        echo "114";
                    } elseif ($store_id == 3) {
                        echo "IP II";
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <main class="container">
        <h3 class="h">Manpower Reports</h3>
        <div class="row justify-content-md-end">
            <div class="col-md-2 col-sm-6">
                <a id="submitButton" class="btn btn-block">Add New Report</a>
            </div>
        </div>

        <!-- Input Incomplete Section -->

        <?php
        if ($result_incompleteInput->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Incomplete Input Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_incompleteInput->num_rows > 0) {
                $sno = 1;
                while ($row = $result_incompleteInput->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-warning' onclick=\"location.href='addWDform.php?form_id={$form_id}&departmentName={$departmentName}'\">Complete</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- Output Incomplete Section -->

        <?php
        if ($result_incompleteOutput->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Incomplete Output Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_incompleteOutput->num_rows > 0) {
                $sno = 1;
                while ($row = $result_incompleteOutput->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-warning' onclick=\"location.href='addWDform.php?form_id={$form_id}&departmentName={$departmentName}'\">Complete</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- PD Incomplete Section -->

        <?php
        if ($result_incompletePD->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Incomplete PD Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_incompletePD->num_rows > 0) {
                $sno = 1;
                while ($row = $result_incompletePD->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-warning' onclick=\"location.href='addWDform.php?form_id={$form_id}&departmentName={$departmentName}'\">Complete</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- Input Complete Section -->

        <?php
        if ($result_completedInput->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Completed Input Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_completedInput->num_rows > 0) {
                $sno = 1;
                while ($row = $result_completedInput->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-success' onclick=\"location.href='viewInput.php?form_id={$form_id}&departmentName={$departmentName}'\">View</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- Output Complete Section -->

        <?php
        if ($result_completedOutput->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Completed Output Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_completedOutput->num_rows > 0) {
                $sno = 1;
                while ($row = $result_completedOutput->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-success' onclick=\"location.href='viewOutput.php?form_id={$form_id}&departmentName={$departmentName}'\">View</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- PD Complete Section -->

        <?php
        if ($result_completedPD->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Completed PD Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_completedPD->num_rows > 0) {
                $sno = 1;
                while ($row = $result_completedPD->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-success' onclick=\"location.href='viewPDQMSH.php?form_id={$form_id}&departmentName={$departmentName}'\">View</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <!-- QMSH Section -->

        <?php
        if ($result_completed->num_rows != 0) {
            echo '<div class="container">
        <h1 class="h3">Completed QMSH Reports</h1>
        <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">
            <tr>
                <th>S.No.</th>
                <th>Department</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Action</th>
            </tr>';

            if ($result_completed->num_rows > 0) {
                $sno = 1;
                while ($row = $result_completed->fetch_assoc()) {
                    $form_id = $row["form_id"];
                    $departmentName = $row["departmentName"];
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["departmentName"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><button class='btn btn-success' onclick=\"location.href='viewPDQMSH.php?form_id={$form_id}&departmentName={$departmentName}'\">View</button></td>";
                    echo "</tr>";
                }
            }

            echo '</table>
    </div>';
        }
        ?>

        <div style="text-align: center; margin-bottom: 10px;">
            <div class="col">
                <form action="/mrp-in/auth/logout.php" method="post">
                    <button type="submit" class="btn btn-danger" style="margin-top:20px">Logout</button>
                </form>
            </div>
        </div>

    </main>
    <script>
        // Add onclick event to the anchor tag
        document.getElementById("submitButton").onclick = function () {
            // Create a SweetAlert modal dialog
            Swal.fire({
                title: 'Add New Report',
                html:
                    '<p>Choose Department</p>' +
                    '<select id="department" class="form-control">' +
                    '<option value="Input">Input</option>' +
                    '<option value="Output">Output</option>' +
                    '<option value="Packaging">Packaging</option>' +
                    '<option value="Dispatch">Dispatch</option>' +
                    '<option value="Quality">Quality</option>' +
                    '<option value="Maintenance">Maintenance</option>' +
                    '<option value="Store">Store</option>' +
                    '<option value="Housekeeping">Housekeeping</option>' +
                    '</select>',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const departmentName = document.getElementById('department').value;
                    // Redirect to another page based on the department name
                    if (departmentName === "Input") {
                        window.location.href = 'reportInput.php?departmentName=' + departmentName;
                    } else if (departmentName === "Output") {
                        window.location.href = 'reportOutput.php?departmentName=' + departmentName;
                    } else if (departmentName === "Packaging" || departmentName === "Dispatch") {
                        window.location.href = 'reportPD.php?departmentName=' + departmentName;
                    } else {
                        window.location.href = 'reportQMSH.php?departmentName=' + departmentName;
                    }
                }
            });
        };
    </script>
    <?php if (isset($_GET['message'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: '<?php echo (strpos($_GET['message'], "successfully") !== false) ? "success" : "error"; ?>',
                    title: '<?php echo urldecode($_GET['message']); ?>'
                });
            });
        </script>
    <?php endif; ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>