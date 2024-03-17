<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>createPoll</title>
    <link rel="stylesheet" href="css/general.css">
    <script src="js/header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/createPoll.css">
</head>
<body>
    <header>
    <a id="logoButton" href="index.php"><h1>Vote Now</h1></a>
    <a id="ConnectName"  onclick="showSidebar()">
        <img src="images/user_48px.png">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<p id='usernamep'>".$_SESSION['username']."</p>";
            } else{
                echo "<script>location.href='index.php'</script>";
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
    <div id="content">

        <div id="introduction">
            <h1>Create a Poll</h1>
            <p>
                In this page you can create a poll. Then you can share it with your friends and see the results.
        </p>
        </div>

        <div class="QuestionBlock">
            <div class='inputLine'>
                <h2>Title</h2>
                <input type="text" id="title" placeholder="Enter your title here">
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>