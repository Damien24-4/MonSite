<?php
	class BDD
	{
		private static $Instance = null;
		private $mConnection;
		private $mQuery;
		
		public static function getInstance()
		{
			if(!isset(self::$Instance))
				self::$Instance = new BDD();
			return self::$Instance;
		}
		
		public static function destroy()
		{
			//Déconnexion
			//unset($Instance);
		}
		
		private function __construct()
		{
			$this->mConnection = new PDO('mysql:host=localhost;dbname=monsite', 'root', '');
                        
                    //$this->mConnection = new PDO('mysql:host=mysql2.000webhost.com;dbname=a5111254_poterie', 'a5111254_louis', 'louis1');
                        
                         $this->prepareQuery("SET NAMES 'UTF8'");
                         $this->executeQuery();
                        
		}
                
                
               
		
		private function __clone()
		{
		}
		
		public function __destruct()
		{
                    
		}
		
		public function prepareQuery($query)
		{
			$this->mQuery = $this->mConnection->prepare($query);
                        
                        
		}
		
		public function executeQuery($param = array())
		{
                    
                       
                    
			$paramSecure = array();
			foreach($param as $key=>$value)
			{
				$paramSecure[$key] = PDO::quote($value);
			}
			$res = $this->mQuery->execute($paramSecure);
                        
                        $chaine = explode(" ",$this->mQuery->queryString);
                        
                        
                        switch ($chaine[0])
                        {
                            case "SELECT":
                                return $this->mQuery->fetchAll();
                            case "INSERT":
                               return $this->mConnection->lastInsertId();
                            case "UPDATE":
                            case "DELETE" : 
                                return $res;
                            default :
                                return 0;
                                
                            
                        }
                       
		
			
		}
		
	}
