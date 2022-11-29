<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Workouts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style/main.css">
  
  <style>
    #search{width: 50vw;}
    #select, .container .card{background-color: #3b4352;}
    .container .card{min-width: 300px; cursor: pointer; color: white;}
    .container .card *{color: white;}
    .container .card:hover{
        background-color: white;
    }

    .container .card:hover *{color: #3b4352;}
    h4{margin: 0; padding: 0;}
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
            <a href="#" class="d-flex align-items-center text-white text-decoration-none mt-3 mb-md-0 me-md-auto" id="user">
                <img src="img/ttrojan.jpeg" alt="profile picture" width="32" height="32" class="rounded-circle me-2">
                <strong>Tommy Trojan</strong>
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
                        <a href="workouts.php" class="nav-link active ">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg> -->
                        Workouts
                        </a>
                    </li>
                </ul>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="settings.html" class="nav-link text-white">
                        <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg> -->
                        Settings
                        </a>
                    </li>
                    <li>
                        <a href="login.php" class="nav-link text-white">
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
            <h1>Workouts</h1>
            <hr>
            
            <div class="d-flex justify-content-around my-3">
                <div>
                    <button type="button" class="btn btn-primary" id="newWorkoutButton">Log a new Workout</button>
                </div>
    
                <div id="search" class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Find Workout" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-light" type="button" id="button-addon2">Search Workout</button>
                </div>

                <div>
                    <select id="select" class="form-select text-white" aria-label="Default select example">
                        <option selected>Latest</option>
                        <option value="1">Earliest</option>
                        <!-- <option value="2">Date</option> -->
                    </select>
                </div>
            </div>

            <div class="container d-flex justify-content-around align-content-end flex-wrap">
                <div class="card text-black p-3 my-4 border border-primary" id="newWorkoutCard">
                    <h2 class="text-primary">+</h2>
                </div>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard">
                    <h4>Leg Day</h4>
                    <hr>
                    <p>11/13/2022</p>
                    <p>00:57:40</p>
                    <p>Total Exercises: 4</p>
                </div>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard">
                    <h4>Back and Bicep Day</h4>
                    <hr>
                    <p>11/12/2022</p>
                    <p>01:23:45</p>
                    <p>Total Exercises: 6</p>
                </div>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard">
                    <h4>Chest and Tricep Day</h4>
                    <hr>
                    <p>11/11/2022</p>
                    <p>01:34:45</p>
                    <p>Total Exercises: 6</p>
                </div>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard">
                    <h4>Shoulders and Arms Day</h4>
                    <hr>
                    <p>11/09/2022</p>
                    <p>01:43:12</p>
                    <p>Total Exercises: 7</p>
                </div>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard">
                    <h4>Chest and Back Day</h4>
                    <hr>
                    <p>11/07/2022</p>
                    <p>01:37:20</p>
                    <p>Total Exercises: 7</p>
                </div>
            </div>
        </div>
    </main>
    
    <?php include "new-workout-modal.php";?>
    <?php include "logged-workout-modal.php";?>

    <script src="refresh-exercises.js"></script>
    <script>
        document.querySelector("#newWorkoutButton").onclick = () => {
            refresh();
            console.log(document.getElementById('newWorkout'))
            let workoutModal = new bootstrap.Modal(document.getElementById('newWorkout'), {
                keyboard: false
            })

            workoutModal.show();
        }

        // show the log new workout modal when clicking the card with a +
        document.querySelector('#newWorkoutCard').onclick = () => {
            refresh();
            console.log(document.getElementById('newWorkout'))
            let workoutModal = new bootstrap.Modal(document.getElementById('newWorkout'), {
                keyboard: false
            })

            workoutModal.show();
        }

        // show the logged workout modal when clicking on a card in workouts tab
        // currently only has placeholder text from "Leg Day" for all the cards, as new modals are needed for each card and is a waste of memory. Will implement with PHP
        document.querySelectorAll('.loggedWorkoutCard').forEach((logged) => {
            logged.onclick = () => {
                console.log(logged)
                let loggedWorkout = new bootstrap.Modal(document.getElementById('loggedWorkout'), {
                    keyboard: false
                })
            
                loggedWorkout.show();
            }
        
        })
    </script>

</body>
</html>