<?php

function getemailbyusername($username){
    $usersfile = file_get_contents("../data/users.json");
    $users = json_decode($usersfile, true);
    foreach($users as $user){
        if($user['username'] == $username){
            return $user['email'];
        }
    }
    return null;
}