<?php
session_start();

require_once("encrypt.php");

// C'est une fonction qui permet renvoyer l'email d'un utilisateur en fonction de son nom d'utilisateur
function getemailbyusername($username)
{
    $usersfile = file_get_contents("../data/users.json");
    $users = json_decode($usersfile, true);
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            return $user['email'];
        }
    }
    return null;
}


if (!isset($_SESSION['username'])) {
    echo "<p class='tip'>Please login first.</p>";
    return;
}

$username = $_SESSION['username'];
$useremail = getemailbyusername($username);


//open JSON file
$pollsfile = file_get_contents("../data/polls.json");
$polls = json_decode($pollsfile, true);

if ($polls == null) {
    echo "<p class='tip'>You have not been invited to any polls yet.</p>";
    return;
}

$myvotepollsInfo = array();
foreach ($polls as $poll) {
    $voters = $poll["voters"];
    foreach ($voters as $voter) {
        if ($voter["voteremail"] === $useremail) {
            $myvotepollsInfo[] = array("poll" => $poll, "voter" => $voter);
            break;
        }
    }
}

if (count($myvotepollsInfo) == 0) {
    echo "<p class='tip'>You have not been invited to any polls yet.</p>";
    return;
}

//reverse the array to show the latest poll first
// $myvotepollsInfo = array_reverse($myvotepollsInfo);

foreach ($myvotepollsInfo as $PollInfo) {
    $poll = $PollInfo["poll"];
    $currentVote = $PollInfo["voter"];

    echo "<div id=" . $poll["uuid"] . " class='PollToVote'>";
    echo "<h2>" . $poll['polltitle'] . "</h2>";
    if ($poll['state'] == 1) {
        echo "<h4 style='background-color:#60ff94'>In progress</h4>";
    } else {
        echo "<h4 style='background-color:#ffb868!important'>Finished</h4>";
    }
    echo "<h3>organizer: " . $poll['organizer'] . "</h3>";
    echo "<h3>start since: " . $poll['createdtime'] . "</h3>";

    if ($poll['state'] == 1) {
        echo "<div class='PollTimesBlock'>";
        echo "<h3>Vote time left:</h3>";
        echo "<p>" . $currentVote["voteleft"] . "</p>";
        echo "</div>";

        echo "<div class='PollQuestionBlock'>";
        echo "<h3>Question:<br>" . $poll["question"] . "</h3>";
        foreach ($poll["candidates"] as $candidate) {
            echo "<a onclick='voteFor(\"" . $poll["uuid"] . "\",\"" . $candidate["name"] . "\")'>" . $candidate["name"] . "</a>";
        }
        echo "</div>";

        echo "<div class='PollButtonsBlock'>";
        echo "<a onclick='restartVote(\"" . $poll["uuid"] . "\",\"" . $currentVote["voteleft"] . "\")' id='restartbutton'>Restart vote</a>";
        echo "<a onclick='confirmVote(\"" . $poll["uuid"] . "\",\"" . $currentVote["voteleft"] . "\")' id='confirmbutton'>Confirm vote</a>";
        echo "</div>";


    } else {
        echo "<div class='PollQuestionBlock'>";
        echo "<h3>Question:<br>" . $poll["question"] . "</h3>";
        echo "<div class='candidateResBlock'>";

        $totalvotes = 0;
        foreach ($poll["candidates"] as $candidate) {
            $totalvotes += $candidate["votes"];
        }

        foreach ($poll["candidates"] as $candidate) {
            echo "<div class='candidateres'>";
            echo "<p class='candidateresname'>" . $candidate["name"] . "</p>";
            echo "<p class='candidateresvote'>" . $candidate["votes"] ." votes </p>";
            echo "<p class='candidateresrate'>rate: " . number_format(((double)$candidate["votes"] / (double) $totalvotes) * 100 ,1) . "%</p>";
            echo "</div>";
        }
        echo "</div>";

        echo "</div>";
    }
    echo "</div>";

}
