<?php

// require "config/config.php";
// $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if ( $mysqli->connect_errno ) {
//     echo $mysqli->connect_error;
//     exit();
// }

// $user_id = 1; // will use sessions here
// // var_dump(intval($_POST['workout_id']));
// $workout_id = 2;

// /*""string(1) "2"
// <br />
// <b>Notice</b>:  Undefined variable: workout_id in <b>/Users/victormuljo/Documents/itp304/gymsoul/logged-workout-modal.php</b> on line <b>20</b><br />
// You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1"*/
// // var_dump($workout_id);

// $sql_cards = "SELECT * FROM workouts WHERE user_id = $user_id AND id = $workout_id;";

// $results_cards = $mysqli->query($sql_cards);
// if (!$results_cards) {
//     echo $mysqli->error;
//     $mysqli->close();
//     exit();
// }

// $row_cards = $results_cards->fetch_assoc();
?>

<div class="modal fade" id="loggedWorkout" tabindex="-1" aria-labelledby="loggedWorkoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loggedWorkoutLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Date: </strong><span id="loggedDate"></span> </p>
                <p><strong>Length of Workout: </strong><span id="loggedLength"></span></p>
                <div class="exercises">
                    <ol id="exercise_list">
                        <?php  
                        while($row_exercises = $results_exercises->fetch_assoc()):
                        ?>
                        <li>
                            <p class="exercise"><?php echo $row_exercises['exercise_name']; ?></p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Set #</th>
                                        <?php 
                                        $reps_arr = explode(",", $row_exercises['reps']);
                                        $weight_arr = explode(",", $row_exercises['weight']);

                                        for($i = 1; $i<=count($reps_arr); $i++) : ?>
                                        <th scope="col"><?php echo $i; ?></th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Reps</th>
                                        <?php foreach($reps_arr as $rep) : ?>
                                        <td><?php echo $rep; ?></td>
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
                        <?php endwhile;?>
                    </ol>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Log it!</button>
            </div>
        </div>
    </div>
</div>