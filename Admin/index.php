<!DOCTYPE html>
<html lang="en">
<?php
include("../Admin/connection/connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM admin WHERE username = '$username' and password= '$password'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);
        if (is_array($row)) {
            $_SESSION['authenticated'] = true;
            $_SESSION["adm_id"] = $row['adm_id'];
            header("refresh:1;url=dashboard.php");
        } else {
            echo "<script>alert('Invalid Username or Password!');</script>";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap links--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!--CSS link--->
    <link rel="stylesheet" href="../Admin/sass/main.css">
    <link rel="stylesheet" href="../Admin/css/login.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <title>Admin Login</title>
</head>

<body>
    <nav class="navbar" style="height:79px">
        <div class="heading">
            <span>BitsNBytesQuiz</span>
        </div>
        <div style="background-color:#fff"></div>
    </nav>
    <div class="container">
        <div class="title d-flex justify-content-center">
            <h3>Admin Panel</h3>
        </div>
        <div class="form d-flex justify-content-center">
            <div class="f_orm">
                <div class="icon mb-3 d-flex justify-content-center"><i class="bi bi-person-circle people"></i></div>
                <form action="" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3 button">
                        <input type="submit" value="Login" name="submit" id="button">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>