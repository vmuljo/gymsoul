<?php
    require '../config/config.php';

    $selected_option = $_POST['option_value'];

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');

    $sql = "SELECT exercise_name as exercise, id FROM exercise_types WHERE muscle_group_id = $selected_option OR muscle_group_id = 7;";
    $results = $mysqli->query($sql);
    if ( !$results) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

    $mysqli->close();

    if($selected_option == 0 && $selected_option != 7){
        $muscle = [];
    }
    elseif ($selected_option == 7){
        $muscle = ['exercise' => "Other", 'id' => "0"];
    }
    else{
        $muscle = $results->fetch_all(MYSQLI_ASSOC);
    }

    $muscle = json_encode($muscle);

    echo $muscle;
?>