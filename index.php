<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Polls</title>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/mypolls.css">
    <script src="js/header.js"></script>
    <script src="js/mypolls.js"></script>
    <script src="js/vote.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <a id="logoButton" href="index.php">
            <h1>Vote Now</h1>
        </a>
        <a id="ConnectName" onclick="showSidebar()">
            <img src="images/user_48px.png">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<p id='usernamep'>" . $_SESSION['username'] . "</p>";
            }
            ?>
        </a>


        <div id="sidebarBack"></div>
        <div id="sidebar">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<a class='sidebarButtons' href='index.php'> <p>My Polls</p></a>";
                echo "<a class='sidebarButtons' href='createPoll.php'> <p>Create Poll</p></a>";
                echo "<a id='logoutButton' class='sidebarButtons' onclick='logout()' ><p>Logout</p></a>";
            } else {
                echo "<a id='loginButton' class='sidebarButtons' href='login.html'><p>Login</p></a>";
            }
            ?>
            <a id="backButton" class='sidebarButtons' onclick="hideSidebar()">
                <p>Back</p>
            </a>
        </div>
    </header>
    <div id="main">
        <div id="content">
            <div class="Indicator">
                <h2>Polls created by me</h1>
            </div>
            <div id="createdPolls" class="PollsList">
                <!-- ici on va afficher les scrutins créés par l'utilisateur -->
                <!-- on va utilise le code php pour afficher les scrutins créés par l'utilisateur -->
            </div>
            <div class="Indicator">
                <h2>Polls to vote</h1>
            </div>
            <div id="pollsToVote" class="PollsList">
                <!-- ici on va afficher les scrutins auxquels l'utilisateur a été invité -->
                <!-- on va utilise le code php pour afficher les scrutins auxquels l'utilisateur a été invité -->
            </div>
</body>

</html>