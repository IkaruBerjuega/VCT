<?php
    $id =  urlencode($_GET["id"]);
    
    
    
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
        

        if($root->childNodes->length > 1) $root->removeChild($teamNode);
        else $root->nodeValue = "\n";

        $xml->save("data.xml");
        
        sleep(2);
        
        // Redirect back to the previous page
        header("Location: edit.php");
        exit;
    
    }
?>