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

// Format the date and time
$dateFormatted = $date->format('Y-m-d');
$timeFormatted = $date->format('H:i:s');

// Store the formatted date and time in variables
$date = $dateFormatted;
$time = $timeFormatted;

// Check if departmentName is present in the URL
if (isset($_GET['departmentName'])) {
    // Sanitize the input to prevent any potential security risks
    $departmentName = htmlspecialchars($_GET['departmentName']);
} else {
    echo "Department Name is not provided in the URL";
}

// Fetch supervisors based on departmentName
$query = "SELECT name, punchid FROM manpower WHERE departmentName = '$departmentName' AND role = 'Supervisor' AND store_id = '$store_id'";
$supervisors = mysqli_query($conn, $query);

// Fetch operators based on departmentName
$query = "SELECT name, punchid FROM manpower WHERE departmentName = '$departmentName' AND role = 'Operator' AND store_id = '$store_id'";
$operators = mysqli_query($conn, $query);

// Fetch labours based on departmentName
$query = "SELECT name, punchid FROM manpower WHERE departmentName = '$departmentName' AND role = 'Labour' AND store_id = '$store_id'";
$labours = mysqli_query($conn, $query);

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
        <h3 class="h">Add Reports</h3>

        <form action="formQMSHsubmit.php" method="post">

            <!-- Supervisor dropdown with search and selected names display -->
            <label for="supervisors">Supervisor:</label><br>
            <input type="text" id="supervisor-search" placeholder="Search by Name or Punch ID"
                onkeyup="filterOptions('supervisor-search', 'supervisors')"><br>
            <select id="supervisors" name="supervisors[]" multiple required>
                <?php while ($supervisor = mysqli_fetch_assoc($supervisors)): ?>
                    <option value="<?= $supervisor['name'] ?> (<?= $supervisor['punchid'] ?>)"><?= $supervisor['name'] ?>
                        (<?= $supervisor['punchid'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
            <div id="selected-supervisors"></div>
            <button type="button" class="btn btn-warning" onclick="clearField('supervisors')">Clear
                Supervisors</button><br><br>

            <!-- Operator dropdown with search and selected names display -->
            <label for="operators">Operators:</label><br>
            <input type="text" id="operator-search" placeholder="Search by Name or Punch ID"
                onkeyup="filterOptions('operator-search', 'operators')"><br>
            <select id="operators" name="operators[]" multiple required>
                <?php while ($operator = mysqli_fetch_assoc($operators)): ?>
                    <option value="<?= $operator['name'] ?> (<?= $operator['punchid'] ?>)"><?= $operator['name'] ?>
                        (<?= $operator['punchid'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
            <div id="selected-operators"></div>
            <button type="button" class="btn btn-warning" onclick="clearField('operators')">Clear
                Operators</button><br><br>

            <!-- Labour dropdown with search and selected names display -->
            <label for="labours">Labours:</label><br>
            <input type="text" id="labour-search" placeholder="Search by Name or Punch ID"
                onkeyup="filterOptions('labour-search', 'labours')"><br>
            <select id="labours" name="labours[]" multiple required>
                <?php while ($labour = mysqli_fetch_assoc($labours)): ?>
                    <option value="<?= $labour['name'] ?> (<?= $labour['punchid'] ?>)"><?= $labour['name'] ?>
                        (<?= $labour['punchid'] ?>)</option>
                <?php endwhile; ?>
            </select>
            <div id="selected-labours"></div>
            <button type="button" class="btn btn-warning" onclick="clearField('labours')">Clear Labours</button><br><br>

            <!-- Shift dropdown -->
            <label for="shift">Shift:</label><br>
            <select name="shift" required>
                <option value="" disabled selected>Select Shift</option>
                <option value="Day">Day</option>
                <option value="Night">Night</option>
            </select><br><br>

            <!-- Hidden inputs -->
            <input type="hidden" name="departmentName" value="<?php echo $departmentName; ?>">
            <input type="hidden" name="date" value="<?php echo $date; ?>">
            <input type="hidden" name="time" value="<?php echo $time; ?>">

            <input type="submit" class="btn btn-success btn-block" value="Submit">
        </form>

    </main>

    <script>
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
            // Clear the corresponding array
            if (fieldId === 'supervisors') selectedSupervisors.length = 0;
            else if (fieldId === 'operators') selectedOperators.length = 0;
            else if (fieldId === 'labours') selectedLabours.length = 0;
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
            } else if (selectId === 'operators') {
                selectedOperators.length = 0;
                selectedOperators.push(...selectedArray);
            } else if (selectId === 'labours') {
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
            else if (selectId === 'operators') selectedArray = selectedOperators;
            else if (selectId === 'labours') selectedArray = selectedLabours;
            console.log(`Selected options in ${selectId}:`, selectedArray);
        }
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </main>
</body>

</html>