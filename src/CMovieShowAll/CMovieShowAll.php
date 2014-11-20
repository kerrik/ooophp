<?php

class CMovieShowAll{
    public $html = '';
    private $genre_buttons = '';
    private $search = array();
    private $movies = '';
    private $movies_per_page = 4;
    private $start_page = 0;
    
    private $show_pageing = null;
    
    public function __construct(){
        // Jag MÅSTE ha den för pagineringen ....
        $_GET['start_page'] = !isset($_GET['start_page']) ? 1 : $_GET['start_page'];
        $this->html .= $this->show_movies_per_page();
        $this->show_paging();
        $this->set_get_string();
        $this->get_genre_buttons();
        $this->show_movies();
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
         
        $this->html .= $this->show_pageing;
        $this->html .= $this->show_movies_per_page();
        $this->html .= $this->movies;
    } // end show_all
    
    private function get_genre_buttons(){
        global $movie;
        $get_string = $this->set_get_string('genre');     
       
        // variabeln $press används fär att manipulera knapparnas klass för markering av aktuellt val
        $press = ( $this->search['genre'] == 'alla' ? '_press' : '' );
        
        // skapar först knappen för att visa alla kategorier. Finns ju inte med i databasfrågan
        $this->genre_buttons = "<div class='left'>";
        $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?genre=alla{$get_string}'>Alla</a></div>\n";
        

        // Hämtar genrerna och iterar genom dem
        
        $genre =  $movie->get_genre();
        foreach ($genre as $key => $genre){
            $press = ( $this->search['genre'] == $genre->name ? '_press' : '' );
            $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?genre={$genre->name}{$get_string}'>" . ucfirst($genre->name ) . "</a></div>\n";
        }
        $this->genre_buttons .= "</div>";      
        
    }// end create_filter()
    
    private function show_movies(){        
        global $movie;
        
        $search = $this->search;
        $search['start_page'] = ($search['start_page']) * $_SESSION['show_movies_per_page'];
        $search['limit'] = true;
        
        //Hämtar filmer 
        $movies = $movie->get_movies($search);        
        //Skapar output
        $this->movies =  "<div class='picrubrik clear_right'>&nbsp;</div>"
                . "<div class='fieldtitle tabellrubrik'>Titel</div><div class='fieldyear tabellrubrik'>Produktionsår</div><div class='fieldgenre tabellrubrik'>Genre</div>";
        foreach($movies AS $key => $val) {
            $this->movies .= "<div class='fieldrow'><a href='movie.php?show={$val->id}'>"
                . "<div class='fieldpic'><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></div>"
                . "<div class='fieldtitle'>{$val->title}</div><div class='fieldyear'>{$val->YEAR}</div><div class='fieldgenre'>$val->genre</div>"
                . "<img src='img/zoom_in.png' alt='zoom'></a>"
                        
                // Kontrollerar om user är inloggad och skapar isådana fall länk för editering
                . (isset($_SESSION['user']) ? "<a href='movie.php?update={$val->id}'><img src='img/edit.png' alt='edit'></a>" : null)

                . "</div><!-- end field-row -->";
        }// end foreach
        return $this->movies;
    }// end skapa_tabell_med_filmer()
    
    private function set_get_string($exclude = null ){ 
         // GET-strängen skapas. $exclude utelämnar ett värde från strängen, det som hämtande funktionen ska lägga till
        // $exclude = null hämtar hela strängen, förutom movies_per_page, som bara behövs vid ändring av antal sidor att visa
         $get_string = '';
        foreach ($this->search as $foo=>$value){
            if( $foo <> $exclude && !empty($value)){
                // tar inte med movies_per_page i $_GET-strängen då den bara behövs när antalet ändras, sedan klart
                $get_string .= (isset($foo) && $foo <> 'movies_per_page' ? "&amp;{$foo}={$value}" : '' );
            }
        } 
        // Sparar en komplett sträng i $_SESSION så man kan återvända till samma vy efter att ha tittat på detaljer eller editerat
        $_SESSION['get_string'] = !isset( $exclude ) ? $get_string : $_SESSION['get_string'];
        return $get_string;
    } // end set_get_string
    
    private function show_movies_per_page(){
        // börjar med att kontollera om antal filmer per sida ska ändras
        if( isset( $_GET['movies_per_page'])){
            $_SESSION['show_movies_per_page'] = intval($_GET['movies_per_page']);
        }
        // sätter sedan variabeln &this->movies_per_page
        $this->movies_per_page = isset($_SESSION['show_movies_per_page']) ? intval($_SESSION['show_movies_per_page']) : $this->movies_per_page ;
        
        //hämtar sedan $_GET-strängen, så det är möjligt att ändra antal sidor utan att ta bort sökbegränsningar
        $get_string = $this->set_get_string('movies_per_page');
        
        // Sedan skapas output
        $return = "<div class='right'><div class='left'> Visa antal filmer per sida:</div>";
        for ($pages = 2; $pages <= 10; $pages += 2 ){
            $return .= $pages == $this->movies_per_page ? "<div class='page_value left'><b>{$pages}</b></div>" : "<a href='movie.php?movies_per_page={$pages}&amp;start_page=1{$get_string}'><div class='page_value left'>{$pages}</div></a>";
        }
        $return .= "</div>";
        return $return;
    } // end show_movies_per_page
    
