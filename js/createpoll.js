
$(document).ready(function() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const pollid = urlParams.get('pollid');
    if(pollid == null){
        // console.log("pollid is null");
        return;
    }
    //si on a un pollid, on recherche le poll avec cet id
    searchPoll(pollid);
});

//on recherche le poll avec l'id donné avec ajax
//si on le trouve, on remplit les champs du formulaire avec les informations du poll
function searchPoll(pollid){
    $.ajax({
        url: "../phps/searchpoll.php",
        type: 'post',
        data: {
            pollid: pollid
        },
        success: function(data) {
            //refresh the page
            // console.log(data);
            //redirection
            //window.location.href = 'index.php';
            fillPoll(JSON.parse(data));
        }
    });
}

//on remplit les champs du formulaire avec les informations du poll
function fillPoll(pollInfo){
    $('#polltitle').val(pollInfo.polltitle);
    $('#polltitle').attr('readonly', true);
    $('#organizer').val(pollInfo.organizer);
    $('#organizer').attr('readonly', true);
    $('#polldesc').val(pollInfo.polldesc);
    $('#polldesc').attr('readonly', true);
    $('#pollQuestion').html(pollInfo.question);
    $('#pollQuestion').attr('readonly', true);
    
    var candidates = pollInfo.candidates;
    for (var i = 0; i < candidates.length; i++) {
        addCandidateWithInfo(candidates[i].name, candidates[i].desc);
    }
    //remove first candidate block
    $('#CandidatesList').children().first().remove();
    //remove second candidate block
    $('#CandidatesList').children().first().remove();

    var voters = pollInfo.voters;
    for (var i = 0; i < voters.length; i++) {
        addVoterWithInfo(voters[i].voteremail, voters[i].votetimes);
    }
    //remove first voter block
    $('#VotersList').children().first().remove();
    //remove second voter block
    $('#VotersList').children().first().remove();
}

//addCandidate function
//ajoute un candidat à la liste des candidats
function addCandidate() {
    var candidate = $('#CandidatesList').children().first().html();
    var candidateList = document.getElementById("CandidatesList");

    //new div element
    var newcandidate = document.createElement("div");
    newcandidate.innerHTML = candidate;
    newcandidate.className = "CandidateBlock";

    //new button element
    candidateList.appendChild(newcandidate);
    // candidateList.innerHTML += newcandidate.outerHTML;
}

//addCandidate with it's name and number of votes
//ajoute un candidat à la liste des candidats avec son nom et le nombre de votes
function addCandidateWithInfo(name, votenb) {
    var candidate = $('#CandidatesList').children().first().html();
    var candidateList = document.getElementById("CandidatesList");

    //new div element
    var newcandidate = document.createElement("div");
    newcandidate.innerHTML = candidate;
    newcandidate.className = "CandidateBlock";

    //new button element
    candidateList.appendChild(newcandidate);
    // candidateList.innerHTML += newcandidate.outerHTML;
    newcandidate.querySelector('#candidateName').value = name;
    // newcandidate.querySelector('.candidateDesc').value = desc;
}

//retire un candidat de la liste des candidats
function removeCandidate(removeButton) {
    //get parent element
    var candidateBlock = removeButton.parentElement;
    //parent element count
    var candidateCount = candidateBlock.parentElement.childElementCount;
    if (candidateCount <= 2) {
        alert("At least two candidates are required");
        return;
    }
    candidateBlock.remove();
}

//ajoute un voter à la liste des votants
function addVoter() {
    var voter = $('#VotersList').children().first().html();
    var voterList = document.getElementById("VotersList");

    //new div element
    var newVoter = document.createElement("div");
    newVoter.innerHTML = voter;
    newVoter.className = "VoterBlock";

    //new button element
    voterList.appendChild(newVoter);
    // voterList.innerHTML += newVoter.outerHTML;
}

//ajoute un votant à la liste des votants avec son email et le nombre de votes
function addVoterWithInfo(email, votetimes) {
    var voter = $('#VotersList').children().first().html();
    var voterList = document.getElementById("VotersList");

    //new div element
    var newVoter = document.createElement("div");
    newVoter.innerHTML = voter;
    newVoter.className = "VoterBlock";

    //new button element
    voterList.appendChild(newVoter);
    // voterList.innerHTML += newVoter.outerHTML;
    newVoter.querySelector('#voteremail').value = email;
    newVoter.querySelector('#votetimes').value = votetimes;
}


//retire un votant de la liste des votants
function removeVoter(removeButton) {
    //get parent element
    var voterBlock = removeButton.parentElement;
    //parent element count
    var voterCount = voterBlock.parentElement.childElementCount;
    if (voterCount <= 2) {
        alert("At least two voters are required");
        return;
    }
    voterBlock.remove();
}

//check if all fields are filled
function testAllFilled() {
    var allFilled = true;

    $('input, textarea').each(function() {
        if (!$(this).val().trim()) {
            allFilled = false;
            return false;
        }
    });

    return allFilled;
}

//page onload
$(document).ready(function() {
    document.getElementById("Inputs").addEventListener("submit", function(event) {
        if (testAllFilled() === false) {
            alert('please fill all the blanks');
            event.preventDefault();
        }
    });
});