<?php
require_once  'functions.php';
session_start();


if(!isset($_SESSION['username'])){
    echo "<p class='tip'>Please login first.</p>";
    return;
}

$username = $_SESSION['username'];
$useremail = getemailbyusername($username);

    
//open JSON file
$pollsfile = file_get_contents("../data/polls.json");
$polls = json_decode($pollsfile,true);

if($polls == null){
    echo "<p class='tip'>You have not been invited to any polls yet.</p>";
    return;
}

$myvotepolls = array();
foreach ($polls as $poll){
    foreach($poll["voters"] as $voter){
        if($voter["voteremail"] == $useremail){
            array_push($myvotepolls, $poll);
            break;
        }
    }
}

if(count($myvotepolls) == 0){
    echo "<p class='tip'>You have not been invited to any polls yet.</p>";
    return;
}

//reverse the array to show the latest poll first
$myvotepolls = array_reverse($myvotepolls);

foreach($myvotepolls as $poll){
    echo "<div class='CreatedPoll'>";
    echo "<h2>".$poll['polltitle']."</h2>";
    echo "<h3>start since:<br>".$poll['createdtime']."</h3>";
    if($poll['state'] == 1){
        echo "<h4>In progress</h4>";
    }else{
        echo "<h4>Finished</h4>";
    }
    echo "</div>";
}
