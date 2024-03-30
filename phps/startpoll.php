<?php
    //ce php file permet de rechercher une scutin avec son uuid et de 
    //mettre à jour son état en 1
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
            if($poll['state'] == 0){
                $poll['state'] = 1;
                echo "ok";
            return;
            }
        }
    }

    echo "Get poll failed";