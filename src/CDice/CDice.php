<?php
class CDice {
    public $resultat_slag = 0;
    private $antal_slag = 0;
    public $score = 0;
    public $sparat = 0;
    
    
    public function __construct() {
        if (isset($_SESSION['score'])){
            $this->score = $_SESSION['score'];
        }
        if (isset($_SESSION['sparat'])){
            $this->score = $_SESSION['sparat'];
        }

       
    }    
   public function main(){
       $main_content= <<<EOD
            <h1>Spela 100!</h1>
            <p>Kasta tärningen och få 100 poäng! Slag på 2-6 ger 2-6 poäng, slår du en etta får du börja om.
            Trycker på stanna så är kommer de poäng du har att sparas. När du fortsätter spelet går
                du bara tillbaka till dina sparade poäng. 
            du spela med dina sparade poäng.
            </p>
  
EOD
             ; //end EOD             
        $main_content .= '<form method="get" action="">';
            $main_content .= '<input type="submit" value="Kasta tärningen" class="button left" name="dice_button"/>';
            $main_content .= '</form>';
            $main_content .= '<form method="get" action="">';
            $main_content .= '<input type="submit" value="Spara" class="button left" name="dice_stop"/>';
            $main_content .= '</form>';
            $main_content .= '<form method="get" action="">';
            $main_content .= '<input type="submit" value="Börja om" class="button left" name="reset"/>';
            $main_content .= '<div id="dice">';
            if (isset($_GET['dice_button'])){
                $this->resultat_slag = $this->sla_tarnining();
                $main_content .= "<ul class='dice'><li class='dice-$this->resultat_slag'></li>'</ul>\n";
                if ($this->resultat_slag==1){
                    $main_content .= "<br>Du slog en etta och förlorade dina poäng!<br>";
                    if (isset($_SESSION['saved'])){
                        $this->rensa_summan();
                        $this->score = $this->sparat;
                    }
                    else{
                        $this->rensa_summan();
                    }    
                }
                else{
                    $this->score += $this->resultat_slag;
                    $main_content .= "<br>Du slog  $this->resultat_slag<br>";
                }
                $main_content .= "<br>Summa $this->score<br>";
            }
            if ($this->score >=100){
                $main_content .= "<br>GRATTIS DU VANN!!!";
               // $this->ResetAll();
            }

            if (isset($_GET['dice_stop'])) {
                $this->sparat += $this->score;
                $this->sparat = $this->score;
            }

            if (isset($_GET['reset'])) {
                $this->rensa_summan();
                $this->resultat_slag = 0;
            }
                $main_content .= '<br><br>Sparat (startpunkt) ' .$this->sparat;

            $main_content .='</div>';


            
            
            
            
       return $main_content;
   }
   
   private function sla_tarnining(){
       return rand(1, 6);
   }   
   public function __destruct() {
        $_SESSION['score'] = $this->score;
   }
   private function rensa_summan(){       
        $this->score = 0;
   }
   
} // end class

