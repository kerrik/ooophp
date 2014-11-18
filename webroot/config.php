<?php
// Configfile For tango

// Error reporting
// 
//Måste läsa mer om detta, otydlig förståelse.
//
error_reporting(-1); // Report all types of errors
ini_set('display_errors', 1); //Visar alla fel
ini_set('output_buffering', 0); //Skriv felen direkt


// Skapar sökvägar som ska användas i systemet

define('TANGO_INSTALL_PATH', __DIR__ . '/..');
define('TANGO_SOURCE_PATH', TANGO_INSTALL_PATH . '/src/');
define('TANGO_THEME_PATH', TANGO_INSTALL_PATH.'/theme/renderer.php');
 

/**
 * 
 * Bootstrapp-funktionerna
 * 
 */

include_once (TANGO_INSTALL_PATH . '/src/bootstrap.php');

// Pga behov av funktionerna dump() och print_a tidigare i processen vid utveckling ...
include_once (TANGO_INSTALL_PATH . '/theme/functions.php');

 
/**
 * 
 * Starta sessionen
 *
 */

session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();   


// skapar en instans av tango
$tango = new CTango();



    
/**
 * Om siten ska ha databas, sätt $use_db till true
 */

$use_db = true;
$use_login = true;

if ($use_db){
    
    // Först skapar vi en array för att föra in inloggningsuppgifter i databasklassen
    $db_connect['dsn']            = 'mysql:host=ooophp-159065.mysql.binero.se;dbname=159065-ooophp;';
    $db_connect['username']       = '159065_uk11396';
    $db_connect['password']       = 'L0s3n0rd';
    $db_connect['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
   
    //sedan en ny instans av den
    //include_once 'dbcreate/dbcreate.php';
    $db = new CDatabase($db_connect);
}
if ($use_login){ $user = new CUser;}

$main_menu = array(
    'id'=>'',
    'vertical'=>false,
    'choise'=>array(
        'home'  => array('text'=>'Home',  'url'=>'me.php?p=home', 'class'=>''),
       'dice' => array('text'=>'Dice', 'url'=>'dice.php?p=dice', 'class'=>''),
       'movie' => array('text'=>'Movie', 'url'=>'movie.php?p=movie', 'class'=>''),
       'red' => array('text'=>'Redovisning', 'url'=>'redovisning.php?p=red', 'class'=>''),
       'om' => array('text'=>'Om', 'url'=>'om.php?p=om', 'class'=>''),
       'source'  => array('text'=>'Källkod',  'url'=>'source.php?p=source', 'class'=>''),
        
    )
);



/**
 * Settings for $tango.
 * 
 * Här kan man ändra defaultvärdena på olika parametrar som är fördefinierade i
 * CTango. 
 *
 */

// $tango->set_property('lang', "sv");
// $tango->set_property('favicon', "");
// $tango->set_property('style', array("css/style.css"));

 $tango->set_property('modernizr' ,'js/modernizr.js');
// 
// jquery har två möjligheter just nu, antingen använda goggles eller inte alls. 
// Standard är den avslagen
$tango->set_property('jquery' , true); 
// $tango->set_property('javascript_include', array());
// 
// För att få fart på google analytics skickar man sitt kontoid till CTango
// $tango->set_property('google_analytics', '');


// $tango->set_property('title',"");
// $tango->set_property('title_append', "");
// $tango->set_property('logo', "img/logo.jpg");
    

