<?php

include 'objects.php';

session_start();

if(!isset($_SESSION['username'])){
    echo "<script>location.href='../index.php'</script>";
}
 
//open or create json file
$jsonFile = '../polls.json';
$jsonString = file_get_contents($jsonFile);
$pollarray = json_decode($jsonString, true);

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
    return new Voter($voteremail, $votetime);
}, $voteremails, $votetimes);

//create poll object
$poll = new Poll($polltitle, $organizer, $polldesc, $waysOfVote, $question, $candidates, $voters);

//add poll to data
$pollarray[] = $poll;

//write to json file
file_put_contents($jsonFile, json_encode($pollarray) );

echo "<script>location.href='../myPolls.php'</script>";
