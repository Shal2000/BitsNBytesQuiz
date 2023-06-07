<?php
include "../Admin/connection/connect.php";

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
    <link rel="stylesheet" href="../Admin/css/users.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <title>Users</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        <div class="heading">
            <span>Users</span>
        </div>
    </nav>

    <div class="container">
        <a href="dashboard.php" class="btn mb-3">BitsNBytesQuiz</a>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `users`";
                $result = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["user_id"] ?></td>
                        <td><?php echo $row["username"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>