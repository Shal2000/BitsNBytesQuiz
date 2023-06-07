<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("connection/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT</title>
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
        <h1 class="sub-title">About BitsNBytesQuiz</h1>
        <p class="pt-3">Welcome to BitsNBytesQuiz, the ultimate online quiz platform for technology enthusiasts!</p>
        <p>At BitsNBytesQuiz, we offer a wide range of quizzes to test your knowledge in various tech-related fields, including HTML, CSS, JavaScript, PHP, and General Knowledge.</p>
        <p>Whether you are a beginner looking to learn more or an experienced professional aiming to sharpen your skills, our quizzes provide a fun and challenging way to expand your knowledge.</p>
        <p>Features of BitsNBytesQuiz:</p>
        <ul>
            <li>Wide range of quizzes covering different technology topics</li>
            <li>Multiple-choice questions to test your understanding</li>
            <li>Leaderboard to compete with other participants</li>
        </ul>
        <p>Join our community of tech enthusiasts and start your quiz journey today!</p>
    </section>

    <?php include "./include/footer.php"; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
