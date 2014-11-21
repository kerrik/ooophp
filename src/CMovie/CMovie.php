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
                case 'new':
                    $tango->set_property('title', "Ny film");
                    $CMovieNew = new CMovieNew;
                    $this->html= $CMovieNew->html; 
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
        SELECT *
        FROM Genre ;';
        
        $result = $this->query_DB($sql);
        return $result;
             
    }// end get_gengre
    
    
    
    public function filter_search($search){
        $limit = null;
        $filter = null ;
        $parameter = array();
        if( isset($search['genre']) && $search['genre'] <> 'alla'){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "G.name LIKE ?";
            $parameter[] = $search['genre'];
        } 
        if( !empty($search['year1'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.year>=?";
            $parameter[] = $search['year1'];
        } 
        if( !empty($search['year2'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.year<=?";
            $parameter[] = $search['year2'];
        } 
        if( !empty($search['title'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.title LIKE ?";
            $parameter[] = $search['title'];
        } 
        if( !empty($search['title'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.title LIKE ?";
            $parameter[] = $search['title'];
        } 
        if( !empty($search['id'])){
            $filter .= isset ($filter)? ' AND ' : '';
            $filter .= "M.id LIKE ?";
            $parameter[] = $search['id'];
        } 
        if( isset($search['limit'])){
            $limit .= " LIMIT {$search['start_page']} , {$search['movies_per_page']} ";
        } 
        $filter = isset ($filter)? ' WHERE ' . $filter : '';
        $return = array( 'sql' => $filter, 'limit' => $limit, 'parameter' => $parameter );
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
                . " GROUP BY M.id"
                . $filter['limit'] . ";";
        $return = $this->query_DB($sql, $filter['parameter']);
        return $return;
    }// end get_movies()
     
    public function paginering($search){
        $filter = $this->filter_search($search);
        $sql = <<<EOD
                SELECT 
                    COUNT(DISTINCT M.id ) AS posts
                  FROM Movie AS M
                    LEFT OUTER JOIN Movie2Genre AS M2G
                      ON M.id = M2G.idMovie
                    INNER JOIN Genre AS G
                      ON M2G.idGenre = G.id 
                    {$filter['sql']} 
                    GROUP BY M.id;
EOD
                ;
        $return = $this->query_DB($sql, $filter['parameter']);
        return count($return);
        
        
    }
    
    public function update_movie($parameter){
        $sql = <<<EOD
               UPDATE Movie SET
                title = ?,
                director = ?,
                length = ?,
                year = ?,
                plot = ?,
                image = ?,
                subtext = ?,
                speech = ?
              {$parameter['sql']}
EOD
       ;
        $return = $this->query_DB($sql, $parameter['value']);
        return $return;
    } // end update_movie()
    
    
     public function new_movie($parameter){
        $sql = <<<EOD
            INSERT INTO Movie(
                title,
                director,
                length,
                year,
                plot,
                image,
                subtext,
                speech)
            VALUES( ?, ?, ?, ?, ?, ?, ?, ?);
              {$parameter['sql']}
EOD
       ;
        $return = $this->query_DB($sql, $parameter['value'], true);
        $return = self::$db->lastInsertId();
        echo "nytt id {$return}";
                
        return $return;
    }
    public function delete_g_to_m($parameter){
        $sql = "DELETE FROM Movie2Genre WHERE idMovie = ?;";
        $return = $this->query_DB($sql, $parameter);
        return $return;
        
    }
    public function update_g2m($parameter){
        $sql = "INSERT INTO Movie2Genre (idMovie, idGenre) VALUES ( ?, ?);";
        $return = $this->query_DB($sql, $parameter);
        return $return;
    }
        
} // end CMovie
