<?php
require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');

// delete the exercises currently in the exercises table
$sql_delete = "DELETE FROM exercises WHERE exercise_id > 0;";
$results_delete = $mysqli->query($sql_delete);
// check for sql errors
if (!$results_delete) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// resets the ids in exercises to start back at 1
$sql_resetindices = "ALTER TABLE exercises AUTO_INCREMENT=1;";
$results_reset = $mysqli->query($sql_resetindices);
if (!$results_reset) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();

echo "deleted";
?>