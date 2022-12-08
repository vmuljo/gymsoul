// script to clear the hold exercises table so it is not repeated
function refresh(){
    $.ajax({
        url: 'ajax-backend/refresh_exercises.php',
        success: (response) => {
            console.log(response);
        },
        error: (e) => {
            alert('AJAX error');
            console.log(e);
        }
    });
}
