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
    <title>Sign-Up Page</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <!-- <form action="signup.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="passcode" placeholder="Password" required>
        <button type="submit" name="signup">Sign up</button>
    </form> -->
    <div class="container">
        <div class="left-section">
            <h2>Sign up</h2>
            <form action="signup.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="passcode" placeholder="Password" required>
                <button class="signup-btn" name="signup" type="submit">Sign Up</button>
                <p class="social-para">Or sign up with social platforms:</p>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-google fa-2xl" style="color: #ebebeb;"></i></a>
                    <a href="#"><i class="fa-brands fa-github fa-2xl" style="color: #ebebeb;"></i></a>
                </div>
            </form>
        </div>
        <div class="right-section">
            <h2>Welcome Back!</h2>
            <p>If you already have an account, please sign in to access your account and explore our services!</p>
            <a href="./login.php"><button class="login-btn">Login</button></a>
        </div>
    </div>
</body>

</html>

<?php 

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $username = $connection->real_escape_string($_POST['username']);
    $email = $connection->real_escape_string($_POST['email']);
    $password = $_POST['passcode']; 
    $encPassword = password_hash($password, PASSWORD_BCRYPT); 

    $sql = "INSERT INTO accounts (user_name, user_mail, user_pass) VALUES ('$username', '$email', '$encPassword')";

    if ($connection->query($sql)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success', // Corrected icon
                title: 'Account Successfully Created!',
                text: 'Welcome back!',
                confirmButtonText: 'Go to Login',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed to create an account',
                text: 'Try Again.',
                confirmButtonText: 'Try Again',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
    

    $connection->close();
}

?>
