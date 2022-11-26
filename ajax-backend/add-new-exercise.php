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
    var_dump($_POST);
    // var_dump($exercise_name);
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// $sql_latest = "SELECT * FROM exercises WHERE exercise_id =" . 
// 3. close the db connection
$mysqli->close();

echo json_encode('success');
?>

