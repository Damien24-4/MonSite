<?php
@session_start();
 
header('Content-Type: application/json');

$currentLang = $_SESSION["lang"];

if(isset($_POST["action"]))
{
    $action = $_POST["action"];
}

switch ($action) {
    case "save":
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
        break;
    case  "getText" :
            if(isset($_POST["key"]))
            {
                $key = $_POST["key"];
            }
            else
            {
                echo -1;
                return;
            }
            $trad = simplexml_load_file("../../lang/lang_".$currentLang.".xml");
            $textReturn = "";
            $ok = false;
            foreach($trad as $categories){
                        foreach($categories as $text){
                            if($text["key"]==$key)
                            {  $textReturn= (string)$text;
                                $ok = true;
                                
                            }
                           
                        }


            } 
            echo json_encode(array("ok" => true,"text" => $textReturn));
            break;
    default:
        break;
}










