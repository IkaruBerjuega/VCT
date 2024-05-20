<?php
$id = urlencode($_POST["id"]);
$teamName = urlencode($_POST["teamName"]);
$abbrev = urlencode($_POST["abbrev"]);
$region = urlencode($_POST["region"]);
$logo = urlencode($_POST["logo"]);




$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");
$root = $xml->documentElement;



$teamNode;
foreach ($root->childNodes as $data) {
    // Check if the node is an element node
    if ($data->nodeType === XML_ELEMENT_NODE) {
        $team_id = $data->getAttribute("id");
        if ($team_id == $id) {
            $teamNode = $data;
            break;
        }
    }
}

if(isset($teamNode)){
    $teamNode->childNodes[0]->nodeValue = $logo;
    $teamNode->childNodes[1]->nodeValue = $teamName; 
    $teamNode->childNodes[2]->nodeValue = $abbrev;
    $teamNode->childNodes[3]->nodeValue = $region;
    $xml->save("data.xml");
    
    sleep(2);

    // Redirect back to the previous page
    header("Location: edit.php");
    exit;

}


?>

