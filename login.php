<?php

session_start();

//read date from post
$username = $_POST['username'];
$password = $_POST['password'];

// echo "Username: " . $username . "<br>";
// echo "Password: " . $password . "<br>";


//create or read jsonfile
$jsonFile = 'users.json';
$jsonString = file_get_contents($jsonFile);
$data = json_decode($jsonString, true);

//check if user already exists
foreach ($data as $user) {
    if ($user['username'] == $username && $user['password'] == $password) {
        echo "success";
        //add session
        $_SESSION['username'] = $username;
        exit();
    }
}
echo "Username or password is incorrect!";