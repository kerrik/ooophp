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

$tango->set_property('main', <<<EOD
<h1>tango-base</h1>
<div class='text'>
<h2>A biolerplate for small websites and webaplications using PHP.</h2>
<p>
tango is developed as a part of the class OOOPHP on BTH. Inspiration from
Mikael Roos Anax-base.
</p>
<p>
Differencis from Anax, so far, is that i use a class insted af an array. Reason
for this is that i can let the class take care of most of the logic needed,
all I have to do is feed in the data. It makes the structure of both the 
sidecontroller and the template cleaner.
</p>
<p> I also see that in the near future I am going to make it database-driven, and then 
        the class-aproach vill be great.
</p>
<h3>Version 0.5</h3>
<p>
It is working as desired, pages show as they should.
To do ... 
</p>
<ul>
    <li>Menus are based on $-GET. Will change that, but no time right now.</li>
    <li>When menus ar positioned vertical it has no possibility to use the &lt;ul&gt;-listtag. Will be fixed.</li>
    <li>I have not implemented the possibility to add more than one styleshhet.</li>
</ul>
<p>And some more ...</p>
<p>Version 0.6</p>
<ul>
    <li>New methot that makes it possible to insert the main content piece by 
        piece insted of doing that with ä variable in the sidecontroller before uppdating  the class.</li>
    <li>It is now possible to embed style in the haed.</li>
</ul>
</div>
EOD
);

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
        
