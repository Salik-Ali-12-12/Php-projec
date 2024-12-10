<?php
include('config.php');

// Get the selected category name from URL
$category_name = isset($_GET['category_name']) ? $_GET['category_name'] : '';

// SQL query to fetch products based on selected category
$sql = "SELECT * FROM products"; // Assuming you have a products table
if ($category_name) {
    $sql .= " WHERE category_name = '$category_name'";
}

$result = $connection->query($sql);
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
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

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
                    <a class="breadcrumb-item small text-body" href="../test/testing.php">Testing</a>
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
                        <a href="../categories/category.php" class="nav-item nav-link active">Categories</a>
                        <a href="../test/testing.php" class="nav-item nav-link">Testing</a>
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
            <h1 class="display-2 text-white mb-3 animated slideInDown">Categories</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../test/testing.php">Testing</a></li>
                    <li class="breadcrumb-item" aria-current="page">Categories</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- product -->
    <div class="container-fluid container-service py-5">
        <div class="container pt-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="display-6 mb-3">Reliable & High-Quality Laboratory Service</h1>
                <p class="mb-5">"Lab Automation offers reliable, high-quality laboratory services that prioritize
                    accuracy and efficiency. Our commitment to excellence ensures every test meets the highest
                    standards."</p>
            </div>
            <h1 class="display-6 mb-3 text-center">Products in <?php echo htmlspecialchars($category_name); ?></h1>
            <div class="row g-4">
                <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item" style="border: 2px solid black; border-radius: 5px;">
                        <div class="icon-box-primary mb-3" style="overflow: hidden;">
                            <img src="<?php echo $row['product_img']; ?>"
                                alt="<?php echo htmlspecialchars($row['product_name']); ?>"
                                style="border: 4px solid #3368c6; border-radius: 5px; width: 100%; height: auto; display: block;">
                        </div>
                        <h4 class="mb-3" style="text-transform: capitalize;">
                            <span style="color: black;">Product Name:</span>
                            <?php echo htmlspecialchars($row['product_name']); ?>
                        </h4>
                        <p class="mb-5" style="font-size: 14px; color: #031b4e; ">
                            <span style="font-weight: bolder; font-size: 17px; color: black;">Product
                                Description:</span> <?php echo htmlspecialchars($row['product_description']); ?>
                        </p class="mb-5" style="font-size: 14px; color: #031b4e; ">
                        <a class="btn btn-light px-3" href="../categories/category.php">Go Back <i
                                class="bi bi-chevron-double-right ms-1"></i></a>
                        <?php
                            $id = isset($_GET['id']) ? $_GET['id'] : ''; // Default to an empty string if 'id' is not set
                                ?>
                        <a class="btn btn-light px-3" href="../test/testing.php?action=add&id=<?php echo $id; ?>">Test
                            <i class="bi bi-chevron-double-right ms-1"></i></a>



                    </div>
                </div>
                <?php endwhile; ?>
                <?php else : ?>
                <p>No products found in this category.</p>
                <?php endif; ?>
            </div>




        </div>
    </div>





    <!-- Footer Start -->
    <div class="container-fluid footer position-relative bg-dark text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 py-5">
                <div class="col-lg-6 pe-lg-5">
                    <a href="./index.php" class="navbar-brand">
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
                            <a class="btn btn-link" href="../test/testing.php">Testing</a>
                            <a class="btn btn-link" href="../login-signup/signup.php">login-signup</a>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Popular Links</h4>
                            <a class="btn btn-link" href="../categories/category.php">Categories</a>
                            <a class="btn btn-link" href="../aboutus/about.php">About Us</a>
                            <a class="btn btn-link" href="../contactus/contact.php">Contact Us</a>
                            <a class="btn btn-link" href="../test/testing.php">Testing</a>
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