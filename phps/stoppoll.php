<?php
     //ce php file permet de rechercher une scutin avec son uuid et de 
    //mettre à jour son état en 0
    $pollid = $_POST['pollid'];
    // echo $pollid;

    //open JSON file
    $pollsfile = file_get_contents("../data/polls.json");
    $polls = json_decode($pollsfile, true);

    if($polls == null){
        echo "Get poll failed";
        return;
    }

    foreach ($polls as &$poll){
        if($poll['uuid'] == $pollid){
            if($poll['state'] == 1){
                $poll['state'] = 0;
                $newpolls = json_encode($polls);
                file_put_contents("../data/polls.json", $newpolls);
                echo "ok";
                return;
            }else if($poll['state'] == 0){
                echo "ok";
                return;
            }
        }
    }

    echo "Get poll failed";
