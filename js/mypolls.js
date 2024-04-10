//page load
//quand index.php est chargé, on veut charger les scrutins créés par l'utilisateur
//et les scrutins auxquels l'utilisateur peut voter
//on utilise ajax pour appeler les fichiers php qui vont chercher les données dans la base de données
window.onload = function() {
    document.getElementById('sidebarBack').addEventListener('click', hideSidebar);
    loadCreatedPolls();
    loadVotePolls();
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

