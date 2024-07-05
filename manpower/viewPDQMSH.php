<?php session_start();
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
                include '../db/db_connect.php'; // Include your database connection file
                
                // Fetch form_id and departmentName from URL
                $form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';
                $departmentName = isset($_GET['departmentName']) ? $_GET['departmentName'] : '';

                if ($departmentName == 'Packaging' || $departmentName == 'Dispatch') {
                    // SQL query to fetch data from form_detailspd table
                    $sql = "SELECT * FROM form_detailspd WHERE form_id = ? AND departmentName = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $form_id, $departmentName);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    // SQL query to fetch data from form_details table
                    $sql = "SELECT * FROM form_details WHERE form_id = ? AND departmentName = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $form_id, $departmentName);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }

                if ($result->num_rows > 0) {
                    // Fetch the data
                    $row = $result->fetch_assoc();

                    // Display data
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-header table-header'><h3 style=color:white;>Department Name: " . htmlspecialchars($row['departmentName']) . "</h3></div>";
                    echo "<div class='card-body'>";
                    echo "<p>Supervisor: " . htmlspecialchars($row['supervisors']) . "</p>";
                    echo "<p>Shift Date: " . htmlspecialchars($row['date']) . "</p>";
                    echo "<p>Shift Time: " . htmlspecialchars($row['time']) . "</p>";
                    echo "<p>Operators: " . htmlspecialchars($row['operators']) . "</p>";
                    echo "<p>Labours: " . htmlspecialchars($row['labours']) . "</p>";
                    if ($departmentName == 'Packaging' || $departmentName == 'Dispatch') {
                        echo "<p>Work Done: " . htmlspecialchars($row['workdone']) . "</p>";
                    }
                    echo "</div></div>";
                }
                // Close the database connection
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