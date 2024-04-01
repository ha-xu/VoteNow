//page load
window.onload = function() {
    document.getElementById('sidebarBack').addEventListener('click', hideSidebar);
    loadCreatedPolls();
    // loadVotePolls();
}

function loadCreatedPolls() {
    $.ajax({
        url: "../phps/getcreatedpolls.php",
        success: function(result) {
            $("#createdPolls").html(result);
        }
    });
}

function loadVotePolls() {
    $.ajax({
        url: "../phps/getvotepolls.php",
        success: function(result) {
            $("#pollsToVote").html(result);
        }
    });
}