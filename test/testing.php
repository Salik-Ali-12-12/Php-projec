<?php
$connection = new mysqli("localhost", "root", "", "e-project");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $random_id = $_POST['rand_id'];
    $product_name = $_POST['product_name'];
    $user_name = $_POST['user_name'];
    $user_mail = $_POST['user_mail'];
    $issue = $_POST['issue'];
    $message = $_POST['message'];

    
    // Insert into products table
    $sql = "INSERT INTO testing (rand_id, product_name, user_name, user_mail, issue, issue_description) 
            VALUES ('$random_id', '$product_name', '$user_name', '$user_mail', '$issue', '$message')";
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
                            text: 'Product Uploades successfully!',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                        window.location.href = '../index.php';
                    });
                    </script>
        </body>
        </html>";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$result = $connection->query("SELECT product_name, random_id FROM products");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Labsky - Laboratory HTML Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/icon.jpg" type="image/x-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="me-3"><i class="fa fa-map-marker-alt me-2"></i>123 Street, Pakistan, karachi</small>
                    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 09am-7pm, Sun Closed</small>
                </div>
                <nav class="breadcrumb mb-0">
                    <a class="breadcrumb-item small text-body" href="../index.php">Home</a>
                    <a class="breadcrumb-item small text-body" href="../aboutus/about.php">About</a>
                    <a class="breadcrumb-item small text-body" href="../contactus/contact.php">contact</a>
                    <a class="breadcrumb-item small text-body" href="../login-signup/signup.php"><i
                            class="fas fa-user"></i></a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Topbar End -->



    <!-- Brand Start -->
    <div class="container-fluid bg-primary text-white pt-4 pb-5 d-none d-lg-flex">
        <div class="container pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <i class="bi bi-telephone-inbound fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Call Now</h5>
                        <span>+92 346 2427332</span>
                    </div>
                </div>
                <a href="../index.php" class="h1 text-white mb-0">Lab<span class="text-dark"> Automation</span></a>
                <div class="d-flex">
                    <i class="bi bi-envelope fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Mail Now</h5>
                        <span>e-project@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand End -->



    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-0 px-lg-3">
                <a href="../index.php" class="navbar-brand d-lg-none">
                    <h1 class="text-primary m-0">Lab<span class="text-dark"> Automation</span></h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="../index.php" class="nav-item nav-link">Home</a>
                        <a href="../categories/category.php" class="nav-item nav-link">Categories</a>
                        <a href="./testing.php" class="nav-item nav-link active">Testing</a>
                        <a href="../aboutus/about.php" class="nav-item nav-link">About</a>
                        <a href="../contactus/contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="ms-auto d-none d-lg-flex">
                        <a class="btn btn-sm-square btn-primary ms-2" href="../login-signup/signup.php"><i
                                class="fas fa-user"></i></a>
                        <a class="btn btn-sm-square btn-primary ms-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-primary ms-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-primary ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-sm-square btn-primary ms-2" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5 mt-4">
            <h1 class="display-2 text-white mb-3 animated slideInDown">Appoinment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../aboutus/about.php">About</a></li>
                    <li class="breadcrumb-item" aria-current="page">Testing</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- testing Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-4">We Ensure You Will Always Get The Best Result</h1>
                    <p>We guarantee accurate, reliable results every time. At Lab Automation, our commitment to quality
                        ensures your lab achieves the highest standards in testing.</p>
                    <p class="mb-4">This version emphasizes both reliability and quality in your services. Let me know
                        if you need any more options!</p>
                    <div class="d-flex align-items-start wow fadeIn" data-wow-delay="0.3s">
                        <div class="icon-box-primary">
                            <i class="bi bi-geo-alt text-dark fs-1"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Company Address</h5>
                            <span>123 Street, Pakistan, karachi</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-start wow fadeIn" data-wow-delay="0.4s">
                        <div class="icon-box-primary">
                            <i class="bi bi-clock text-dark fs-1"></i>
                        </div>
                        <div class="ms-3">
                            <h5>Lab Time</h5>
                            <span>Mon-Sat 09am-7pm, Sun Closed</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <h2 class="mb-4">Online Testing</h2>
                        <div class="row g-3">
                            <!-- Product Selection -->
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <select name="product_id" class="form-select" id="product_select" required>
                                        <option value="">Select Product</option>
                                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['random_id'] . "'>" . $row['product_name'] . "</option>";
                            }
                        }
                        ?>
                                    </select>
                                    <label for="product_select">Select Product</label>
                                </div>
                            </div>

                            <!-- Product Information -->
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" name="rand_id" class="form-control" id="rand_id"
                                        placeholder="Product Testing ID" readonly>
                                    <label for="rand_id">Testing ID</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" name="product_name" class="form-control" id="product_name"
                                        placeholder="Product Name" readonly>
                                    <label for="product_name">Product Name</label>
                                </div>
                            </div>

                            <!-- User Information -->
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" name="user_name" class="form-control" id="user_name"
                                        placeholder="Your Name" required>
                                    <label for="user_name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" name="user_mail" class="form-control" id="user_mail"
                                        placeholder="Your Email" required>
                                    <label for="user_mail">Your Email</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <select class="form-select" name="issue" id="testing_issue" required>
                                        <option value="Testing" selected>Testing</option>
                                        <option value="Voltage Testing">Voltage Testing</option>
                                        <option value="Amperes Testing">Amperes Testing</option>
                                        <option value="Watts Testing">Watts Testing</option>
                                        <option value="Capacity Testing">Capacity Testing</option>
                                        <option value="Resistance Testing">Resistance Testing</option>
                                    </select>
                                    <label for="testing_issue">Select Your Issue</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here"
                                        id="message" style="height: 130px" required></textarea>
                                    <label for="message">Type Short Message...</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <input class="btn btn-primary w-100 py-3" type="submit" name="submit" value="Test Now">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- JavaScript to Handle Product Selection -->
                <script>
                document.getElementById('product_select').addEventListener('change', function() {
                    var productId = this.value;
                    if (productId) {
                        // Fetch the product name and random id from the selected option
                        var selectedOption = this.options[this.selectedIndex];
                        document.getElementById('rand_id').value = productId; // Set the random id
                        document.getElementById('product_name').value = selectedOption
                            .text; // Set the product name
                    } else {
                        // Reset the fields if no product is selected
                        document.getElementById('rand_id').value = '';
                        document.getElementById('product_name').value = '';
                    }
                });
                </script>
            </div>
        </div>
    </div>
    <!-- testing Start -->


    <!-- Footer Start -->
    <div class="container-fluid footer position-relative bg-dark text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 py-5">
                <div class="col-lg-6 pe-lg-5">
                    <a href="../index.php" class="navbar-brand">
                        <h1 class="h1 text-primary mb-0">Lab<span class="text-white"> Automation</span></h1>
                    </a>
                    <p class="fs-5 mb-4">"Lab Automation brings you intelligent solutions to optimize your workflow.
                        Discover how automation can enhance productivity and drive results."


                        Previous
                    </p>
                    <p><i class="fa fa-map-marker-alt me-2"></i>123 Street, Pakistan, karachi</p>
                    <p><i class="fa fa-phone-alt me-2"></i>+92 346 2427332</p>
                    <p><i class="fa fa-envelope me-2"></i>e-project@gmail.com</p>
                    <div class="d-flex mt-4">
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Quick Links</h4>
                            <a class="btn btn-link" href="../index.php">Home</a>
                            <a class="btn btn-link" href="../aboutus/about.php">About Us</a>
                            <a class="btn btn-link" href="../contactus/contact.php">Contact Us</a>
                            <a class="btn btn-link" href="./testing.php">Testing</a>
                            <a class="btn btn-link" href="../login-signup/signup.php">login-signup</a>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Popular Links</h4>
                            <a class="btn btn-link" href="../categories/category.php">Categories</a>
                            <a class="btn btn-link" href="../aboutus/about.php">About Us</a>
                            <a class="btn btn-link" href="../contactus/contact.php">Contact Us</a>
                            <a class="btn btn-link" href="./testing.php">Testing</a>
                        </div>
                        <div class="col-sm-12">
                            <h4 class="text-light mb-4">Newsletter</h4>
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 py-3 px-4"
                                        style="background: rgba(255, 255, 255, .1);"
                                        placeholder="Your Email Address"><button class="btn btn-primary px-4">Sign
                                        Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#">Lab Automation</a>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>