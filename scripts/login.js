document.querySelector('form').onsubmit = () => {
    document.querySelector('#email')

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

    return ( !document.querySelectorAll('.is-invalid').length > 0 );
}