    private function show_paging(){
        global $movie;
        // Jag börjar med att kolla hur många filmer som ska visas per sida
        $this->html .= $this->show_movies_per_page();
        
        $this->show_pageing = '';
        // När vad som är första sidan bestämts så skapar jag filtervariabeln, som jag behöver 
        // för att se hur många filmer som finns med angiven sökbegränsning
        $this->search_criteria();
        
        // Det här kom till när jag försökte felsöka för ett validerngsfel som
        // uppstår när jag använder ett värde från $_SESSION i beräkingarna. Suck. ....
        
        $movies_to_show = intval($_GET['start_page']);
        $show_movies_per_page = intval($_SESSION['show_movies_per_page']);
        
        //Här visar Unicorn valideringsfel. Byter jag  värdet från  $_SERVER försvinner det
        $start_point = $movies_to_show * $show_movies_per_page;
        $movies_to_show = $movie->paginering($this->search);
        
        // Kollar hur många sidor det är totalt, för att kunna styra behovet av forward och backwardslänkarna
        $total_pages = ceil( $movies_to_show /$show_movies_per_page );
        $page_before = $_GET['start_page'] > 1 ? $_GET['start_page'] -1 : 1 ;
        
        // snabbspolning bakåt, om ej på första sidan
        $this->show_pageing .= $_GET['start_page'] <= 1 ? "<div class='page_value left'>&nbsp</div>" : 
                                                    "<a href='movie.php?start_page=1'><div class='page_value left'>&lt;&lt;</div></a>";
        $this->show_pageing .= $_GET['start_page'] <= 1 ? "<div class='page_value left'>&nbsp</div>" : 
                                                    "<a href='movie.php?start_page={$page_before}'><div class='page_value left'>&lt;</div></a>";
        
        // Skapar länkar för sidorna
        for( $page_number = 1; $page_number <= $total_pages; $page_number++){
            $this->show_pageing .=  $page_number<> (int)$_GET['start_page'] ? 
                                    "<a href='movie.php?start_page={$page_number}'><div class='page_value left'>{$page_number}</div></a>" :     
                                    "<div class='page_value left'><b>{$page_number}</b></div>"  ;
        }
        
        // och vid behov snabbspolning framår
        $next_page = $_GET['start_page'] + 1;
         $this->show_pageing .= $_GET['start_page'] == $total_pages ? "<div class='page_value left'>&nbsp</div>" : 
                                            "<a href='movie.php?start_page={$next_page}'><div class='page_value left'>&gt;</div></a>";
        $this->show_pageing .= $_GET['start_page'] == $total_pages ? "<div class='page_value left'>&nbsp</div>" : 
                                                       "<a href='movie.php?start_page={$total_pages}'><div class='page_value left'>&gt;&gt;</div></a>";
      
    }
    
    private function search_criteria(){
    // Skapas en array med värden för att generera GET-strängen
        $skapa_filter = isset($_GET) ? (isset ($_GET['search']) ? $_GET['search'] : 'Filtrera' ) : false ;
        if (  $skapa_filter == 'Filtrera'){
            $this->search['year1'] = (isset( $_GET['year1'])? strip_tags($_GET['year1']) : '');
            $this->search['year2'] = (isset( $_GET['year2'])? strip_tags($_GET['year2']) : '');
            $this->search['title'] = (isset( $_GET['title'])? strip_tags($_GET['title']) : '' );
            $this->search['start_page'] = (isset( $_GET['start_page'])? strip_tags($_GET['start_page'])-1 : 0) ;
            $this->search['genre'] = (isset( $_GET['genre'])? strip_tags($_GET['genre']) : 'alla' );
        } else {
            //Jag behöver $GET['start_page'] senare, i show_pageing(), så eftersom den inte finns fixar jag till det här ....
            $this->search['year1'] = '';
            $this->search['year2'] = '';
            $this->search['title'] = '';
            $this->search['start_page'] = (isset( $_GET['start_page'])? strip_tags($_GET['start_page'])-1 : 0) ;
            $this->search['genre'] = 'alla';
        }
    } // end search_criteria
        
}// end CMovieShowAll
http://dv1464.thereisnowebsite.info/ooophp/kmom01/webroot/movie.php?start_page=0