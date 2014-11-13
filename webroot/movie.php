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

//$result = "databaskörning";
$test = array();
$sql = "SELECT * FROM Movie";
$result = $db->query_DB($sql);

$tr = "<tr><th>Rad</th><th>Id</th><th>Bild</th><th>Titel</th><th>År</th></tr>";
foreach($result AS $key => $val) {
    dump($val);
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td><td>{$val->YEAR}</td></tr>";
}


// Do it and store it all in variables in the Anax container.

$tango->set_property('title', "Koppla upp PHP PDO mot MySQL");

$tango->set_property('main', <<<EOD
<h1>Resultatet från SQL-frågan</h1>
<p>Resultatet från SQL-frågan:</p>
<p><code>{$sql}</code></p>
<table>
{$tr}
</table>
EOD
);

include_once (TANGO_THEME_PATH);
        
