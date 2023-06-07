<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("connection/connect.php");

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate form data
    if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($cpassword)) {
        $message = "All fields must be filled!";
    } elseif ($password != $cpassword) {
        echo "<script>alert('Password does not match');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address. Please enter a valid email');</script>";
    } else {
        // Check if username or email already exists
        $check_username = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");
        $check_email = mysqli_query($db, "SELECT email FROM users WHERE email = '$email'");
        
        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username already exists!');</script>";
        } elseif (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            // Insert user into the database
            $sql = "INSERT INTO users (username, first_name, last_name, email, password) VALUES ('$username', '$firstname', '$lastname', '$email', '$password')";
            if (mysqli_query($db, $sql)) {
                $_SESSION['registration_success'] = true;
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <title>REGISTER</title>
</head>
<body>
    <header id="header">
        <nav class="navbar nav-bar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid ">
                <a class="navbar-brand logo" href="index.php">BitsNBytesQuiz</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="quiz.php">Quizzes</a>
                        </li>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="leaderboard.php">Leaderboard</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['username'])) { ?>
                                <a class="nav-link" href="logout.php">Logout</a>
                            <?php } else { ?>
                                <a class="nav-link" href="login.php">Log In</a>
                            <?php } ?>
                        </li>
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="registration.php">Register</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        
        <form action="" method="post" style="width:50vw;min-width:300px;">
        <h3>Register Here!</h3>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="firstname" class="register mt-3">First Name</label>
                    <input class="form-control" type="text" name="firstname" id="firstname">
                </div>
                <div class="form-group col-sm-6">
                    <label for="lastname" class="register mt-3 my-1">Last Name</label>
                    <input class="form-control" type="text" name="lastname" id="lastname">
                </div>
                <div class="form-group col-sm-6">
                    <label for="username" class="register mt-3">User Name</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>
                <div class="form-group col-sm-6">
                    <label for="email" class="register mt-3">Email Address</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group col-sm-6">
                    <label for="password" class="register mt-3">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group col-sm-6">
                    <label for="cpassword" class="register mt-3">Confirm password</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword">
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p> <input type="submit" value="Register" name="submit" class="register-btn"> </p>
                </div>
            </div>
        </form>
    </div>
    <?php include "./include/footer.php"; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
