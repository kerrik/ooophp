<?php
class CDice {
    private $slag = array('', '');
    private $spelare = array();
    
    public function __construct() {
        if( isset( $_GET['rensa'])){
            $_SESSION['spelare'] = null;}
        
        if(isset( $_SESSION['spelare']) && !isset($_GET['rensa'])){
            $this->spelare = unserialize($_SESSION['spelare']);
        }else{
            $this->spelare[] =array( 'jag');
            $this->spelare[] =array( 'du');
        }
        $foo= (isset( $_GET['spelare'])?$this->slag($_GET['spelare']):'');
    }
    
    
    public function monitor($spelare=0){
        $return = '';
        foreach ( $this->spelare[$spelare] as $slag){
            $return .= "$slag<br>";
        }
        return $return;
    }
    
    public function slag($spelare){
        $this->spelare[$spelare][] = rand(1,6);
    }
    
                
    
    public function __destruct(){
        $_SESSION['spelare'] = serialize($this->spelare);
    }
} // end class



   