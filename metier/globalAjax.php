<?php
@session_start();
 
header('Content-Type: application/json');



if(isset($_POST["action"]))
{
    $action = $_POST["action"];
}

switch ($action) {
    case "updateSessionVar" :
        try{
        if(isset($_POST["key"]) && isset($_POST["value"]))
        {
            $key = $_POST["key"];
            $value = $_POST["value"];
        }
         UpdateSessionVar($key,$value);
        } catch (Exception $ex) {
             echo json_encode(array('ok' => false));
        }
        echo json_encode(array('ok' => $_SESSION[$key]));
        break;
        
    return;

}

function UpdateSessionVar($key,$value)
{
    $_SESSION[$key]=$value;
}

