<?php
session_start();


if(!isset($_SESSION['username'])){
    echo "<p class='tip'>Please login first.</p>";
    return;
}
    
$username = $_SESSION['username'];

//open JSON file
$pollsfile = file_get_contents("../data/polls.json");
$polls = json_decode($pollsfile, true);

if($polls == null){
    echo "<p class='tip'>You have not created any polls yet.</p>";
    return;
}

$myPolls = array();
foreach ($polls as $poll){
    if($poll['createrUserName'] == $username){
        array_push($myPolls, $poll);
    }
}

if(count($myPolls) == 0){
    echo "<p class='tip'>You have not created any polls yet.</p>";
    return;
}

//ici on va afficher les scrutins créés par l'utilisateur
foreach($myPolls as $poll){
        echo "<a  class='CreatedPoll' href='createpoll.php?pollid=".$poll['uuid']."'>"; 
        echo "<h2>".$poll['polltitle']."</h2>";
        if($poll['state'] == 1){
            echo "<h4 style='background-color:#60ff94'>In progress</h4>";
        }else{
            echo "<h4 style='background-color:#ffb868!important'>Finished</h4>";
        }
        echo "<h3>start since:<br>".$poll['createdtime']."</h3>";
        echo "</a>";
}
