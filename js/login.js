//on page load
document.addEventListener('DOMContentLoaded', function() {
    //read keyboard input
    document.getElementById('loginForm').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            TryLogin();
        }
    });

    document.getElementById('registerForm').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            TryRegister();
        }
    });
});


function ShowRegisterForm() {
    ClearLoginForm();
    document.getElementById('registerForm').style.display = 'flex';
    document.getElementById('loginForm').style.display = 'none';
}

function ShowLoginForm() {
    ClearRegisterForm();
    document.getElementById('loginForm').style.display = 'flex';
    document.getElementById('registerForm').style.display = 'none';
}

function ClearLoginForm() {
    //set error message to hidden
    document.getElementById('loginError').style.display = 'none';
    document.getElementById('loginUserName').value = '';
    document.getElementById('loginPassword').value = '';
}

function ClearRegisterForm() {
    //set error message to hidden
    document.getElementById('registerError').style.display = 'none';
    document.getElementById('regUserName').value = '';
    document.getElementById('regEmail').value = '';
    document.getElementById('regPassword').value = '';
    document.getElementById('regPassword2').value = '';
}


//ajax function , on essaie de se connecter, on envoie les données au serveur
function TryLogin() {
    var username = document.getElementById('loginUserName').value;
    var password = document.getElementById('loginPassword').value;

    // console.log(username);
    // console.log(password);

    // ajax sample
    $.ajax({
        type: "POST",
        url: "../phps/login.php",
        data: { username: username, password: password },
        success: function(data) {
            console.log(data);
            if (data == 'success') {
                //pop up success message
                //window.alert('You have been logged in successfully');
                //get url info
                var url = window.location.href;
                //get last part of url
                //var lastPart = url.substr(url.lastIndexOf('/') + 1);
                var urlParams = new URLSearchParams(window.location.search);
                var redirecturl = urlParams.get('redirect');
                if (redirecturl == null) {
                    redirecturl = 'index.php';
                }
                //redirect to home page
                window.location.href = '../' + redirecturl;
                //add session
            } else {
                document.getElementById('loginError').style.display = 'block';
                document.getElementById('loginError').innerHTML = data;
            }
        }
    });

}

//ajax function , on essaie de s'inscrire, on envoie les données au serveur
function TryRegister() {
    var username = document.getElementById('regUserName').value;
    var email = document.getElementById('regEmail').value;
    var password = document.getElementById('regPassword').value;
    var confirmPassword = document.getElementById('regPassword2').value;

    // console.log(username);
    // console.log(email);
    // console.log(password);
    // console.log(confirmPassword);

    // ajax sample
    $.ajax({
        type: "POST",
        url: "../phps/register.php",
        data: { username: username, email: email, password: password, confirmPassword: confirmPassword },
        success: function(data) {
            console.log(data);
            if (data == 'success') {
                //pop up success message
                window.alert('You have been registered successfully');
                //redirect to login page
                ShowLoginForm();
                ClearRegisterForm();

            } else {
                document.getElementById('registerError').style.display = 'block';
                document.getElementById('registerError').innerHTML = data;
            }

        }
    });
}