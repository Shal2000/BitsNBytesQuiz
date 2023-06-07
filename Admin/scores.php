<?php
session_start();
include("../Admin/connection/connect.php");

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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!--CSS links -->
    <link rel="stylesheet" href="../Admin/sass/main.css">
    <link rel="stylesheet" href="../Admin/css/scores.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <title>Leaderboard</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        <div class="heading">
            <span>Leaderboard</span>
        </div>
    </nav>

    <div class="container">
        <a href="dashboard.php" class="btn mb-3">BitsNBytesQuiz</a>
        <table class="table table-hover text-center">
            <thead class="table">
                <tr>
                    <th scope="col">Ranking</th>
                    <th scope="col">Name</th>
                    <th scope="col">Score</th>
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


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>