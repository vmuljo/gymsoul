<?php 
// Call this when adding an exercise with the set
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

// var_dump($_POST);
$mysqli->set_charset('utf8');

$muscle_group_id = $_POST['muscle_group_id'];
// $exercise_id = $_POST['exercise_id'];
$exercise_name = "'" . $_POST['exercise_name'] . "'";
$reps = "'".$_POST['reps']. "'";
$weight = "'".$_POST['weights'] . "'";

$sql = "INSERT INTO hold_exercises(muscle_group_id, exercise_name, reps, weight) VALUES ($muscle_group_id, $exercise_name, $reps, $weight);";
$results = $mysqli->query($sql);
// check for sql errors
if (!$results) {
    echo "error 1";
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$sql_latest = "SELECT id, muscle_groups.muscle as muscle, exercise_name, reps, weight 
                FROM hold_exercises 
                LEFT JOIN muscle_groups
                ON muscle_groups.muscle_id = hold_exercises.muscle_group_id
                ORDER BY id DESC LIMIT 1;
                ";
$results_latest = $mysqli->query($sql_latest);

if (!$results_latest) {
    echo "error 2";
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// var_dump($results_latest);

// 3. close the db connection
$mysqli->close();

$latest_row = $results_latest->fetch_assoc();
$latest_row = json_encode($latest_row);

echo $latest_row;
?>

