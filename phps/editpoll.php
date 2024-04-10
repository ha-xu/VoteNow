<?php
    //ce php file permet de rechercher une scutin avec son uuid et de 
    //renvoyer les informations de ce scrutin   
    $pollid = $_POST['pollid'];
    $pollinfo = $_POST['pollinfo'];
    // echo $pollid;
    
    //open JSON file
    $pollsfile = file_get_contents("../data/polls.json");
    $polls = json_decode($pollsfile, true);

    if($polls == null){
        echo "Edit poll failed";
        return;
    }

    //ici on va mettre à jour le scrutin avec les nouvelles informations
    foreach ($polls as &$poll){
        if($poll['uuid'] == $pollid){

            $poll['state'] = 1;
            $poll['createdtime'] = date("Y-m-d H:i:s");

            $poll['polltitle'] = $pollinfo['polltitle'];
            $poll['organizer'] = $pollinfo['organizer'];
            $poll['polldesc'] = $pollinfo['polldesc'];
            $poll['question'] = $pollinfo['question'];
            $poll['candidates'] = $pollinfo['candidates'];
            $poll['voters'] = $pollinfo['voters'];

            $newpolls = json_encode($polls);
            file_put_contents("../data/polls.json", $newpolls);
            echo "Edit poll success";
            return;
        }
    }

    echo "Edit poll failed";