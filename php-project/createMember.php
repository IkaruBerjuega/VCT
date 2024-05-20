<?php
function isFirstCharInteger($string) {
    if ($string === "") {
        return false;
    }
    return is_numeric($string[0]) && ctype_digit($string[0]);
}

// Load the XML file
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->load("data.xml");

// Get the root element
$root = $xml->documentElement;

// Retrieve form data
$teamId =  urlencode($_POST['team_id']);
$name =  urlencode($_POST['memberName']);
$IGN =  urlencode($_POST['memberIgn']);
$profileURL =  urlencode($_POST['memberPortrait']);



// Identify the correct team node
$teamNode = null;
foreach ($root->getElementsByTagName('team') as $team) {
    if ($team->getAttribute("id") == $teamId) {
        $teamNode = $team;
        break;
    }
}

// Determine the new member ID
$abbrev = $teamNode->getElementsByTagName('abbreviation')->item(0)->nodeValue;
$idAppend = 0;
foreach ($teamNode->getElementsByTagName('member') as $member) {
    $memid_ = $member->getAttribute("id");
    $number = filter_var($memid_, FILTER_SANITIZE_NUMBER_INT);
    if ($number > $idAppend) {
        $idAppend = $number;
    }
}
$idAppend++;

$memberId = isFirstCharInteger($abbrev) ? "X{$abbrev}{$idAppend}" : "{$abbrev}{$idAppend}";

// Construct the new member XML string
$newMemberXml = "
    <member id='{$memberId}'>
        <name>{$name}</name>
        <ign>{$IGN}</ign>
        <portrait>{$profileURL}</portrait>
    </member>
";

// Insert the new member using preg_replace
$xmlString = file_get_contents("data.xml");

// Find the correct place to insert the new member XML
$teamStartPos = strpos($xmlString, "<team id=\"{$teamId}\">");
$membersEndPos = strpos($xmlString, "</members>", $teamStartPos);

$newXmlString = substr_replace($xmlString, $newMemberXml, $membersEndPos, 0);

// Save the updated XML back to the file
file_put_contents("data.xml", $newXmlString);

// Optional: Add a slight delay and redirect back to the previous page
sleep(2);
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
