<?php
/** Det här är mitt första försök till em me-sida med tango
 * 
 * Tango är en struktur för websidor skapad på kursen ooophp av mig
 * Peder Nordenstad.
 */// Ikluderar config.php. som sätter igång allt.

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

$tango->main_content( " <div class='spelplan'>");        
$tango->main_content( "<h1>" . $dice->player() . " spelare rond nr " .$dice->rond() . ".</h1>\n" ); 

if(isset($_GET['slag'])){
    $tango->main_content($dice->spelare_slar()); //end EOD
}  else {
    
    $tango->main_content(<<<EOD
       
        <div class='slag'>
        <p><a href='dice_play.php?p=dice&slag=1'>Slå en tärning></a></p>
        <p><a href='dice_play.php?p=dice&slag=2'>Slå två tärningar></a></p>
        <p><a href='dice_play.php?p=dice&slag=3'>Slå tre tärning></a></p>
        <p><a href='dice_play.php?p=dice&slag=0'>Stå över></a></p>
        <p>
            </div>
            </div>
EOD
); //end EOD
}



// $dice_screen .= "<p><a href='dice.php?p=dice&rensa'>Börja om></a></p>";  


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
        
