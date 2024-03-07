function ShowRegisterForm() {
    document.getElementById('registerForm').style.display = 'flex';
    document.getElementById('loginForm').style.display = 'none';
}

function ShowLoginForm() {
    document.getElementById('loginForm').style.display = 'flex';
    document.getElementById('registerForm').style.display = 'none';
}

function TryLogin() {
    var username = document.getElementById('loginUserName').value;
    var password = document.getElementById('loginPassword').value;

    console.log(username);
    console.log(password);

    // ajax sample
    $.ajax({
        type: "POST",
        url: "login.php",
        data: { username: username, password: password },
        success: function(data) {
            console.log(data);
        }
    });

}

function TryRegister() {
    var username = document.getElementById('regUserName').value;
    var email = document.getElementById('regEmail').value;
    var password = document.getElementById('regPassword').value;
    var confirmPassword = document.getElementById('regPassword2').value;

    console.log(username);
    console.log(email);
    console.log(password);
    console.log(confirmPassword);

    // ajax sample
    $.ajax({
        type: "POST",
        url: "register.php",
        data: { username: username, email: email, password: password, confirmPassword: confirmPassword },
        success: function(data) {
            console.log(data);
            document.getElementById('registerError').style.display = 'block';
            document.getElementById('registerError').innerHTML = data;
        }
    });
}