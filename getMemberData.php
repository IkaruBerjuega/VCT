<?php
// getData.php

// Retrieve the id from the POST request
$id =  urlencode($_POST['id']);
$memberID = urlencode($_POST['memberId']); // Corrected variable name

// Load XML file
$xml = new DomDocument();
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");
$root = $xml->documentElement;

// Search for the team node with the given id
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

$member_;
if (isset($teamNode)) {
    foreach ($teamNode->getElementsByTagName('member') as $member) {
        $name = $member->getAttribute("id");
        if ($name == $memberID) {
            $member_ = $member;
            break;
        }
    }
}

if (isset($member_)) {
    $response = array(
        'name' => urldecode($member_->getElementsByTagName('name')->item(0)->nodeValue),
        'ign' => urldecode($member_->getElementsByTagName('ign')->item(0)->nodeValue),
        'portrait' => urldecode($member_->getElementsByTagName('portrait')->item(0)->nodeValue)
    );
    echo json_encode($response);
} else {
    // Handle case where member is not found
    echo json_encode(array('error' => 'Member not found'));
}
?>
