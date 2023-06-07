<?php
session_start();
include("./connection/connect.php");

// Query to retrieve the top scores from the database
$query = "SELECT username, score FROM users ORDER BY score DESC LIMIT 10";
$result = mysqli_query($db, $query);
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
    <title>LEADERBOARD</title>
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

<section class="leaderboard-section mt-5 pt-5">
    <div class="container">
        <h2 class="leaderboard-title">Leaderboard</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rank = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $username = $row['username'];
                    $score = $row['score'];
                    echo '
                    <tr>
                        <td>' . $rank . '</td>
                        <td>' . $username . '</td>
                        <td>' . $score . '</td>
                    </tr>
                    ';
                    $rank++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include "./include/footer.php" ; ?>
<script src="./js/script.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script> 
</body>
</html>
