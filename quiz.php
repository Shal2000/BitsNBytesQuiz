<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("connection/connect.php");
if ( !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZZES</title>
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
                        <?php if ( isset($_SESSION['username'])) { ?>
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
    <section class="welcome text-center mt-5 pt-5">
        <h3 class="heading mt-4">BitsNBytesQuiz - Test Your Knowledge!</h3>
        <div class="row hotpick row-cols-1 row-cols-md-3 g-4">
        <?php

    $query = mysqli_query($db,"SELECT * FROM quizzes");
    while ($r = mysqli_fetch_assoc($query)) {
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
        } else {
            $userID = ""; // Set a default value for $userID if it's not present in the session
        } 
        echo '<a href="'.$r['category'].'-quiz.php?quiz-id=' . $r['quiz_id'] . '&user_id=' . urlencode($userID) . '" id="hotpick-links" class="mt-5">';
        echo '<div class="card h-100 hotpick-card">';
        echo '<img src="./imgs/' . $r['img'] . '" class="card-img-top hotpick-img" alt="...">';
        echo '<div class="card-body hotpick-card-body">';
        echo '<h5 class="card-title hotpick-title">' . $r['quiz_title'] . '</h5>';
        echo '<p class="card-text hotpick-text">' . $r['description'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
    }
?>


        </div>
    </section>
    <?php include "./include/footer.php"; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
