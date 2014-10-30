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

tangoAutoloader('tango');
 
/**
 * 
 * Starta sessionen
 *
 */

session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();        
?>