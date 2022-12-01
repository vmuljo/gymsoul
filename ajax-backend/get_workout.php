<?php

require "../config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$user_id = 1; // will use sessions here
$workout_id = intval($_POST['workout_id']);

$sql_cards = "SELECT * FROM workouts WHERE user_id = $user_id AND id = $workout_id;";

$results_cards = $mysqli->query($sql_cards);
if (!$results_cards) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$row_cards = $results_cards->fetch_assoc();

$row_cards = json_encode($row_cards);

echo $row_cards;
?>