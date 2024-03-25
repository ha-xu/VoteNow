<?php 

class Poll{
    public $uuid;
    public $createdtime;
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
        $this->createdtime = date("Y-m-d h:i:s");
        $this->createrUserName = $_SESSION['username'];
        $this->polltitle = $polltitle;
        $this->organizer = $organizer;
        $this->polldesc = $polldesc;
        $this->waysOfVote = $waysOfVote;
        $this->question = $question;
        $this->candidates = $candidates;
        $this->voters = $voters;
    }

}

class Voter{
    public $voteremail;
    public $votetime;

    public function __construct($voteremail, $votetime){
        $this->voteremail = $voteremail;
        $this->votetime = $votetime;
    }
}