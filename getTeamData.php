<?php
// getData.php

// Retrieve the id from the POST request
$id =  urlencode($_POST['id']);

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

// Prepare data to send back
$response = array(
    'teamName' => urldecode($teamNode->childNodes[1]->nodeValue),
    'abbrev' => urldecode($teamNode->childNodes[2]->nodeValue) ,
    'region' => urldecode($teamNode->childNodes[3]->nodeValue),
    'logo' => urldecode($teamNode->childNodes[0]->nodeValue)
);

// Convert data to JSON and echo it
echo json_encode($response);
?>