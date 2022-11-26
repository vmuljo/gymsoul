<?php 
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

// var_dump($_POST);
$mysqli->set_charset('utf8');

$muscle_group_id = $_POST['muscle_group_id'];
$exercise_name = "'" . $_POST['exercise_name'] . "'";
$reps = "'".$_POST['reps']. "'";
$weight = "'".$_POST['weights'] . "'";

// "string(29) "'Unilateral Tricep Extension'"
// Column count doesn't match value count at row 1"

$sql = "INSERT INTO exercises(muscle_group_id, exercise_name, reps, weight) VALUES ($muscle_group_id, $exercise_name, $reps, $weight);";

$results = $mysqli->query($sql);
// check for sql errors
if (!$results) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$sql_latest = "SELECT muscle_groups.muscle as muscle, exercise_name, reps, weight 
                FROM exercises 
                LEFT JOIN muscle_groups
                ON muscle_groups.muscle_id = exercises.muscle_group_id
                ORDER BY exercise_id DESC LIMIT 1;
                ";
$results_latest = $mysqli->query($sql_latest);

if (!$results_latest) {
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

