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
    <!-- css links-->
    <link rel="stylesheet" href="../Admin/sass/main.css">
    <link rel="stylesheet" href="../Admin/css/quiz.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />

    <title>Quiz</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        <div class="heading">
            <span>Quiz Questions</span>
        </div>
    </nav>

    <div class="container">
        <?php
        function showAlert($msg, $alert_type)
        {
            echo '<div class="alert ' . $alert_type . ' alert-dismissible fade show" role="alert">
        ' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            if ($msg == "added") {
                showAlert("User Added Successfully!", "alert-success");
            } else if ($msg == "edited") {
                showAlert("Record Edited Successfully!", "alert-info");
            } else {
                showAlert("Record Deleted Successfully!", "alert-danger");
            }
        }
        ?>

        <a href="add_quiz.php" class="btn mb-3">Add New</a>
        <a href="dashboard.php" class="btn mb-3">BitsNBytesQuiz</a>

        <table class="table table-hover text-center">
            <thead class="table">
                <tr>
                    <th scope="col">Question ID</th>
                    <th scope="col">Quiz ID</th>
                    <th scope="col">Quiz Text</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `questions`";
                $result = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["question_id"] ?></td>
                        <td><?php echo $row["quiz_id"] ?></td>
                        <td><?php echo $row["question_text"] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row["question_id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $row["question_id"] ?>" class="link-dark" onclick='return confirmDelete()'><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- <button onclick="topFunction()" id="scrollToTopBtn" title="Scroll to Top" class="d-none d-sm-block">&#8593;</button> -->
    </div>


    <button onclick="topFunction()" id="scrollToTopBtn" title="Scroll to Top" class="d-none d-sm-block">&#8593;</button>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this question?");
        }
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
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>