<?php 

require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');

$id = $_POST['exercise_id'];

$sql = "DELETE FROM hold_exercises WHERE id = $id;";
$results = $mysqli->query($sql);

if (!$results) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();
?>