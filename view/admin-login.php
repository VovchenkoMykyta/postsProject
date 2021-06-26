<form action="/login" method="POST" onsubmit="validateForm()">
    <label>Login:
        <input type="text" name="login" id="login" onkeyup="validateLogin()"><span id="msg-login"></span>
    </label>
    <label>Password:
        <input type="password" name="password" id="pass" onkeyup="validatePass()"><span id="msg-pass"></span>
    </label>
    <input type="submit" value="Login" id="sub">
</form>
