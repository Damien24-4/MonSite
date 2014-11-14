<?php

class Photo
	{
		public $ID = null;
		public $nom;
		public $chemin;
                public $IdCategorie;
                
                
               
                
                static function get($id)
                {
                    $query = "SELECT * FROM photo where ID_photo = '".$id."'";
                    BDD::getInstance()->prepareQuery($query);
                    $photos = BDD::getInstance()->executeQuery();
                    
                    
                    if(count($photos)==0)
                        return -1;
                    if(count($photos)>1)
                        return -2;
                    
                   
                    $photo = $photos[0];
                    
                    
                    
                    
                    $temp = new Photo();
                    $temp->ID = $photo["ID_photo"];
                    $temp->nom = $photo["nom"];
                    $temp->chemin = $photo["chemin"];
                    $temp->IdCategorie = $photo["ID_categorie"];

                    return $temp;
                    
                }
                
                static function create($nom,$chemin,$IdCategorie)
                {
                    $temp = new Photo();
                    $temp->nom = $nom;               
                    $temp->chemin = $chemin;
                    $temp->IdCategorie = $IdCategorie;

                    return $temp;
                    
                }
                
                static function createWithId($id,$nom,$chemin,$IdCategorie)
                {
                    $temp = new Photo();
                    $temp->ID=$id;
                    $temp->nom = $nom;               
                    $temp->chemin = $chemin;
                    $temp->IdCategorie = $IdCategorie;

                    return $temp;
                    
                }
                
                static function getAllPhotos()
                {
                    $query = "SELECT * FROM photo";
                    BDD::getInstance()->prepareQuery($query);
                    
                    
                    
                    $photos = BDD::getInstance()->executeQuery();
                    
                    
                    
                    
                    $all = array();
                    
                    
                    foreach ($photos as $photo)
                    {
                        array_push($all,self::createWithId($photo["ID"],$photo["nom"],$photo["chemin"]));
                    }
                    
                    
                    return $all;
                    
                }
                
                
                static function getAllPhotosByIdCategorie($idCategorie)
                {
                    $query = "SELECT * FROM photo where ID_Categorie='".$idCategorie."'";
                    BDD::getInstance()->prepareQuery($query);
                    
                    
                    
                    $photos = BDD::getInstance()->executeQuery();
                    
                    
                    $all = array();
                    
                    
                    foreach ($photos as $photo)
                    {
                                           
                        array_push($all,self::createWithId($photo["ID_photo"],$photo["nom"],$photo["chemin"],$photo["ID_categorie"]));
                    }
                    
                   
                    return $all;
                    
                }
                
                function save()
                {
                    
                    if($this->ID==null)
                    {
                        $query = "INSERT INTO photo(nom,chemin,ID_Categorie) values( ".
                            "'".$this->nom."',".
                            "'".$this->chemin."',".
                            $this->IdCategorie.")";
                            
                    }else
                    {
                       $query = "UPDATE photo set ".
                            "nom='".$this->nom."',".
                            "chemin='".$this->chemin."',".
                            "ID_Categorie='".$this->IdCategorie."'".
                            " where ID_photo=".$this->ID; 
                       
                       
                      
                       
                    }
                    
                   
                    
                    
                    BDD::getInstance()->prepareQuery($query);
                    $result = BDD::getInstance()->executeQuery();
                    
                    return $result;      
                    
                    
                }
                
                
                function delete()
                {
                     $query = "DELETE FROM Photo where ID_Photo='".$this->ID."'";
                     
                     BDD::getInstance()->prepareQuery($query);
                     $result = BDD::getInstance()->executeQuery();
                    
                     if($result):
                        // echo  "../../".$this->chemin;
                     unlink("../../".$this->chemin);
                     unlink("../../".str_replace("photos", "miniatures",$this->chemin));
                     endif;
                     
                     return $result;   
                            
                }
                
                
                
                
        }
