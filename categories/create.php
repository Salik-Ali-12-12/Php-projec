<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["category_img"]["name"]);
    
    // Check if category already exists
    $sql = "SELECT * FROM category WHERE category_name = '$category_name' AND category_img = '$target_file'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Duplicate Category',
                text: 'This category already exists. Please use a unique category name and image.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = '#'; // Redirect after alert
            });
        </script>
    </body>
    </html>";
    } else {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["category_img"]["tmp_name"], $target_file)) {
            // Insert the new category if it does not already exist
            $sql = "INSERT INTO category (category_name, category_img) VALUES ('$category_name', '$target_file')";
            
            if ($connection->query($sql) === TRUE) {
                echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Record Created',
                        text: 'New record created successfully!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                </script>
    </body>
    </html>";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } else {
            echo "
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
        Swal.fire({
            icon: 'error',
            title: 'Upload Failed',
            text: 'Failed to upload the image. Please try again.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    </script>
            </body>
            </html>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lab Automation</title>
    <link rel="shortcut icon" href="./assets/img/icon.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 fw-bold" href="../dashboard/dashboard.php">Lab Automation</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
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
                                <a class="nav-link" href="../dashboard/status.php">Changed Testing Status</a>
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
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">categories Upload</li>
                    </ol>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white text-center">
                                    <h4>Upload Category</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="create.php" enctype="multipart/form-data">
                                        <!-- Category Name -->
                                        <div class="mb-4">
                                            <label for="category_name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="category_name"
                                                name="category_name" placeholder="Enter category name" required>
                                        </div>
                                        <!-- Category Image -->
                                        <div class="mb-4">
                                            <label for="category_img" class="form-label">Category Image</label>
                                            <input type="file" class="form-control" id="category_img"
                                                name="category_img" required>
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>