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
    private $db = null;
    private $options = null;
    
    
    
    public function __construct($db_setup) {
       $this->DB_open($db_setup); 
    
    }
public function DB_open($db_setup){
    $db_default = array(
        'dsn' => null,
        'username' => null,
        'password' => null,
        'driver_options' => null,
        'fetch_style' => PDO::FETCH_OBJ,
    ); // end $db_default
    $this->options = array_merge($db_default, $db_setup);

    try {$this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);

    } catch (Exception $e) {
        throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
    }

    $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,  $this->options['fetch_style']);
} //end DB_open
    
} //End class