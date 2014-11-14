<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CUser
 *
 * @author peder
 */
class CUser{
    private $user = null ;
    
    public function __construct() {
        if(isset($_POST['login'])){ $this->login();}
        if(isset($_POST['logout'])){unset ($_SESSION['user']);}
    }//end __construct
    
    public function logincheck(){
        if(isset($_SESSION['user'])){            
            global $db;
            $sql = "SELECT id, acronym, name FROM User WHERE id = ?;";
            $this->user =  $db->query_DB($sql, array($_SESSION['user']), true);
            $this->user = $this->user[0];
            $return = isset($this->user)? true: false ;
        }else{
            $return = false;
        }       
        return $return;
        //return (isset($_SESSION['user'])? true:false);       
    }//end logincheck()
    public function login(){
        global $db;
        $sql = "SELECT id, acronym, name FROM User WHERE acronym = ? AND password = md5(concat(?, salt))";
        $this->user =  $db->query_DB($sql, array($_POST['acronym'], $_POST['password']));
        $this->user = $this->user[0];
        if(isset($this->user)) {
          $_SESSION['user'] = $this->user->id;
        }
    
    }// end login()
        
    public function id(){
            return $this->user->id;
    }
    public function name(){
            return $this->user->name;
    }
    public function acronym(){
            return $this->user->acronym;
    }
        /* mall för ytterliggare metoder
           public function (){
            return $this->user-;
        }
         */
}
