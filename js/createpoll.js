var currentPollid = null;
var pollfinished = false;


$(document).ready(function () {

    document.getElementById('sidebarBack').addEventListener('click', hideSidebar);


    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const pollid = urlParams.get('pollid');
    currentPollid = pollid;
    if (pollid == null) {
        $('#ConfirmButton').css('display', 'none');
        $('#EditButton').css('display', 'none');
        $('#StopButton').css('display', 'none');
        $('#CreateButton').css('display', 'block');
        $('#statuebar').css('display', 'none');
        $('#deleteButton').css('display', 'none');

        document.getElementById("Inputs").addEventListener("submit", function (event) {
            if (testAllFilled() === false) {
                alert('please fill all the blanks');
                event.preventDefault();
            }
        });
        return;
    } else {
        //si on a un pollid, on recherche le poll avec cet id

        // console.log($('#introduction h1').html());
        $('#introduction h1').html('Poll details');
        $('#introduction p').html('In this page, you can see the result of the poll. You can also restart the poll if you want.');

        searchPoll(pollid);
        $('#CreateButton').css('display', 'none');

        startReadOnly();
    }

});

//function to start a read-only mode
function startReadOnly() {
    $('input').attr('readonly', true);
    $('textarea').attr('readonly', true);
    $('.addButton').css('display', 'none');
    $('.removeButton').css('display', 'none');

    $('#ConfirmButton').css('display', 'none');
    $('#EditButton').css('display', 'none');
    $('#StopButton').css('display', 'block');
    $('#CancelButton').css('display', 'none');
    $('#BackButton').css('display', 'block');
    $('#deleteButton').css('display', 'block');

}

//function to start edit
function startEdit() {


    $('input').attr('readonly', false);
    $('textarea').attr('readonly', false);
    $('.addButton').css('display', 'block');
    $('.removeButton').css('display', 'flex');

    $('#cover').css('display', 'none');

    $('#ConfirmButton').css('display', 'block');
    $('#EditButton').css('display', 'none');
    $('#StopButton').css('display', 'none');
    $('#CancelButton').css('display', 'block');
    $('#BackButton').css('display', 'none');

    $('#deleteButton').css('display', 'none');

}

//function to confirm the changes
function confirmEdit() {

    if (testAllFilled() === false) {
        alert('please fill all the blanks');
        return;
    }

    startReadOnly();
    applyEdit();
    searchPoll(currentPollid);
}

function CancelEdit() {
    startReadOnly();
    searchPoll(currentPollid);
}

function deletePoll() {
    var result = confirm("Are you sure to delete this poll?");
    if (result == true) {
        $.ajax({
            url: "../phps/deletepoll.php",
            type: 'post',
            data: {
                pollid: currentPollid
            },
            success: function (data) {
                //refresh the page
                console.log(data);
                if (data == 'ok') {
                    //redirection
                    window.location.href = 'index.php';
                } else {
                    alert('Delete poll failed');
                }
                
            }
        });
    }
}

//function to go back to the index page
function BackList() {
    window.location.href = 'index.php';
}

function getPollInfo() {
    var pollInfo = {
        polltitle: $('#polltitle').val(),
        organizer: $('#organizer').val(),
        polldesc: $('#polldesc').val(),
        question: $('#pollQuestion').val(),
        candidates: [],
        voters: []
    };

    //get the candidates
    var candidateList = document.getElementById("CandidatesList").children;
    for (var i = 0; i < candidateList.length; i++) {
        var candidate = candidateList[i];
        pollInfo.candidates.push({
            name: candidate.querySelector('#candidateName').value,
            votes: 0
        });
    }

    //get the voters
    var voterList = document.getElementById("VotersList").children;
    for (var i = 0; i < voterList.length; i++) {
        var voter = voterList[i];
        pollInfo.voters.push({
            voteremail: voter.querySelector('#voteremail').value,
            proxy: voter.querySelector('#proxy').value,
            voteleft: parseInt(voter.querySelector('#proxy').value) + 1
        });
    }

    return pollInfo;
}

//function to Apply the changes
function applyEdit() {

    console.log(getPollInfo());

    //get the poll information
    console.log(currentPollid);
    //send the poll information to the server
    $.ajax({
        url: "../phps/editpoll.php",
        type: 'post',
        data: {
            pollid: currentPollid,
            pollinfo: getPollInfo()
        },
        success: function (data) {
            //refresh the page
            console.log(data);
            if (data == 'Edit poll success') {
                alert('Poll restarted successfully');
            } else {
                alert('Edit poll failed');
            }
            //redirection
            // window.location.href = 'index.php';
        }
    });
}


function ShowResult() {
    //confirm box

    if (pollfinished === false) {
        var result = confirm("Are you sure to show the result?\nThis poll will stop.\nIt means this poll won't be able to vote anymore.");
        if (result == false) {
            return;
        }
    }
    StopPoll();
    searchPoll(currentPollid);
    searchResult(currentPollid);

    ClearResultList()
    $("#cover").css("display", "flex");

}

