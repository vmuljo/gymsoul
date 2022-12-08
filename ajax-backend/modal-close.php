<?php 
// when modal closed, calls this backend code to reload
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');


$sql_all = "SELECT workouts.name as name, workouts.date as date, workouts.length as length, workouts.id as id,COUNT(*) as total_exercises 
        FROM workouts_exercises_join
        LEFT JOIN workouts
        ON workouts_exercises_join.workout_id = workouts.id
        LEFT JOIN exercises
        ON workouts_exercises_join.exercise_id = exercises.exercise_id
        GROUP BY workouts_exercises_join.workout_id ORDER BY workouts.id DESC;";
$results_all = $mysqli->query($sql_all);

if ( !$results_all ) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}
$mysqli->close();

$all_rows = $results_all->fetch_all(MYSQLI_ASSOC);

$all_rows = json_encode($all_rows);
echo $all_rows;

?>