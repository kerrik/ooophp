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

$tango->main_content(<<<EOD
        <h1>Spela 100. Ensam eller mot en motståndare</h1>
        <div class='spelplan'>
            <p>Dice är ett spel där det gäller att komma upp så när 100 poäng utan att passsera
            100. Du kan spela en eller flera spelare.
            </p>
            <p>
            Varje rond kan du välja mellan att spela med en, två eller tre tärningar.
            Du kan också stå välja att stå över, men bara en rond, du måste spela nästa.
            </p>   


            <p><a href='dice_play.php?antal=1'>Ensam</a>
                <a href='dice_play.php?antal=2'>Två</a>
                <a href='dice_play.php?antal=3'>Tre</a>
                <a href='dice_play.php?antal=4'>Fyra</a>
            </p>
        </div><!-- spelplan -->
   
EOD
); //end EOD

//$tango->main_content( $dice->monitor(0) . '</p></div>');
        

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
        
