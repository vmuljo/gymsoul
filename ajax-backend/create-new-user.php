<?php

require '../config/config.php';

if ( !isset($_POST['email']) || trim($_POST['email'] == '')
    || !isset($_POST['firstname']) || trim($_POST['firstname'] == '')
    || !isset($_POST['lastname']) || trim($_POST['lastname'] == '')
	|| !isset($_POST['password']) || trim($_POST['password'] == '')
    || !isset($_POST['confirmpassword']) || trim($_POST['confirmpassword'] == ''))  {
	var_dump("Please fill out all required fields.");
} else {
	// All required fields were provided.
	if($_POST['password'] != $_POST['confirmpassword']){
		var_dump("Passwords do not match");
	}else{

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];

		$firstname = $mysqli->escape_string($firstname);
		$lastname = $mysqli->escape_string($lastname);
		$email = $mysqli->escape_string($email);
		$password = $mysqli->escape_string($password);
		$confirmpassword = $mysqli->escape_string($confirmpassword);

		$password = hash('sha256', $password);

		$sql_registered = "SELECT * FROM user_info WHERE email = '$email';";

		$results_registered = $mysqli->query($sql_registered);

		if (!$results_registered) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}			
		
		if ($results_registered->num_rows > 0) {
			$error = "Username or email already registered.";
		} else {
			$sql = "INSERT INTO user_info (firstname, lastname, email, password)
						VALUES ('$firstname', '$lastname', '$email', '$password');";

			$results = $mysqli->query($sql);

			if (!$results) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
		}

		$mysqli->close();

		echo json_encode("Success");
	}

}