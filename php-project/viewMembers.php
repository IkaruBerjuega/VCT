<?php
    $id = $_GET["id"];

    $xml = new DOMDocument();
    $xml->preserveWhiteSpace = false;
    $xml->load("data.xml");
    $root = $xml->documentElement;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Document</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
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

        /* Section should take full available height */
        section {
            height: 150lvh;
            width: 100%; /* Ensure it takes full width */
        }

        /* Container centered with Flexbox */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        /* Row styling */
        .container .row {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px;
            width: 80%;
            height: 90%; 
            gap:25px;
            border-radius: 5px;

        }

        .row-item{
            display:flex;
            width: 80%;
            height: 100%;
            background-color: rgba(60,60,60,.6);
            padding: 25px;
            border-radius: 3px;
            flex-direction: column;
            gap:20px;
        }

        .flex-row{
            display: flex;
            align-items: center;
            gap:20px;
        }


        /* MemberView styling for images */
        .memberView img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }


        .membersCont{
            display: grid;
            gap:2em;
            width: 100%;
            grid-template-columns: repeat(auto-fill, minmax(300px,1fr));
            overflow-y: auto;
        }

        .memberView{
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding:10px;
            border-radius: 5px;
            width: auto;
            background-color: rgba(60,60,60,1);
            gap:20px;
            border:1px solid rgba(255,255,255,.1);
            cursor: pointer;
        }


        .memberView:hover{
            border-color: rgba(255,255,255,.5);
        }
        

        .memberView .pic-container{
            width:100px;
            height:100px;
            object-fit: fill;
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


        .popupForm form{
        width: 90%;
        }

        .popupForm .teamDeetHeader {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
        }

        .teamDeetHeader div{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:5px;
            height:100%;
        }

        .popupForm label {
        margin-bottom: 10px;
        }

        .popupForm input[type="text"],
        .popupForm input[type="submit"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 100%;/* Subtracting padding and border width */
        box-sizing: border-box;
        margin-bottom: 20px;
        height: 50px;
        }

        .popupForm input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        }

        .popupForm input[type="submit"]:hover {
        background-color: #0056b3;
        }

        input{
            font-size: 1rem;
        }

        button {
            border-radius: 5px;
            background-color: transparent;
            border: none;
        }

        .btnContainer {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            display: grid;
            place-content: center;
        }

        .btnContainer:hover{
            transition:.2s;
            background-color: rgba(79, 79, 79,1);
        }

        .cont-column_{
        width: 100%;
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
            background-color: rgba(60,60,60,.6);
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
            background-color: rgba(60,60,60,1);
            border-color: rgba(60,60,60,1);
            color: white;
        }

        .confirmationPopup .btnContainerConfirmation .btnSecondary:hover{
            border-color: rgba(60,60,60,.6);
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

        button, a {
            cursor: pointer;
        }

        .flex{
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5rem;
        }

        .addBtnContainer button{
            padding:10px;
            transition:.2s;
        }

   

        .addBtnContainer button:hover{
            transition:.2s;
            background-color: rgba(79, 79, 79,1);
        }

        .btnAction{
            display: flex;
            justify-content: center;
            align-items: center;
            padding:5px;
            border-radius: 4px;
            background-color:rgba(214,0,0,.2)
        }

        .btnAction:hover{
            background-color:rgba(214,0,0,1)
        }
        
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<section id="teamMembersSection">

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
            <Strong>Are you sure you want to delete this member?</Strong>
        </div>
        <div class="btnContainerConfirmation">
            <button id="updBtnNoDelete" class="btnSecondary">No</button>
            <button id="updBtnYesDelete" class="btnPrimary">Yes</button>
        </div>
    </div>


    <div id="addMemberPopupForm" class="popupForm">
        <form id="addForm" action="createMember.php" method="POST">
                <input type="hidden" id="teamidInput_" name="team_id" value="">
                <div class="teamDeetHeader space-around">
                    <strong>Add Member</strong>
                    <a id="closeAddMember"  class="btnContainer" ><img src="btnImages/closeIconWhite.png" alt="" width="24px"></a>
                </div>
                <div class="cont-column">
                    <div class="cont-column_ input"> 
                        <label>Name</label>
                        <input id="name_" type="text" name="memberName" min="1" placeholder="Enter Name"required/>
                    </div>
                    <div class="cont-column_ input">
                        <label>IGN</label>
                        <input id="IGN_" type="text" name="memberIgn" min="1" placeholder="Enter IGN" required/>
                    </div>
                    <div class="cont-column_ input">
                        <label>Portrait</label>
                        <input id="portrait_" type="text" name="memberPortrait" min="1" placeholder="Enter Portrait URL" required/>
                    </div>
                </div>
                <div class="submitBtn">
                    <input type="submit" value="Add Member"/>
                </div>
        </form>
    </div>
    
    

    <div id="popupForm" class="popupForm">
        <form id="myForm" action="updateMembers.php" method="POST">
                <input type="hidden" id="teamidInput" name="team_id" value="">
                <input type="hidden" id="memberidInput" name="mem_id" value="">
                <div class="teamDeetHeader space-around">
                    <strong>Member Details</strong>
                    <div>
                        <div><a id="deleteMemberBtn" href="deleteMember.php" class="btnContainer btnAction" ><img src="btnImages/deleteIconWhite.png" alt="" width="24px"></a></div>
                        <div><a id="closePopup"  class="btnContainer" ><img src="btnImages/closeIconWhite.png" alt="" width="24px"></a></div>
                    </div>
                </div>
                <div class="cont-column">
                    <div class="cont-column_ input"> 
                        <label>Name</label>
                        <input id="name" type="text" name="memberName" min="1" placeholder="Enter Name"required/>
                    </div>
                    <div class="cont-column_ input">
                        <label>IGN</label>
                        <input id="IGN" type="text" name="memberIgn" min="1" placeholder="Enter IGN" required/>
                    </div>
                    <div class="cont-column_ input">
                        <label>Portrait</label>
                        <input id="portrait" type="text" name="memberPortrait" min="1" placeholder="Enter Portrait URL" required/>
                    </div>
                </div>
                <div class="submitBtn">
                        <input type="submit" value="Update"/>
                </div>
            </form>
    </div>

        
    <div class="container">

        
        <div class="row">
            <div class="row-item">

            
                <?php
                        $teamNode;
                        $teamId_;
                        foreach ($root->childNodes as $data) {
                            // Check if the node is an element node
                            if ($data->nodeType === XML_ELEMENT_NODE) {
                                $team_id = $data->getAttribute("id");
                                
                                if ($team_id == $id) {
                                $teamId_ = $team_id;
                                $teamNode = $data;
                                }
                            }
                        }

                        if(isset($teamNode)){
                            $logoImg = $teamNode->childNodes[0]->nodeValue;
                            $teamName = $teamNode->childNodes[1]->nodeValue;
                            $abbrev = $teamNode->childNodes[2]->nodeValue;
                            $region = $teamNode->childNodes[3]->nodeValue;

                            $teamName = urldecode($teamName);
                            $abbrev = urldecode($abbrev);
                            $region = urldecode($region);
                            $logoImg = urldecode($logoImg);
                        }
                        
                ?>
                <div class="flex-row">
                    <img src="<?php echo $logoImg; ?>" alt="" width="150px">
                    <div class="cont-column details">
                        <b><?php echo $teamName; ?></b>
                        <p><?php echo "Team-id:". $teamId_."\n";?> </p>
                        <p><?php echo "Abbreviation:". $abbrev."\n";?> </p>
                        <p><?php echo "Region:". $region."\n";?> </p>
                    </div>
                </div>
                
            

                    <div class="flex">
                            <strong>Members</strong>
                            <div class="addBtnContainer">
                                <button id="btnAddMember"><img src="btnImages/addIconWhite.png" width="24px" alt="add member button"/></button>
                            </div>
                    </div>
                    <div class="membersCont">
                    <?php

                            $teamNode;
                            foreach ($root->childNodes as $data) {
                                if ($data->nodeType === XML_ELEMENT_NODE) {
                                    $team_id = $data->getAttribute("id");
                                    if ($team_id == $id) {
                                        $teamNode = $data;
                                        break;
                                    }
                                }
                            }

                            if(isset($teamNode)){
                                foreach ($teamNode->getElementsByTagName('member') as $member) {
                                            $memberId = urldecode($member->getAttribute("id"));
                                            $memberName = urldecode($member->getElementsByTagName('name')->item(0)->nodeValue);
                                            $memberIgn = urldecode($member->getElementsByTagName('ign')->item(0)->nodeValue);
                                            $memberPortrait = urldecode($member->getElementsByTagName('portrait')->item(0)->nodeValue);
                                            

                                            echo "<div id='$memberId' class=\"memberView\">  
                                                    <div class='pic-container'>
                                                        <img src='$memberPortrait' alt='$memberName'/>
                                                    </div>
                                                    <div class='name-container'>
                                                        <strong>$memberName</strong>
                                                        <p>$memberIgn</p>
                                                    </div>
                                            </div>";
                                        }
                            }
                            ?>
                    
                    </div>
        </div>
        
    </div>
</section>
<div id="overlay"></div>
</body>

<script>
        $(document).ready(function(){

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const id = urlParams.get('id');
            var originalURL = window.location.pathname+"?id="+id;
            history.replaceState('', '', originalURL);

            $('.memberView').on('click', function() {
                // replaceStateHistory();
                var memberId = $(this).attr('id');
                var newUrl = window.location.pathname + '?id=' + id+ '&memberId='+memberId; 
                history.replaceState('', '', newUrl);

                $.ajax({
                    type: "POST",
                    url: "getMemberData.php",
                    data: {
                        id: id,
                        memberId: memberId
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#name').val(data.name);
                        $('#IGN').val(data.ign);
                        $('#portrait').val(data.portrait);
                    }
                });

                $('#teamidInput').val(id);
                $('#memberidInput').val(memberId);
                $('#popupForm').css('display', 'flex');
                $('#overlay').css('display', 'block');
            });

            $("#myForm").submit(function(event) {
                event.preventDefault();
                // Show confirmation popup
                $('#confirmationPopup').css('display', 'block');
                $('#updBtnNo').on('click', function() {
                    $('#confirmationPopup').css('display', 'none'); 
                });
                $('#updBtnYes').on('click', function() {
                    $(this).off("click"); 
                    $("#myForm").off("submit").submit();
                });
            });

            $('#closePopup').on('click', function(){
                    // replaceStateHistory();
                    $('#popupForm').css('display', 'none'); // Hide the popup form
                    $('#overlay').css('display', 'none'); // Hide the overlay
                    var newUrl = window.location.pathname+"?id="+id;
                    history.replaceState('', '', newUrl);
             });

             $('#deleteMemberBtn').on('click', function(event) {
                event.preventDefault();
                var href = $(this).attr('href');
                $('#confirmationPopupDelete').css('display', 'block');
                $('#overlay').css('display', 'block');
                $('#updBtnNoDelete').on('click', function() {
                    var defaultURL = window.location.pathname+"?id="+id;
                    history.replaceState('', '', defaultURL);
                    $('#confirmationPopupDelete').css('display', 'none'); // Hide the confirmation popup
                    $('#overlay').css('display', 'none');
                });
                $('#updBtnYesDelete').on('click', function() {
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const memId = urlParams.get('memberId');
                    window.location.href = href+"?id="+id+"&memberId="+memId;
                });

            });

            $('#btnAddMember').on('click', function(event) {
                event.preventDefault();
                $('#addMemberPopupForm').css('display', 'flex');
                $('#overlay').css('display', 'block');
                $('#teamidInput_').val(id);
            });

            $('#closeAddMember').on('click', function(){
                    $('#addMemberPopupForm').css('display', 'none'); 
                    $('#overlay').css('display', 'none'); 
                    history.replaceState('', '', originalURL);
             });

        });
</script>


</html>
