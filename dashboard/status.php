<?php
// Database connection
$connection = new mysqli("localhost", "root", "", "e-project");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Insert or update data on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $testing_status = isset($_POST['testing_status']) ? trim($_POST['testing_status']) : '';

    if (!empty($user_name) && !empty($testing_status)) {
        // Check if the user already exists in the database
        $stmt = $connection->prepare("SELECT id FROM testing WHERE user_name = ?");
        if ($stmt) {
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Update existing record
                $stmt = $connection->prepare("UPDATE testing SET testing_status = ? WHERE user_name = ?");
                if ($stmt) {
                    $stmt->bind_param("ss", $testing_status, $user_name);
                    $stmt->execute();
                    $msg = "Record updated successfully.";
                } else {
                    $msg = "Error preparing update statement: " . $connection->error;
                }
            } else {
                $msg = "Error: No matching user found for user_name '$user_name'.";
            }
            $stmt->close();
        } else {
            $msg = "Error preparing select statement: " . $connection->error;
        }
    } else {
        $msg = "Please fill in all fields.";
    }
}

// Fetch all data for display
$result = $connection->query("SELECT * FROM testing");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manage Testing Data</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" href="./assets/img/icon.jpg" type="image/x-icon">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3 fw-bold" href="../dashboard/dashboard.php">Lab Automation</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i
                class="fas fa-bars"></i></button>
    </nav>

    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="../dashboard/dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Pages</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Uploading Page
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../categories/create.php">Category Uploading</a>
                                <a class="nav-link" href="../products/create.php">Product Uploading</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Users Requests
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../dashboard/requests.php">User Testing Products</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">View</div>
                        <a class="nav-link" href="../dashboard/logindata.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Active Users
                        </a>
                        <a class="nav-link" href="../login-signup/signup.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Register
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Testing Data</h1>

                    <!-- Success/Error Message -->
                    <?php if (isset($msg)): ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($msg); ?></div>
                    <?php endif; ?>

                    <!-- Form for Inserting/Updating Data -->
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="testing_status" class="form-label">Testing Status</label>
                            <select class="form-control" id="testing_status" name="testing_status" required>
                                <option value="">Select Testing Status</option>
                                <option value="Pending" selected>Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Declined">Declined</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                    <!-- Display Existing Data -->
                    <h2 class="mt-5">Existing Records</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Testing Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["user_name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["testing_status"]); ?></td>
                                </tr>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="3">No records found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Lab Automation 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>