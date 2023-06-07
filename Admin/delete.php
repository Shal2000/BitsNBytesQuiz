<?php
include "../Admin/connection/connect.php";
$question_id = $_GET["id"];

if (isset($question_id)) {
    // Delete options related to the question from the options table
    $deleteOptionsQuery = "DELETE FROM options WHERE question_id = $question_id";
    $resultOptions = mysqli_query($db, $deleteOptionsQuery);

    // Check if the deletion of options was successful
    if ($resultOptions) {
        // Deletion of options successful


        // Delete the question from the questions table
        $deleteQuestionQuery = "DELETE FROM questions WHERE question_id = $question_id";
        $resultQuestion = mysqli_query($db, $deleteQuestionQuery);

        // Check if the deletion of the question was successful
        if ($resultQuestion) {
            header("Location: quiz.php?msg=deleted!");
            // Deletion of the question successful
            // echo "Question and related options have been deleted.";
            // You can also redirect to another page if needed
        } else {
            // Error occurred while deleting the question
            echo "Error deleting the question. Please try again.";
        }
    } else {
        // Error occurred while deleting options
        echo "Error deleting options. Please try again.";
    }
} else {
    // Missing question ID
    echo "Missing question ID. Please provide the question ID.";
}
