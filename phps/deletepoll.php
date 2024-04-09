<?php 
    $pollid = $_POST['pollid'];

    $pollsfile = file_get_contents("../data/polls.json");

    $polls = json_decode($pollsfile, true);

    $newpolls = array();

    // retier les polls qui ne sont pas celui qu'on veut supprimer
    foreach ($polls as $poll) {
        if ($poll['uuid'] != $pollid) {
            $newpolls[] = $poll;
        }
    }

    //sauvegarder les polls restants
    $newpolls = json_encode($newpolls, JSON_PRETTY_PRINT);

    file_put_contents("../data/polls.json", $newpolls);

    echo "ok";

