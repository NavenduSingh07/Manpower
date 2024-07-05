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

// Fetch form_id and departmentName from URL
$form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';
$departmentName = isset($_GET['departmentName']) ? $_GET['departmentName'] : '';

// Define different input sets for different departments
function getInputFields($departmentName)
{
    switch ($departmentName) {
        case 'Input':
            return '
                <label for="manualLayupBussWD">Manual Layup and Bussing:</label>
                <input type="text" id="manualLayupBussWD" name="manualLayupBussWD" required><br>
                <label for="repairingStringWD">Repairing String:</label>
                <input type="text" id="repairingStringWD" name="repairingStringWD" required><br>
                <label for="repairingModuleWD">Repairing Module:</label>
                <input type="text" id="repairingModuleWD" name="repairingModuleWD" required><br>
                <label for="evaGlassWD">Eva and Glass Loader:</label>
                <input type="text" id="evaGlassWD" name="evaGlassWD" required><br>
                <label for="stringerL1WD">Stringer and Layup 1:</label>
                <input type="text" id="stringerL1WD" name="stringerL1WD" required><br>
                <label for="stringerL2WD">Stringer and Layup 2:</label>
                <input type="text" id="stringerL2WD" name="stringerL2WD" required><br>
                <label for="stringerL3WD">Stringer and Layup 3:</label>
                <input type="text" id="stringerL3WD" name="stringerL3WD" required><br>
                <label for="stringerMS40WD">Stringer MS-40:</label>
                <input type="text" id="stringerMS40WD" name="stringerMS40WD" required><br>
                <label for="bussTapingWD">Bussing and Tapping:</label>
                <input type="text" id="bussTapingWD" name="bussTapingWD" required><br>
                <label for="evaBacksheetWD">EVA and Backsheet:</label>
                <input type="text" id="evaBacksheetWD" name="evaBacksheetWD" required><br>
                <label for="elRepairWD">EL and Repairing:</label>
                <input type="text" id="elRepairWD" name="elRepairWD" required><br>
                <label for="elRepairWD">Lamination 1:</label>
                <input type="text" id="elRepairWD" name="elRepairWD" required><br>
                <label for="lamination2WD">Lamination 2:</label>
                <input type="text" id="lamination2WD" name="lamination2WD" required><br>
            ';
        case 'Output':
            return '
                <label for="trimmingWD">Trimming:</label>
                <input type="text" id="trimmingWD" name="trimmingWD" required><br>
                <label for="visualWD">Visual:</label>
                <input type="text" id="visualWD" name="visualWD" required><br>
                <label for="shortingWD">Framing:</label>
                <input type="text" id="shortingWD" name="shortingWD" required><br>
                <label for="framingWD">Junction Box:</label>
                <input type="text" id="framingWD" name="framingWD" required><br>
                <label for="junctionBoxWD">Potting:</label>
                <input type="text" id="junctionBoxWD" name="junctionBoxWD" required><br>
                <label for="pottingWD">Curring:</label>
                <input type="text" id="pottingWD" name="pottingWD" required><br>
                <label for="curringWD">Cleaning:</label>
                <input type="text" id="curringWD" name="curringWD" required><br>
                <label for="cleaningWD">Hipot:</label>
                <input type="text" id="cleaningWD" name="cleaningWD" required><br>
                <label for="hipotWD">Sunsimulator:</label>
                <input type="text" id="hipotWD" name="hipotWD" required><br>
                <label for="sunsimulatorWD">EL:</label>
                <input type="text" id="sunsimulatorWD" name="sunsimulatorWD" required><br>
                <label for="elWD">Shorting:</label>
                <input type="text" id="elWD" name="elWD" required><br>
            ';
        default:
            return '
                <label for="workdone">Add Work Done:</label>
                <input type="text" id="workdone" name="workdone" required><br>
            ';
    }
}

// Define the submit script based on the department
function getSubmitScript($departmentName)
{
    switch ($departmentName) {
        case 'Input':
            return 'submitWDinput.php';
        case 'Output':
            return 'submitWDoutput.php';
        default:
            return 'submitWDpd.php';
    }
}

// Get the input fields for the current department
$inputFields = getInputFields($departmentName);

// Get the submit script for the current department
$submitScript = getSubmitScript($departmentName);

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
        <h3 class="h">Add Work Done to <?php echo $departmentName; ?> Report</h3>

        <form action="<?php echo htmlspecialchars($submitScript); ?>" method="POST">
            <!-- Hidden inputs for form_id and departmentName -->
            <input type="hidden" name="form_id" value="<?php echo htmlspecialchars($form_id); ?>">
            <input type="hidden" name="departmentName" value="<?php echo htmlspecialchars($departmentName); ?>">
            <input type="hidden" name="store_id" value="<?php echo htmlspecialchars($store_id); ?>">

            <!-- Dynamic input fields based on department -->
            <?php echo $inputFields; ?>

            <input type="submit" class="btn btn-success btn-block" value="Submit">
        </form>

    </main>
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