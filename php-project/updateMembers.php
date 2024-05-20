<?php
// getData.php

// Retrieve the id from the POST request
$team_id = urlencode($_POST['team_id']);
$mem_id =  urlencode($_POST['mem_id']);
$memberName =  urlencode($_POST['memberName']); // Corrected variable name
$memberIgn =  urlencode($_POST['memberIgn']);
$memberPortrait =  urlencode($_POST['memberPortrait']);

echo $id;

// Load XML file
$xml = new DomDocument();
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
    foreach ($teamNode->getElementsByTagName('member') as $member) {
        $memid_ = $member->getAttribute("id");
        if ($memid_ == $mem_id) {
            $member_ = $member;
            break;
        }
    }
}

if (isset($member_)) {
        $member_->childNodes[0]->nodeValue = $memberName;
        $member_->childNodes[1]->nodeValue = $memberIgn;
        $member_->childNodes[2]->nodeValue = $memberPortrait;
        $xml->save("data.xml");
        sleep(2);

        // Redirect back to the previous page
        header("Location: viewMembers.php?id=".urlencode($team_id));
        exit;
    
}
else{
    echo "not found";
}
?>
