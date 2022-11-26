<?php 
require "../config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');
$count = $_POST['view_count'];
$sql_temp = "CREATE VIEW exercises" . $count . " AS 
                SELECT * FROM exercises ORDER BY exercise_id;"; // get all the exercises currently listed in the exercises table and put it into a new view
$results_temp = $mysqli->query($sql_temp);
if (!$results_temp) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

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

// add a view to an views table, with id and view name as columns, and put the view id as the "exercise id" in workouts table
$view_name = "exercises" . $count;
$sql_addTable = "INSERT INTO views(view_name) VALUES ($exercises_name);";
$results_addTable = $mysqli->query($sql_addTable);
if (!$results_addTable) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

// gets the latest view added
$sql_latest = "SELECT id FROM views ORDER BY views.id DESC LIMIT 1;"; 
$results_latest = $mysqli->query($sql_latest);
if (!$results_latest) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$view_id = $results_latest->fetch_assoc()['id']; // calls the row from the results and get the id of the latest view
$name = $_POST['workout_name'];
$date = "'" . $_POST['date'] . "'";
$length = "'" . $_POST['length'] . "'";

$sql_workouts = "INSERT INTO workouts(name, date, length, view_id) VALUES($name, $date, $length, $view_id);";
$results_workouts = $mysqli->query($sql_workouts);
// check for sql errors
if (!$results_workouts) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();

?>