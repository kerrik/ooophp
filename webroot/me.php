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
        <h1>En tangodansare på villospår</h1>
        <div class='text'>
        <p >Hej.</p>
        <p >Här är
        jag. En fd IT-arbetare med bakgrund som systemansvarig för
        administrativa system i Novell, Linux och i viss mån MS
        Servermiljö. Konsult och utvecklingschef på ett mindre
        IT-företag med inriktning på transportadministration.</p>
        <p >Den delen av livet
        tog slut straxt efter 2000, företaget jag arbetade på och
        jag gick in i väggen.</p>
        <p >Min erfarenhet då
        var programmering i främst VB och Magic.</p>
        <p >Under min bortvaro
        från IT-sektorn, när jag testat att vara shiatsu-terapeut,
        driva kaf&eacute; och köra taxi, har jag lekt en hel del med
        Wordpress, anpassat, tweakat och skrivit plugins för mina egna
        behov.</p>
        <p >BTH och dessa kurser
        har jag sökt mig till för att fördjupa och bredda mina
        kunskaper, och framför allt äntligen få koll på
        CSS och Javascript, som jag fuskar i. PHP känns tryggt, har en
        bra baskunskap och har jobbat med objektorienterad PHP.</p>
        <p >Min utvecklingsmiljö
        är i första hand Linux. FTP med FireFTP, utveckling sedan
        något år i Netbeans. Mot BTH laddar jag upp filerna med
        Filezilla.</p>
        <p >Med hjälp av
        snabb uppkoppling så använder jag mig av en av mina
        domäner på binero som testmiljö, jag litar på
        att det är rätt konfigurerat, jag slipper det tidigare
        pysslet med egen server. </p>
        <p >Information hämtar
        jag nog i första hand från PHP-manualen på nätet
        och w3schools.com.</p>
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
        
