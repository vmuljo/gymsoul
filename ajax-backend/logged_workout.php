<?php 
require "../config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');
$user_id = 1;
// $user_id = $_SESSION['user_id'];
/*
$sql_workouts = "SELECT * FROM workouts (LEFT JOIN stuff) WHERE user_id = $user_id;

this will give us the workouts with a user id.
-----
When we add an exercise and log it, before we add the exercise, we will call a select statement to get the latest ID:
    $sql_latest_exercise = "SELECT exercise_id FROM exercises ORDER BY exercise_id DESC LIMIT 1;";
then fetch the row: 
    $latest_exercise = $results->fetch_assoc()['exercise_id'];
Then we insert into workouts
then we get the latest added workout:
    $sql_latest_workout = "SELECT id FROM workouts ORDER BY id DESC LIMIT 1;";
    $latest_workout = $results->fetch_assoc()['id'];
Then we want to add to the join table
    $sql_join = "INSERT INTO workouts_exercises_join(workout_id, exercise_id) SELECT ($latest_workout AS workout_id, exercise_id) FROM exercises WHERE exercise_id > $latest_exercise;";
----
*/

// get the latest added exercise
$sql_latest_exercise = "SELECT exercise_id FROM exercises ORDER BY exercise_id DESC LIMIT 1;";
$results_latest_exercise = $mysqli->query($sql_latest_exercise);
if (!$results_latest_exercise) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}
if($results_latest_exercise->num_rows == 0){
    $latest_exercise = 0;
}
else{
    $latest_exercise = $results_latest_exercise->fetch_assoc()['exercise_id'];
}

// Move data from holding table into main exercises table
$sql_move_holding = "INSERT INTO exercises(muscle_group_id, exercise_name, reps, weight) SELECT muscle_group_id, exercise_name, reps, weight FROM hold_exercises;";
$results_move_holding = $mysqli->query($sql_move_holding);
if (!$results_move_holding) {
    echo "move holding error";
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// insert into workouts
$name =  "'" .$_POST['workout_name'] . "'";
$date = "'" . $_POST['date'] . "'";
$length = "'" . $_POST['length'] . "'";

if (isset($_POST['notes']) && trim($_POST['notes']) != ''){
    $notes = "'" . $_POST['notes'] . "'";
    $sql_workouts = "INSERT INTO workouts(name, date, length, user_id, notes) VALUES($name, $date, $length, $user_id, $notes);";
} else{
    $sql_workouts = "INSERT INTO workouts(name, date, length, user_id) VALUES($name, $date, $length, $user_id);";
}
$results_workouts = $mysqli->query($sql_workouts);
if (!$results_workouts) {
    var_dump($_POST['date']);
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

//Error Code: 1064. You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1


// get latest added workout id
$sql_latest_workout = "SELECT id FROM workouts ORDER BY id DESC LIMIT 1;";
$results_latest_workout = $mysqli->query($sql_latest_workout);
if (!$results_latest_workout) {
    echo "latest workout error";
    echo $mysqli->error;
    $mysqli->close();
    exit();
}
$latest_workout = $results_latest_workout->fetch_assoc()['id'];

// add info into join table
$sql_join = "INSERT INTO workouts_exercises_join(workout_id, exercise_id) SELECT $latest_workout AS workout_id, exercise_id FROM exercises WHERE exercise_id > $latest_exercise;";
$results_join = $mysqli->query($sql_join);
if (!$results_join) {
    echo "join table insert error";
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();


?>
