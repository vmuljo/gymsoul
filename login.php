<?php
	require "config/config.php";

	if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) {
		// User IS logged in.
		header('Location: home.php');
	} else {
		// User is NOT logged in and The form was submitted.
		if ( isset($_POST['email']) && isset($_POST['password'])) {
			// Check if email and/or password is filled with valid info
			if(trim($_POST['email']) == "" && trim($_POST['password']) == ""){
				$error = "Please fill out all the required fields";
			}
			elseif(trim($_POST['email']) == "" || trim($_POST['password']) == ""){
				if(trim($_POST['email']) == ""){
					$error_email = "Email cannot be empty";
				}
				if(trim($_POST['password']) == ""){
					$error_password = "Password cannot be empty";
				}
			}
			
			else{
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

				if($mysqli->connect_errno) {
					echo $mysqli->connect_error;
					exit();
				}

				$email = $_POST['email'];
				$password = $_POST['password'];

				$email = $mysqli->escape_string($email);
				$password = $mysqli->escape_string($password);

				$password = hash('sha256', $password);
				// var_dump($password);

				$sql_email = "SELECT * FROM user_info WHERE email = '$email';";

				$results_email = $mysqli->query($sql_email);

				if (!$results_email) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}

				$sql_password = "SELECT * FROM user_info WHERE password = '$password';";

				$results_password = $mysqli->query($sql_password);

				if (!$results_password) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}

				$mysqli->close();

				if ( $results_email->num_rows == 1 && $results_password->num_rows>=1) {
					// Valid credentials.
					$row = $results_password->fetch_assoc();

					$_SESSION['logged_in'] = true;
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];

					header('Location: home.php');

				} else{
					if($results_email->num_rows != 1){
						$error_email = "Invalid email";
					}
					if($results_password->num_rows < 1){
						$error_password = "Invalid password.";
					}
				}
			}

		} 
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - Gym Soul</title>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>
  
  <style>
    .card{background-color: #3b4352; margin: 0 auto;}
    p{text-align:center;}
  </style>
</head>
<body class="bg-dark text-white d-flex align-items-center">
  <div class="card d-flex  p-3 justify-content-center">
    <h2>Welcome to Gym Soul</h2> <!-- some title -->
	<?php if (isset($error) && trim($error) != "") : ?>
    <small id="error" class="text-danger"><?php echo $error; ?></small>
    <?php endif; ?>
    <form method="POST" action="login.php" class="d-flex flex-column">
        <div class="form-group my-3">
            <label for="email" >Email: <span class="text-danger">*</span></label>
            <input name="email" class="form-control" type="email" id="email" />
            <?php if ( !empty($error_email) ) : ?>
						<small id="email-error" class="text-danger"><?php echo $error_email; ?></small>
					  <?php endif; ?>
            
        </div>
        <div class="form-group mb-3">
            <label for="password">Password: <span class="text-danger">*</span></label>
            <input name="password" class="form-control" type="password" id="password"/>
            <?php if ( !empty($error_password) ) : ?>
              <small id="password-error" class="text-danger"><?php echo $error_password; ?></small>
					  <?php endif; ?>
            
          </div>
        
        <button type="submit" class="btn btn-primary my-3">Log in</button>
        <p class="my-2">Don't have an account? <a href="signup.php">Sign up here.</a></p>
    </form>
  </div>
  <!-- <script src="login.js" ></script> -->
</body>
</html>