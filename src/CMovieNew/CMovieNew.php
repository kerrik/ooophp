<?php


class CMovieNew {
       public $html = '';
       private $new_movie = array();
               
    
    public function __construct() {
        $this->new_movie['title'] = null;
        $this->new_movie['director'] = null;
        $this->new_movie['value'] = null;
        $this->new_movie['length'] = null;
        $this->new_movie['year'] = null;
        $this->new_movie['plot'] = null;
        $this->new_movie['image'] = null;
        $this->new_movie['subtext'] = null;
        $this->new_movie['speech'] = null;
        $this->new_movie['id'] = null;
        $this->new_movie['genre'] = 'ej satt';
        
        if ( isset($_POST['new_post'])){ $this->new_post();}
        $this->show_new();
    }
    
    private function show_new(){
        $result = $this->new_movie;
        
        $this->html .=  "<div class='text'>" ;
        $this->html .=  "<h1>Skapa ny film</h1>";
        
        $genres_checked= explode(",", $result['genre']);
        
        $this->html .= <<<EOD
            <form method="post">
            <fieldset>
EOD
        ; //end main_content
        $this->html .= " <div class='left clear_right'><input type='hidden' name='id' value='{$result['id']}'>";

        $this->html .= " <p><label class='label left' for='rubrik'>Titel:</label>"
                . "<input type='text' class='input left' name='rubrik' value=' {$result['title']} '></p>";    
        $this->html .= " <p><label class='label left' for='director'>Regissör:</label>"
                . "<input type='text' class='input left' name='director' value='{$result['director']}'></p>";    
        $this->html .= " <p><label class='label left' for='year'>År:</label>"
                . "<input type='text' class='input left' name='year' value='{$result['year']}'></p>";    
        $this->html .= " <p><label class='label left' for='speech'>Språk:</label>"
                . "<input type='text' class='input left' name='speech' value='{$result['speech']}'></p>";
        $this->html .= " <p><label class='label left' for='image'>Bild: (utan mapp)</label>"
                . "<input type='text' class='input left' name='image' value='{$result['image']}'></p>";
        $this->html .= " <p><label class='label left' for='plot'>Handling:</label></p>"
                . "<p><textarea   class='plot left' name='plot'>{$result['plot']}</textarea></p></div>";
        $this->html .= $this->show_radiobutton_gengre($genres_checked);
        $this->html .= <<<EOD
                <div class='left clear_left'><input type="submit" name="new_post" value="Spara" >
              <input type='reset' value='Ångra'></div>
            </p></fieldset>
            </form>
EOD
        ;// end EOD
        
        
        $this->html .= "<div class='right bottom_links'>";
        $this->html .=  (isset($_SESSION['user']) ? "<a class='left' href='movie.php?'>"
                                        .   "<img src='img/home.png' alt='home'></a>" : "" );
        $this->html .= "</div><!-- end bottom_links -->";
          
    } //end show_new 

    private function show_radiobutton_gengre($genres_checked){
        global $movie;
        $genres = $movie->get_genre();
        $return = "<b>Genrer:</b><br>";
        
        foreach($genres as $id => $genre){
            $checked = in_array($genre->name, $genres_checked) ? ' checked' : '';
            $return .= "<input type='checkbox' name='genre[]' value='{$genre->id}'{$checked}>" . ucfirst($genre->name) . "<br>";            
        }// end foreach
        
        return $return;
        
    } // end show_radiobutton_gengre()
    
    private function new_post(){
        global $movie;
        $parameter['value'][] = $_POST['rubrik'];
        $parameter['value'][] = $_POST['director'];
        $parameter['value'][] = 'test';
        $parameter['value'][] = $_POST['year'];
        $parameter['value'][] = $_POST['plot'];
        $parameter['value'][] = "img/movie/" . $_POST['image'];
        $parameter['value'][] = 'null';
        $parameter['value'][] = $_POST['speech'];
        $id =  $movie->new_movie($parameter);
        $parameter = array();
        foreach ( $_POST['genre'] as $g2m ){
            $parameter[0] = $id;
            $parameter[1] = $g2m;
            $movie->update_g2m($parameter);
        }
        
       
    }
}


