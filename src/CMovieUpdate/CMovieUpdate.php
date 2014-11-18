<?php


class CMovieUpdate {
       public $html = '';
    
    public function __construct() {
        $this->show_update();
    }
    
    private function show_update(){
        global $movie;
         $sql = "SELECT * FROM Movie WHERE id=?";
        $param = array( $_GET['update']);
        $result = $movie->query_DB($sql, $param);
        $result = $result[0];
        
        $this->html .=  "<div class='text'>" ;
        $this->html .=  "<h1>Updatera en post</h1>";

        $this->html .= <<<EOD
            <form method="post">
            <fieldset>
EOD
        ; //end main_content
        $this->html .= " <div class='left clear_right'><input type='hidden' name='id' value='" . $result->id . "'>";

        $this->html .= " <p><label class='label left' for='rubrik'>Titel:</label>"
                . "<input type='text' class='input left' name='rubrik' value='" . $result->title . "'></p>";    
        $this->html .= " <p><label class='label left' for='director'>Regissör:</label>"
                . "<input type='text' class='input left' name='director' value='" . $result->director . "'></p>";    
        $this->html .= " <p><label class='label left' for='year'>År:</label>"
                . "<input type='text' class='input left' name='year' value='" . $result->YEAR . "'></p>";    
        $this->html .= " <p><label class='label left' for='speech'>Språk:</label>"
                . "<input type='text' class='input left' name='speech' value='" . $result->speech . "'></p>";
        $this->html .= " <p><label class='label left' for='image'>Bild:</label>"
                . "<input type='text' class='input left' name='image' value='" . $result->image . "'></p>";
        $this->html .= " <p><label class='label left' for='plot'>Handling:</label></p>"
                . "<p><textarea   class='plot left' name='plot'>" . $result->plot . "</textarea></p></div>";
        $this->html .=  <<<EOD
            <div class='left clear_left'><input type="submit" name="saveFile" value="Spara" >
              <input type="reset" value="Ångra"></div>
            </p>

          </fieldset>
            </form>
EOD
        ;// end EOD
    } //end show_update 
}
