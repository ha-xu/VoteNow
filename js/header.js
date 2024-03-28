//window laod event
window.onload = function() {
    //add event listener to the sidebarback

}

function showSidebar() {
    document.getElementById('sidebarBack').style.opacity = 1;
    document.getElementById('sidebarBack').style.pointerEvents = 'auto';
    //gradully show the sidebar with jquery

    document.getElementById('sidebar').style.right = '0px';
    document.getElementById('sidebar').style.opacity = 1;
    document.getElementById('sidebar').style.pointerEvents = 'all';

}

function hideSidebar() {
    document.getElementById('sidebarBack').style.opacity = 0;
    document.getElementById('sidebarBack').style.pointerEvents = 'none';
    //gradully hide the sidebar with jquery

    document.getElementById('sidebar').style.right = '-300px';
    document.getElementById('sidebar').style.opacity = 0;
    document.getElementById('sidebar').style.pointerEvents = 'none';
}

function logout() {
    //clear the local storage
    localStorage.clear();
    //clear the session storage
    sessionStorage.clear();
    //clear php session
    $.ajax({
        url: '../phps/logout.php',
        type: 'post',
        data: {
            logout: 'logout'
        },
        success: function(data) {
            //refresh the page
            localStorage.clear();
            location.reload();
            //redirection
            //window.location.href = 'index.php';
        }
    });
}