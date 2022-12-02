document.querySelector('form').onsubmit = () => {
    if ( document.querySelector('#firstname').value.trim().length == 0 ) {
        document.querySelector('#firstname').classList.add('is-invalid');
    } else {
        document.querySelector('#firstname').classList.remove('is-invalid');
    }
    if ( document.querySelector('#lastname').value.trim().length == 0 ) {
        document.querySelector('#lastname').classList.add('is-invalid');
    } else {
        document.querySelector('#lastname').classList.remove('is-invalid');
    }

    if ( document.querySelector('#email').value.trim().length == 0 ) {
        document.querySelector('#email').classList.add('is-invalid');
    } else {
        document.querySelector('#email').classList.remove('is-invalid');
    }

    if ( document.querySelector('#password').value.trim().length == 0 ) {
        document.querySelector('#password').classList.add('is-invalid');
    } else {
        document.querySelector('#password').classList.remove('is-invalid');
    }

    if ( document.querySelector('#confirm-password').value.trim().length == 0 ) {
        document.querySelector('#confirm-password').classList.add('is-invalid');
    } else {
        document.querySelector('#confirm-password').classList.remove('is-invalid');
    }

    if ( !document.querySelector('#termsandconditions').checked ) {
        document.querySelector('#termsandconditions').classList.add('is-invalid');
    } else {
        document.querySelector('#termsandconditions').classList.remove('is-invalid');
    }

    return ( !document.querySelectorAll('.is-invalid').length > 0 );
}