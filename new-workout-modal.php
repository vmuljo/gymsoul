<?php 
// require "config/config.php";

// $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if ( $mysqli->connect_errno ) {
//     echo $mysqli->connect_error;
//     exit();
// }

// $mysqli->set_charset('utf8');

$sql_muscle = "SELECT muscle, muscle_id FROM muscle_groups;";
$results_muscle = $mysqli->query($sql_muscle);
if ( !$results_muscle ) {
    echo $mysqli->error;
    $mysqli->close();
    exit();
}

$mysqli->close();
?>

<div class="modal fade" id="newWorkout" tabindex="-1" aria-labelledby="newWorkoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newWorkoutLabel">Log a New Workout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="newSubmit">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="workout-name" placeholder="workout Name">
                        <label for="workout-name">Workout Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date" placeholder="date" onchange="console.log(this.value)">
                        <label for="date">Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="length" placeholder="workout length">
                        <label for="length">Workout Length</label>
                    </div>
                    <!-- <hr> -->
                    <div class="card p-3 my-3 exercise-card">
                        <h4 class="mb-2">Exercise</h4>
                        <div class="form-floating mb-3">
                            <div class="input-group mb-3">
                                <select class="form-select" id="muscle_group" onchange='load_exercises()'>
                                    <option value="0" selected>Muscle Group</option>
                                    <?php while($row = $results_muscle->fetch_assoc()) : ?>
                                        <option value="<?php echo $row['muscle_id']?>" class="dropdown-item"><?php echo $row['muscle']?></option>
                                    <?php endwhile; ?>
                                </select>
                                <select class="form-select" id="muscle_exercises">
                                    <option value="0" selected>Exercise Name</option>
                                    
                                </select>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="exercise-name" aria-label="exercise">
                                    <label for="exercise-name">Name of Exercise</label>
                                </div>
                                <!-- <label class="input-group-text" for="inputGroupSelect02">Options</label> -->
                            </div>
                            
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reps</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody id="addSets">
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control" id="reps"/></td>
                                    <td><input type="text" class="form-control" id="weight"/></td>
                                    <td><button type="button" class="btn btn-outline-primary" onclick="addSetClicked()">Add new set</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center"><button type="button" class="btn btn-outline-primary" onclick="addNewExerciseClicked()">Add New Exercise</button></div>
                        </div>
                    </div>
                    <div class="card p-3 my-3">
                        <h4 class="mb-3">Added Exercises</h4>
                        <div class="input-group">
                            <span class="input-group-text" >Notes:</span>
                            <input type="text" class="form-control" id="notes" placeholder="" aria-label="notes">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Muscle</th>
                                <th scope="col">Workout</th>
                                <th scope="col">Reps</th>
                                <th scope="col">Weight</th>
                            </tr>
                            </thead>
                            <tbody id="addedExercises">
                            </tbody>
                        </table>
                    </div>     
                    <div class="d-flex justify-content-end">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary">Save workout</button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="loggedWorkoutClicked()">Log it!</button>
            </div> -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    function load_exercises(){
        let selected_muscle_group=$("#muscle_group option:selected").val(); //get the value of the current selected option.

        $.ajax({
            url: 'ajax-backend/dropdown-select.php',
            type: 'POST',
            data: {option_value: selected_muscle_group},
            dataType: 'json', // parses 
            success: (response) => {
                console.log(response)
                document.querySelector('#muscle_exercises').innerHTML = '<option value="0" selected>Exercise Name</option>';
                // may return undefined if other is selected, so check if not undefined to loop through. Otherwise, just fill in with the response
                if(response.length !== undefined){
                    response.forEach(element => {
                        console.log(element);
                        fillSelect(element);
                    });
                    // document.querySelector('#exercise-name').disabled=true;
                } else{
                    fillSelect(response);
                    // document.querySelector('#exercise-name').disabled=false;
                }
            },
            error: (e) => {
                alert('AJAX error');
                console.log(e);
            }
        })
    }

    function fillSelect(exercise){
        let option = document.createElement('option');

        option.value = exercise.id;
        option.textContent = exercise.exercise;

        document.querySelector('#muscle_exercises').appendChild(option)

    }

    let count = 0;
    function addSetClicked(){
        count++;
        let muscle_group_id = $('#muscle_group option:selected').val();
        let reps = document.querySelector('#reps').value.trim();
        let weight = document.querySelector('#weight').value.trim();
        let exercise_name = $('#muscle_exercises option:selected').html();
        if(exercise_name == 'Other' || muscle_group_id == 7){
            exercise_name = document.querySelector('#exercise-name').value.trim();
        }

        let tr = document.createElement('tr');
        let td_reps = document.createElement('td');
        let td_weight = document.createElement('td');
        let td_count = document.createElement('td');
        let td_delete = document.createElement('td');
        let deleteBtn = document.createElement('button');

        tr.classList.add('setData');
        td_reps.textContent = reps;
        td_weight.textContent = weight;
        td_count.textContent = count;
        deleteBtn.classList.add('btn','btn-outline-danger');
        deleteBtn.type = 'button'
        deleteBtn.textContent = "Delete";
        deleteBtn.setAttribute('onclick', 'deleteSetClicked(this)');
        td_delete.appendChild(deleteBtn)

        tr.appendChild(td_count);
        tr.appendChild(td_reps);
        tr.appendChild(td_weight);
        tr.appendChild(deleteBtn);
        
        document.querySelector('#addSets').appendChild(tr);

        document.querySelector('#reps').value = "";
        document.querySelector('#weight').value = "";
    }

    function addNewExerciseClicked(){
        count = 0;
        let base = "<tr><td></td><td><input type='text' class='form-control' id='reps'/></td><td><input type='text' class='form-control' id='weight'/></td><td><button type='button' class='btn btn-outline-primary' onclick='addSetClicked()'>Add new set</button></td></tr>";
        let selected_muscle_group=$("#muscle_group option:selected").val();
        let selected_exercise = $("#muscle_exercises option:selected").html();
        if(selected_exercise == "Other"){
            selected_exercise = document.querySelector('#exercise-name').value.trim();
        }

        let addedSets = document.getElementsByClassName("setData");
        console.log(addedSets);

        let reps = [];
        let weight = [];

        for (let set of addedSets){
            reps.push(set.querySelectorAll('td')[1].textContent);
            weight.push(set.querySelectorAll('td')[2].textContent);
        }

        reps = reps.toString();
        weight = weight.toString();

        $.ajax({
            url: 'ajax-backend/add-new-exercise.php',
            type: 'POST',
            data: {muscle_group_id: selected_muscle_group, reps: reps, weights: weight, exercise_name: selected_exercise},
            dataType: 'json', // parses 
            success: (response) => {
                console.log(response);
                // alert("Successfully added");

                let tr = document.createElement('tr');
                let td_delete = document.createElement('td');
                let deleteBtn = document.createElement('a');
                let td_muscle = document.createElement('td');
                let td_workout = document.createElement('td');
                let td_reps = document.createElement('td');
                let td_weight = document.createElement('td');

                // deleteBtn.classList.add('btn','btn-link');
                // deleteBtn.type = 'button'
                deleteBtn.innerHTML = "&#10006;";
                deleteBtn.style.cssText = 'cursor:pointer;'
                deleteBtn.setAttribute('onclick', 'deleteExerciseClicked(this)');
                td_delete.appendChild(deleteBtn);
                td_muscle.textContent = response.muscle;
                td_workout.textContent = response.exercise_name;
                td_reps.textContent = response.reps;
                td_weight.textContent = response.weight;
                tr.dataset.id = response.id;
                tr.appendChild(td_delete);
                tr.appendChild(td_muscle);
                tr.appendChild(td_workout);
                tr.appendChild(td_reps);
                tr.appendChild(td_weight);

                document.querySelector('#addedExercises').appendChild(tr);
            },
            error: (e) => {
                alert('AJAX error');
                console.log(e);
            }
        })
                
        document.querySelector('#addSets').innerHTML = base;
        document.querySelector('#muscle_group').value = "0";
        document.querySelector('#muscle_exercises').value = "0";
        document.querySelector('#exercise-name').value = "";

    }

    function deleteSetClicked(btn){
        console.log(btn.parentNode);
        btn.parentNode.remove();
    }

    function deleteExerciseClicked(btn){
        console.log("Exercise clicked");
        $.ajax({
            url: 'ajax-backend/delete-added-exercise.php',
            type: 'POST',
            data: {exercise_id: btn.parentNode.parentNode.dataset.id},
            success: (response) => {
                console.log(response);
                console.log(btn.parentNode.parentNode);
                // alert("Successfully added");
                btn.parentNode.parentNode.remove();
            },
            error: (e) => {
                alert('AJAX error');
                console.log(e);
            }
        })
        // ajax stuff to delete the button
        // btn.parentNode.remove();
    }

    document.querySelector('#newSubmit').onsubmit = () => {
    // function loggedWorkoutClicked(){
        let workoutName = document.querySelector('#workout-name').value.trim();
        let date = document.querySelector('#date').value;
        let length = document.querySelector('#length').value.trim();
        let notes = document.querySelector('#notes').value.trim();

        console.log(workoutName);
        console.log(date);

        $.ajax({
            url: 'ajax-backend/logged_workout.php',
            type: 'POST',
            data: {workout_name: workoutName, date: date, length: length, notes: notes},
            success: (response) => {
                console.log(response);
                $('#newWorkout').modal('hide');
                
            },
            error: (e) => {
                alert('AJAX error');
                console.log(e);
            }
        })

        // reload the page
        $(this).ajaxStop(function(){
            window.location.reload();
        });

        return false;
    }

</script>
