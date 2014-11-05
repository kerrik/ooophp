<?php
class CDice {
    private $slag = array('', '');
    private $spelare = "";
    private $antal_spelare = 0;
    private $aktiv_spelare = 1;
    private $rond="1";
    private $dump;
    
public function __construct() {
        if( isset( $_GET['rensa'])){
            $this->rensa_variabler();
        }
        
        if(isset( $_SESSION['spelare']) && !isset($_GET['rensa']) && $_SESSION['antal_spelare']){
            $this->hamta_data_fran_sesson();
        }elseif (isset($_GET['antal'])){
            $this->startvarden_for_variabler();
        }  else {
            
            $_SESSION['spelare'] = null ;
            $_SESSION['aktiv_spelare'] = null;  
            $_SESSION['antal_spelare']=  null;
            $_SESSION['slag']=  null;
            $_SESSION['rond'] = 1;
            $_SESSION['pass']= false;
        }
        if(isset($_GET['slag']) && $_SESSION['slag']){
            $this->slag();
        }
        //dump($_SESSION    );
       //print_a($this->spelare);*/
    }
    
    private function rensa_variabler(){
            session_unset();
            $_SESSION['spelare'] = null;
            $_SESSION['antal_spelare']=null;
            $_SESSION['slag']=null; 
    }
    
    private function hamta_data_fran_sesson(){
        $this->spelare = unserialize($_SESSION['spelare']);
        $this->rond= $_SESSION['rond'];
        if(isset($_SESSION['aktiv_spelare'])){
            $this->aktiv_spelare = $_SESSION['aktiv_spelare'];
        }  else {
            $this->aktiv_spelare=1;
        }
    }
    private function startvarden_for_variabler(){
        $this->spelare[1] =array( 'namn' =>'Gron','total'=>0, 'pass'=> null , 'slag'=> array(1,2,4,3,6,5));
        $this->spelare[2] =array( 'namn'=>'Rod', 'total'=>0, 'pass'=> null , 'slag'=> array(2,4,2,3,6,2));
        $this->spelare[3] =array( 'namn' =>'Bla','total'=>0, 'pass'=> null , 'slag'=> array(5,4,6,7,3,1));
        $this->spelare[4] =array( 'namn'=>'Gul', 'total'=>0, 'pass'=> null , 'slag'=> array(6,6,6,4,5,3));
        $this->aktiv_spelare = 1;
        $_SESSION['antal_spelare']= $_GET['antal'];
    }


    public function monitor(){
        if ($_GET['slag']==0){            
            $return=  "<h2>Du valde att passa. Det går bra, men du måste spela nästa omgång.</h2>";
        }else{
           $return=  $this->spelare_slår();
            $_SESSION['pass'] = false;                    
        }
        $return .= "<p><a href='dice_play.php?p=dice'>Fortsätt</a></p>";
        $this->uppdatera_diverse_variabler();
        return htmlentities($return);
    }
    
    public function spelare_slar(){        
        $alla_slag=$this->spelare[$this->aktiv_spelare]['slag'][$this->rond -1]; 
        
       // print_a($alla_slag);
        $summa_ronder=0;
        $listar_ronder='';
        $summa_slag = array_sum($alla_slag);
        $return = "<ul class='dice'>";
        foreach ( $alla_slag as $rond){            
           $return .= "<li class='dice-$rond'></li>\n";
        }
        $return .= '</ul><h3>Du fick ' . $summa_slag . ' poäng den här ronden</h3>';
        $return .= "<h3>Du har nu " .$this->spelare[$this->aktiv_spelare]['total'] . " poäng</h3>";
        return ($return);
    }
    
    private function uppdatera_diverse_variabler(){
        if(!$_SESSION['slag']){
            $this->aktiv_spelare= ($this->aktiv_spelare< $_SESSION['antal_spelare']?  ++$this->aktiv_spelare:1);  
            $_SESSION['rond'] = ($this->aktiv_spelare == $_SESSION['antal_spelare']? ++$_SESSION['rond']:$_SESSION['rond']);
        }
    }
    
    private function slag(){
        $slag=array();
        for ($i=0; $i<$_GET['slag']; ++$i){
            $slag[]= rand(1,6);
            
        }
        
        $this->spelare[$this->aktiv_spelare]['total'] += array_sum($slag) ;
        $this->spelare[$this->aktiv_spelare]['slag'][] = $slag ;
    }
    
 
    public function player(){
        return $this->spelare[$this->aktiv_spelare]['namn'];
    }
    
    public function rond(){
        return $this->rond;
    }
    public function passa(){
        $pass= ($_SESSION['pass']?' STYLE="visibility: hidden"':'');
    }               
    
    public function __destruct(){
        $_SESSION['spelare'] = serialize($this->spelare);
        $_SESSION['slag']=(isset($_GET['slag']) && $_SESSION['slag']?false:true);
        $_SESSION['aktiv_spelare']= $this->aktiv_spelare;
    }
   
} // end class



   