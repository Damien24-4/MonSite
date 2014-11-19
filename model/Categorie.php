<?php

    class Categorie
    {
        private $mIdCategorie = null;
	private $mCategorieKey;
//	public $photoss = array();
                
                
        static function getByKey($key)
        {
            $query = "SELECT * FROM categorie where categorie_key=:key";
            BDD::getInstance()->prepareQuery($query);
           
            $categs = BDD::getInstance()->executeQuery(array(':key' => $key));
//            echo $key.'<pre>';print_r($categs);echo '</pre>';
            $categ = $categs[0];
                    
            $temp = new Categorie();
            $temp->setIdCategorie($categ["ID_categorie"]);
            $temp->setCategorieKey($categ["categorie_key"]);
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
            return $this->mCategorieKey;
        }
        
        public function setCategorieKey($key)
        {
            $this->mCategorieKey = $key;
        }
    }

