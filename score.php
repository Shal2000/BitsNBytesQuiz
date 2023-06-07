<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("./connection/connect.php");
var_dump($_SESSION['username'])
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
    <title>SCORE</title>
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
    <section class="score-section mt-5 pt-5 text-center">
            <div class="score">
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Retrieve the user's answers from the submitted form
                    $userAnswers = $_POST;

                    // Calculate the score
                    $score = 0;
                    foreach ($userAnswers as $questionID => $selectedOption) {
                        // Retrieve the correct option for the question from the options table
                        $query_correct_option = mysqli_query($db,"SELECT is_correct FROM options WHERE option_id = " . $selectedOption);

                        // Check if the query was successful and the correct option exists
                        if ($query_correct_option && mysqli_num_rows($query_correct_option) > 0) {
                            $correctOptionRow = mysqli_fetch_assoc($query_correct_option);
                            $correctOption = $correctOptionRow['is_correct'];

                            // Check if the selected option is the correct option
                            if ($correctOption === "1") {
                                $score++;
                            }
                        }
                    }

                    // Display the score to the user
                    echo '<h2 class="score-title">Your Score</h2>';
                    echo '<p class="score-mark">You scored ' . $score . ' out of 15</p>';

                    // Add funny and creative messages based on the score
                    if ($score == 15) {
                        echo "<p class='note'>Wow! You're an expert! Great job!</p>";
                    } elseif ($score >= 10) {
                        echo "<p class='note'>Well done! You have a solid knowledge!</p>";
                    } elseif ($score >= 5) {
                        echo "<p class='note'>Not bad! You're on your way to becoming a pro!</p>";
                    } else {
                        echo "<p class='note'>Don't worry, everything can be tricky. Keep learning, and you'll improve!</p>";
                    }

                    // Update the user's score in the database
                    if (isset($_GET['user_id'])) {
                        $userID = $_GET['user_id'];

                        // Update the score in the users table
                        $updateQuery = "UPDATE users SET score = $score WHERE user_id = $userID";
                        mysqli_query($db, $updateQuery);
                    }
                }
            ?>

            </div>
            <a href="quiz.php" class="quiz-btn px-3 pt-1 mt-3">Back to quiz</a>

    </section>
    <?php include "./include/footer.php" ; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script> 
</body>
</html>