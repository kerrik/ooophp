<?php
/** Det här är mitt första försök till em me-sida med tango
 * 
 * Tango är en struktur för websidor skapad på kursen ooophp av mig
 * Peder Nordenstad.
 */

// Ikluderar config.php. som sätter igång allt.

include( __DIR__ . '/config.php');

//fyller $tango med lite data att skriva ut...

$tango->set_property('title', "Tango, webbsidor som en dans");
$tango->set_property('title_append', "En webmall skapad på kursen ooophp på BTH");


/**
 * Du är inte nöjd med det sidhuvud som automatiskt skapas av CTango?
 * Fritt fram att göra vad du vill. Mallen här nedan är precis vad som
 * skrivs ut av systemet automatiskt baserat på inlagda värden
 */
//$header = "<img class='sitelogo left' src='" . $tango->logo() . "' alt=''/>n";
//$header .= "<div class='sitetitle left'>" . $tango->title() . "</div>\n";
//$header .= "<div class='siteslogan left'>" . $tango->title_append() . "</div>\n";
//$tango->set_property('header', $header);

$tango->main_content(<<<EOD
    <p></p>
    <form method=post>
        <fieldset>
        <legend>Login</legend>
EOD
); //end main_content

if( $user->logincheck()){    
    $tango->main_content("<p>Du &auml;r inloggad som " . $user->name() . " </p>");    
    $tango->main_content("<p><input type='submit' name='logout' value='Logout'/></p>");
}else{
    $tango->main_content( <<<EOD
        <p><em>Du kan logga in med doe:doe eller admin:admin.</em></p>
        <p><label>Användare:<br/><input type='text' name='acronym' value=''/></label></p>
        <p><label>Lösenord:<br/><input type='password' name='password' value=''/></label></p>
        <p><input type='submit' name='login' value='Login'/></p>
        </fieldset>
    </form>

EOD
    );// end main content
} // end if


include_once 'footer.php';
include_once (TANGO_THEME_PATH);
        
