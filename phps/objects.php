<?php 
date_default_timezone_set('Europe/Paris');
include 'functions.php';

// class Polls implements JsonSerializable{
//     public $polls;
//     public function __construct(){
//         $this->polls = array();
//     }
//     public function addPoll($poll){
//         array_push($this->polls, $poll);
//     }

//     public function getPollsByCreaterName($createrUserName){
//         $polls = new Polls();
//         foreach($this->polls as $poll){
//             if($poll->createrIs($createrUserName)){
//                 $polls->addPoll($poll);
//             }
//         }
//         return $polls;
//     }

//     public function reverse(){
//         $this->polls = array_reverse($this->polls);
//     }

//     public function getPolls(){
//         return $this->polls;
//     }

//     public function jsonSerialize(): mixed{
//         return get_object_vars($this);
//     }
    
// }
class Poll{
    public $uuid;
    public $createdtime;

    public $state;
    public $createrUserName;
    public $polltitle;
    public $organizer;
    public $polldesc;
    public $waysOfVote;
    public $question;
    public $candidates;
    public $voters;

    public function __construct($polltitle, $organizer, $polldesc, $waysOfVote, $question, $candidates, $voters){
        $this->uuid = uniqid();
        $this->createdtime = date("Y-m-d H:i:s");
        $this->state = 1;
        $this->createrUserName = $_SESSION['username'];
        $this->polltitle = $polltitle;
        $this->organizer = $organizer;
        $this->polldesc = $polldesc;
        $this->waysOfVote = $waysOfVote;
        $this->question = $question;
        $this->candidates = $candidates;
        $this->voters = $voters;
    }

    // public function userIsVoter($username){
    //     foreach($this->voters as $voter){
    //         if($voter->voteremail == getemailbyusername($username)){
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public function createrIs($username){
    //     return $this->createrUserName == $username;
    // }

    // public function jsonSerialize(): mixed{
    //     return get_object_vars($this);
    // }

}

class Voter {
    public $voteremail;
    public $votetime;

    public function __construct($voteremail, $votetime){
        $this->voteremail = $voteremail;
        $this->votetime = $votetime;
    }

//     public function jsonSerialize(): mixed{
//         return get_object_vars($this);
//     }
}