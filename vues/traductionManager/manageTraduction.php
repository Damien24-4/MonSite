<?php
@session_start();
 
header('Content-Type: application/json');


if(isset($_POST["key"]) && isset($_POST["text"]) )
{
    $newtext = $_POST["text"];   
    $key = $_POST["key"];
}
else
{
    echo -1;
    return;
}


$currentLang = $_SESSION["lang"];



 
$dom = new DOMDocument;
$dom->load("../../lang/lang_".$currentLang.".xml");

$textes = $dom->getElementsByTagName('text');
    foreach ($textes as $text) {
        if($text->getAttribute("key")==$key)
        {
            
            $text->nodeValue = $newtext;
        }
           
        
    }
$dom->save("../../lang/lang_".$currentLang.".xml"); 

echo json_encode(array('ok' => true));