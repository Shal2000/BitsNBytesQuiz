<?php
// create a connection
include "../Admin/connection/connect.php";

if (isset($_POST['submit'])) {
    $quiz_id = $_POST["quiz_id"];
    $question_text = $_POST["q_text"];

    // declare options
    $op_1 = $_POST['op_1'];
    $op_2 = $_POST['op_2'];
    $op_3 = $_POST['op_3'];
    $op_4 = $_POST['op_4'];

    // answer options
    $ans_1 = $_POST['ans_1'];
    $ans_2 = $_POST['ans_2'];
    $ans_3 = $_POST['ans_3'];
    $ans_4 = $_POST['ans_4'];

    // execute query to insert question
    $sql = "INSERT INTO questions (quiz_id, question_text) VALUES ($quiz_id, '$question_text')";
    $db->query($sql);
    $question_id = $db->insert_id;

    // execute query to insert options
    $options_sql = "INSERT INTO options (question_id, option_text, is_correct) VALUES ";
    $options_sql .= "($question_id, '$op_1', '$ans_1'), ";
    $options_sql .= "($question_id, '$op_2', '$ans_2'), ";
    $options_sql .= "($question_id, '$op_3', '$ans_3'), ";
    $options_sql .= "($question_id, '$op_4', '$ans_4')";

    $result = $db->query($options_sql);

    // process the result
    if ($result) {
        header("Location: quiz.php?msg=added");
        exit(); // Important: Add an exit() statement after redirection
    } else {
        echo "Failed: " . $db->error;
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
    <link rel="stylesheet" href="../Admin/sass/main.css">
    <link rel="stylesheet" href="../Admin/css/add.css">
    <!--favicon-->
    <link rel="icon" href="./imgs/logo.png" sizes="96x96" type="image/png" />

    <title>Add New Quiz</title>
</head>

<body>
    <!-- ---header section--- -->
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
        <div class="heading">
            <span>Add Question</span>
        </div>
    </nav>

    <div class="container">
        <!-- form section  -->
        <div class="container d-flex justify-content-center">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Category:</label>
                    <select class="form-select" style="width:261px" name="quiz_id">
                        <option selected value="1">HTML</option>
                        <option value="2">CSS</option>
                        <option value="3">PHP</option>
                        <option value="3">JavaScript</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">question :</label>
                    <input type="text" name="q_text" id="q_text">
                </div>
                <div name="options">
                    <div class="mb-3">
                        <label class="form-label">Option 1:</label>
                        <input type="text" name="op_1" id="op_1">

                        <div class="answer_option" name="ans">
                            <input type="radio" class="form-check-input mx-2" name="ans_1" id="true" value="1">
                            <label for="true" class="form-input-label">True</label>

                            <input type="radio" class="form-check-input mx-2" name="ans_1" id="false" value="0">
                            <label for="false" class="form-input-label">False</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Option 2:</label>
                        <input type="text" name="op_2" id="op_2">
                        <div class="answer_option" name="ans">
                            <input type="radio" class="form-check-input mx-2" name="ans_2" id="true" value="1">
                            <label for="true" class="form-input-label">True</label>

                            <input type="radio" class="form-check-input mx-2" name="ans_2" id="false" value="0">
                            <label for="false" class="form-input-label">False</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Option 3:</label>
                        <input type="text" name="op_3" id="op_3">
                        <div class="answer_option" name="ans">
                            <input type="radio" class="form-check-input mx-2" name="ans_3" id="true" value="1">
                            <label for="true" class="form-input-label">True</label>

                            <input type="radio" class="form-check-input mx-2" name="ans_3" id="false" value="0">
                            <label for="false" class="form-input-label">False</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Option 4:</label>
                        <input type="text" name="op_4" id="op_4">
                        <div class="answer_option" name="ans">
                            <input type="radio" class="form-check-input mx-2" name="ans-4" id="true" value="1">
                            <label for="true" class="form-input-label">True</label>

                            <input type="radio" class="form-check-input mx-2" name="ans-4" id="false" value="0">
                            <label for="false" class="form-input-label">False</label>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <a href="quiz.php" class="btn btn-danger" !important>Cancel</a>
                </div>
            </form>
        </div>
    </div>



    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>