<?php 

if (!isset($_POST['name']) || trim($_POST['name']) == '' ||
	!isset($_POST['date']) || trim($_POST['date']) == '' ||
	!isset($_POST['length']) || trim($_POST['length']) == ''){
		$error = "<em>Please fill out all the required fields.</em>";
}else{
	// session_start();
    require '../config/config.php';

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ( $mysqli->connect_errno ) {
        echo $mysqli->connect_error;
        exit();
    }

    $mysqli->set_charset('utf8');

    $name = "'" . $_POST['name'] . "'";
    $date = "'" . $_POST['date'] . "'";
    $length = "'" . $_POST['length'] . "'";
    $id = $_POST['workout_id'];
	$user_id = intval($_SESSION['user_id']);

    $sql = "UPDATE workouts SET name = $name, date = $date, length = $length WHERE id = $id;";
    $results = $mysqli->query($sql);

    if (!$results) {
        echo "result error";
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    $sql_return = "SELECT * FROM workouts WHERE id = $id and user_id = $user_id;";
    $results_return = $mysqli->query($sql_return);

    if (!$results_return) {
        echo "return error";
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    $mysqli->close();

    $workout_row = $results_return->fetch_assoc();
    $workout_row = json_encode($workout_row);

    echo $workout_row;
}
?>
