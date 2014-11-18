<?php


class CMovieShowOne {
    public $html = '';
    
    public function __construct() {
        $this->show_one();
    }
    
  private function show_one(){
      global $movie;
        $sql = "SELECT * FROM VMovie where id=?";
        $result = $movie->query_DB($sql, array($_GET['show']));
        $this->html .=  "<div class='text'>" ;
        $this->html .=  "<h1>Visar en post</h1>";

        $table = "<div class='fieldrow'>"
        . "<div class='fieldpic'></div>"
        . "<div class='fieldtitle'>Titel</div><div class='fieldyear'>Produktionsår</div><div class='fieldgenre'>Genre</div>"
        . "</div><!-- end field-row -->";
        foreach($result AS $key => $val) {
            $table .= "<a href='movie.php?update={$val->id}'><div class='fieldrow'>"
            . "<div class='fieldpic'><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></div>"
            . "<div class='fieldtitle'>{$val->title}</div><div class='fieldyear'>{$val->YEAR}</div><div class='fieldgenre'>$val->genre</div>"
            . "</div></a><!-- end field-row -->";
        }// end foreach
        $this->html .= <<<EOD
            {$table}
EOD
        ; //end EOD
    } // end show_one
}
