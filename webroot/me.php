<?php
/** Det här är mitt första försök till em me-sida med tango
 * 
 * Tango är en struktur för websidor skapad på kursen ooophp av mig
 * Peder Nordenstad.
 */

// Ikluderar config.php. som sätter igång allt.

include( __DIR__ . '/config.php');

// skapar en instans av tango
$tango = new tango();

//fyller $tango med lite data ...

$tango->set_property('title', "Tango, websidor som en dans");
$tango->set_property('title_append', "En webmall skapad på kursen ooophp på BTH");

$header = "<img class='sitelogo' src='" . $tango->logo() . "' />";
$header .= "<span class='sitetitle'>" . $tango->title() . "</span>";
$header .= "<span class='siteslogan'>" . $tango->title_append() . "</span>";

$tango->set_property('header', $header);
$tango->set_property('main', <<<EOD
        <h1>Här är jag, en tangodansare på villospår</h1>
        <p>Det här ska bli en mesida med en massa intressant text ...</p>
EOD
);

$tango->set_property('footer', <<<EOD
        <footer><span class='sitefooter'><a href='https://github.com/kerrik/ooophp'>tango på GitHub</a></span></footer>
EOD
);

include_once (TANGO_THEME_PATH);
        
