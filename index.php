<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteNow</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/general.css">
    <script src="js/home.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <a id="logoButton" href="index.php"><h1>Vote Now</h1></a>
        <a id="ConnectName" onclick="showSidebar()">
            <img src="images/user_48px.png">
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<p id='usernamep'>".$_SESSION['username']."</p>";
                } 
                ?>
            </a>
        
        <div id="sidebarBack"></div>
        <div id="sidebar">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<a class='sidebarButtons'> <p>My Polls</p></a>";
                echo "<a id='logoutButton' class='sidebarButtons' onclick='logout()' ><p>Logout</p></a>";
            } else {
                echo "<a id='loginButton' class='sidebarButtons' href='login.html'><p>Login</p></a>";
            }
            ?>
            <a id="backButton" class='sidebarButtons' onclick="hideSidebar()"><p>Back</p></a>
        </div>
    </header>
    <div id="main">
        <div id="introduction">
            <h1>Welcome to Vote Now</h1>
            <p>
                Vote Now is a platform that allows you to create and vote for polls. You can create a poll and share it with your friends, or vote for a poll that you find interesting. You can also see the results of the polls that you have voted for.
            </p>
        </div>
        <div id="Actions">
            <a id="createPollButton" class="actionButton" href="<?php
            if (isset($_SESSION['username'])) {
                echo "creerscrutin.html";
            } else {
                echo "login.html?redirect=creerscrutin.html";
            }
            ?>">
                <p>Create a Poll (scrutin)</p>
            </a>
            <a id="voteButton" class="actionButton" href="<?php
            if (isset($_SESSION['username'])) {
                echo "voter.html";
            } else {
                echo "login.html?redirect=voter.html";
            }
            ?>">
                <p>Vote for a Poll</p>
            </a>
        </div>
    </div>
</body>

</html>