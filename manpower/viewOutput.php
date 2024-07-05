<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /mrp-in/auth/login.php");
    exit;
}

$username = $_SESSION['username'];
$store_id = $_SESSION['store_id'];

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

        .table-header {
            background-color: #a20000;
            color: white;
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
    <main class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php
                include '../db/db_connect.php';

                // Retrieve form_id and departmentName from URL
                if (isset($_GET['form_id']) && isset($_GET['departmentName'])) {
                    $form_id = $_GET['form_id'];
                    $departmentName = $_GET['departmentName'];

                    // SQL query to fetch data from form_detailsinput table
                    $sql = "SELECT * FROM form_detailsoutput WHERE form_id = ? AND departmentName = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $form_id, $departmentName);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if the data is retrieved
                    if ($result->num_rows > 0) {
                        // Fetch the data
                        $row = $result->fetch_assoc();

                        // Display main details
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-header table-header'><h3 style=color:white;>Department Name: " . htmlspecialchars($row['departmentName']) . "</h3></div>";
                        echo "<div class='card-body'>";
                        echo "<p>Supervisor: " . htmlspecialchars($row['supervisors']) . "</p>";
                        echo "<p>Shift Date: " . htmlspecialchars($row['date']) . "</p>";
                        echo "<p>Shift Time: " . htmlspecialchars($row['time']) . "</p>";
                        echo "</div></div>";

                        // Units
                        $units = [
                            'trimming' => 'Trimming',
                            'visual' => 'Visual',
                            'framing' => 'Framing',
                            'junctionbox' => 'Junction Box',
                            'potting' => 'Potting',
                            'curring' => 'Curring',
                            'cleaning' => 'Cleaning',
                            'hipot' => 'Hipot',
                            'sunsimulator' => 'Sunsimulator',
                            'el' => 'EL',
                            'shorting' => 'Shorting'
                        ];

                        // Work done fields
                        $work_done_fields = [
                            'trimming' => 'trimmingWD',
                            'visual' => 'visualWD',
                            'framing' => 'shortingWD',
                            'junctionbox' => 'framingWD',
                            'potting' => 'junctionBoxWD',
                            'curring' => 'pottingWD',
                            'cleaning' => 'curringWD',
                            'hipot' => 'cleaningWD',
                            'sunsimulator' => 'hipotWD',
                            'el' => 'sunsimulatorWD',
                            'shorting' => 'elWD'
                        ];

                        // Display the data in a table
                        echo "<table class='table table-bordered'>";
                        echo "<thead class='table-header'>";
                        echo "<tr>";
                        echo "<th scope='col'>Unit</th>";
                        echo "<th scope='col'>Operators</th>";
                        echo "<th scope='col'>Labours</th>";
                        echo "<th scope='col'>Work Done</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        foreach ($units as $unit_key => $unit_name) {
                            echo "<tr>";
                            echo "<td>" . $unit_name . "</td>";
                            echo "<td>" . htmlspecialchars($row[$unit_key . '_operators']) . "</td>";
                            echo "<td>" . htmlspecialchars($row[$unit_key . '_labours']) . "</td>";
                            echo "<td>" . htmlspecialchars($row[$work_done_fields[$unit_key]]) . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>No data found for form_id: " . htmlspecialchars($form_id) . " and departmentName: " . htmlspecialchars($departmentName) . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Missing form_id or departmentName in the URL.</div>";
                }

                // Close connection
                $conn->close();
                ?>
            </div>
        </div>
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