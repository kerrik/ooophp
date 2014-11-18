<?php

class CMovieShowAll{
    public $html = '';
    private $genre_buttons = '';
    private $search = array();
    private $movies = '';
    
    public function __construct(){
        $this->search_criteria();
        $this->get_genre_buttons();
        $this->get_movies();
        $this->show_all();
    }
    
    private function show_all(){
        /**
        * Funktion för att skapa sidan som visar alla filmer
        */
       
        $this->html .=  "<div class='text'>" ;
        $this->html .=  "<h1>Filmdatabas</h1>";
          $this->html .= <<<EOD
            <form method="get">
            <fieldset>
EOD
        ; // end EOD 
        $this->html .= " <input type='hidden' name='genre' value='{$this->search['genre']}'>";
        $this->html .= $this->genre_buttons;

        $this->html .= " <div class='left clear_right'><label class='label left' for='year1'>År:</label>"
                . "<input id='year1' type='text' class='left' name='year1' value='{$this->search['year1']}'>";    
        $this->html .= "<label class='left' for='year2'>-</label>"
                . "<input id='year2' type='text' class='left ' name='year2' value='{$this->search['year2']}'></div>";    
        $this->html .= " <div class='left clear_right'><label class='label left' for='title'>Titlel ( joker= %) :</label>"
                . "<input id='title' type='text' class='input left' name='title' value='{$this->search['title']}'></div>";    
        $this->html .=  <<<EOD
            <div class='left'> <input type="submit" name="search" value="Filtrera" >
              <input type="submit"  name='search' value="Rensa"></div>

          </fieldset>
            </form>
EOD
        ;// end EOD
         
        //$this->pageing();
        $this->html .= $this->movies;
    } // end show_all
    
    private function get_genre_buttons(){
        global $movie;
             
        // GET-strängen skapas
        $search_variables = '';
        foreach ($this->search as $foo=>$value){
            if( $foo <> 'genre' && !empty($value)){
                $search_variables .= isset($foo)? "&amp;{$foo}={$value}" : '';
            }
        }   
        // variabeln $press används fär att manipulera knapparnas klass för markering av aktuellt val
        $press = ( $this->search['genre'] == 'alla' ? '_press' : '' );
        
        // skapar först knappen för att visa alla kategorier. Finns ju inte med i databasfrågan
        $this->genre_buttons = "<div class='left'>";
        $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?genre=alla$search_variables'>Alla</a></div>\n";
        

        // Hämtar genrerna och iterar genom dem
        
        $genre =  $movie->get_genre();
        
        foreach ($genre as $key => $genre){
            $press = ( $this->search['genre'] == $genre->name ? '_press' : '' );
            $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?genre={$genre->name}{$search_variables}'>" . ucfirst($genre->name ) . "</a></div>\n";
        }
        $this->genre_buttons .= "</div>";      
        
    }// end create_filter()
    
    private function get_movies(){        
        global $movie;
        $movies = $movie->get_movies($this->search);
        
        $this->movies =  "<div class='picrubrik '>&nbsp;</div>"
                . "<div class='fieldtitle tabellrubrik'>Titel</div><div class='fieldyear tabellrubrik'>Produktionsår</div><div class='fieldgenre tabellrubrik'>Genre</div>";
        foreach($movies AS $key => $val) {
            $this->movies .= "<a href='movie.php?show={$val->id}'><div class='fieldrow'>"
                . "<div class='fieldpic'><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></div>"
                . "<div class='fieldtitle'>{$val->title}</div><div class='fieldyear'>{$val->YEAR}</div><div class='fieldgenre'>$val->genre</div>"
                . "</div></a><!-- end field-row -->";
        }// end foreach
        return $this->movies;
    }// end skapa_tabell_med_filmer()
    
    
    
    private function search_criteria(){
    // Först skapas en array med värden för att generera GET-strängen
        $skapa_filter = isset($_GET) ? (isset ($_GET['search']) ? $_GET['search'] : 'Filtrera' ) : false ;
        if (  $skapa_filter == 'Filtrera'){
            $this->search = array( 'year1' => (isset( $_GET['year1'])? strip_tags($_GET['year1']) : '' ),
                        'year2' => (isset( $_GET['year2'])? strip_tags($_GET['year2']) : '' ),
                        'title' => (isset( $_GET['title'])? strip_tags($_GET['title']) : '' ),
                        'genre' => (isset( $_GET['genre'])? strip_tags($_GET['genre']) : 'alla' ));
        }  else {
             $this->search = array( 'year1' => '',
                        'year2' => '',
                        'title' => '',
                        'genre' => 'alla');
        }
    } // end search_criteria
        
}// end CMovieShowAll