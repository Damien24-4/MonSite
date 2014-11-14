<?php

class Image 
{
    protected $mUrl;
    protected $mWidth;
    protected $mHeight;
    protected $mExtension;

    public function __construct()
    {
        
    }
    
    public function createMiniature($widthMin=150, $heightMin=150)
    {
        
        
        
        
        $this->determineExtension();
        
        $imageBase = $this->createImageByExist();
        
      
      
        
        
        $this->mWidth = imagesx($imageBase);
        $this->mHeight = imagesy($imageBase);
        
        
        if($this->mWidth > $this->mHeight )
        {
            //$widthMin > $heightMin;
            $heightMin = ($widthMin * $this->mHeight)/$this->mWidth;
        }
        else
            $widthMin = ($heightMin * $this->mWidth)/$this->mHeight;
        
        

        $miniature = imagecreatetruecolor($widthMin, $heightMin);
        
        $dest = str_replace('/photos/', '/miniatures/', $this->mUrl);
        imagecopyresampled($miniature, $imageBase, 0, 0, 0, 0, $widthMin, $heightMin, $this->mWidth, $this->mHeight);

        $this->saveImage($miniature, $dest);
    }
    
    protected function determineExtension()
    {
        $this->mExtension = substr($this->mUrl, strrpos($this->mUrl, '.')+1);
    }
    
    protected  function createImageByExist()
    {
        $image = null;
        
        switch (strtolower($this->mExtension))
        {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($this->mUrl);
                break;
            case 'png':
                $image = imagecreatefrompng($this->mUrl);
                break;
            case 'gif':
                $image = imagecreatefromgif($this->mUrl);
                break;
        }
        
        return $image;
    }
    
    protected function saveImage($image, $dest)
    {
        switch (strtolower($this->mExtension))
        {
            case 'jpeg':
            case 'jpg':
                imagejpeg($image, $dest);
                break;
            case 'png':
                $image = imagepng($image, $dest);
                break;
            case 'gif':
                $image = imagegif($image, $dest);
                break;
        }
    }
    
    public function getmUrl()
    {
        return $this->mUrl;
    }
    
    public function setmUrl($url)
    {
        $this->mUrl = $url;
    }
}
