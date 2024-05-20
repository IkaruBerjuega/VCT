<?php

$xml = new DOMDocument();

//Removes all #TEXT nodes
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");
$root = $xml->documentElement;


?>


<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
     * {
    margin: 0;
    padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body{
            display: flex;
            justify-content: center;
            flex-direction: column;
        }


        table {
            border: solid black 1px;
            border-collapse: collapse;
            border-radius: 5px;
            border-style: hidden;
            box-shadow: 0 0 0 2px #666;
            width: 100%;
        }

        th, tr, td {
            border: solid white 1px;
            padding: 5px;
        }

        th, td {
            width: 150px;
            text-align: center;
        }

        section {
            height: 100vh;
            display: flex;
            justify-content: center; 
            align-items: center;
            gap: 20px;
            padding: 50px 10px;
            box-sizing: border-box;
        }

        

        ::-webkit-scrollbar {
        width: 3px;
        }

        ::-webkit-scrollbar-track {
        background: black;
        }

        ::-webkit-scrollbar-thumb {
        background-color: rgba(255,255,255,.5);
        border-radius: 20px;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .tableContRoot {
            display: flex;
            justify-content: center;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
            overflow-x: auto;
            width: 100%;
        }

        .tableCont{
            width: 100%;
        }

        .form {
            padding: 50px;
            width: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
        }

        .tableContRoot, .form{
            margin-top:50px;
            background-color: rgba(60,60,60,.6);
            color:white;
            box-sizing: border-box;
            height: 100%;
            padding: 20px;
        }


        .form form {
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }

        .form input[type=text] {
            height: 50px;
        }
        

        .space-around {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0px;
        }

        .input {
            gap: 0px;
        }

        .membersCont {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        .membersCont div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        button {
            border-radius: 5px;
            background-color: transparent;
            border: none;
            padding: 5px;
            transition:.3s;
        }

        .btnContainer {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: grid;
            place-content: center;
        }

        .btnContainer:hover,
        button:hover {
            transition: .4s;
            background-color: rgba(79, 79, 79,1);
        }

        .submitBtn {
            display: flex;
            justify-content: end;
            text-align: center;
        }

        .popupForm {
            display: none;
            justify-content: center;
            align-items: center;
            background-color: ;
            position: fixed;
            width: 30%;
            height: auto;
            top: 50%;
            overflow-y: auto;
            left: 50%;
            border-radius: 10px;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #242424;
            z-index: 1000;
        }

        .confirmationPopup {
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: fixed;
            width: 350px;
            height: 250px;
            top: 50%;
            overflow-y: auto;
            left: 50%;
            border-radius:5px;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 25px;
            border: 1px solid #ccc;
            z-index: 2000;
        }

        .confirmationPopup .txtContainer,
        .confirmationPopup .btnContainerConfirmation {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 50%;
            gap: 30px;
        }

        .confirmationPopup .txtContainer strong {
            font-size: 1.2rem;
            color: black;
            text-align: center;
        }

        .confirmationPopup .btnContainerConfirmation button {
            height: 50px;
            width: 100px;
            background-color: rgba(60,60,60,1);
            cursor: pointer;
            color: white;
            font-size: 1rem;
            border-radius: 0px;
        }

        .confirmationPopup .btnContainerConfirmation .btnSecondary {
            height: 50px;
            width: 100px;
            background-color: transparent;
            cursor: pointer;
            color: black;
            border: 1px solid rgba(60,60,60,.2);
            font-size: 1rem;
            border-radius: 0px;
        }

        .confirmationPopup .btnContainerConfirmation .btnPrimary:hover {
            background-color: rgba(60,60,60,.6);
            border-color: rgba(60,60,60,.6);
            color: white;
        }

        .confirmationPopup .btnContainerConfirmation .btnSecondary:hover{
            border-color: rgba(60,60,60,.6);
        }

        .popupForm .form-header {
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .popupForm label {
            margin-bottom: 5px;
        }

        .popupForm input {
            height: 50px;
        }

        input[type="text"],
        input[type="submit"], select {
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            font-size: 1rem;
            padding: 0px 15px;
        }

        .membersCont input, select{
            width: 100%;
            height: 50px;
        }

       

        .membersContInput {
            display: flex;
            flex-direction: column;
            height: auto;
            gap: 10px;
            padding: 20px;
            border-radius: 4px;
            background-color: rgba(60,60,60,1);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            height: 50px;
            font-size: 1rem;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .popupForm form .teamDeetHeader {
            margin-bottom: 20px;
        }

        .popupForm form {
            width: 90%;
        }

        strong {
            font-size: 1.2rem;
        }

        .bold {
            font-weight: bold;
        }

        h1 {
            margin-bottom: 20px;
        }

        .cancelAddBtn{
            color: red;
        }

        button, a{
            cursor: pointer;
        }


        .btnAction{
            display: flex;
            justify-content: center;
            align-items: center;
            padding:5px;
            border-radius: 4px;
            background-color: rgba(60,60,60,1);
        }

        .btnAction:hover{
            box-shadow: 0 0 0 2px rgba(255,255,255,.7);
        }

        .actionsCont{
            display: flex;
            justify-content: center; /* horizontally center */
            align-items: center; /* vertically center */
            height: 100%;
            gap: 5px;
            border:none;
        }

        .textAnchor{
            text-decoration: underline;
            color: rgba(255,255,255,.5);
            font-size: .9rem;
            transition:.2s;
        }

        .textAnchor:hover{
            transition:.2s;
            color:white;
        }

        #addMemberBtn img{
            
            width: 24px;
        }

        

    </style>
</head>
<body>
    <div>
        <?php include 'navbar.php'; ?>
    </div>
    <div class="editContainer">
        <div id="confirmationPopup" class="confirmationPopup">
                <div class="txtContainer">
                    <Strong>Are you sure you want to update this team?</Strong>
                </div>
                <div class="btnContainerConfirmation">
                    <button id="updBtnNo" class="btnSecondary">No</button>
                    <button id="updBtnYes" class="btnPrimary">Yes</button>
                </div>
            </div>

            <div id="confirmationPopupDelete" class="confirmationPopup">
                <div class="txtContainer">
                    <Strong>Are you sure you want to delete this team?</Strong>
                </div>
                <div class="btnContainerConfirmation">
                    <button id="updBtnNoDelete" class="btnSecondary">No</button>
                    <button id="updBtnYesDelete" class="btnPrimary">Yes</button>
                </div>
            </div>


            <div id="popupForm" class="popupForm">
                <form id="updForm" action="updateTeam.php" method="POST">
                    <input type="hidden" id="idInput" name="id" value="">
                    <div class="teamDeetHeader space-around">
                        <strong>Team Details</strong>
                        <button id="closePopup" type="button"><img src="btnImages/closeIconWhite.png" alt="" width="24px"></button>
                    </div>
                    <div class="cont-column">
                        <div class="cont-column input"> 
                            <label>Team Name</label>
                            <input id="teamNameInput" type="text" name="teamName" min="1" placeholder="Enter Team Name" value="<?php $teamName;?>"required/>
                        </div>
                        <div class="cont-column input">
                            <label>Abbreviation</label>
                            <input id="abbrevInput" type="text" name="abbrev" min="1" placeholder="Enter Abbreviation (ex. PRX)" required/>
                        </div>
                        <div class="cont-column input">
                            <label>Region</label>
                            <select id="regionInput" name="region" required >
                                    <option value="" disabled selected>Select Region</option>
                                    <option value="VCT EMEA">VCT EMEA</option>
                                    <option value="VCT China">VCT China</option>
                                    <option value="VCT Americas">VCT Americas</option>
                                    <option value="VCT Asia-Pacific">VCT Asia-Pacific</option>
                            </select>
                        </div>
                        <div class="cont-column input">
                            <label>Logo</label>
                            <input id="logoInput" type="text" name="logo" min="1" placeholder="Enter Logo URL" required/>
                        </div>
                    </div>
                    <div class="submitBtn">
                            <input type="submit" value="Update"/>
                    </div>
                </form>
            </div>

            
            <section id = "empTableView">
                    <div class="tableContRoot">
                        <div class="tableCont">
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Logo</th>
                                    <th>Team Name</th>
                                    <th>Abbreviation</th>
                                    <th>Region</th>
                                    <th>Members</th>
                                    <th>Actions</th>
                                </tr>
                            <?php

                            $x='t';
                            foreach ($root->childNodes as $teamNode) {
                                // Check if the node is an element node
                                if ($teamNode->nodeType === XML_ELEMENT_NODE) {
                                    $id = $teamNode->getAttribute("id");
                                    $logoImg = $teamNode->childNodes[0]->nodeValue;
                                    $teamName = $teamNode->childNodes[1]->nodeValue;
                                    $abbrev = $teamNode->childNodes[2]->nodeValue;
                                    $region = $teamNode->childNodes[3]->nodeValue;

                                    $id = urldecode($id);
                                    $teamName = urldecode($teamName);
                                    $abbrev = urldecode($abbrev);
                                    $region = urldecode($region);
                                    $logoImg = urldecode($logoImg);
                            
                                    echo "<tr>";
                                    echo "<td>$id</td>";
                                    echo "<td><img src='$logoImg' height='50px'/></td>";
                                    echo "<td>$teamName</td>";
                                    echo "<td>$abbrev</td>";
                                    echo "<td>$region</td>";
                                    echo "<td><a href='viewMembers.php?id=$id' class='textAnchor'>View Members</a></td>";
                                            //<a href='viewMembers.php?id=$id' class='btnAction' ><img src='btnImages/viewIconWhite.png' width='24px' alt='View Button'/></a>
                                    echo "<td>
                                            <div class='actionsCont'>
                                                
                                                <a href='edit.php?id=$id' id='openPopupLink' class='popupLink btnAction' data-id='$id' ><img src='btnImages/editIconWhite.png' width='24px' alt='Edit Button'/></a>
                                                <a href='deleteTeam.php?id=$id' id='openDeleteConfirmation' class='deleteLink btnAction' data-id='$id' style='background-color:rgba(214,0,0,.8)'><img src='btnImages/deleteIconWhite.png' width='24px' alt='Delete Button'/></a>
                                            </div>  
                                        </td>";
                                    echo "</tr>"; 

                                
                                }
                            }
                        
                            ?>
                        </table>
                        </div>
                    </div>

                    <div id="addForm" class="form">
                        <form action="createTeam.php" method="POST">
                            <div>
                                <h1>Add a team</h1>
                                <strong>Team Details</strong>
                            </div>
                            <div class="cont-column">
                                <div class="cont-column input">
                                    <label>Team Name</label>
                                    <input type="text" name="teamName" min="1" placeholder="Enter Team Name" required/>
                                </div>
                                <div class="cont-column input">
                                    <label>Abbreviation</label>
                                    <input type="text" name="abbrev" min="1" placeholder="Enter Abbreviation (ex. PRX)" required/>
                                </div>
                                <div class="cont-column input">
                                        <label>Region</label>
                                        <select name="region" required>
                                            <option value="" disabled selected>Select Region</option>
                                            <option value="VCT EMEA">VCT EMEA</option>
                                            <option value="VCT China">VCT China</option>
                                            <option value="VCT Americas">VCT Americas</option>
                                            <option value="VCT Asia-Pacific">VCT Asia-Pacific</option>
                                        </select>
                                <div class="cont-column input">
                                    <label>Logo</label>
                                    <input type="text" name="logo" min="1" placeholder="Enter Logo URL" required/>
                                </div>
                            </div>

                            <div class="space-around">
                                <strong>Members</strong>
                                <button type="button" id="addMemberBtn"><img src="btnImages/addIconWhite.png" alt="" width="24px"></button>
                            </div>
                            

                            <div class="cont-column">
                                <div id="membersContainer" class="cont-column input membersCont">
                                    <div class="membersContInput">
                                        <div>
                                            <label class="bold">Team Member 1</label>
                                        </div>
                                        <div>
                                            <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                                        </div>
                                    </div>
                                    <div class="membersContInput">
                                        <div>
                                            <label class="bold">Team Member 2</label>
                                        </div>
                                        <div>
                                            <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                                        </div>
                                    </div>
                                    <div class="membersContInput">
                                        <div>
                                            <label class="bold">Team Member 3</label>
                                        </div>
                                        <div>
                                            <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                                        </div>
                                    </div>
                                    <div class="membersContInput">
                                        <div>
                                            <label class="bold">Team Member 4</label>
                                        </div>
                                        <div>
                                            <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                                        </div>
                                    </div>
                                    <div class="membersContInput">
                                        <div>
                                            <label class="bold">Team Member 5</label>
                                        </div>
                                        <div>
                                            <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name"required/>
                                        </div>
                                        <div>
                                            <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="submitBtn">
                                    <input type="submit" />
                            </div>
                            
                        </form>
                    </div>
            </section>
    </div>
    <div id="overlay"></div>
</body>
<script>
        $(document).ready(function() {


            var originalURL = window.location.pathname;
            history.replaceState('', '', originalURL);

            $('#addMemberBtn').on('click', function() {
                const container = $('#membersContainer');
                const memberNumber = container.children().length + 1;
                const memberDiv = $('<div>');
                memberDiv.html(`
                            <div>
                                <label class="bold">Team Member ${memberNumber}</label>
                                <button type="button" class="dltMemberBtn" data-member-index="${memberNumber}"><img src="btnImages/closeIconWhite.png" alt="" width="24px" class="cancelAddBtn"></button>
                            </div>
                            <div>
                                <input type="text" name="memberName[]" min="1" placeholder="Enter Member Name" required/>
                            </div>
                            <div>
                                <input type="text" name="ignName[]" min="1" placeholder="Enter IGN Name" required/>
                            </div>
                            <div>
                                <input type="text" name="profile[]" min="1" placeholder="Enter Profile URL" required/>
                            </div>
                `);
                memberDiv.addClass("membersContInput");
                container.append(memberDiv);

                //scroll to bottom
                var scrollToBottom = $("#addForm")[0].scrollHeight - $("#addForm").height();
                $("#addForm").animate({ scrollTop: scrollToBottom }, 500);
            });

            $('#closePopup').on('click', function(){
                    $('#popupForm').css('display', 'none'); // Hide the popup form
                    $('#overlay').css('display', 'none'); // Hide the overlay
                    var newUrl = window.location.pathname;
                    history.replaceState('', '', newUrl);
             });



            $('#membersContainer').on('click', '.dltMemberBtn', function() {
                const container = $('#membersContainer');
                const memberIndexToRemove = $(this).data('member-index');
                container.children().eq(memberIndexToRemove-1).remove();
                //refreshes all the labels and data indexing
                container.find('.membersContInput').each(function(index) {
                    $(this).find('label').first().text(`Team Member ${index + 1}`);
                    $(this).find('.dltMemberBtn').data('member-index', index + 1);
                
                });

            });
            
            //handle popup update form 
            $("#updForm").submit(function(event) {
                // Prevent default form submission
                event.preventDefault();
                // Show confirmation popup
                $('#confirmationPopup').css('display', 'block');
                // If "No" button is clicked, hide the confirmation popup and cancel the submission
                $('#updBtnNo').on('click', function() {
                    $('#confirmationPopup').css('display', 'none'); // Hide the confirmation popup
                });
                // If "Yes" button is clicked, submit the form
                $('#updBtnYes').on('click', function() {
                    $(this).off("click"); // Remove the click event handler to avoid multiple submissions
                    $("#updForm").off("submit").submit(); // Submit the form
                });
            });
       
            $('.deleteLink').on('click', function(event) {
                // Prevent default anchor behavior
                event.preventDefault();
                var id = $(this).attr('href').split('=')[1];
                var href = $(this).attr('href');
                var newUrl = window.location.pathname + '?id=' + id;
                history.replaceState('', '', newUrl);

                $('#confirmationPopupDelete').css('display', 'block');
                $('#confirmationPopupDelete').fadeIn(500);
                $('#overlay').css('display', 'block');
                // If "No" button is clicked, hide the confirmation popup and cancel the submission
                $('#updBtnNoDelete').on('click', function() {
                    var defaultURL = window.location.pathname;
                    history.replaceState('', '', defaultURL);
                    $('#confirmationPopupDelete').css('display', 'none'); // Hide the confirmation popup
                    $('#overlay').css('display', 'none');
                });
                $('#updBtnYesDelete').on('click', function() {
                    window.location.href = href;
                });

            });
            // Attach click event listeners to each anchor
            $('.popupLink').on('click', function(event) {
                event.preventDefault();
                var overlay = $('#overlay');
                var id = $(this).attr('href').split('=')[1];
                var newUrl = window.location.pathname + '?id=' + id;
                history.replaceState('', '', newUrl);

                $.ajax({
                    type: "POST",
                    url: "getTeamData.php",
                    data: { id: id },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#teamNameInput').val(data.teamName);
                        $('#abbrevInput').val(data.abbrev);
                        $('#regionInput').val(data.region).change();
                        $('#logoInput').val(data.logo);
                    }
                });

                $('#idInput').val(id);
                $('#popupForm').css('display', 'flex');
                overlay.css('display', 'block');
            });
                
            });
    </script>

</html>

