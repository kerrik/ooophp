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
        <h1>Kmom01</h1>
        <div class='text'>
        <p >Har en hel del erfarenhet av ojektorienterad programmering i PHP, 
        så guiden var mestadels en mycket nyttig repititon. Och vad som är
        verkligen nyttigt är övningar och programmering, att ge sig tid att 
        hitta lösningar och möjligheter, inte bara snabbt fuska sig fram.</p>
        <p>Några riktiga guldklimpar hittade jag. &lt;? ?&gt;, &lt;?= ?&gt; är
        underbara, heredoc har jag heller aldrig testat tidigare.</p>
        <h2>Min webmall</h2>
        <p>Den fick namnet tango. Namnvalet var för mig självklart. Argentinsk
        tango är en improviserad pardans utan begränsningar, bara
        möjligheter, där man ständigt strävar efter
        förfining och perfektion, utveckling av det som finns och jakt
        efter nya möjligheter. </p>
        <p >En dans där man ständigt dansar med nya partners och därigenom måste
        vara flexibel för att kunna ge tillfredställelse.</p>
        <p >Strukturen i Anax ... behöll jag med några få avsteg. Min första
        tanke var: Array? Varför inte en klass. Det ger mig större
        möjligheter. </p>
        <p >Så i tango styrs det mesta från klassen CTango, som vill bli matad
        med info. Dock finns redan defaultvärden på många ställen för att minska
        arbetet.  Alla variabler är interna, man får gå via metoder för att 
        komma åt dem. Jag vill ha kommandot. Kontrollfreak? Javisst.</p>
        
        <p >I index.tpl.php finns ingen kod, bara anrop till de funktioner som ger
        utskriften. Som default skapas &lt;head&gt; av klassen, men möjlighet
        finns givetvis att skapa en egen i sidmallen och skicka in i klassen
        för utskrift. </p>
        <p>Det som inte fungerar är att koppla flera stylesheets till klassen för
        länkning, det kommer, måste dock sätta igång med nästa kurs medan tid är.</p>
        <p >Source.php fungerade bra att inkludera, med lite fix i surce.css så det
        gick ihop med min övriga sida.</p>
        <p >Koden finns på github, länk ner till höger på sidan.</p>
        
        <h1>Kmom02</h1>
        <p>Storslagna planer som gick helt åt skogen. Började med dice, som var
        den mest komplicerade, då jag redan har en alamacksfunktin klar från ett 
        projekt med taxiadministration jag jobbar med. Tänkte ... jag gör båda.
        Min storslagna lösning sket sig. På något sätt anropar den funktioner 
        två ggr, och triggar därmed de räknare av olika slag jag har där för
        ofta. Intressant var att jag inte kunde få några som helst utskrifter från
            den första iteringen, allt som syntes var från steg två</p>
        <p>Dagar år skogen bara för att jag inte ger upp utan fortsätter rota. 
        Suckar och stönar, är trotts allt nöjd med att jag fått en stor dos träning
        och läst in mig på funktionalitet jag annars varit utan ...</p>
        <p> så resultatet blev en omskriven applikation utan några frills. Allt
        sker i en klass. Osexigt och kanske inte vad syftet med kursen var, men
        det var vad som hanns med före deadline. Får väl fila mer senare.</p>
        
        <h1>Kmom03</h1>
        <p>I mycket en repetition. Jag har arbetat med relationsdatabaser sedan jag under
        f&ouml;rsta h&auml;lften av 90-talet byggde mitt f&ouml;rsta program,
        ett applikation f&ouml;r att hantera kundkontakter f&ouml;r oss
        s&auml;ljare. Programmet byggde jag i Superbase.
        </p>
        <p>Senare blev jag
        ansvarig f&ouml;r inf&ouml;randet av aff&auml;rssystemet Scala hos p&aring;
        min arbetsplats, numera iScala tror jag, med
        order/fakturering/lager/produktionsstyrning. Jag l&auml;rde mig den
        databasen utan och innan. Rapportskrivning i Chrystal Reports,
        framtagandet av hj&auml;lpprogram i VB mm. 
        </p>
        <p>Senare, arbetade jag som Scala-konsult och ansvarig för programutveckling
        blev jag ansvarig f&ouml;r skapandet av Tuf2500, en produkt f&ouml;r 
        transportadministration, med order/fakturering/avr&auml;kning/kund och 
        &aring;karreskontra. (Stora styrkan var gr&auml;nssnittet
        f&ouml;r att f&ouml;rdela transporterna p&aring; bilar.) Affärslogik och
        databasen var mitt ansvar. Ej programmering, programmet skrevs i Magic, 
        som jag inte kan. Intressant att hitta var buggarna ligger utan att kunna 
        läsa koden ...
        <p>Arbetet med
        Wordpress har gjort mig v&auml;l f&ouml;rtrogen med MySQL, MySQL CLU
        och My Admin.</p>
        <p>S&aring; inget i det
        h&auml;r momentet k&auml;nns nytt, d&auml;remot en nyttig repetition
        och uppfr&auml;schning. MySQL Workbench &auml;r en trevlig nykomling
        som jag anv&auml;nt f&ouml;r att b&ouml;rja modellera databasen f&ouml;r
        examinationsuppgiften. (Den h&auml;r kursen har jag varit smart nog
        att kolla in den direkt, s&aring; jag kan fundera igenom ordentligt
        och inte beh&ouml;ver g&ouml;ra allt p&aring; en g&aring;ng.)</p>
        
        <h1>Kmom04</h1>
        <p>Ett mycket roligt
        kursmoment med m&aring;nga utmaningar.<br>Den sista har varit att f&aring;
        ig&aring;ng min webb-plats med SQL p&aring; BTH-s server. Jag har
        sk&auml;ndligen misslyckats.</p>
        <p>M&aring;nga logiska
        utmaningar i s&ouml;kfunktionen. Hur f&aring; till att s&ouml;kstr&auml;ngen
        finns kvar n&auml;r man &auml;ndrar val, hur skapa where-satsen.
        Tycker jag fick till ganska snygga l&ouml;sningar &hellip;</p>
        <p>Tabellen byggde jag
        upp med floats ist&auml;llet f&ouml;r HTML. Jag tycker att jag f&aring;r
        st&ouml;rre formateringsm&ouml;jligheter d&aring;.</p>
        <p>En fundering var om
        jag skulle bygga Cmovie som en extension p&aring; Cdatabase. Gillade
        inte att &ouml;ppna flera anslutningar mot databasen om jag skulle
        anv&auml;nda den p&aring; fler st&auml;llen.</p>
        <p>Kom sedan p&aring;
        att om jag gjorde $ db static s&aring; blir det bara en koppling.</p>
        <p>En del annat finns
        fixat, loginfunktion och m&ouml;jlighet att komaa in och se film mer
        detaljerat och start p&aring; redigering/nyuppl&auml;ggning av film.
        Bara skal &auml;n s&aring; l&auml;nge, ingen funktionalitet.</p>
        <p>K&auml;nner att jag
        utvecklas som programmerare av kurserna. Positivt. &Ouml;nskar jag
        hade mer tid, dvs inte l&aring;g s&aring; mycket efter, men livet &auml;r
        som det &auml;r. Och tar en del tid att jobba heltid 10-12 timmar
        ut&ouml;ver detta. Suck.</p>
        <p>Vad g&auml;ller
        uppdatering av databasen &hellip; Funktionalitet inbyggd f&ouml;r att
        kontrollera att tabellerna finns och skapa nya om de saknas. Finns i
        Cdatabase.</p>
        <p>PHP PDO är en trevlig bekantskap, jag känner att vi kommer att få en 
            lång och trivsam relation. Vad gäller min plattform och moduler i 
            form av classer ... så byggde jag ju platformen från början med en 
            class som styr flödet.
        
        
        
   
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
        
