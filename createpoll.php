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
    <script src="js/createPoll.js"></script>
    <link rel="stylesheet" href="css/createPoll.css">
</head>

<body>
    <header>
        <a id="logoButton" href="index.php">
            <h1>Vote Now</h1>
        </a>
        <a id="ConnectName" onclick="showSidebar()">
            <img src="images/user_48px.png">
            <?php
            if (isset ($_SESSION['username'])) {
                echo "<p id='usernamep'>" . $_SESSION['username'] . "</p>";
            } else {
                echo "<script>location.href='index.php'</script>";
            }
            ?>
        </a>


        <div id="sidebarBack"></div>
        <div id="sidebar">
            <?php
            if (isset ($_SESSION["username"])) {
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

    <div id="main">
        <div id="content">

            <div id="introduction">
                <h1>Create a Poll</h1>
                <p>
                    In this page you can create a poll. Then you can share it with your friends and see the results.
                </p>
            </div>
            <form id="Inputs" action="phps/addpoll.php" method="post">
                <div class='InputLine'>
                    <h2>Title of the Poll</h2>
                    <input type="text" name="polltitle" placeholder="Enter your title here">
                </div>
                <div class='InputLine'>
                    <h2>Organizer/Group</h2>
                    <input type="text" name="organizer" placeholder="Enter your organizer here">
                </div>
                <div class='InputLine multilines'>
                    <h2>Description</h2>
                    <textarea type="text" rows="3" name="polldesc" placeholder="Enter your description here"></textarea>
                </div>
                <div class='InputLine'>
                    <h2>Ways of vote</h2>

                    <div class="radioButtons">
                        <div class="radioBlock">
                            <input type="radio" id="identified" name="waysOfVote" value="identified" checked>
                            <label class="radioLabel" for="identified">Identified</label>
                        </div>
                        <div class="radioBlock">
                            <input type="radio" id="anonymous" name="waysOfVote" value="anonymous">
                            <label class="radioLabel" for="anonymous">Anonymous</label>
                        </div>
                    </div>
                </div>
                <div class="QuestionBlock">
                    <div class='InputLine multilines'>
                        <h2>Question of the Poll</h2>
                        <textarea type="text" rows="3" name="pollQuestion"
                            placeholder="Describe your question here"></textarea>
                    </div>
                    <div class="Indicator">
                        <h2>Candidates</h2>
                        <a class="buttons addButton" onclick="addCandidate()">
                            Add candidate
                        </a>
                    </div>
                    <div id="CandidatesList" style="margin-bottom:5px;">
                        <div class="CandidateBlock">
                            <div class='InputLine' style="margin:5px 10px !important;">
                                <div style="display:flex;flex-wrap:nowrap;align-items:center;">
                                    <!-- <p class="LineNumber">1</p> -->
                                    <h2>Candidate</h2>
                                </div>
                                <input type="text" name="candidates[]" placeholder="Enter the candidate here">
                            </div>
                            <a class="removeButton" onclick="removeCandidate(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                        <div class="CandidateBlock">
                            <div class='InputLine' style="margin:5px 10px !important;">
                                <div style="display:flex;flex-wrap:nowrap;align-items:center;">
                                    <!-- <p class="LineNumber">1</p> -->
                                    <h2>Candidate</h2>
                                </div>
                                <input type="text" name="candidates[]" placeholder="Enter the candidate here">
                            </div>
                            <a class="removeButton" onclick="removeCandidate(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                    </div>
                </div>

                <div id="VotersBlock">
                    <!-- <div id="introduction">
                        <h1>Voters</h1>
                        <p>
                            You can add voters to your poll. You can add them by their email.
                        </p>
                    </div> -->
                    <div class="Indicator">
                        <h2>Voters</h2>
                        <a class="buttons addButton" onclick="addVoter()">
                            Add voter
                        </a>
                    </div>
                    <div id="VotersList">
                        <div class="VoterBlock">
                            <div class='InputLine'>
                                <h2>Voter's Email</h2>
                                <input type="email" name="voteremails[]" placeholder="Enter the email here">
                                <div style="display:flex;align-items:center;flex-wrap:nowrap;">    
                                    <h2>Vote times</h2>
                                    <input type="number" name="votetimes[]" value="0" min="0" max="2">
                                </div>
                                </div>
                            <a class="removeButton" onclick="removeVoter(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                        <div class="VoterBlock">
                            <div class='InputLine'>
                                <h2>Voter's Email</h2>
                                <input type="email" name="voteremails[]" placeholder="Enter the email here">
                                <div style="display:flex;align-items:center;flex-wrap:nowrap;">    
                                    <h2>Vote times</h2>
                                    <input type="number" name="votetimes[]" value="0" min="0" max="2">
                                </div>
                                </div>
                            <a class="removeButton" onclick="removeVoter(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                    </div>

                </div>
                <button type="submit">Create Poll</button>

            </form>
        </div>
    </div>

</body>

</html>