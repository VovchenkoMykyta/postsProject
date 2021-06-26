function validateLogin() {

    let login = document.getElementById('login').value;

    if(login.length === 0) {

        producePrompt('invalid', 'msg-login' , 'red');
        return false;

    }

    if (!login.match(/^[A-Za-z]+$/)) {

        producePrompt('invalid','msg-login', 'red');
        return false;

    }

    producePrompt('Valid', 'msg-login', 'green');
    return true;

}

function validatePass() {

    let pass = document.getElementById('pass').value;

    if(pass.length === 0) {
        producePrompt('invalid', 'msg-pass', 'red');
        return false;
    }

    if(pass.length < 6) {
        producePrompt('invalid', 'msg-pass', 'red');
        return false;
    }

    if(!pass.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/)) {
        producePrompt('invalid' ,'msg-pass', 'red');
        return false;
    }

    producePrompt('Valid', 'msg-pass', 'green');
    return true;

}

function validateForm() {
    if (!validateLogin() || !validatePass()) {
        jsShow('msg-login');
        jsShow('msg-pass');
        producePrompt('invalid', 'msg-login', 'red');
        producePrompt('invalid', 'msg-pass', 'red');
        setTimeout(function(){jsHide('msg-login');}, 3000);
        setTimeout(function(){jsHide('msg-pass');}, 3000);
        return false;
    }
    else {

    }
}

function jsShow(id) {
    document.getElementById(id).style.display = 'inline-block';
}

function jsHide(id) {
    document.getElementById(id).style.display = 'none';
}


function producePrompt(message, promptLocation, color) {

    document.getElementById(promptLocation).innerHTML = message;
    document.getElementById(promptLocation).style.color = color;

}
