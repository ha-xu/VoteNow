<?php

require_once('getvotepolls.php');
//get current user
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Please login first.');</script>";
    return;
}

$username = $_SESSION['username'];
$useremail = getemailbyusername($username);
$voteInfo = $_POST['voteInfo'];

//open JSON file
$pollsfile = file_get_contents("../data/polls.json");
$polls = json_decode($pollsfile,true);

if(count($voteInfo) > 0){
    if($polls != null){
        foreach($polls as &$poll){
            if($poll['uuid'] == $voteInfo[0]['uuid']){
                $currentCandidates = $poll['candidates'];
                $currentVoters = $poll['voters'];

                foreach($voteInfo as $vote){
                    foreach($currentCandidates as &$candidate){
                        if($candidate['name'] == $vote['candidate']){
                            $candidate['votes'] += 1;
                            break;
                        }
                    }
                }

                $poll['candidates'] = $currentCandidates;

                foreach($currentVoters as &$voter){
                    if($voter['voteremail'] == $useremail){
                        $voter['voteleft'] = (int)$voter['voteleft'] - count($voteInfo);
                        break;
                    }
                }

                $poll['voters'] = $currentVoters;

            }
        }

        $newpolls = json_encode($polls);
        file_put_contents("../data/polls.json", $newpolls);
        echo "ok";
    }
}


    