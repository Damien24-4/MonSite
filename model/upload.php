<?php
    
    require_once('../../fonctions.php');
   
    class Upload
    {
        static protected $URL_BASE = '../../images/photos/';

        protected $mExtensions;
        protected $mUrl;
        protected $mSize;
        protected  $mFiles;
        
        public function __construct()
        {
            $this->mExtensions = array();
            $this->mUrl = '';
            $this->mSize = 0;
            $this->mFiles = array();
        }

        public function upload($files)
        {
            foreach($files as $key => $value)
            {
                $this->mFiles[$key] = array();

                if(mb_strlen($value['name']) > 0)
                {
                    $value['name'] = cleanChaine($value['name']);
                    $extension = strtolower(substr($value['name'], strrpos($value['name'], '.')+1));

                    if(in_array($extension, $this->mExtensions))
                    {
                        if(filesize($value['tmp_name']) > $this->mSize)
                        {
                            $dest = self::$URL_BASE.$value['name'];
                            $this->mFiles[$key]['path'] = $dest;

                            if(move_uploaded_file($value['tmp_name'], $dest))                            
                                $this->mFiles[$key]['error'] = NONE;
                            else
                                $this->mFiles[$key]['error'] = FILE_MOVE_UPLOAD_ERROR;
                        }
                        else
                            $this->mFiles[$key]['error'] =  FILE_SIZE_ERROR;
                    }
                    else
                        $this->mFiles[$key]['error'] =  FILE_TYPE_ERROR;
                    
                }
                else
                    $this->mFiles[$key]['error'] = FILE_NAME_ERROR;
            }
            
            return $this->mFiles;
        }
        
        public function getExtensions()
        {
            return $this->mExtensions;
        }
        
        public function  setExtensions($extensions)
        {
            $this->mExtensions= $extensions;
        }
        
        public function getUrl()
        {
            return $this->mUrl;
        }
        
        public function  setURL($url)
        {
            $this->mUrl = $url;
        }
        
        public function getSize()
        {
            return $this->mSize;
        }
        
        public function  setSize($size)
        {
            $this->mSize = $size;
        }
    }
    
?>
