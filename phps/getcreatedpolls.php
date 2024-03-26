<?php
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['username'])){
    echo "failed";
    return;
}
    
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

//reverse the array to show the latest poll first
$myPolls = array_reverse($myPolls);

foreach($myPolls as $poll){
        echo "<a href='poll.php?pollid=".$poll['uuid']."'>";
        echo "<div class='CreatedPoll'>";
        echo "<h2>".$poll['polltitle']."</h2>";
        echo "<h3>start since:<br>".$poll['createdtime']."</h3>";
        if($poll['state'] == 1){
            echo "<h4>In progress</h4>";
        }else{
            echo "<h4>Finished</h4>";
        }
        echo "</div>";
        echo "</a>";
}
