<?php


class CMovieShowOne {
    public $html = '';
    
    public function __construct() {
        $this->show_one();
    }
    
  private function show_one(){
      global $movie;
        $search['id'] = $_GET['show'];
        $result = $movie->get_movies($search);
        $val = $result[0];
        $this->html .=  "\n<div class='text'>" ;
        $this->html .=  "<h1>Information om {$val->title}</h1>\n";
        
        $genres= explode(",", $val->genre);

           /* 
            .\n<div class='fieldgenre'>$val->genre\n</div>"
            . "\n</div></a><!-- end field-row -->";
            
           */ 
        $this->html .= "\n<div class='info_pic_box left'>\n\n<div class='info_pic left'><img class='info_pic' width='300'  src='{$val->image}' alt='{$val->title}' />\n</div>\n";
        $this->html .= "\n<div class='info_pic left'><b>Gengrer:</b>";
        foreach ($genres as $genre){
            $this->html .= "\n\n<div>{$genre}\n</div>\n";
        }
        $this->html .= "</div>\n"
                      . "</div>\n<!-- end info_pic -->\n<"
                      . "div class='info_box right'>\n"
                      . "<div class='left'>\n\n<div class='info_label left'>&Aring;r:\n"
                      . "</div>\n<div class='info_text left'>{$val->year}\n"
                      . "</div>\n"
                      . "</div>\n"
                      . "<div class='left'>\n"
                      . "<div class='info_label left'>Regissör:\n"
                      . "</div>\n"
                      . "<div class='info_text left'>{$val->director}\n"
                      . "</div>\n"
                      . "</div>\n"
                      . "<div class='left'>\n"
                      . "<div class='info_label left'>Info:\n"
                      . "</div>\n<div class='info_plot left'>{$val->plot}\n"
                      . "</div>"
                      . "</div>"
                      . "</div>"
                      . "<div class='right bottom_links'>";
        $this->html .= (isset($_SESSION['user']) ? "<a class='right' href='movie.php?update={$val->id}'>"
                                        .   "<img src='img/edit.png' alt='edit'></a>" : "" );
        $this->html .= (isset($_SESSION['user']) ? "<a class='right' href='movie.php?new'>"
                                         .   "<img src='img/ny_film.png' alt='edit'></a>" : "" );
      
        $this->html .=  (isset($_SESSION['user']) ? "<a class='left' href='movie.php?'>"
                                        .   "<img src='img/home.png' alt='edit'></a>" : "" );
        $this->html .= "</div><!-- end bottom_links -->";
          

    } // end show_one
}
