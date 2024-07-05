<?php
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /mrp-in/auth/login.php");
    exit;
}

include '../db/db_connect.php'; // Include your database connection file

$username = $_SESSION['username'];
$store_id = $_SESSION['store_id'];

// Set the timezone to Indian Standard Time (IST)
$timezone = new DateTimeZone('Asia/Kolkata');
$date = new DateTime('now', $timezone);
$dateFormatted = $date->format('Y-m-d');
$timeFormatted = $date->format('H:i:s');

// Check if departmentName is present in the URL
if (isset($_GET['departmentName'])) {
    $departmentName = htmlspecialchars($_GET['departmentName']);
} else {
    echo "Department Name is not provided in the URL";
    exit;
}

function generateDropdown($conn, $departmentName, $role, $stage)
{
    global $store_id;
    $query = "SELECT name, punchid FROM manpower WHERE departmentName = '$departmentName' AND role = '$role' AND store_id = '$store_id'";
    $result = mysqli_query($conn, $query);
    $roleLower = strtolower($role);
    $stageLower = strtolower($stage);

    echo "<h5>{$role} ($stage)</h5>";
    echo "<label for='{$roleLower}_{$stageLower}s'>{$role}:</label><br>";
    echo "<input type='text' id='{$roleLower}_{$stageLower}-search' placeholder='Search by Name or Punch ID' onkeyup=\"filterOptions('{$roleLower}_{$stageLower}-search', '{$roleLower}_{$stageLower}s')\"><br>";
    echo "<select id='{$roleLower}_{$stageLower}s' name='{$roleLower}_{$stageLower}s[]' multiple required>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['name']} ({$row['punchid']})'>{$row['name']} ({$row['punchid']})</option>";
    }
    echo "</select>";
    echo "<div id='selected-{$roleLower}_{$stageLower}s'></div>";
    echo "<button type='button' class='btn btn-warning' onclick=\"clearField('{$roleLower}_{$stageLower}s')\">Clear $role ($stage)</button><br><br>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Record Manpower</title>
    <link rel="icon" href="/mrp-in/assets/images/title.png" type="image/icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .progress {
            height: 20px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-bar {
            height: 100%;
            background-color: #a20000;
            width: 0;
            transition: width 0.6s ease;
        }

        .btn {
            margin-bottom: 10px;
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
        <h3 class="h">Add Reports</h3>
        <div class="progress">
            <div class="progress-bar" id="progressBar" role="progressbar"></div>
        </div>
        <form id="multiStepForm" action="formInputsubmit.php" method="post">
            <!-- Step 1 -->
            <div class="step active">
                <?php
                generateDropdown($conn, $departmentName, 'Supervisor', '');
                generateDropdown($conn, $departmentName, 'Operator', 'Manual Layup and Bussing');
                generateDropdown($conn, $departmentName, 'Labour', 'Manual Layup and Bussing');
                generateDropdown($conn, $departmentName, 'Operator', 'Repairing String');
                generateDropdown($conn, $departmentName, 'Labour', 'Repairing String');
                generateDropdown($conn, $departmentName, 'Operator', 'Repairing Module');
                generateDropdown($conn, $departmentName, 'Labour', 'Repairing Module');
                ?>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>

            <!-- Step 2 -->
            <div class="step">
                <?php
                generateDropdown($conn, $departmentName, 'Operator', 'Eva and Glass Loader');
                generateDropdown($conn, $departmentName, 'Labour', 'Eva and Glass Loader');
                ?>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>

            <!-- Step 3 -->
            <div class="step">
                <?php
                generateDropdown($conn, $departmentName, 'Operator', 'Stringer and Layup 1');
                generateDropdown($conn, $departmentName, 'Labour', 'Stringer and Layup 1');
                generateDropdown($conn, $departmentName, 'Operator', 'Stringer and Layup 2');
                generateDropdown($conn, $departmentName, 'Labour', 'Stringer and Layup 2');
                generateDropdown($conn, $departmentName, 'Operator', 'Stringer and Layup 3');
                generateDropdown($conn, $departmentName, 'Labour', 'Stringer and Layup 3');
                ?>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>

            <!-- Step 4 -->
            <div class="step">
                <?php
                generateDropdown($conn, $departmentName, 'Operator', 'Stringer MS-40');
                generateDropdown($conn, $departmentName, 'Labour', 'Stringer MS-40');
                generateDropdown($conn, $departmentName, 'Operator', 'Bussing and Tapping');
                generateDropdown($conn, $departmentName, 'Labour', 'Bussing and Tapping');
                generateDropdown($conn, $departmentName, 'Operator', 'EVA and Backsheet');
                generateDropdown($conn, $departmentName, 'Labour', 'EVA and Backsheet');
                ?>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>

            <!-- Step 5 -->
            <div class="step">
                <?php
                generateDropdown($conn, $departmentName, 'Operator', 'EL and Repairing');
                generateDropdown($conn, $departmentName, 'Labour', 'EL and Repairing');
                generateDropdown($conn, $departmentName, 'Operator', 'Lamination 1');
                generateDropdown($conn, $departmentName, 'Labour', 'Lamination 1');
                generateDropdown($conn, $departmentName, 'Operator', 'Lamination 2');
                generateDropdown($conn, $departmentName, 'Labour', 'Lamination 2');
                ?>

                <label for="shift">Shift:</label><br>
                <select name="shift" required>
                    <option value="" disabled selected>Select Shift</option>
                    <option value="Day">Day</option>
                    <option value="Night">Night</option>
                </select><br><br>

                <input type="hidden" name="departmentName" value="<?php echo $departmentName; ?>">
                <input type="hidden" name="date" value="<?php echo $dateFormatted; ?>">
                <input type="hidden" name="time" value="<?php echo $timeFormatted; ?>">

                <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
                <input type="submit" class="btn btn-success btn-block" value="Submit">
            </div>
        </form>
    </main>
    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.step');
        const progressBar = document.getElementById('progressBar');

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === stepIndex);
            });
            updateProgressBar(stepIndex);
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function updateProgressBar(stepIndex) {
            const progress = (stepIndex + 1) / steps.length * 100;
            progressBar.style.width = `${progress}%`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });

        // Arrays to store selected options
        const selectedSupervisors = [];
        const selectedOperators = [];
        const selectedLabours = [];

        function clearField(fieldId) {
            var select = document.getElementById(fieldId);
            for (var i = 0; i < select.options.length; i++) {
                select.options[i].selected = false;
            }
            var display = document.getElementById("selected-" + fieldId);
            if (display) {
                display.innerHTML = "";
            }
            if (fieldId === 'supervisors') selectedSupervisors.length = 0;
            else if (fieldId.includes('operator')) selectedOperators.length = 0;
            else if (fieldId.includes('labour')) selectedLabours.length = 0;
            logSelectedOptions(fieldId);
        }

        function filterOptions(inputId, selectId) {
            var input = document.getElementById(inputId);
            var filter = input.value.toUpperCase();
            var select = document.getElementById(selectId);
            var options = select.getElementsByTagName("option");

            for (var i = 0; i < options.length; i++) {
                var option = options[i];
                var txtValue = option.textContent || option.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    option.style.display = "";
                } else {
                    option.style.display = "none";
                }
            }
        }

        function addToSelected(selectId, displayId) {
            var select = document.getElementById(selectId);
            var display = document.getElementById(displayId);
            if (!display) return;

            display.innerHTML = ""; // Clear previous selections
            var selectedOptions = select.selectedOptions;
            var selectedArray = [];

            for (var i = 0; i < selectedOptions.length; i++) {
                var option = selectedOptions[i];
                var name = option.textContent;
                var span = document.createElement("span");
                span.textContent = name + "; ";
                display.appendChild(span);
                selectedArray.push(name);
            }

            if (selectId === 'supervisors') {
                selectedSupervisors.length = 0;
                selectedSupervisors.push(...selectedArray);
            } else if (selectId.includes('operator')) {
                selectedOperators.length = 0;
                selectedOperators.push(...selectedArray);
            } else if (selectId.includes('labour')) {
                selectedLabours.length = 0;
                selectedLabours.push(...selectedArray);
            }
            logSelectedOptions(selectId);
        }

        // Use 'change' event to capture changes
        document.querySelectorAll('select[multiple]').forEach(select => {
            select.addEventListener('change', function (e) {
                var selectId = select.id;
                var displayId = 'selected-' + selectId;
                addToSelected(selectId, displayId);
                logSelectedOptions(selectId);
            });

            // Prevent default behavior on 'mousedown' to allow custom toggling
            select.addEventListener('mousedown', function (e) {
                e.preventDefault();
                var option = e.target;
                if (option.tagName === 'OPTION') {
                    option.selected = !option.selected;
                    var selectId = select.id;
                    var displayId = 'selected-' + selectId;
                    addToSelected(selectId, displayId);
                    logSelectedOptions(selectId);
                }
            });
        });

        function logSelectedOptions(selectId) {
            let selectedArray;
            if (selectId === 'supervisors') selectedArray = selectedSupervisors;
            else if (selectId.includes('operator')) selectedArray = selectedOperators;
            else if (selectId.includes('labour')) selectedArray = selectedLabours;
            console.log(`Selected options in ${selectId}:`, selectedArray);
        }
    </script>
</body>

</html>