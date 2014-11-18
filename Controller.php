

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script type="text/javascript"  src="../script/jquery.min.js" ></script>
        <script type="text/javascript" src="../script/lightbox.js"></script>
        <script type="text/javascript" src="../script/jquery.dataTables.js"></script>
        <link  rel="stylesheet" href="../css/global.css" />
        <link  rel="stylesheet" href="../css/lightbox.css" />
        <link  rel="stylesheet" href="../css/jquery.dataTables.css" />
        <link href='http://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="../script/global.js"></script>
       
    </head>
    <body>
        <div id="global">
            
        
    <?php
    @session_start();
    
    global $trad, $url;
     $url = strtolower($_GET["key"]); 
     $lang = strtolower($_GET["lang"]); 
     
   
     
     
     $_SESSION["lang"]= $lang;
  
    
    $trad = simplexml_load_file("lang/lang_".$lang.".xml");

    
   

    require_once ("lang/lang_fr.php");
    require_once ("model/Photo.php"); 
    require_once("model/Categorie.php");
    require_once("model/BDD.php");   

    require_once("fonctions.php");


 
  

    include("vues/banner.php");
    include("vues/menu.php");
    
   
   
    
    
    switch($url)
    {
        case "accueil" :
            include("vues/accueil.php");
            break;
        case "presentation" :
            include("vues/presentation.php");
            break;
        case "galerie" :
            $categories = Categorie::getAllCategorie();
            
            include("vues/galerie.php");
            break;
        case "contact" :
            include("vues/contact.php");
            break;
        
        case "activites_locales":
        case "activites_militantes": 
            load($url);
            
            include("vues/activite.php");
            break;        
        case "activites" :
            
            include("vues/activite.php");
            break;

        case "traductions" :
            include("vues/traductions.php");
            break;
        case "bea" :
            include("vues/connexion.php");
            break;
        case "login" :
            
            if(loginAdmin())
                include("vues/accueil.php");
            else
            {
                 $error = TRUE;
                include("vues/connexion.php");
            }
               
            break;
        case "logout" :
            session_destroy(); 
            include("vues/accueil.php");
            break;

        default : break;

    }
    include("vues/footer.php");
    ?>
            </div>
    </body>
</html>


<?php


function loginAdmin()
{
   
    if(isset($_POST["login"]) && isset($_POST["mdp"]))
    {
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];

        if (strcmp($login, "louis") === 0 && strcmp($mdp, "louis") === 0) {
                $_SESSION["admin"] = TRUE;
            }

        else
        {
             $_SESSION["admin"] = FALSE;
        }
        
        return $_SESSION["admin"];
    }
    
    return FALSE;
    
        
}




?>