<?php
// gets all the exercises on a workout id
require "../config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$workout_id = intval($_POST['workout_id']);

$sql_exercises = "SELECT workout_id, workouts_exercises_join.exercise_id, muscle_groups.muscle as muscle, exercises.exercise_name as exercise_name, exercises.reps as reps, exercises.weight as weight
                    FROM workouts_exercises_join 
                    LEFT JOIN exercises
                    ON exercises.exercise_id = workouts_exercises_join.exercise_id
                    LEFT JOIN muscle_groups
                    ON muscle_groups.muscle_id = exercises.muscle_group_id
                    WHERE workouts_exercises_join.workout_id = $workout_id;
                    ";
$results_exercises = $mysqli->query($sql_exercises);
if (!$results_exercises) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}     

$all_exercises = $results_exercises->fetch_all(MYSQLI_ASSOC);

$all_exercises = json_encode($all_exercises);

echo $all_exercises;
?>