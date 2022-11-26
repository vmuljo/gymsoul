<?php
    require '../config/config.php';

    $selected_option = $_POST['option_value'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');
    $sql_shoulder = "SELECT shoulder_exercise as exercise, shoulder_id as id FROM shoulder_exercises;";
    $results_shoulder = $mysqli->query($sql_shoulder);
    if ( !$results_shoulder ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_chest = "SELECT chest_exercise as exercise, chest_id as id FROM chest_exercises;";
    $results_chest = $mysqli->query($sql_chest);
    if ( !$results_chest ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_back = "SELECT back_exercise as exercise, back_id as id FROM back_exercises;";
    $results_back = $mysqli->query($sql_back);
    if ( !$results_back) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_leg = "SELECT leg_exercise as exercise, leg_id as id FROM leg_exercises;";
    $results_leg = $mysqli->query($sql_leg);
    if ( !$results_leg ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_tricep = "SELECT tricep_exercise as exercise, tricep_id as id FROM tricep_exercises;";
    $results_tricep = $mysqli->query($sql_tricep);
    if ( !$results_tricep ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $sql_bicep = "SELECT bicep_exercise as exercise, bicep_id as id FROM bicep_exercises;";
    $results_bicep = $mysqli->query($sql_bicep);
    if ( !$results_bicep ) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $mysqli->close();

    if ($selected_option == 1){
        $muscle = $results_chest->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 2){
        $muscle = $results_back->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 3){
        $muscle = $results_tricep->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 4){
        $muscle = $results_bicep->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 5){
        $muscle = $results_shoulder->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 6){
        $muscle = $results_leg->fetch_all(MYSQLI_ASSOC);
    }
    elseif ($selected_option == 7){
        $muscle = ['exercise' => "Other", 'id' => "1"];
    }
    else{
        $muscle = [];
    }

    $muscle = json_encode($muscle);

    echo $muscle;
?>