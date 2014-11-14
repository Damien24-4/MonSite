<?php

    class Contenu
    {
        private $mIdContenu;
        private $mContenu;
        private $mCategorie;
        private $mDate;

        public function __construct() 
        {
        }
        
        public static function loadByCateg($id)
        {
            $this->mCategorie = BDD::getInstance()->prepareQuery($query);
        }
        
        public function save()
        {
            
        }

        public function getIdContenu()
        {
            return $this->mIdContenu;
        }
        
        public function setIdContenu($id)
        {
            $this->mIdContenu = $id;
        }
        
        public function getContenu()
        {
            return $this->mContenu;
        }
        
        public function setContenu($contenu)
        {
            $this->mContenu = $contenu;
        }
        
        public function getCategorie()
        {
            return $this->mCategorie;
        }
        
        public function setCategorie($categorie)
        {
            $this->mCategorie = $categorie;
        }
        
        public function getDate()
        {
            return $this->mDate;
        }
        
        public function setDate($date)
        {
            $this->mDate = $date;
        }
    }
?>
