<?php
    $xml = new DomDocument();
    $xml->preserveWhiteSpace = false;
    $xml->load("data.xml");
    $root = $xml->documentElement;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCT Champions Tour</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        html{
            scroll-behavior: smooth;
        }
        
        body{
            background-image: url(btnImages/background.png);
            background-repeat: repeat;
        }

        #homePageContainer{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100lvh;
        }

        .titleCont{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap:30px;
            height: 100%;
        }

        .titleCont img{
            width: 200px;
        }
        .titleCont p{
            font-size: 5rem;
            font-weight: bold;
            line-height: 100%;
        }

        .titleCont div{
            display:flex;
            justify-content:center;
            align-items: center;
            flex-direction:column;
            gap: 15px;
        }
    
        .titleCont a{
            text-decoration: none;
            color:inherit;
            color:white;
            padding: 20px;
            background-color: transparent;
            transition:.2s;
            border:solid 2px #c5b174;
            margin-top: 50px;
        }

        .titleCont a:hover{
            transition:.2s;
            color:white;
            background-color: #c5b174;
        }

        #teamsContainer{
            display:flex;
            justify-self: center;
            align-items: center;
            flex-direction: column;
            padding:200px 100px;
            box-sizing: border-box;
        }

        .vctTeamsCont{
            height: 30%; 
        }
        
        .vctTeamsCont h1{
            font-size: 4rem;
        }

        #teamsContainer .team-cont{
            display: grid;
            gap:2em;
            width: 100%;
            grid-template-columns: repeat(auto-fill, minmax(300px,1fr));
            height: 70%;
            margin: 100px 0 400px 0;
        }

        #teamsContainer img{
            width: 100px;
            height: 100px;
        }

        #teamsContainer div .teamCard{
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-color: rgba(60,60,60,.9);
            flex-direction: column;
            gap:20px;
            box-shadow: 0 2px 4px #000000;
            box-sizing: border-box;
            cursor: pointer;    
            transition: .3s;
        }

        #teamsContainer div a{
            text-decoration:none;
            color:inherit;
        }


        #teamsContainer div .teamCard:hover{
            transition: .3s;
            box-shadow: 0 0 0 2px rgba(255,255,255,.4);
        }

        #teamsContainer div .teamCard div{
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: left;
            width: 100%;
        }

        #teamsContainer div .teamCard .cont-logo{
            padding: 50px 20px 40px 20px;
        }

        #teamsContainer div .teamCard .teamDetails{
            align-items: flex-start;
            background-color: #151515;
            padding: 20px 20px;
        }

        img{
            border-radius: 50%;
        }

        
    </style>
</head>
<body>
        <?php include 'navbar.php'; ?>
        <?php include 'anim.php'; ?>
        <section id="homePageContainer">
            <div class="titleCont" data-aos="fade-up" data-aos-duration="1000"> 
                    <img src="btnImages/vct icon colored.png" alt="vct icon">
                    <div>
                        <p>VALORANT</p>
                        <p>CHAMPIONS TOUR</p>
                        <div>
                            <a href="#teamsContainer">View Teams</a>
                        </div>
                    </div>
            </div>
        </section>
        <section id="teamsContainer" data-aos="fade-up" data-aos-duration="1000">
            <div class="vctTeamsCont">
                <h1>VCT TEAMS</h1>
            </div>
            
            <div class="team-cont">
                <?php
                    foreach ($root->childNodes as $teamNode) {
                        if ($teamNode->nodeType === XML_ELEMENT_NODE) {
                                $team_id =  $teamNode->getAttribute('id');
                                $logo = $teamNode->childNodes[0]->nodeValue;
                                $teamName = $teamNode->childNodes[1]->nodeValue;
                                $teamAbbrev = $teamNode->childNodes[2]->nodeValue;
                                $teamRegion = $teamNode->childNodes[3]->nodeValue;

                                $logo = urldecode($logo);
                                $teamName = urldecode($teamName);
                                $teamAbbrev = urldecode($teamAbbrev);
                                $teamRegion = urldecode($teamRegion);

                                echo "<a href='viewTeams.php?id=$team_id'>
                                        <div class='teamCard'>
                                            <div class='cont-logo'>
                                                <img src='$logo' alt='logo name'/>
                                            </div>
                                            <div class='teamDetails'>
                                                <p>$teamName ($teamAbbrev)</p>
                                                <p>$teamRegion</p>
                                            </div>
                                        </div>
                                    </a>";
                            }
                        }
                ?>
            </div>
            
        </section>
        <?php include 'footer.php'; ?>
        
</body>
         <script>
            window
            $(document).ready(function() {
                history.replaceState('index', 'index.php', window.location.pathname);
            });
         </script>               
</html>
