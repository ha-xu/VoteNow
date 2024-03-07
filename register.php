<?php
//read date from post
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];


if ($password != $confirmPassword) {
    echo "Passwords do not match!";
    exit();
}

//create or read jsonfile
$jsonFile = 'users.json';
$jsonString = file_get_contents($jsonFile);
$data = json_decode($jsonString, true);

//check if user already exists
foreach ($data as $user) {
    if ($user['username'] == $username) {
        echo "Username already exists!";
        exit();
    }
}

//add new user to array
$data[] = array('username' => $username, 'email' => $email, 'password' => $password);

//write jsonfile
$newJsonString = json_encode($data);
file_put_contents($jsonFile, $newJsonString);

?>