var candidatesInfo = [];
function voteFor(uuid, candidate) {
    var voteTimeLeft = parseInt($("#" + uuid + " .PollTimesBlock p").html());

    if (voteTimeLeft > 0) {
        //modify the voteTimeLeft
        voteTimeLeft--;
        $("#" + uuid + " .PollTimesBlock p").html(voteTimeLeft);

        //add the candidate to the votedCandidates array

        candidatesInfo.push({ uuid: uuid, candidate: candidate });
        console.log(candidatesInfo);
    } else {
        alert("You have no more votes left");
    }
}

function restartVote(uuid, totalvotetimeleft) {
    var restartVote = confirm("Are you sure you want to restart the vote?\nAll votes will be lost.");
    if (restartVote == true) {
        var newCandidatesInfo = [];
        for (var i = 0; i < candidatesInfo.length; i++) {
            if (candidatesInfo[i].uuid !== uuid) {
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

function confirmVote(uuid, totalvotetimeleft) {

    var currentVoteInfo = [];
    var otherVoteInfo = [];
    for (var i = 0; i < candidatesInfo.length; i++) {
        if (candidatesInfo[i].uuid === uuid) {
            currentVoteInfo.push(candidatesInfo[i]);
        }else{
            otherVoteInfo.push(candidatesInfo[i]);
        
        }
    }
    if (currentVoteInfo.length === 0) {
        alert("You havn't voted yet");
    } else {

        var confirmVote = confirm("Are you sure you want to vote?\nYou can't change your vote later.");
        if (confirmVote == true) {
            console.log(currentVoteInfo);
            $.ajax({
                type: "POST",
                url: "../phps/confirmvote.php",
                data: {voteInfo: currentVoteInfo},
                success: function(data){
                    console.log(data);
                    if(data === "ok"){
                        alert("You voted successfully");
                        candidatesInfo = otherVoteInfo;
                        //refresh the page
                        location.reload();
                    }
                }
            });
        }
        else {
            console.log("You canceled your vote");
        }

    }
}