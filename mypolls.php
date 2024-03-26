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
            } else {
                echo "<script>location.href='index.php'</script>";
            }
            ?>
        </a>


        <div id="sidebarBack"></div>
        <div id="sidebar">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<a class='sidebarButtons' href='myPolls.php'> <p>My Polls</p></a>";
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
            <!-- <div class="CreatedPoll">
                <h2>What is your favorite color?</h2>
                <h3>26/03/2024</h3>
                <h4>In progress</h4>
            </div> -->
        </div>
        <div class="Indicator">
            <h2>Polls to vote</h1>
        </div>
        <div id="pollsToVote" class="PollsList">
            <!-- <div class="PollToVote">
                <h2>What is your favorite color?</h2>
                <h3>26/03/2024</h3>
                <button>Vote</button>
            </div> -->
    </div>
</body>
</html>
