<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--fav icon-->
    <link rel="shortcut icon" href="../img/icon.jpg" type="image/x-icon">
    <title>Sign-In Page</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <!-- <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="passcode" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form> -->
    <div class="container">
        <div class="left-section">
            <h2>New here?</h2>
            <p>Learn more about our great services by signing up, it's easier than ever!</p>
            <a href="./signup.php"><button class="signup-btn">Sign Up</button></a>
        </div>
        <div class="right-section">
            <h2>Sign in</h2>
            <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="passcode" placeholder="Password" required>
                <button class="login-btn" type="submit" name="login">Login</button>
                <p class="social-para">Or sign in with social platforms:</p>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-google fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-github fa-2xl" style="color: #ebebeb;"></i></a>

                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php 
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $connection->real_escape_string($_POST['email']);
    $password = $_POST['passcode'];

    $sql = "SELECT * FROM accounts WHERE user_mail = '$email'";
    $result = $connection -> query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_pass'])) {
            session_start();
            $_SESSION['user_mail'] = $email;
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] === 'admin') {
                // Admin-specific redirection or functionality
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Admin Access Granted',
                        text: 'Welcome, Admin!',
                        confirmButtonText: 'Go to Admin Panel',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = '../dashboard/dashboard.php';
                    });
                </script>";
            } else {
                // User-specific redirection or functionality
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Logged In',
                        text: 'Welcome back!',
                        confirmButtonText: 'Go to Home',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = '../index.php';
                    });
                </script>";
            }
            exit;
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Credentials',
                    text: 'The username or password you entered is incorrect.',
                    confirmButtonText: 'Try Again',
                    confirmButtonColor: '#d33'
                });
            </script>";
        }
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'First Signup Then Login',
                text: 'Please sign up first before logging in.',
                confirmButtonText: 'Go to Signup',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = 'signup.php';
            });
        </script>";
    }
    $connection->close();
}
?>

