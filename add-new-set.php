<?php 
require 'config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

var_dump($_POST);
$mysqli->set_charset('utf8');

$muscle_group_id = $_POST['muscle_group_id'];
$exercise_name = $_POST['exercise_name'];
$reps = $_POST['reps_value'];
$weight = $_POST['weight_value'];

$sql = "INSERT INTO exercises(muscle_group_id, exercise_name, reps, weight) VALUES ($muscle_group_id, $exercise_name, $reps, $weight);";

$results = $mysqli->query($sql);
// check for sql errors
if (!$results) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// $sql_latest = "SELECT * FROM exercises WHERE exercise_id =" . 
// 3. close the db connection
$mysqli->close();
?>

<!-- "array(4) {
  ["muscle_group_id"]=>
  string(1) "4"
  ["reps_value"]=>
  string(2) "23"
  ["weight_value"]=>
  string(2) "23"
  ["exercise_name"]=>
  string(21) "Dumbbell Incline Curl"
}
You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Incline Curl, 23, 23)' at line 1" -->