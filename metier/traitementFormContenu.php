<?php 
    session_start();
    require_once('../fonctions.php');
    require_once ('../model/Contenu.php');
    require_once ('../model/BDD.php');
    
    $trad = simplexml_load_file("../lang/lang_".$_SESSION["lang"].".xml");

    if(IsAdmin())
    {
        if(isset($_POST) && sizeof($_POST) > 0)
        {
            foreach($_POST as &$value) // on sécurise
                ;
            
            $contenu = new Contenu();

            switch($_POST['action'])
            {
                case  'edit':
                case 'add':
                    $contenu->setContenu($_POST['contenu']);
                    $contenu->save();
                    break;

            }
        }
    }
    else
    {
        
    }
?>