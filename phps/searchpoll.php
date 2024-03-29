<?php
    //ce php file permet de rechercher une scutin avec son uuid et de 
    //renvoyer les informations de ce scrutin   
    $pollid = $_POST['pollid'];
    // echo $pollid;

    //open JSON file
    $pollsfile = file_get_contents("../data/polls.json");
    $polls = json_decode($pollsfile, true);

    if($polls == null){
        echo "Get poll failed";
        return;
    }

    foreach ($polls as $poll){
        if($poll['uuid'] == $pollid){
            echo json_encode($poll);
            return;
        }
    }