// show the log new workout modal when clicking the log new workout button

document.querySelector("#newWorkoutButton").onclick = () => {
    console.log("heelo")
    console.log(document.getElementById('newWorkout'))
    let workoutModal = new bootstrap.Modal(document.getElementById('newWorkout'), {
        keyboard: false
    })

    workoutModal.show();
}



// show the log new workout modal when clicking the card with a +
document.querySelector('#newWorkoutCard').onclick = () => {
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