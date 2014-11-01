<?php
// Configfile For Loke

// Error reporting
// 
//Måste läsa mer om detta, otydlig förståelse.
//
error_reporting(-1); // Report all types of errors
ini_set('display_errors', 1); //Visar alla fel
ini_set('output_buffering', 0); //Skriv felen direkt


// Skapar sökvägar som ska användas i systemet

define('TANGO_INSTALL_PATH', __DIR__ . '/..');
define('TANGO_THEME_PATH', TANGO_INSTALL_PATH.'/theme/renderer.php');
 

/**
 * 
 * Bootstrapp-funktionerna
 * 
 */

include_once (TANGO_INSTALL_PATH . '/src/bootstrap.php');

tangoAutoloader('CTango');
 
/**
 * 
 * Starta sessionen
 *
 */

session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();   


// skapar en instans av tango
$tango = new CTango();
$main_menu = array(
    'id'=>'',
    'vertical'=>false,
    'choise'=>array(
        'home'  => array('text'=>'Home',  'url'=>'me.php?p=home', 'class'=>''),
        'away'  => array('text'=>'Källkod',  'url'=>'source.php?p=away', 'class'=>''),
        'about' => array('text'=>'About', 'url'=>'?p=about', 'class'=>''),
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
    

