<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMovie
 *
 * @author peder
 */
class CMovie extends CDatabase{
    private $html = '';
    private $filtrera= false;
    public function __construct() {
        $this->create_db( TANGO_SOURCE_PATH . 'CMovie/dbcreate.php');
        //$this->check_for_include();
    } // end __construct
    
    private function check_for_include(){
        $found = false;
        if (isset($_GET)){
            foreach($_GET as $search=>$dump){
                $found = $this->include_file($search);
                if ( $found ){ break; }
            }
        }
       if ( !$found ){
                $this->include_file();            
        }
        
    } // end check_for_include
    
    private function include_file($search = null){
        /**
         * dumt namn, jag började med att olika includefiler för olika sidor i Movie
         * 
         * den väljer vilken sida som ska visas utifrån vad som finns i $_get.
         * 
         */
        global $tango;
        if(isset($search)){
            switch ($search){
                case 'update':
                    $tango->set_property('title', "Uppdatera filmdatabasen");
                    $CMovieUpdate = new CMovieUpdate;
                    $this->html= $CMovieUpdate->html; 
                    return true;
                break;
                case 'show':
                    $tango->set_property('title', "Visa enskild post");
                    $CMovieShowOne = new CMovieShowOne;
                    $this->html= $CMovieShowOne->html; 
                    return true;
                 break;
            } // end switch
        }else{
            $tango->set_property('title', "Visa filmdatabas");
            $CMovieShowAll = new CMovieShowAll;
            $this->html= $CMovieShowAll->html; 
        }//end if
        return false;
    }
    public function html(){
        $this->check_for_include();
        return $this->html;
    } // end html
        
    public function get_genre(){ 
    /**
     * funktion för att skapa knappar för val av filmgene
     */
        $sql = '
        SELECT DISTINCT G.name
        FROM Genre AS G
            INNER JOIN Movie2Genre AS M2G
                ON G.id = M2G.idGenre;';
        
        $result = $this->query_DB($sql);
        return $result;
             
    }// end get_gengre
    
    
    
    public function filter_search($search){
        $filter = null ;
        $parameter = array();
        if( $search['genre'] <> 'alla'){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "G.name=?";
            $parameter[] = $search['genre'];
        } 
        if( !empty($search['year1'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.YEAR>=?";
            $parameter[] = $search['year1'];
        } 
        if( !empty($search['year2'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.YEAR<=?";
            $parameter[] = $search['year2'];
        } 
        if( !empty($search['title'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.title LIKE ?";
            $parameter[] = $search['title'];
        } 
        $filter = isset ($filter)? ' WHERE ' . $filter : '';
        $return = array( 'sql' => $filter, 'parameter' => $parameter );
        
        return $return;
    } // end search
    
    public function get_movies($search){
        $filter = $this->filter_search($search);
        $sql = "SELECT 
                    M.*,
                    GROUP_CONCAT(G.name) AS genre
                  FROM Movie AS M
                    LEFT OUTER JOIN Movie2Genre AS M2G
                      ON M.id = M2G.idMovie
                    INNER JOIN Genre AS G
                      ON M2G.idGenre = G.id" 
                . $filter['sql'] 
                . " GROUP BY M.id;";
        $return = $this->query_DB($sql, $filter['parameter']);
        return $return;
    }// end get_movies()
     
    
    
        
} // end CMovie
