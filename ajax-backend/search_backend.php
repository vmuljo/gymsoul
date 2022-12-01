<?php
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');

// $sql = "SELECT workouts.name as name, workouts.date as date, workouts.length as length, workouts.id as id, 
//                 FROM workouts_exercises_id
//                 LEFT JOIN workouts
//                 ON workouts_exercises_id.workout_id = workouts.id
//                 LEFT JOIN exercises
//                 ON workouts_exercises_id.exercise_id = exercises.id
//                 WHERE 1 = 1";
$sql = "SELECT * FROM workouts WHERE 1=1";

if ( isset($_POST['search_term']) && !empty($_POST['search_term']) ) {
    $search_term = $_POST['search_term'];
    $search_term = $mysqli->escape_string($search_term);
    $sql = $sql . " AND workouts.name LIKE '%$search_term%'";
}

$sql = $sql . ";";

$results = $mysqli->query($sql);

if ( !$results ) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();

$all_rows = $results->fetch_all(MYSQLI_ASSOC);

$all_rows = json_encode($all_rows);
echo $all_rows;

?>