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
            <a href="#" class="d-flex align-items-center text-white text-decoration-none mt-3 mb-md-0 me-md-auto" id="user">
                <img src="img/ttrojan.jpeg" alt="profile picture" width="32" height="32" class="rounded-circle me-2">
                <strong>Tommy Trojan</strong>
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
            <h1>Welcome, Tommy Trojan</h1>
            <hr>
            <div class="d-flex justify-content-around">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newWorkout">Log a new Workout</button>
                <!-- <button type="button" class="btn btn-primary">Search a Workout</button> Might not add search function since repetitive with Workouts tab. -->
            </div>
            <h2 class="my-3">Latest Workouts</h2>
            <!-- Cards to display latest workouts -->
            <div id="cards" class="d-flex flex-row">
                <div class="card p-3 mx-3 d-flex flex-column text-black">
                    <h3>Leg Day</h3>
                    <p>11/13/2022</p>
                    <p>00:57:40</p>
                    <div class="exercises">
                        <ol>
                            <li>
                                <p class="exercise">Barbell Squat</p>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        <th scope="col">5</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>6</td>
                                        <td>5</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Weight</th>
                                        <td>135</td>
                                        <td>180</td>
                                        <td>205</td>
                                        <td>225</td>
                                        <td>230</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </li>
                            <li>
                                <p class="exercise">Leg Curl</p>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>8</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Weight</th>
                                        <td>100</td>
                                        <td>115</td>
                                        <td>115</td>
                                        <td>120</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </li>
                            <li>
                                <p class="exercise">Leg Extension</p>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>8</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Weight</th>
                                        <td>100</td>
                                        <td>105</td>
                                        <td>110</td>
                                        <td>110</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </li>
                            <li>
                                <p class="exercise">Dumbbell Romanian Deadlifts</p>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Weight</th>
                                        <td>45</td>
                                        <td>50</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Notes</th>
                                        <td>Lower back pain, cut sets short to 2 sets</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                  </table>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="card p-3 mx-3 d-flex flex-column text-black">
                    <h3>Back and Bicep Day</h3>
                    <p>11/12/2022</p>
                    <p>01:23:45</p>
                    <div class="exercises">
                        <ol>
                            <li>
                                <p class="exercise">Lat Pulldown</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                            <th scope="col">4</th>
                                            <th scope="col">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                            <td>8</td>
                                            <td>8</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>100</td>
                                            <td>120</td>
                                            <td>125</td>
                                            <td>130</td>
                                            <td>140</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Seated Rows</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                            <th scope="col">4</th>
                                            <th scope="col">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                            <td>8</td>
                                            <td>8</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>120</td>
                                            <td>125</td>
                                            <td>130</td>
                                            <td>140</td>
                                            <td>145</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Bicep Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                            <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                            <td>8</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>22.5</td>
                                            <td>27.5</td>
                                            <td>27.5</td>
                                            <td>30</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Hammer Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>30</td>
                                            <td>35</td>
                                            <td>40</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Seated Unilateral Lat Pull</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>52.5</td>
                                            <td>55</td>
                                            <td>60</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Incline Bicep Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Set #</th>
                                            <th scope="col">1</th>
                                            <th scope="col">2</th>
                                            <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Reps</th>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Weight</th>
                                            <td>22.5</td>
                                            <td>25</td>
                                            <td>30</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="card p-3 mx-3 d-flex flex-column text-black">
                    <h3>Chest and Tricep Day</h3>
                    <p>11/11/2022</p>
                    <p>01:34:45</p>
                    <div class="exercises">
                        <ol>
                            <li>
                                <p class="exercise">Barbell Bench Press</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        <th scope="col">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>9</td>
                                        <td>8</td>
                                        <td>6</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>135</td>
                                        <td>155</td>
                                        <td>175</td>
                                        <td>180</td>
                                        <td>180</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Incline Bench Press</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>9</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>50</td>
                                        <td>55</td>
                                        <td>60</td>
                                        <td>70</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Crossbody Tricep Extension</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>23</td>
                                        <td>23</td>
                                        <td>27</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Chest Flys</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>100</td>
                                        <td>105</td>
                                        <td>115</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Unilateral Tricep Extension</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>22.5</td>
                                        <td>25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Chest Dips</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>10</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>Body Weight</td>
                                        <td>Body Weight</td>
                                        <td>Body Weight</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="card p-3 mx-3 d-flex flex-column text-black">
                    <h3>Shoulders and Arms Day</h3>
                    <p>11/09/2022</p>
                    <p>01:43:12</p>
                    <div class="exercises">
                        <ol>
                            <li>
                                <p class="exercise">Shoulder Press</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        <th scope="col">5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>9</td>
                                        <td>8</td>
                                        <td>6</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>30</td>
                                        <td>50</td>
                                        <td>55</td>
                                        <td>55</td>
                                        <td>60</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Dumbbell Lateral Raises</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>12</td>
                                        <td>12</td>
                                        <td>12</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>20</td>
                                        <td>20</td>
                                        <td>20</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Crossbody Tricep Extension</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>23</td>
                                        <td>23</td>
                                        <td>27</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Cable Bicep Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        <th scope="col">4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>23</td>
                                        <td>23</td>
                                        <td>27</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Cable Incline Bicep Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>10</td>
                                        <td>10</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>23</td>
                                        <td>23</td>
                                        <td>27</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Unilateral Tricep Extensions</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>20</td>
                                        <td>22.5</td>
                                        <td>25</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                <p class="exercise">Hammer Curl</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Set #</th>
                                        <th scope="col">1</th>
                                        <th scope="col">2</th>
                                        <th scope="col">3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <th scope="row">Reps</th>
                                        <td>12</td>
                                        <td>10</td>
                                        <td>8</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td>35</td>
                                        <td>35</td>
                                        <td>40</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include "new-workout-modal.php"; ?>
  <!-- <script src="scripts.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->

</body>
</html>