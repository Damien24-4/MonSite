<?php

    class Contenu
    {
        private $mIdContenu;
        private $mContenu;
        private $mCategorie;
        private $mDateAjout;
        private $mDateModif;

        public function __construct() 
        {
        }
        
        public static function loadByCateg($key)
        {
            $contenu = new Contenu();
            
            $contenu->setCategorie(Categorie::getByKey($key));
                    
            $query = 'SELECT co.ID_contenu, co.contenu, co.dateAjout, co.dateModif FROM categorie_contenu cc, contenu co WHERE cc.ID_catgorie=:idCateg AND co.ID_contenu = cc.ID_contenu';
            BDD::getInstance()->prepareQuery($query);
            $content = BDD::getInstance()->executeQuery(array(':idCateg' => $key));
            
            if(sizeof($content) > 0)
            {
                //echo '<pre>';print_r($content);echo '</pre>';
                $contenu->setIdContenu($content['ID_contenu']);
                $contenu->setContenu($content['contenu']);
                $contenu->setDateAjout(new DateTime($content['dateAjout']));
                $contenu->setDateModif(new DateTime($content['dateModif']));
            }
            
            return $content;
        }
        
        public function save()
        {
            $query = "INSERT INTO contenu(contenu) VALUES(:contenu)";
            BDD::getInstance()->prepareQuery($query);
            BDD::getInstance()->executeQuery(array(':contenu' => $this->mContenu));
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
        
        public function getDateAjout()
        {
            return $this->mDateAjout;
        }
        
        public function setDateAjout($date)
        {
            $this->mDateAjout = $date;
        }
        
        public function getDateModif()
        {
            return $this->mDateModif;
        }
        
        public function setDateModif($date)
        {
            $this->mDateModif = $date;
        }
    }
?>
