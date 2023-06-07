<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("connection/connect.php");

if ( isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address. Please enter a valid email');</script>";
    } else {
        // Check if the email already exists in the database
        $check_email = mysqli_query($db,"SELECT email FROM subscribers WHERE email = '$email'");
        
        if (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email address already subscribed!');</script>";
        } else {
            // Insert the email address into the newsletter table
            $sql = "INSERT INTO subscribers (email) VALUES ('$email')";
            if (mysqli_query($db, $sql)) {
                echo "<script>alert('Thank you for subscribing to our subscribers!');</script>";
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
    <title>NEWSLETTER</title>
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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
                            <a class="nav-link" href="quiz.php">
                                Quizzes
                            </a>
                            
                        </li>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="leaderboard.php">LeaderBoard</a>
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

    <section class="container mt-5 pt-5">
        <div>
        <h1 class="sub-title">Subscribe to Our Newsletter</h1>
        <p>Stay up-to-date with the latest news, updates, and quiz announcements.</p>

        <div class="newsletter-info pt-4">
            <h2 class="news-info-title">Why Subscribe to Our Newsletter?</h2>
            <ul>
                <li>Explore fascinating quizzes on a wide range of topics, including science, technology, history, and pop culture.</li>
                <li>Get thought-provoking questions and challenging trivia to test your knowledge.</li>
                <li>Stay informed about new quiz releases and be the first to know about our exciting updates.</li>
            </ul>
        </div>

        <form action="" method="post" class="mt-4">
            <div class="row">
                <div class="col-sm-6">
                    <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="col-sm-6">
                    <button class="news-btn" type="submit" name="subscribe">Subscribe</button>
                </div>
            </div>
        </form>
        </div>
    </section>

    <?php include "./include/footer.php"; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
