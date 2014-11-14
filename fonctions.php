<?php



function IsAdmin()
{
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]==TRUE)
        return TRUE;
    return FALSE;
}


function cleanChaine($string, $charset='UTF-8')
{
   $string = htmlentities($string, ENT_NOQUOTES, $charset);
    
   $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
   $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string);
   $string = preg_replace('#&[^;]+;#', '', $string);
    
   return $string;
}




function requireToVar($file){
    ob_start();
    require($file);
    return ob_get_clean();
}


function getTrad($key)
{
    global $trad;
    
    
    foreach($trad as $categories){
                foreach($categories as $text){
                    if($text["key"]==$key)
                        return $text;
                }
                
                
}

    return "";
}

function getAllTraductions()
{
    global $trad;
    
    
    $trads = array();
    
     foreach($trad as $categories){
         $categ = array();
         
         
         
         
         foreach($categories as $text){
                   
                   
             
             
                   $categ[(string)$text["key"]]=(string)$text;
                   
                   
                   
                }
         
         $trads[(string)$categories['key']] = $categ;
         
         
     }
                
    return $trads;
    
}

