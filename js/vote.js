var candidatesInfo = [];
function voteFor(uuid, candidate){
    var voteTimeLeft = parseInt($("#" + uuid + " .PollTimesBlock p").html());

    if(voteTimeLeft > 0){
        //modify the voteTimeLeft
        voteTimeLeft--;
        $("#" + uuid + " .PollTimesBlock p").html(voteTimeLeft);

        //add the candidate to the votedCandidates array

        candidatesInfo.push({uuid: uuid, candidate: candidate});
        console.log(candidatesInfo);
    }else{
         alert("You have no more votes left");
    }
}

function restartVote(uuid,totalvotetimeleft){
    var restartVote = confirm("Are you sure you want to restart the vote?\nAll votes will be lost.");
    if (restartVote == true){
        var newCandidatesInfo = [];
        for(var i = 0; i < candidatesInfo.length; i++){
            if(candidatesInfo[i].uuid !== uuid){
                newCandidatesInfo.push(candidatesInfo[i]);
            }
        }
        candidatesInfo = newCandidatesInfo;
        console.log(candidatesInfo);
        $("#" + uuid + " .PollTimesBlock p").html(totalvotetimeleft);

    } else {
        console.log("You canceled to restart the vote");
    }
}

function confirmVote(uuid,totalvotetimeleft){
    var confirmVote = confirm("Are you sure you want to vote?\nYou can't change your vote later.");
    if (confirmVote == true){
        console.log("length: " + votedCandidates.length);
        console.log(totalvotetimeleft);
        if(votedCandidates.length === 0){
            alert("You havn't voted yet");
        }else{
            $ajax({
                type: "POST",
                url: "vote.php",
                data: {votedCandidates: votedCandidates},
                success: function(data){
                    console.log(data);
                    votedCandidates = [];
                    $(".PollTimesBlock p").html(totalvotetimeleft);
                }
            });
        }
    } else {
        console.log("You canceled your vote");
    }
}