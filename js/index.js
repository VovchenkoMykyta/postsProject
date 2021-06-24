function check() {

    let login = document.getElementById("login").value;
    let pwd = document.getElementById("pass").value;

    let pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/;
    let letters = /^[A-Za-z]+$/;

    if (login === '') {
        msg('invalid', 'msg-login', 'red');
        if(pwd === ''){
            msg( 'invalid', 'msg-pass', 'red');
        }
    } else if (!letters.test(login)) {
        msg( 'invalid', 'msg-pass', 'red');
    } else if (!pwd_expression.test(pwd)) {
        msg( 'invalid', 'msg-pass', 'red');
    } else if (document.getElementById("pass").value.length < 6) {
        msg( 'small password', 'msg-pass', 'red');
    } else {
        msg('valid', 'msg-login', 'green');
        msg('valid', 'msg-pass', 'green');
    }
}

function msg(message, location, color) {

    document.getElementById(location).innerHTML = message;
    document.getElementById(location).style.color = color;

}