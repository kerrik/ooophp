<?php
/** Det här är mitt första försök till em me-sida med tango
 * 
 * Tango är en struktur för websidor skapad på kursen ooophp av mig
 * Peder Nordenstad.
 */

// Ikluderar config.php. som sätter igång allt.

include( __DIR__ . '/config.php');

$dice = new CDice();


/**
 * 
 * Sidspecifik styling läggs till här
 * 
 */
$style =<<<EOD
        #header {
            background-image: url('img/header_dice.jpg');
        }
EOD
; //end $style-declaration


$tango->set_property('embed_style', $style);
//fyller $tango med lite data att skriva ut...

$content = $dice->main();
$tango->main_content($content);


$tango->set_property('footer', <<<EOD
        <div class='sitefooter left'>
            &copy;Peder Nordenstad <a href='mailto:peder@nordenstad.se'>(peder@nordenstad.se)</a>
        </div>
        <div class='right sitefooter'>
            <a  href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a> | <a href='https://github.com/kerrik/ooophp'>tango på GitHub</a>
        </div>
EOD
);



include_once (TANGO_THEME_PATH);
        
