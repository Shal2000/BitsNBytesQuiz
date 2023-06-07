<?php
include "../Admin/connection/connect.php";
$id = $_GET["id"];
if (isset($_POST["submit"])) {
    $quiz_id = $_POST['quiz_id'];
    $q_text = $_POST['q_text'];
    $op_1 = $_POST['op_1'];
    $op_2 = $_POST['op_2'];
    $op_3 = $_POST['op_3'];
    $op_4 = $_POST['op_4'];
    $ans_1 = $_POST['ans_1'];
    $ans_2 = $_POST['ans_2'];
    $ans_3 = $_POST['ans_3'];
    $ans_4 = $_POST['ans_4'];

    $sql = "UPDATE `questions` SET `quiz_id` = '$quiz_id', `question_text` = '$q_text' WHERE `question_id` = $id;";
    $result = mysqli_query($db, $sql);

    // Option update
    $optionUpdate1 = "UPDATE `options` SET `option_text` = '$op_1', `is_correct` = '$ans_1' WHERE `option_id` = 1 AND `question_id` = $id;";
    $optionUpdate2 = "UPDATE `options` SET `option_text` = '$op_2', `is_correct` = '$ans_2' WHERE `option_id` = 2 AND `question_id` = $id;";
    $optionUpdate3 = "UPDATE `options` SET `option_text` = '$op_3', `is_correct` = '$ans_3' WHERE `option_id` = 3 AND `question_id` = $id;";
    $optionUpdate4 = "UPDATE `options` SET `option_text` = '$op_4', `is_correct` = '$ans_4' WHERE `option_id` = 4 AND `question_id` = $id;";

    $resultOption1 = mysqli_query($db, $optionUpdate1);
    $resultOption2 = mysqli_query($db, $optionUpdate2);
    $resultOption3 = mysqli_query($db, $optionUpdate3);
    $resultOption4 = mysqli_query($db, $optionUpdate4);

    if ($result && $resultOption1 && $resultOption2 && $resultOption3 && $resultOption4) {
        header("Location: quiz.php?msg=edited");
    } else {
        echo "Failed: " . mysqli_error($db);
    }
}

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
    <!--CSS links-->
    <link rel="stylesheet" href="../Admin/sass/main.css">
    <link rel="stylesheet" href="../Admin/css/edit.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />
    <title>Editing Question</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #1E375A;color:white;">
        Editing Questions
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Editing Question</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>
        <?php
        $sql = "SELECT * FROM `questions` WHERE question_id = $id LIMIT 1";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);

        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw;min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Question ID</label>
                        <input type="number" class="form-control" name="question_id" value="<?php echo $row['question_id'] ?>">
                    </div>
                    <div class="col">
                        <label class="form-label">Category:</label>
                        <select class="form-select" style="width:120px" aria-valuemax="<?php echo $row['quiz_id'] ?>" name="quiz_id">
                            <option selected value="1">HTML</option>
                            <option value="2">CSS</option>
                            <option value="3">PHP</option>
                            <option value="3">JavaScript</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Quiz Text:</label>
                    <input type="text" class="form-control" name="q_text" value="<?php echo $row['question_text'] ?>">
                </div>
                <?php
                $sql = "SELECT * FROM `questions` WHERE question_id = $id LIMIT 1";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_assoc($result);

                $option = "SELECT * FROM `options` WHERE question_id = $id";
                $option_rs = mysqli_query($db, $option);
                if ($option_rs) {
                    while ($rrow = mysqli_fetch_assoc($option_rs)) {
                        $optionId = $rrow['option_id'];
                        $optionText = $rrow['option_text'];
                        $isChecked = ($rrow['is_correct'] == 1) ? 'checked' : '';
                ?>
                        <div class="mb-3 option">
                            <div class="option_label">
                                <label class="form-label">Option <?php echo $optionId; ?>:</label>
                                <input type="text" name="op_<?php echo $optionId; ?>" id="op_<?php echo $optionId; ?>" value="<?php echo $optionText; ?>">
                            </div>
                            <div class="answer_option" name="ans">
                                <input type="radio" class="form-check-input mx-2" name="ans_<?php echo $optionId; ?>" id="true" value="1" <?php echo $isChecked; ?>>
                                <label for="true" class="form-input-label">True</label>
                                <input type="radio" class="form-check-input mx-2" name="ans_<?php echo $optionId; ?>" id="false" value="0" <?php echo ($isChecked == '') ? 'checked' : ''; ?>>
                                <label for="false" class="form-input-label">False</label>
                            </div>
                        </div>
                <?php
                    }
                    mysqli_free_result($option_rs);
                } else {
                    echo "Error: " . mysqli_error($db);
                }
                ?>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="quiz.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>