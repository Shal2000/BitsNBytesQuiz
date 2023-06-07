<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("connection/connect.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($password)) {
        $message = "Username and password are required!";
    } else {
        // Check if the username and password match the database records
        $query = mysqli_query($db,"SELECT * FROM users WHERE username = '$username' AND password = '$password'" );
        $result = mysqli_num_rows($query);
        
        if ($result > 0) {
            $user = mysqli_fetch_assoc($query);
            // Username and password are correct, set the session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $userID = $user['user_id'];
            $_SESSION['user_id'] = $userID;
            // Redirect the user to the leaderboard page
            header("Location: index.php?user_id=" . urlencode($userID));
            exit();
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>LOGIN</title>
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

    <div class="container d-flex justify-content-center">
        <div class="form d-flex justify-content-center flex-column">
            <div class="title d-flex justify-content-center">
                <h3 class="login-title pt-4">LogIn</h3>
                
            </div>
            <div class="icon d-flex justify-content-center"><i class="bi bi-person-circle people"></i></div>
            <div class="f_orm">
                <!-- <div class="icon mb-3 d-flex justify-content-center"><i class="bi bi-person-circle people"></i></div> -->
                <form action="" method="post" class="text-center">
                    <div class="mb-3">
                        <input type="text" name="username" id="username" placeholder="Username" class="px-2" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" placeholder="Password" class="px-2" required>
                    </div>
                    <div class="mb-3 button">
                        <input type="submit" value="Login" name="submit" class="login-btn mt-2">
                    </div>
                    <div class="reg mt-4">
                        <hr style="color:#000">
                        <p class="mt-2">Don't have an account? <a href="registration.php" class="reg">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include "./include/footer.php"; ?>
<script src="./js/script.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>