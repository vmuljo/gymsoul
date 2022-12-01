<?php 
require "config/config.php";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$user_id = 1;

$sql_cards = "SELECT *
                FROM workouts 
                WHERE user_id = $user_id 
                ORDER BY id DESC;";

$results_cards = $mysqli->query($sql_cards);
if (!$results_cards) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

?>

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
                    <input type="text" class="form-control" placeholder="Find Workout" aria-label="search" aria-describedby="search-button" id="search-field">
                    <button class="btn btn-outline-light" type="button" id="search-button">Search Workout</button>
                </div>

                <div>
                    <select id="select" class="form-select text-white" aria-label="Default select example">
                        <option selected>Latest</option>
                        <option value="1">Earliest</option>
                        <!-- <option value="2">Date</option> -->
                    </select>
                </div>
            </div>

            <div class="container d-flex justify-content-around align-content-end flex-wrap" id="cards-list">
                <div class="card text-black p-3 my-4 border border-primary" id="newWorkoutCard" onclick="addCardClicked()">
                    <h2 class="text-primary">+</h2>
                </div>
                <?php while ($row_cards = $results_cards->fetch_assoc()) : $workout_id = $row_cards['id'];?>
                <div class="card text-black p-3 my-4 border border-light text-white loggedWorkoutCard" onclick="cardClicked(this)" data-workout-id="<?php echo $workout_id; ?>">
                    <h4><?php echo $row_cards['name']; ?></h4>
                    <hr>
                    <p><?php echo $row_cards['date']; ?></p>
                    <p><?php echo $row_cards['length']; ?></p>
                    <?php  
                    // $workout_id = $row_cards['id'];
                    $sql_exercises = "SELECT workouts_exercises_join.workout_id, COUNT(*) as total_exercises
                                        FROM workouts_exercises_join 
                                        WHERE workouts_exercises_join.workout_id = $workout_id 
                                        GROUP BY workouts_exercises_join.workout_id;
                                        ";
                    $results_exercises = $mysqli->query($sql_exercises);
                    if (!$results_exercises) {
                        echo $mysqli->error;
                        $mysqli->close();
                        exit();
                    }            
                    ?>
                    <p>Total Exercises: <?php echo $results_exercises->fetch_assoc()['total_exercises']; ?></p>
                </div>
                <?php endwhile;?>
            </div>
        </div>
    </main>

    <?php include "logged-workout-modal.php";?>
    <?php include "new-workout-modal.php";?>

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

        function addCardClicked(){
            refresh();
            console.log(document.getElementById('newWorkout'))
            let workoutModal = new bootstrap.Modal(document.getElementById('newWorkout'), {
                keyboard: false
            })

            workoutModal.show();
        }

        function cardClicked(card){
            console.log(card);
            $.ajax({
                url: 'ajax-backend/get_workout.php',
                type: 'POST',
                dataType: 'json',
                data: {workout_id: card.dataset.workoutId},
                success: (response) => {
                    console.log(response);
                    // alert("Successfully added");
                    $('#loggedWorkoutLabel').html(response.name);
                    $('#loggedDate').html(response.date);
                    $('#loggedLength').html(response.length);
                },
                error: (e) => {
                    alert('AJAX error');
                    console.log(e);
                }
            })
            $.ajax({
                url: 'ajax-backend/get_exercises.php',
                type: 'POST',
                dataType: 'json',
                data: {workout_id: card.dataset.workoutId},
                success: (response) => {
                    console.log(response);
                    // alert("Successfully added");
                    document.querySelector('#exercise_list').innerHTML = '';
                    response.forEach((exercise) => {
                        fillTableSection(exercise);
                    })
                    
                },
                error: (e) => {
                    alert('AJAX error');
                    console.log(e);
                }
            })

            let loggedWorkout = new bootstrap.Modal(document.getElementById('loggedWorkout'), {
                keyboard: false
            })
        
            loggedWorkout.show();
        }

        function fillTableSection(exercise){
            let li = document.createElement('li');
            let exercise_name = document.createElement('p');
            exercise_name.classList.add('exercise');
            let table = document.createElement('table');
            table.classList.add('table');

            // thead section
            let thead = document.createElement('thead');
            let tr_head = document.createElement('tr');
            let th_set = document.createElement('th');
            th_set.scope = 'col';
            th_set.textContent = 'Set #';
            tr_head.appendChild(th_set);

            let reps_arr = exercise.reps.split(',');
            let weight_arr = exercise.weight.split(',');

            for(let i = 1; i<=reps_arr.length; i++){
                let th_setnum = document.createElement('th');
                th_setnum.scope = 'col';
                th_setnum.textContent = i;
                tr_head.appendChild(th_setnum);
            }
            thead.appendChild(tr_head);

            // tbody section
            let tbody = document.createElement('tbody');
            let tr_reps = document.createElement('tr');
            let th_reps = document.createElement('th');
            th_reps.scope = 'row';
            th_reps.textContent = "Reps"
            tr_reps.appendChild(th_reps);
            reps_arr.forEach((rep) => {
                let td_rep = document.createElement('td');
                td_rep.textContent = rep;
                tr_reps.appendChild(td_rep);
            });
            let tr_weight = document.createElement('tr');
            let th_weight = document.createElement('th');
            th_weight.scope = 'row';
            th_weight.textContent = "Weight";
            tr_weight.appendChild(th_weight);
            weight_arr.forEach((weight) => {
                let td_weight = document.createElement('td');
                td_weight.textContent = weight;
                tr_weight.appendChild(td_weight);
            });
            tbody.appendChild(tr_reps);
            tbody.appendChild(tr_weight);

            table.appendChild(thead);
            table.appendChild(tbody);

            li.appendChild(exercise_name);
            li.appendChild(table);

            document.querySelector('#exercise_list').appendChild(li);

        }

        document.querySelector('#search-button').onclick = () => {
            var term = document.querySelector('#search-field').value.trim();

            $.ajax({
                url: 'ajax-backend/search_backend.php',
                type: 'POST',
                dataType: 'json',
                data: {search_term: term},
                success: (response) => {
                    console.log(response);
                    // resets cards
                    document.querySelector('#cards-list').innerHTML = '';
                    let add = document.createElement('div');
                    add.classList.add('card','text-black','p-3','my-4','border','border-primary');
                    add.id = 'newWorkoutCard';
                    add.setAttribute('onclick', 'addCardClicked()');
                    let h2 = document.createElement('h2');
                    h2.classList.add('text-primary');
                    h2.textContent = '+';
                    add.appendChild(h2);
                    document.querySelector('#cards-list').appendChild(add);
                    response.forEach((exercise) => {
                        addCard(exercise);
                    })
                    
                },
                error: (e) => {
                    alert('AJAX error');
                    console.log(e);
                }
            })
        }

        function addCard(exercise){
            let cardDiv = document.createElement('div');
            cardDiv.classList.add('card','text-black','p-3','my-4','border','border-light','text-white','loggedWorkoutCard');
            cardDiv.dataset.workoutId = exercise.id;
            cardDiv.setAttribute('onclick', 'cardClicked(this)');
            
            let h4 = document.createElement('h4');
            let hr = document.createElement('hr');
            let p_date = document.createElement('p');
            let p_length = document.createElement('p');
            let p_total = document.createElement('p');

            h4.textContent = exercise.name;
            p_date.textContent = exercise.date;
            p_length.textContent = exercise.length;
            p_total.textContent = "Total Exercises: " + exercise.total_exercises;

            cardDiv.appendChild(h4);
            cardDiv.appendChild(hr);
            cardDiv.appendChild(p_date);
            cardDiv.appendChild(p_length);
            cardDiv.appendChild(p_total);

            document.querySelector('#cards-list').appendChild(cardDiv);
        }
    </script>

</body>
</html>