<?php
@session_start();
 
header('Content-Type: application/json');


if(isset($_POST["action"]))
    $action = $_POST["action"];
else
{
    echo -1;
    return;
}

 $error = "";

 require_once ("../../model/upload.php");
 require_once ("../../model/Image.php");
 require_once ("../../model/Photo.php");
 require_once ("../../model/Categorie.php");

 require_once ("../../model/BDD.php"); 
 require_once ("../../lang/lang_fr.php");

 
switch ($action)
{
    case "addPhoto" : 
        
       if(isset($_POST["name"])):
           $name = $_POST["name"];
       endif;
       if(isset($_POST["idCateg"])):
         $idCateg = $_POST["idCateg"];
       endif;
        
        
        $upload = new Upload();
        $upload->setExtensions(array("jpeg", "jpg", "png", "gif"));
        $upload->setSize(1000);
        $files = $upload->upload($_FILES);
        $key = key($files);
        
        $image = new Image();
        $image->setmUrl($files[$key]['path']);
        $image->createMiniature();
        
        
        $photo = Photo::create($name, substr($files[$key]['path'],6),$idCateg);
        $categ = Categorie::get($idCateg);
        $id = (int)$photo->save();
        
        
        if(is_int($id))
        {
            $photo->ID =$id;
            $result = true;
        }
        else
        {
            $error = "probleme interne";
            $result = false;
        }
        
        ob_start();
        require("../photoView.php");
        $view= ob_get_clean();
         
       //  $view = requireToVar("../photoView.php") ;
         
         echo json_encode(array('ok' => $result,"error" => $error,"photo" => $view ));
         
        

  /*       if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../../images/photo/' . $_FILES['file']['name']);
    }*/
        
        
        //echo "adding a file ! ";
        return;
    case "updatePhoto" : 
       if(isset($_POST["idPhoto"]) && isset($_POST["name"]) && isset($_POST["idCateg"])):
           $idPhoto = $_POST["idPhoto"];
           $name = $_POST["name"];
           $idCateg = $_POST["idCateg"];
      else:
          $error = "un champ n'est pas renseigné";
          return;
      endif;
       $photo = Photo::get($idPhoto);
       $photo->nom = $name;
       $photo->IdCategorie = $idCateg;
       
       
       if(count($_FILES)>0)
       { 
           $upload = new Upload();
        $upload->setExtensions(array("jpeg", "jpg", "png", "gif"));
        $upload->setSize(1000);
        $files = $upload->upload($_FILES);
        $key = key($files);
        
        $image = new Image();
        $image->setmUrl($files[$key]['path']);
        $image->createMiniature();
        
        
         $photo->chemin = substr($files[$key]['path'],6);
       }
       
       
       
       $result = $photo->save();
       $categ = Categorie::get($idCateg);
       
        ob_start();
        require("../photoView.php");
        $view= ob_get_clean();
       
       echo json_encode(array('ok' => $result,"error" => $error,"photo" => $view ));
       
       
        return;
    case "delete" : 
        if(isset($_POST["id"])):
           $idPhoto = $_POST["id"];
       else:
          echo " error";
           
       endif;
       
           $result = Photo::get($idPhoto);
           
           
           if(is_int($result))
           {
               $error  = "une erreur interne est apparu";
               $result = FALSE;
           }
           else
           {
               
               $result = $result->delete();
               
           }
     
       
        if(!$result)
        {
           $error  = "une erreur interne est apparu" ;
        }
       
        echo json_encode(array('ok' => $result,"error" => $error));
        return;
    default : 
        echo "default";
}