function ClearCandidateList() {
    var candidateList = document.getElementById("CandidatesList");
    while (candidateList.childElementCount > 1) {
        candidateList.children[1].remove();
    }
}

function ClearVotersList() {
    var voterList = document.getElementById("VotersList");
    while (voterList.childElementCount > 1) {
        voterList.children[1].remove();
    }
}

function ClearResultList() {
    var candidateList = document.getElementById("CandidateResultList");
    while (candidateList.childElementCount > 1) {
        candidateList.children[1].remove();
    }
}


//on recherche le poll avec l'id donné avec ajax
//si on le trouve, on remplit les champs du formulaire avec les informations du poll
function searchPoll(pollid) {
    $.ajax({
        url: "../phps/searchpoll.php",
        type: 'post',
        data: {
            pollid: pollid
        },
        success: function (data) {
            if (data == 'Get poll failed') {
                alert('Get poll failed');
                //redirection
                window.location.href = 'index.php';
                return null;
            } else {
                fillPoll(JSON.parse(data));
            }
        }
    });
}

function searchResult(pollid) {
    $.ajax({
        url: "../phps/searchpoll.php",
        type: 'post',
        data: {
            pollid: pollid
        },
        success: function (data) {
            if (data == 'Get result failed') {
                alert('Get result failed');
                //redirection
                window.location.href = 'index.php';
                return null;
            } else {
                fillResult(JSON.parse(data));
            }
        }
    });
}

//on remplit les champs du formulaire avec les informations du poll
function fillPoll(pollInfo) {

    if (pollInfo.state == 0) {
        pollfinished = true;
    } else {
        pollfinished = false;
    }

    $('#polltitle').val(pollInfo.polltitle);
    $('#organizer').val(pollInfo.organizer);
    $('#polldesc').val(pollInfo.polldesc);
    $('#pollQuestion').html(pollInfo.question);

    if (pollfinished === false) {
        $('#statuebar').css('background-color', '#60ff94');
        $('#statuebar h2').html('In progress');
        $('#StopButton').html('Stop Poll & Show Result');


    } else {
        $('#statuebar').css('background-color', '#ffb868');
        $('#statuebar h2').html('Finished');
        $('#StopButton').html('Show Result');

    }

    ClearCandidateList();
    var candidates = pollInfo.candidates;
    for (var i = 0; i < candidates.length; i++) {
        addCandidateWithInfo(candidates[i].name);
    }
    //remove first candidate block
    $('#CandidatesList').children().first().remove();


    ClearVotersList();
    var voters = pollInfo.voters;
    for (var i = 0; i < voters.length; i++) {
        addVoterWithInfo(voters[i].voteremail, voters[i].proxy);
    }
    //remove first voter block
    $('#VotersList').children().first().remove();

}

//on remplit les champs du formulaire avec les resultat du poll
function fillResult(pollInfo) {
    //total votes
    var totalvotes = 0;
    for (var i = 0; i < pollInfo.candidates.length; i++) {
        totalvotes += pollInfo.candidates[i].votes;
    }
    console.log(totalvotes);
    $("#pollResQuestion").val(pollInfo.question);
    for (var i = 0; i < pollInfo.candidates.length; i++) {
        addResCandidateWithInfo(pollInfo.candidates[i].name, pollInfo.candidates[i].votes, totalvotes);
    }
    //remove first candidate block
    $('#CandidateResultList').children().first().remove();
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
function addCandidateWithInfo(name) {
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

function addResCandidateWithInfo(name, votes, totalvotes) {
    var candidate = $('#CandidateResultList').children().first().html();
    var candidateList = document.getElementById("CandidateResultList");


    //new div element
    var newcandidate = document.createElement("div");
    newcandidate.innerHTML = candidate;
    newcandidate.className = "CandidateResBlock";

    //new button element
    candidateList.appendChild(newcandidate);
    // candidateList.innerHTML += newcandidate.outerHTML;
    newcandidate.querySelector('#candidateResName').value = name;
    newcandidate.querySelector('#candidateVotes').innerHTML = votes;
    newcandidate.querySelector('#candidateRate').innerHTML = (votes / totalvotes * 100).toFixed(2) + '%';
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
function addVoterWithInfo(email, proxy) {
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
    newVoter.querySelector('#proxy').value = proxy;
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

    $('input, textarea').each(function () {
        console.log($(this).val());
        console.log($(this).css('visibility'));
        //get this id
        console.log($(this).attr('id'));

        if (!$(this).val().trim() && $(this).attr('id') !== 'pollResQuestion' && $(this).attr('id') !== 'candidateResName'){
            allFilled = false;
            return false;
        }
    });

    return allFilled;
}

function StopPoll() {
    $.ajax({
        url: "../phps/stoppoll.php",
        type: 'post',
        data: {
            pollid: currentPollid
        },
        success: function (data) {
            //refresh the page
            console.log(data);
            if (data !== 'ok') {
                alert('Stop poll failed');
            }
            //redirection
            // window.location.href = 'index.php';
        }
    });
}


function HideCover() {
    $("#cover").css("display", "none");
}