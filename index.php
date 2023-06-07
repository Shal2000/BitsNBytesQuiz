<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("./connection/connect.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
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
    <section class="welcome container-fluid mt-5 pt-5 text-center w-75">
        <div class="welcome-content mt-4">
            <h2 class="heading">Welcome To BitsNBytesQuiz</h2>
            <span class="greeting mt-3">
                <p >Expand your knowledge, challenge your skills, and embrace the world of Information Technology with IT Quiz. Whether you're a seasoned developer, a curious student, or an IT enthusiast, our platform offers an interactive and educational experience to help you master various IT disciplines.</p>
                <p >Embark on a journey of discovery as you delve into quizzes covering a wide range of topics, including HTML, CSS, JavaScript, PHP, databases, networking, and more. Put your knowledge to the test, tackle thought-provoking questions, and unlock new levels of expertise.</p>
                <p >Stay engaged with our carefully crafted quizzes designed to enhance your learning. Each quiz is meticulously curated to ensure a balance of fun and educational content, helping you reinforce your understanding and stay up-to-date with the latest industry trends.</p>
                <p >Track your progress, earn achievements, and compete with fellow IT enthusiasts on our leaderboard. Whether you're aiming to top the charts or simply enjoy a friendly challenge, our community-driven platform provides a platform for growth and healthy competition.</p>
                <p >So, are you ready to take the plunge? Join IT Quiz today and embark on an exciting journey to expand your IT knowledge and elevate your skills to new heights!</p>
            </span>
            <a href="quiz.php" class="start-button pt-1 mt-3">Get Started</a>
        </div>  
    </section>
    <section class="welcome mt-5 pt-2 text-center welcome-bnb">
        <div class="welcome-hero row row-cols-md-3 mt-4 text-center">
            <div class="col">
                <img src="./imgs/brainstorming.png" alt="" class="img-fluid">
                <p class="welocme-hero-text pt-3">"Engage in critical thinking to identify the correct answer"</p>
            </div>
            <div class="col">
                <img src="./imgs/finger.png" alt="">
                <p class="welocme-hero-text pt-3">"Deliberate and select the correct answer through thoughtful analysis"</p>
            </div>
            <div class="col">
                <img src="./imgs/certification.png" alt="">
                <p class="welocme-hero-text pt-3">"Celebrate your accomplishments with a score on leaderboard"</p>
            </div>
        </div>
    </section>
    <section class="welcome mt-5 text-center">
        <h3 class="all-time-picks">All-Time Picks</h3>
        <div class="row hotpick row-cols-1 row-cols-md-3 g-4">
            <?php 
            
            $query_quiz = mysqli_query($db, "SELECT * FROM quizzes WHERE quiz_id = 1 OR quiz_id = 3 OR quiz_id = 5");
            while ($r = mysqli_fetch_array($query_quiz)) {
                if (isset($_SESSION['user_id'])) {
                    $userID = $_SESSION['user_id'];
                } else {
                    $userID = ""; // Set a default value for $userID if it's not present in the session
                }                
                $quizURL = isset($_SESSION['username']) ? $r['quiz_link'].'?user_id='.$userID : 'login.php';
                echo '
                <div class="col hotpick-col">
                    <a href="' . $quizURL ,'" id="hotpick-links">
                        <div class="card h-100 hotpick-card">
                            <img src="./imgs/' . $r['img'] . '" class="card-img-top hotpick-img" alt="...">
                            <div class="card-body hotpick-card-body">
                                <h5 class="card-title hotpick-title">' . $r['quiz_title'] . '</h5>
                                <p class="card-text hotpick-text">' . $r['description'] . '</p>
                            </div>
                        </div>
                    </a>
                </div>
                ';
            }
            ?>
        </div>

</div>

    
    </section>
    <?php include "./include/footer.php"; ?>
    <script src="./js/script.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script> 
</body>
</html>
