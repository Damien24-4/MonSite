<?php

class Categorie
	{
		public $ID = null;
		public $nom;
		public $photoss = array();
                sdfghjikop
                
                static function get($id)
                {
                    $query = "SELECT * FROM categorie where ID_categorie = '".$id."'";
                    BDD::getInstance()->prepareQuery($query);
                    $categs = BDD::getInstance()->executeQuery();
                    
                   $categ = $categs[0];
                    
                    $temp = new Categorie();
                    $temp->ID = $categ["ID_categorie"];
                    $temp->nom = $categ["nom"];
                    //$temp->photos = Photo::getAllPhotosByIdCategorie($categ["ID_categorie"]);
                    

                    return $temp;
                    
                }
                
                
                static function createWithId($id,$nom)
                {
                    $temp = new Categorie();
                    $temp->ID=$id;
                    $temp->nom = $nom;               
                   
                    $temp->photos = Photo::getAllPhotosByIdCategorie($id);

                    
                   
                    
                    return $temp;
                    
                }
                
                
                static function getAllCategorie()
                {
                    $query = "SELECT * FROM categorie";
                    BDD::getInstance()->prepareQuery($query);
                    $categs = BDD::getInstance()->executeQuery();
                    
                   
                    
                    $all = array();
                    
                    
                    foreach ($categs as $categ)
                    {
                        array_push($all,self::createWithId($categ["ID_categorie"],$categ["nom"]));
                    }
                    
                    

                    return $all;
                    
                }
                
                
        }

