<?php 
require "config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$user_id = intval($_SESSION['user_id']);

$mysqli->set_charset('utf8');

// sql statement to get from workouts based on the user id and get the latest 5 workouts
$sql = "SELECT *
                FROM user_info 
                WHERE user_id = $user_id";

$results = $mysqli->query($sql);
if (!$results) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$row = $results->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style/main.css">
  
  <style>
    #select, .card{background-color: #3b4352;}
    .card, .setting{min-width: 500px;}
    .card img{margin: 0 auto;}
    h4{margin: 0; padding: 0;}
    ul{list-style: none;}
    /* .container{background-color: aqua;} */
  </style>
</head>
<body>
    <nav>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark nav-bar">
            <a href="home.html" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
                <span class="fs-4">Gym Soul</span>
            </a>
            <a href="profile.php" class="d-flex align-items-center text-white text-decoration-none mt-3 mb-md-0 me-md-auto" id="user">
                <img src="img/ttrojan.jpeg" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $_SESSION['name']; ?></strong>
                </a>
            <hr>
            <div class="selections d-flex flex-column ">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link text-white">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg> -->
                        Home
                        </a>
                    </li>
                    <li>
                        <a href="workouts.php" class="nav-link text-white">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg> -->
                        Workouts
                        </a>
                    </li>
                </ul>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="profile.php" class="nav-link active">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg> -->
                        Profile
                        </a>
                    </li>
                    <li>
                        <a href="signout.php" class="nav-link text-white">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg> -->
                        Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white nav-body">
            <h1>Profile</h1>
            <hr>
            
            <div class="container d-flex flex-wrap justify-content-around">
                <div class="card text-black p-3 my-4 border border-light text-white ">
                    <h4>User Info</h4>
                    <hr>
                    <img src="img/ttrojan.jpeg" alt="profile picture" width="100" height="100" class="rounded-3">
                    <p>Name: <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                    <p>Email: <?php echo $row['email']; ?></p>
                </div>
                <!-- <div >
                    <ul>
                        // on click, open a modal that allows user to change email or password
                        <li class="p-3 my-4"><button class="setting btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#changeEmail">Change Email</button></li>
                        <li class="p-3 my-4"><button class="setting btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</button></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </main>

    <!-- To be implemented in future versions -->
    <!-- <div class="modal fade" id="changeEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Change Email</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="currEmail" placeholder="name@example.com">
                    <label for="currEmail">Current Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="newEmail" placeholder="name@example.com">
                    <label for="newEmail">New Email address</label>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Change Email</button>
            </div>
          </div>
        </div>
      </div>
    
    
      <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="test" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="test">Change Password</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="currPass" placeholder="password">
                    <label for="currPass">Current Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="newPass" placeholder="passwordm">
                    <label for="newPass">New Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmNewPass" placeholder="password">
                    <label for="confirmNewPass">Confirm New Password</label>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Change Password</button>
            </div>
          </div>
        </div> -->
</div>
  <!-- <script src="scripts.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>