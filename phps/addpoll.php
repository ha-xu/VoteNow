<?php

date_default_timezone_set('Europe/Paris');

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>location.href='../index.php'</script>";
}
 
//open or create json file
$jsonFile = '../data/polls.json';
$jsonString = file_get_contents($jsonFile);
$pollarray = json_decode($jsonString, true);

//Poll properties
$uuid = uniqid();
$createdtime = date("Y-m-d H:i:s");
$state = 1;
$createrUserName = $_SESSION['username'];
//get values from post
$polltitle = $_POST['polltitle'];
$organizer = $_POST['organizer'];
$polldesc = $_POST['polldesc'];
$waysOfVote = $_POST['waysOfVote'];
$question = $_POST['pollQuestion'];
$candidates = $_POST['candidates'];
$voteremails = $_POST['voteremails'];
$votetimes = $_POST['votetimes'];

$voters = array_map(function ($voteremail, $votetime) {
    return array('voteremail' => $voteremail,'votetimes' => $votetime);
}, $voteremails, $votetimes);

//create poll object
$poll = array(
    'uuid' => $uuid,
    'createdtime' => $createdtime,
    'state' => $state,
    'createrUserName' => $createrUserName,
    'polltitle' => $polltitle,
    'organizer' => $organizer,
    'polldesc' => $polldesc,
    'waysOfVote' => $waysOfVote,
    'question' => $question,
    'candidates' => $candidates,
    'voters' => $voters
);

//add poll to data
$pollarray[] = $poll;

//write to json file
file_put_contents($jsonFile, json_encode($pollarray) );

echo "<script>location.href='../myPolls.php'</script>";
