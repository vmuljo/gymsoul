<?php

require 'config/config.php';
session_start();

if ( !isset($_POST['email']) || trim($_POST['email'] == '')
    || !isset($_POST['firstname']) || trim($_POST['firstname'] == '')
    || !isset($_POST['lastname']) || trim($_POST['lastname'] == '')
	|| !isset($_POST['password']) || trim($_POST['password'] == '')
    || !isset($_POST['confirmpassword']) || trim($_POST['confirmpassword'] == ''))  {
	$error = "Please fill out all required fields.";
} else {
	// All required fields were provided.
	if($_POST['password'] != $_POST['confirmpassword']){
		$error = "Passwords do not match";
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
			$error = "Email already registered.";
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
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>

  <title>Sign Up</title>
  <style>
    .container{background-color: #3b4352; max-width: 50%;}
    p{text-align: center;}
  </style>
</head>
<body class="bg-dark text-white d-flex align-items-center">
  <div class="container card rounded justify-content-center">
    <h2>Create an Account</h2> <!-- some title -->
    <?php if (isset($error) && trim($error) != "") : ?>
    <small id="error" class="text-danger"><?php echo $error; ?></small>
    <?php endif; ?>
    <form method="POST" action="signup.php" class="d-flex flex-column" id="createSubmit">
        <div class="form-group my-2">
            <label for="firstname" >First Name <span class="text-danger">*</span></label>
            <input name="firstname" class="form-control" type="text" id="firstname"/>
            <small id="fname-error" class="invalid-feedback">First name is required.</small>
        </div>
        <div class="form-group my-2">
            <label for="lastname" >Last Name <span class="text-danger">*</span></label>
            <input name="lastname" class="form-control" type="text" id="lastname"/>
            <small id="lname-error" class="invalid-feedback">Last Name is required.</small>
        </div>
        <div class="form-group my-2">
            <label for="email" >Email <span class="text-danger">*</span></label>
            <input name="email" class="form-control" type="email" id="email"/>
            <small id="email-error" class="invalid-feedback">Email is required.</small>
        </div>
        <div class="form-group my-2">
            <label for="password">Password <span class="text-danger">*</span></label>
            <input name="password" class="form-control" type="password" id="password"/>
            <small id="password-error" class="invalid-feedback">Password is required.</small>
        </div>
        <div class="form-group my-2">
            <label for="confirmpassword">Confirm Password <span class="text-danger">*</span></label>
            <input name="confirmpassword" class="form-control" type="password" id="confirm-password"/>
            <small id="confirm-pass-error" class="invalid-feedback">Password confirmation is required.</small>
        </div>

        <div class="form-check my-2">
            <input class="form-check-input" type="checkbox" value="yes" id="termsandconditions" name="accepted">
            <label class="form-check-label" for="termsandconditions">
              I agree to create an account for GymSoul.  <span class="text-danger">*</span>
            </label>
            <small id="tc-error" class="invalid-feedback">You must agree to create an account.</small>
          </div>

        <button type="submit" class="btn btn-primary my-2">Sign Up</button>
        <p class="my-3 justify-content-center">Already have an account? <a href="login.php">Log in here.</a></p>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    // document.querySelector('#createSubmit').onsubmit = () => {
      
    //   if ( document.querySelector('#firstname').value.trim().length == 0 ) {
    //       document.querySelector('#firstname').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#firstname').classList.remove('is-invalid');
    //   }
    //   if ( document.querySelector('#lastname').value.trim().length == 0 ) {
    //       document.querySelector('#lastname').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#lastname').classList.remove('is-invalid');
    //   }

    //   if ( document.querySelector('#email').value.trim().length == 0 ) {
    //       document.querySelector('#email').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#email').classList.remove('is-invalid');
    //   }

    //   if ( document.querySelector('#password').value.trim().length == 0 ) {
    //       document.querySelector('#password').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#password').classList.remove('is-invalid');
    //   }

    //   if ( document.querySelector('#confirm-password').value.trim().length == 0 ) {
    //       document.querySelector('#confirm-password').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#confirm-password').classList.remove('is-invalid');
    //   }

    //   if ( !document.querySelector('#termsandconditions').checked ) {
    //       document.querySelector('#termsandconditions').classList.add('is-invalid');
    //   } else {
    //       document.querySelector('#termsandconditions').classList.remove('is-invalid');
    //   }

    // //   let firstName = document.querySelector('#firstname').value.trim();
    // //   let lastName = document.querySelector('#lastname').value.trim();
    // //   let email = document.querySelector('#email').value.trim();
    // //   let password = document.querySelector('#password').value.trim();
    // //   let confirmPassword = document.querySelector('#confirm-password').value.trim();

    // //   $.ajax({
    // //       url: 'ajax-backend/create-new-user.php',
    // //       type: 'POST',
    // //       dataType: 'json',
    // //       data: {firstname: firstName, lastname: lastName, email: email, password: password, confirmpassword: confirmPassword},
    // //       success: (response) => {
    // //         alert("response");
    // //           console.log(response);
  
    // //       },
    // //       error: (e) => {
    // //           alert(e.response);
    // //           console.log(e);
    // //       }
    // //   })

      
    //   return false;
    // }


  </script>
</body>
</html>