<?php

$team_id =  htmlspecialchars($_GET['id']);
$memberID = $_GET['memberId']; // Corrected variable name

// Load XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");
$root = $xml->documentElement;

// Search for the team node with the given id
$teamNode;
foreach ($root->childNodes as $data) {
    if ($data->nodeType === XML_ELEMENT_NODE) {
        $team_id_ = $data->getAttribute("id");
        if ($team_id_ == $team_id) {
            $teamNode = $data;
            break;
        }
    }
}



$member_;
if (isset($teamNode)) {
    foreach ($teamNode->childNodes[4]->childNodes as $member) {
        $memId = $member->getAttribute("id");
        if ($memId == $memberID) {
            $member_ = $member;
            break;
        }
    }
}


$parentNode=$teamNode->childNodes[4];

if (isset($member_)) {

    
    if($root->childNodes->length > 1) $parentNode->removeChild($member_);
    else $root->nodeValue = "\n";

    $xml->save("data.xml");
    
    sleep(2);
    
    // Redirect back to the previous page
    header("Location: view.php?id=". urldecode($team_id));
    exit;
}



?>