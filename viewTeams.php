<?php
    $id = urlencode($_GET["id"]);
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

        body{
            background-image: url(btnImages/background.png);
            background-repeat: repeat;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
            flex-direction: column;
        }

        .membersCont{
            display: grid;
            gap:2em;
            width: 100%;
            grid-template-columns: repeat(auto-fill, minmax(200px,1fr));
        }
        

        .memberView {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            background-color: rgba(60,60,60,.7);
        }

        .memberView:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .memberView img {
            width: 100%;
            height: 250px;
            border-bottom: 1px solid #ccc;
            object-fit: contain;
        }

        .memberView strong {
            display: block;
            font-weight: bold;
            padding: 10px 0;
        }

        .memberView p {
            padding: 10px 0;
        }

        .cont{
            display: flex;
            gap:20px;
            width: 85%;
        }

        .cont-column{
            display:flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap:10px;
        }

        .memberTitle{
            display: flex;
            width: 100%;
            justify-content: flex-start;
        }


        .memberTitle strong{
            font-size: 1.7rem;
        }

        .cont-column-members{
            display:flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
            flex-direction: column;
            width:85% ;
            gap:50px;
            padding: 30px 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            background-color: rgba(60,60,60,.5);
        }

        .details{
            gap:0px;
            align-items: flex-start;
            padding: 30px 50px;
        }

        .teamDetailsCont{
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            padding: 30px 50px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(60,60,60,.5);
        }

        .cont-column_{
        width: 100%;
        }

        #teamMembersSection{
            padding:70px 0px;
        }

        .memberImgCont{
            background-color: rgba(0, 0, 0, 0.2);
        }
        </style>
       
</head>
<body>
<?php include 'navbar.php'; ?>
<section id="teamMembersSection">
    <div class="container">
        <div class="teamDetailsCont cont">
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
        <div class="cont-column">
             <img src="<?php echo $logoImg; ?>" alt="" width="150px">
        </div>
        <div class="cont-column details">
             <b><?php echo $teamName; ?></b>
             <p><?php echo "Team-id: ". $teamId_."\n";?> </p>
             <p><?php echo "Abbreviation: ". $abbrev."\n";?> </p>
             <p><?php echo "Region: ". $region."\n";?> </p>
        </div>
       
        </div>
        
        <div class="cont-column-members">
                <div class="memberTitle">
                        <strong>Members</strong>
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
                                                <img src='$memberPortrait' alt='$memberName'/>
                                                <strong>$memberName</strong>
                                                <p>$memberIgn</p>
                                              </div>";
                                    }
                        }
                        ?>
                        </div>
                 </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
</body>
</html>
