<?php
// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");

// Get the root element
$root = $xml->documentElement;


//automate team_id 
$memId = 0;
$team_id= 0;
foreach ($root->childNodes as $teamNode) {
    $tempId =  $teamNode->getAttribute("id");
    $number = filter_var($tempId, FILTER_SANITIZE_NUMBER_INT);
    if ($number>$team_id) {
        $team_id = $number;
    }
}

$team_id++;
$team_id = "t" . $team_id;

// Retrieve form data
$teamName =  urlencode($_POST['teamName']);
$abbrev =  urlencode($_POST['abbrev']);
$region =  urlencode($_POST['region']);
$logo =  urlencode($_POST['logo']);

// Retrieve member details
// Retrieve member details
$memberNames = array_map('urlencode', $_POST['memberName']);
$ignNames = array_map('urlencode', $_POST['ignName']);
$profiles = array_map('urlencode', $_POST['profile']);




function isFirstCharInteger($string) {
    // Check if the string is not empty
    if ($string === "") {
        return false;
    }

    // Get the first character of the string
    $firstChar = $string[0];

    // Check if the first character is a digit
    return is_numeric($firstChar) && ctype_digit($firstChar);
}


$IdPrepend;
if (isFirstCharInteger($abbrev)){
$IdPrepend="X".$abbrev;
}
else{
$IdPrepend=$abbrev;
}

$membersXml = '';
for ($i = 0; $i < count($memberNames); $i++) {
    $memberId = $IdPrepend . ($i + 1);
    $membersXml .= "<member id='$memberId'>
                        <name>{$memberNames[$i]}</name>
                        <ign>{$ignNames[$i]}</ign>
                        <portrait>{$profiles[$i]}</portrait>
                    </member>";
}

// Generate XML for team details
$newData = "<team id='$team_id'>
                <logo>{$logo}</logo>
                <teamname>{$teamName}</teamname>
                <abbreviation>{$abbrev}</abbreviation>  
                <region>{$region}</region>
                <members>{$membersXml}</members>
            </team>";

// Replace existing team node with new data

$xmlString = file_get_contents("data.xml");

$newXml = preg_replace('/<\\/vct>/', $newData . "\n". '</vct>', $xmlString);

file_put_contents("data.xml", $newXml);


sleep(2);

// Redirect back to the previous page
header("Location: edit.php");
exit;

?>
