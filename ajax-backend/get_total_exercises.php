<?php

require "../config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$workout_id = intval($_POST['workout_id']);

$sql_exercises = "SELECT workouts_exercises_join.workout_id, COUNT(*) as total_exercises
                    FROM workouts_exercises_join 
                    WHERE workouts_exercises_join.workout_id = $workout_id 
                    GROUP BY workouts_exercises_join.workout_id;
                    ";
$results_exercises = $mysqli->query($sql_exercises);
if (!$results_exercises) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}            

$row_total = $results_exercises->fetch_assoc();

$row_total = json_encode($row_total);

echo $row_total;
?>