<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CDatabase
 *
 * @author peder
 */
class CDatabase {
    static $db = null;
    private $options = null;
    Private $stm = null;
    private static $num_queries = 0;     // räknare fär SQL-queries
    private static $sql = array();  // Spara alla queries för felsökning
    private static $parametrar = array();   // Spara parametrar för felsökning
 
    
    
public function __construct() {
   $this->DB_open(); 
   $this->create_db( TANGO_SOURCE_PATH . 'CDatabase/dbcreate.php');
  // $this->create_db();

}
public function DB_open(){
    global $db_connect;
    $db_default = array(
        'dsn' => null,
        'username' => null,
        'password' => null,
        'driver_options' => null,
        'fetch_style' => PDO::FETCH_OBJ,
    ); // end $db_default
    $this->options = array_merge($db_default, $db_connect);

    try {self::$db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);

    } catch (Exception $e) {
        throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
    }

    self::$db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  $this->options['fetch_style']);
   
} //end DB_open
     
public function query_DB( $sql, $parametrar = array(), $debug = false ){
    self::$sql[] = $sql;
    self::$parametrar = $parametrar;
    self::$num_queries++;
    
    if($debug){
        echo "<p>$sql= <br><pre>{$sql}</pre></p><p> Number $sql= " . self::$num_queries . "</p><p><pre>" . print_r($parametrar, 1) . "</pre></p>";
      }
    $this->stm = self::$db->prepare($sql);
    $this->stm->execute($parametrar);
    return $this->stm->fetchAll();
}//end queryDB
    protected function create_db($path){
    include $path;
    $sql = '';
    foreach($dbcreate as $query){
        //$sql .= "DROP " . $query['type'] . " IF EXISTS " . $query['name'] .  ";";
        $sql .= $query['sql'];
        $sql .= ($query['data']?$query['data']:null);
        $this->query_DB($sql);
        $sql = '';
    }
}

public function dump() {
    $html  = '<p><i>You have made ' . self::$numQueries . ' database queries.</i></p><pre>';
    foreach(self::$queries as $key => $val) {
      $params = empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1)) . '<br/></br>';
      $html .= $val . '<br/></br>' . $params;
    }
    return $html . '</pre>';
  }//end Dump 
} //End class