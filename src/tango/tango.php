<?php

/**
 * 
 * Skapar tangoobjektet
 * 
 */

class CTango{
    // Först lite settings för hela siten
    private $lang = "sv";
    private $favicon = "favicon.ico";
    private $style = "css/style.css";
    
    private $title = "";
    private $title_append = "";
    private $logo = "img/logo.jpg";
    
    // Här kommer variablerna för sidinnehåll
    
    private $header = "";
    private $main = "";
    private $footer = "";
    private $side = array(); 
    
    
    
    public function lang(){
        return $this->lang;        
    }
     public function favicon(){
        return $this->favicon;        
    } 
    public function style(){
        return $this->style;        
    } 
    public function title(){
        return $this->title;        
    } 
    public function title_append(){
        return $this->title_append;        
    } 
    public function logo(){
        return $this->logo;        
    } 
    public function header(){
        return $this->header;        
    } 
    public function main(){
        return $this->main;        
    }
    public function footer(){
        return $this->footer;        
    } 
    
     public function set_property($property, $value){
        switch ($property){ 
            case 'lang':
                $this->lang =$value; 
                break;
            case 'favicon':
                $this->favicon =$value; 
                break;
            case 'style':
                $this->style =$value; 
                break;
            case 'title':
                $this->title =$value; 
                break;
            case 'title_append':
                $this->title_append =$value; 
                break;
            case 'logo':
                $this->logo =$value; 
                break;
            case 'header':
                $this->header =$value; 
                break;
            case 'main':
                $this->main =$value; 
                break;
            case 'footer':
                $this->footer =$value; 
                break;
            case 'side':
                $this->side =$value; 
                break;
            default:
                echo 'Värdet finns inte';
        }
        
    }
}
