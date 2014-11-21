<?php

class CMovieShowAll{
    public $html = '';
    private $genre_buttons = '';
    private $search = array();
    private $movies = '';
    
    private $show_pageing = null;
    
    public function __construct(){
        $this->search_criteria();
        $this->show_paging();
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
        $get_string = $this->search;  
        $get_string['start_page'] = 1;
       
        // variabeln $press används fär att manipulera knapparnas klass för markering av aktuellt val
        $press = ( $this->search['genre'] == 'alla' ? '_press' : '' );
        
        // skapar först knappen för att visa alla kategorier. Finns ju inte med i databasfrågan
        $this->genre_buttons = "<div class='left'>";
        $get_string['genre'] = 'alla';
        $get = http_build_query($get_string, '' , 'amp;');  
        $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?{$get}'>Alla</a></div>\n";
        

        // Hämtar genrerna och iterar genom dem
        
        $genre =  $movie->get_genre();
        foreach ($genre as $key => $genre){
            $press = ( $this->search['genre'] == $genre->name ? '_press' : '' );            
            $get_string['genre'] = $genre->name;
            $get = http_build_query($get_string, '' , 'amp;');  
            $this->genre_buttons .= "<div class='button_genre{$press}'><a href='movie.php?{$get}'>" . ucfirst($genre->name ) . "</a></div>\n";
        }
        $this->genre_buttons .= "</div>";      
        
    }// end create_filter()
    
    private function show_movies(){        
        global $movie;
        
        $search = $this->search;
        $search['start_page'] = ($search['start_page']-1) * $search['movies_per_page'];
        $search['limit'] = true;
        
        //Hämtar filmer 
        $movies = $movie->get_movies($search);        
        //Skapar output
        $this->movies =  "<div class='picrubrik clear_right'>&nbsp;</div>"
                . "<div class='fieldtitle tabellrubrik'>Titel</div><div class='fieldyear tabellrubrik'>Produktionsår</div><div class='fieldgenre tabellrubrik'>Genre</div>";
        foreach($movies AS $key => $val) {
            $this->movies .= "<div class='fieldrow'><a href='movie.php?show={$val->id}'>"
                . "<div class='fieldpic'><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></div>"
                . "<div class='fieldtitle'>{$val->title}</div><div class='fieldyear'>{$val->year}</div><div class='fieldgenre'>$val->genre</div>"
                . "<img src='img/zoom_in.png' alt='zoom'></a>"
                        
                // Kontrollerar om user är inloggad och skapar isådana fall länk för editering
                . (isset($_SESSION['user']) ? "<a href='movie.php?update={$val->id}'><img src='img/edit.png' alt='edit'></a>" : null)
                . (isset($_SESSION['user']) ? "</div><div class'info_pick right'><a href='movie.php?new'>"
                                        .   "<img class='left' src='img/ny_film.png' alt='edit'></a>" : null )
                . "</div><!-- end field-row -->";
        }// end foreach
        return $this->movies;
    }// end skapa_tabell_med_filmer()
    
    
    private function show_movies_per_page(){  
        //hämtar sedan $_GET-strängen, så det är möjligt att ändra antal sidor utan att ta bort sökbegränsningar
        $get_string = $this->search;
        
        // Sedan skapas output
        $return = "<div class='right'><div class='left'> Visa antal filmer per sida:</div>";
        for ($pages = 2; $pages <= 10; $pages += 2 ){
            $get_string['movies_per_page'] = $pages;
            $get = http_build_query($get_string, '' , 'amp;');
            $return .= $pages == $this->search['movies_per_page'] ? "<div class='page_value left'><b>{$pages}</b></div>" : "<a href='movie.php?{$get}'><div class='page_value left'>{$pages}</div></a>";
        }
        $return .= "</div>";
        return $return;
    } // end show_movies_per_page
    
    private function show_paging(){
        global $movie;
        // Jag börjar med att kolla hur många filmer som ska visas per sida        
         
        //Här visar Unicorn valideringsfel. Byter jag  värdet från  $_SERVER försvinner det
        $start_point = $this->search['start_page'] * $this->search['movies_per_page'];
        $movies_to_show = $movie->paginering($this->search);
        
        // Kollar hur många sidor det är totalt, för att kunna styra behovet av forward och backwardslänkarna
        $total_pages = ceil( $movies_to_show /$this->search['movies_per_page'] );
        $get_string = $this->search;
        $get_string['start_page'] = 1;
        $get = http_build_query($get_string, '' , 'amp;');
        $this->show_pageing .= $this->search['start_page'] <= 1 ? "<div class='page_value left'>&lt;&lt;</div>" : 
                                                    "<a href='movie.php?{$get}'><div class='page_value left'>&lt;&lt;</div></a>";
        
        $get_string['start_page'] = $this->search['start_page'] > 1 ?$this->search['start_page'] -1 : 1;
        $get = http_build_query($get_string, '' , 'amp;');
        // snabbspolning bakåt, om ej på första sidan
        $this->show_pageing .= $this->search['start_page'] <= 1 ? "<div class='page_value left'>&lt;</div>" : 
                                                    "<a href='movie.php?{$get}'><div class='page_value left'>&lt;</div></a>";
        
        // Skapar länkar för sidorna
                                           
        for( $page_number = 1; $page_number <= $total_pages; $page_number++){
            
            $get_string['start_page']  = $page_number;
            $get = http_build_query($get_string, '' , 'amp;');
            $this->show_pageing .=  $page_number<> (int)$this->search['start_page'] ? 
                                    "<a href='movie.php?{$get}'><div class='page_value left'>{$page_number}</div></a>" :     
                                    "<div class='page_value left'><b>{$page_number}</b></div>"  ;
        }
        
        // och vid behov snabbspolning framår
        $get_string['start_page']  = $this->search['start_page'] + 1;
        $get = http_build_query($get_string, '' , 'amp;');
        $this->show_pageing .= $this->search['start_page'] == $total_pages ? "<div class='page_value left'>&gt;</div>" : 
                                            "<a href='movie.php?{$get}'><div class='page_value left'>&gt;</div></a>";
        $get_string['start_page']  = $total_pages;
        $get = http_build_query($get_string, '' , 'amp;');
        $this->show_pageing .= $this->search['start_page'] == $total_pages ? "<div class='page_value left'>&nbsp</div>" : 
                                                       "<a href='movie.php?{$get}'><div class='page_value left'>&gt;&gt;</div></a>";
      
    }
    
    private function search_criteria(){
    // Skapas en array med värden för att generera GET-strängen
        
        $search['start_page'] =  1;
        $search['genre'] =  'alla';
        $search['title'] =  '';
        $search['year1'] =  '';
        $search['year2'] =  '';
        $search['movies_per_page'] =  4;
        $_GET['search'] = ( !isset($_GET['search'])?  'Filtrera' : $_GET['search']);
        if( $_GET['search'] == 'Filtrera'){
            parse_str($_SERVER['QUERY_STRING'], $this->search);
            $this->search = array_merge( $search, $this->search );
        }else{
            $this->search = $search;
        }
    } // end search_criteria
        
}// end CMovieShowAll