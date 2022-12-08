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
$sql_slider = "SELECT *
                FROM workouts 
                WHERE user_id = $user_id 
                ORDER BY id DESC LIMIT 5;";

$results_slider = $mysqli->query($sql_slider);
if (!$results_slider) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style/main.css">
  
  <style>
    /* ul{list-style: none;} */
    .card{
        min-width: 450px;
        overflow: scroll;
    }

    .exercise-card{
        overflow: visible;
    }
    #cards{overflow-x: scroll;}

    .card li{font-weight: bold;}

    .exercise{
        text-align: left;
        font-weight: bold;
    }
    table{font-weight: initial;}

  </style>
</head>
<body>
    <nav>
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark nav-bar">
            <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
                <span class="fs-4">Gym Soul</span>
            </a>
            <a href="profile.php" class="d-flex align-items-center text-white text-decoration-none mt-3 mb-md-0 me-md-auto" id="user">
                <img src="img/ttrojan.jpeg" alt="profile picture" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $_SESSION['name']; ?></strong>
                <!-- Might add profile page? Maybe in future versions where "Friend" features are implemented -->
                </a>
            <hr>
            <div class="selections d-flex flex-column ">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
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
                        <a href="profile.php" class="nav-link text-white">
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
            <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
            <hr>
            <div class="d-flex justify-content-around">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newWorkout" onclick="refresh()">Log a new Workout</button>
                <!-- <button type="button" class="btn btn-primary">Search a Workout</button> Might not add search function since repetitive with Workouts tab. -->
            </div>
            <h2 class="my-3">Latest Workouts</h2>
            <!-- Cards to display latest workouts -->
            <div id="cards" class="d-flex flex-row">
                <?php while($row = $results_slider->fetch_assoc()) :?>
                <div class="card p-3 mx-3 d-flex flex-column text-black">
                    <h3><?php echo $row['name'];?></h3>
                    <p><?php echo $row['date'];?></p>
                    <p><?php echo $row['length'];?></p>
                    <?php  
                    // then wants to use each workout id to get the exercises
                    $workout_id = $row['id'];
                    $sql_exercises = "SELECT workout_id, workouts_exercises_join.exercise_id, muscle_groups.muscle as muscle, exercises.exercise_name as exercise_name, exercises.reps as reps, exercises.weight as weight
                                        FROM workouts_exercises_join 
                                        /* LEFT JOIN workouts */
                                        /* ON workouts.id = workouts_exercises_join.workout_id */
                                        LEFT JOIN exercises
                                        ON exercises.exercise_id = workouts_exercises_join.exercise_id
                                        LEFT JOIN muscle_groups
                                        ON muscle_groups.muscle_id = exercises.muscle_group_id
                                        WHERE workouts_exercises_join.workout_id = $workout_id;
                                        ";
                    $results_exercises = $mysqli->query($sql_exercises);
                    if (!$results_exercises) {
                        echo $mysqli->error;
                        $mysqli->close();
                        exit();
                    }            
 
                    ?>
                    <div class="exercises">
                        <ol>
                            <?php while($row_exercises = $results_exercises->fetch_assoc()):?>
                            <li>
                                <p class="exercise"><?php echo $row_exercises['exercise_name'];?></p>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Set #</th>
                                        <?php 
                                        $reps_arr = explode(",", $row_exercises['reps']);
                                        $weight_arr = explode(",", $row_exercises['weight']);

                                        for($i = 1; $i<=count($reps_arr); $i++) : ?>
                                        <th scope="col"><?php echo $i ;?></th>
                                        <?php endfor; ?>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">Reps</th>
                                        <?php foreach($reps_arr as $rep) : ?>
                                        <td><?php echo $rep ;?></td>
                                        <?php endforeach; ?>
                                      </tr>
                                      <tr>
                                        <th scope="row">Weight</th>
                                        <?php foreach($weight_arr as $weight): ?>
                                        <td><?php echo $weight;?></td>
                                        <?php endforeach; ?>
                                      </tr>
                                    </tbody>
                                  </table>
                            </li>
                            <?php endwhile; ?>
                        </ol>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
        </div>
    </main>

    <?php include "new-workout-modal.php"; ?>
  <script src="scripts/refresh-exercises.js"></script> 
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->

</body>
</html>
