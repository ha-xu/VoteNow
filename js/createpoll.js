//onload

//addCandidate function
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