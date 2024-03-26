//page load
window.onload = function(){
    loadCreatedPolls();
    loadVotePolls();
}

function loadCreatedPolls(){
        $.ajax({
        url: "../phps/getcreatedpolls.php",
        success: function(result){
            $("#createdPolls").html(result);
        }
        });
}

function loadVotePolls(){
        $.ajax({
        url: "../phps/getvotepolls.php",
        success: function(result){
            $("#pollsToVote").html(result);
        }
        });
}