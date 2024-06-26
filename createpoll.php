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

            <div id="introduction">
                <h1>Create a Poll</h1>
                <p>
                    In this page you can create a poll. Then you can share it with your friends and see the results.
                </p>
            </div>
            <form id="Inputs" action="phps/addpoll.php" method="post">
                <div id="statuebar">
                    <h2>In progress</h2>
                </div>
                <div class='InputLine'>
                    <h2>Title of the Poll</h2>
                    <input id="polltitle" type="text" name="polltitle" placeholder="Enter your title here">
                </div>
                <div class='InputLine'>
                    <h2>Organizer/Group</h2>
                    <input id="organizer" type="text" name="organizer" placeholder="Enter your organizer here">
                </div>
                <div class='InputLine multilines'>
                    <h2>Description</h2>
                    <textarea id="polldesc" type="text" rows="3" name="polldesc"
                        placeholder="Enter your description here"></textarea>
                </div>

                <div class="QuestionBlock">
                    <div class='InputLine multilines'>
                        <h2>Question of the Poll</h2>
                        <textarea id="pollQuestion" type="text" rows="3" name="pollQuestion"
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
                                    <input id="candidateName" type="text" name="candidates[]"
                                        placeholder="Enter the candidate here">
                                </div>
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
                                    <input id="candidateName" type="text" name="candidates[]"
                                        placeholder="Enter the candidate here">
                                </div>
                            </div>
                            <a class="removeButton" onclick="removeCandidate(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                    </div>
                </div>

                <div id="VotersBlock">

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
                                <input id="voteremail" type="email" name="voteremails[]"
                                    placeholder="Enter the email here">
                                <div style="display:flex;align-items:center;flex-wrap:nowrap;">
                                    <h2>proxy</h2>
                                    <input id="proxy" type="number" name="proxies[]" value="0" min="0" max="2">
                                </div>
                            </div>
                            <a class="removeButton" onclick="removeVoter(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                        <div class="VoterBlock">
                            <div class='InputLine'>
                                <h2>Voter's Email</h2>
                                <input id="voteremail" type="email" name="voteremails[]"
                                    placeholder="Enter the email here">
                                <div style="display:flex;align-items:center;flex-wrap:nowrap;">
                                    <h2>proxy</h2>
                                    <input id="proxy" type="number" name="proxies[]" value="0" min="0" max="2">
                                </div>
                            </div>
                            <a class="removeButton" onclick="removeVoter(this)">
                                <img src="images/close_96px.png">
                            </a>
                        </div>
                    </div>

                </div>
                <div id="buttonsDiv">
                    <a id="deleteButton" onclick="deletePoll()" class="pollSubmitButtons">Delete Poll</a>

                    <a id="BackButton" onclick="BackList()" class="pollSubmitButtons">Back to list</a>
                    <a id="CancelButton" onclick="CancelEdit()" class="pollSubmitButtons">Cancel</a>
                    <a id="ConfirmButton" onclick="confirmEdit()" class="pollSubmitButtons">Restart</a>
                    <a id="EditButton" onclick="startEdit()" class="pollSubmitButtons">Edit</a>
                    <a id="StopButton" onclick="ShowResult()" class="pollSubmitButtons">Stop poll & Show results</a>
                    <button id="CreateButton" class="pollSubmitButtons" type="submit">Create Poll</button>
                </div>
            </form>
        </div>
    </div>

    <div id="cover" >
        <div id="resultPanel">
            <div class='InputLine multilines'>
                <h2>Question of the Poll</h2>
                <textarea id="pollResQuestion" type="text" rows="3" name="pollQuestion"
                    placeholder="Describe your question here" readonly></textarea>
            </div>
            <div id="CandidateResultList">
                <div class="CandidateResBlock">
                    <div class='InputLine CandidateResultsLine' style="margin:5px 10px !important;">
                        <div style="display:flex;flex-wrap:nowrap;align-items:center;">
                            <!-- <p class="LineNumber">1</p> -->
                            <h2>Candidate</h2>
                            <input id="candidateResName" type="text" name="candidates[]"
                                placeholder="Enter the candidate here" readonly>
                        </div>

                        <div class="votenumberBlock">
                            <p id="candidateVotes">0</p>
                            <h2>votes |</h2>
                            <p id="candidateRate">0</p>
                        </div>
                    </div>
                </div>

            </div>

            <div id="buttonsDiv">
                <a onclick="HideCover()" class="buttons">Back to Poll</a>
                <a onclick="BackList()" class="buttons">Back to list</a>
                <a onclick="startEdit()" class="buttons">Edit & Restart</a>
            </div>
        </div>
    </div>

</body>

</html>