<?php
session_start();
//get values from post
$candidate = $_POST['candidate'];
//log
echo "candidate: ".$candidate[0];
echo "candidate: ".$candidate[1];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Polls</title>

    <link rel="stylesheet" href="css/general.css">
    <script src="js/header.js"></script>
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
                echo "<a class='sidebarButtons'> <p>My Polls</p></a>";
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
    
</body>
</html>
