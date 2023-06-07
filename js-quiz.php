<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL) ; 
include("./connection/connect.php");?>

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
    <title>JAVASCRIPT-QUIZ</title>
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
    <section class="quiz container mt-5 pt-5">
        <?php
        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
        } else {
            $userID = ""; // Set a default value for $userID if it's not present in the session
        }  
         ; ?>
        
        <form action="score.php?user_id=<?php echo $userID; ?>" method="post" class="mt-4">
            <h2 class="quiz-heading">JavaScript Quiz - Evaluate Your JavaScript Proficiency</h2>
                <div class="quiz-section container-fluid">
                    <?php 
                    // Initialize the userID variable
                    
                    $query_questions = mysqli_query($db, "SELECT * FROM questions  WHERE quiz_id =3 ORDER BY RAND() LIMIT 15");
                    $questions = mysqli_fetch_all($query_questions, MYSQLI_ASSOC);

                    $counter = 1; // Initialize the counter

                    foreach ($questions as $question) {
                        echo '<p class="question pt-3">'.$counter.'.&nbsp;'.$question['question_text'].'</p>';
                        
                        $query_options = mysqli_query($db, "SELECT * FROM options WHERE question_id = " . $question['question_id']);
                        $options = mysqli_fetch_all($query_options, MYSQLI_ASSOC);
                        
                        foreach ($options as $option) {
                            echo '<label for="option' . $option['option_id'] . '" class="custom">
                                <input type="radio" id="option' . $option['option_id'] . '" name="q' . $question['question_id'] . '" value="' . $option['option_id'] . '" class="quiz-input">
                                &nbsp;' . $option['option_text'] . '
                            </label><br>';
                        }

                        $counter++; // Increment the counter
                    }
                    ?>
                </div>
                <div class="quiz-section container-fluid mt-4">
                    <?php if (isset($_SESSION['userID'])) { ?>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['userID']; ?>">
                    <?php } ?>
                    <input type="submit" value="Finish" class="finish">
                </div>
        </form>
    </section>
    <?php include "./include/footer.php" ; ?>
    <button onclick="topFunction()" id="scrollToTopBtn" title="Scroll to Top" class="d-none d-sm-block">&#8593;</button>
    <script>
        window.addEventListener("scroll", function() {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script> 
</body>
</html>
