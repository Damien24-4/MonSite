<?php

    class Categorie
    {
        private $mIdCategorie = null;
	private $mKey;
//	public $photoss = array();
                
                
        static function get($id)
        {
            $query = "SELECT * FROM categorie where ID_categorie = '".$id."'";
            BDD::getInstance()->prepareQuery($query);

            $categs = BDD::getInstance()->executeQuery();

            $categ = $categs[0];
                    
            $temp = new Categorie();
            $temp->setIdCategorie($categ["ID_categorie"]);
            $temp->setKey($categ["key"]);
            //$temp->photos = Photo::getAllPhotosByIdCategorie($categ["ID_categorie"]);
                    
            return $temp;
                    
        }
                
                
        static function createWithId($id, $key)
        {
            $temp = new Categorie();
            $temp->setICategorie($id);
            $temp->setKey($key);               
                   
            //$temp->photos = Photo::getAllPhotosByIdCategorie($id);   
            return $temp;
                    
        }
                
                
        static function getAllCategorie()
        {
            $query = "SELECT * FROM categorie";
            BDD::getInstance()->prepareQuery($query);
            $categs = BDD::getInstance()->executeQuery();
            
            $all = array();
                    
                    
            foreach ($categs as $categ)
                array_push($all,self::createWithId($categ["ID_categorie"],$categ["nom"]));

            return $all;
        }
                
        public function getIdCategorie()
        {
            return $this->mIdCategorie;
        }
        
        public function setIdCategorie($id)
        {
            $this->mIdCategorie = $id;
        }
        
        public function getKey()
        {
            return $this->mKey;
        }
        
        public function setKey($key)
        {
            $this->mKey = $key;
        }
    }

