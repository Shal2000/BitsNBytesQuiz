<?php

// Establish a connection
$db = mysqli_connect(
    'localhost',
    'root',
    '',
    'bnb_quiz_db'
);

// Check the connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

