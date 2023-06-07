<?php
session_start(); // Start the session


if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
  // If the user is not authenticated, redirect to the login page
  header('Location: index.php');
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin page</title>
  <link rel="shortcut icon" type="image/png" href="images/favicon.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <!-- CSS links -->
  <link rel="stylesheet" href="../Admin/sass/main.css" />
  <link rel="stylesheet" href="../Admin/css/dashboard.css">
  <link rel="stylesheet" href="../Admin/css/leaderboard.css">
  <!---google icon link-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <!--favicon-->
  <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
</head>

<body>
  <!--heading-->
  <header>
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid #fff">
      <div class="container-fluid heading">
        <span class="navbar-brand d-none d-lg-block">BitsNBytesQuiz</span>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav d-lg-none">
            <li class="nav-links">
              <a href="dashboard.php">
                <i class="bi bi-columns-gap"></i>
                <span class="navtext">Dashboard</span>
              </a>
            </li>
            <li class="nav-links">
              <a href="users.php">
                <i class="bi bi-people-fill"></i>
                <span class="navtext">Users</span>
              </a>
            </li>
            <li class="nav-links">
              <a href="scores.php">
                <i class="bi bi-trophy-fill"></i>
                <span class="navtext">Scores</span>
              </a>
            </li>
            <li class="nav-links">
              <a href="quiz.php">
                <span class="material-symbols-outlined" id="q">quiz</span>
                <span class="navtext">Quiz</span></a>
            </li>
            <li class="nav-links">
              <a href="add_quiz.php">
                <i class="bi bi-cloud-plus"></i>
                <span class="navtext">Add Quiz</span></a>
            </li>
            <li class="nav-links">
              <a href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span class="navtext">Logout</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- mainsection -->
  <div class="main row">
    <!-- sidebar-menu -->
    <div class="col-lg-2 px-0 d-none d-lg-block sidebar">
      <ul class="menu-links">
        <li class="nav-links">
          <a href="#">
            <i class="bi bi-columns-gap"></i>
            <span class="navtext">Dashboard</span>
          </a>
        </li>
        <li class="nav-links">
          <a href="users.php">
            <i class="bi bi-people-fill"></i>
            <span class="navtext">Users</span>
          </a>
        </li>
        <li class="nav-links">
          <a href="scores.php">
            <i class="bi bi-trophy-fill"></i>
            <span class="navtext">Scores</span>
          </a>
        </li>
        <li class="nav-links">
          <a href="quiz.php">
            <span class="material-symbols-outlined" id="q">quiz</span>
            <span class="navtext">Quiz</span></a>
        </li>
        <li class="nav-links">
          <a href="add_quiz.php">
            <i class="bi bi-cloud-plus"></i>
            <span class="navtext">Add Quiz</span></a>
        </li>
        <li class="nav-links">
          <a href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span class="navtext">Logout</span></a>
        </li>
      </ul>
    </div>
    <!-- main section -->
    <div class="col-lg-10">
      <!-- card section -->
      <div class="row container mx-auto">
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">quiz</p>
          </div>
          <div class="card-body">
            <p>Total Quiz</p>
            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT * FROM `questions`;";
            $result = mysqli_query($db, $sql);
            if ($result) {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">quiz</span>
          </div>

        </div>
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">Users</p>
          </div>
          <div class="card-body">
            <p>Total Users</p>
            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT * FROM `users`;";
            $result = mysqli_query($db, $sql);
            if ($result) {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">groups</span>
          </div>
        </div>
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">HTMl</p>
          </div>
          <!---category division count-->
          <div class="card-body">
            <p>Total</p>
            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT `question_id` FROM `questions` WHERE `quiz_id` = 1;";
            $result = mysqli_query($db, $sql);
            if ('count($result)') {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">html</span>
          </div>
        </div>
      </div>
      <div class="row container mx-auto">
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">CSS</p>
          </div>
          <div class="card-body">
            <p>Total</p>
            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT `question_id` FROM `questions` WHERE `quiz_id` = 2;";
            $result = mysqli_query($db, $sql);
            if ('count($result)') {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">css</span>
          </div>
        </div>
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">PHP</p>
          </div>
          <div class="card-body">
            <p>Total</p>

            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT `question_id` FROM `questions` WHERE `quiz_id` = 3;";
            $result = mysqli_query($db, $sql);
            if ('count($result)') {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">php</span>
          </div>
        </div>
        <div class="card col-lg-3">
          <div class="card-content m-0 p-0 border-0">
            <p class="head">JavaScript</p>
          </div>
          <div class="card-body">
            <p>Total</p>
            <?php
            include("../Admin/connection/connect.php");
            $sql = "SELECT `question_id` FROM `questions` WHERE `quiz_id` = 4;";
            $result = mysqli_query($db, $sql);
            if ('count($result)') {

              $rowCount = mysqli_num_rows($result);
            ?>
              <p><?php echo $rowCount; ?></p>
            <?php
            }
            ?>
            <span class="material-symbols-outlined">javascript</span>
          </div>
        </div>
      </div>
      <!--leaderboard section-->
      <div class="row container mx-auto">
        <div class="wrapper mt-3">
          <div class="row container mb-3">
            <div class="col-lg-6 tb">
              <h3 class="d-flex justify-content-center lead rounded">Subscribers</h3>
              <table class="table table-hover text-center">
                <thead class="table">
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT `email` FROM `subscribers`";
                  $result = mysqli_query($db, "SELECT email FROM subscribers");
                  $num = 1;
                  if (mysqli_num_rows($result)) {
                    while ($ros = mysqli_fetch_array($result)) {
                      echo "<tr class='tb-2r'>
                          <td>{$num}</td>
                          <td>{$ros['email']}</td>
                          </tr>";
                      $num++;
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>