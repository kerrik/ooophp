<?php
/** Det här är mitt första försök till em me-sida med tango
 * 
 * Tango är en struktur för websidor skapad på kursen ooophp av mig
 * Peder Nordenstad.
 */

// Ikluderar config.php. som sätter igång allt.

include( __DIR__ . '/config.php');


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



$tango->set_property('title', "Först till hundra ...");
$tango->set_property('title_append', "Ett tärningsspel för en eller flera");


/**
 * Du är inte nöjd med det sidhuvud som automatiskt skapas av CTango?
 * Fritt fram att göra vad du vill. Mallen här nedan är precis vad som
 * skrivs ut av systemet automatiskt baserat på inlagda värden
 * 
 * Om du skriver något här måste hela headern skapas
 */
//$header = "<img class='sitelogo left' src='" . $tango->logo() . "' alt=''/>n";
//$header .= "<div class='sitetitle left'>" . $tango->title() . "</div>\n";
//$header .= "<div class='siteslogan left'>" . $tango->title_append() . "</div>\n";
//$tango->set_property('header', $header);

$dice_screen=<<<EOD
        <h1>Spela 100. Ensam eller mot en motståndare</h1>
        <div class='spelplan'>
        <p><a href='dice.php?p=dice&spelare=0'>Slå ett slag></a></p>
        <p> 
EOD
; //end EOD

 $dice_screen .=  $dice->monitor(0) . '</p></div>';
        
$dice_screen .=<<<EOD
       <div class='spelplan'>
        <p><a href='dice.php?p=dice&spelare=1'>Slå ett slag></a></p>
EOD
; //end EOD
$dice_screen .=  $dice->monitor(1) . '</p></div>' ;


$dice_screen .= "<p><a href='dice.php?p=dice&rensa'>Börja om></a></p>";        

$tango->set_property('main', $dice_screen);

include_once (TANGO_THEME_PATH);
        
