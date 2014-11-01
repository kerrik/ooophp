<?php

/**
 * 
 * Skapar tangoobjektet
 * 
 */

class CTango{
    // Först lite settings för hela <head>
    private $lang = "sv";
    private $favicon = "";
    private $style = array("css/style.css");
    
    private $modernizr = 'js/modernizr.js';
    private $jquery = '';
    private $javascript_include = array();
    private $google_analytics = false;


    private $title = "";
    private $title_append = "";
    private $logo = "img/logo.jpg";
    
    // Här kommer variablerna för sidinnehåll
    
    private $header = "";
    private $main = "";
    private $footer = "";
    private $side = array(); 
    
    
    public function __construct(){
        $this->set_property('favicon', 'favicon.ico');
        $this->set_property('jquery', false);
    }
    
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
        if(!$this->header){
            $this->header = "<img class='sitelogo left' src=' $this->logo' alt=''/>";
            $this->header .= "<div class='sitetitle left'>$this->title</div>";
            $this->header .= "<div class='siteslogan left'>$this->title_append</div>";
        }
        return $this->header;        
    } 
    public function main(){
        return $this->main;        
    }
    public function footer(){
        return $this->footer;        
    } 
    public function head(){
    $head  = <<<EOD
         <html class='no-js' lang="$this->lang">
        <head>
        <meta charset='utf-8'/>
        <title>$this->title</title>
        $this->favicon        
EOD
    ;
    foreach($this->style as $val){
        $head .= "<link rel='stylesheet' type='text/css' href='$val'/>\n";
    }
    if($this->modernizr){
        $head .= <<<EOD
           <script src='$this->modernizr'></script>
EOD
        ;
    }
    $head .= '</head>';
     return $head;
    }
    
    
    public function scripts_footer(){
        $scripts_footer = $this->jquery;
        if(isset($this->javascript_include)){
            foreach($this->javascript_include as $val){
                $scripts_footer .= "<script src='$val'></script>";
            }   
        }
        if($this->google_analytics){
            $scripts_footer .=<<<EOD
                    <script>
                    var _gaq=[['_setAccount','$this->google_analytics'],['_trackPageview']];
                    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                    s.parentNode.insertBefore(g,s)}(document,'script'));
                    </script>
                    
EOD
            ; // endif
        }
        return $scripts_footer;
}
    
     public function set_property($property, $value){
        switch ($property){ 
            case 'lang':
                $this->lang =$value; 
                break;
            case 'favicon':
                $this->favicon = (file_exists($value)? "<link rel='shortcut icon' href='favicon.ico'/>\n" : "");
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
            case 'modernizr':
                $this->modernizr =$value; 
                break;
            case 'jquery':
                $this->jquery =($value?"<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'></script>\n":""); 
                break;
            case 'javascript_include':
                $this->javascript_include =$value; 
                break;
            default:
                echo 'Värdet finns inte';
        }
        
    }
    
    public static function menu($items) {
        $id = (!$items['id']?'pagemenu':$items[id]);
        $vertical= ($items['vertical']?'<br>':'');
        $html = "<nav id='$id'>\n";
        foreach($items['choise'] as $item) {
          $html .= "<a href='{$item['url']}'>{$item['text']}</a>$vertical\n";
        }
        $html .= "</nav>\n";
        return $html;
  }
}
