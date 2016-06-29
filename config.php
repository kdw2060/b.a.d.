<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Kris De Winter">
    <title>Instellingenscherm</title>
<style>
    p {
        width: 600px;
    }
    #invoerveld{
        width: 350px;
    }
</style>

</head>
<body>
<h1>Bepaal de inhoud van de lijst/carrousel</h1>
    <p>
    Geef in het zoekveld ofwel een API-url van een Mijn Bibliotheek lijst in, bv. <i>http://mijn.bibliotheek.be/list/api/1831</i></p><p>Of een API-url met een cataloguszoekvraag, bv. <i>http://zoeken.bibliotheek.be/api/v0/search/?q=thrones&authorization=...</i></p><p>Bij die tweede optie is zoals je kunt zien ook een authorization key nodig. Die kun je verkrijgen bij <a href="http://www.cultuurconnect.be" target="_blank">Cultuurconnect</a>. Zie ook de <a href="https://docs.google.com/spreadsheets/d/1IMSaNgcQNpE6KC_tgzyCRkXh6yUBF8rn_lyjrd6bUaM/edit#gid=9" target="_blank">API-documentatie</a>.
    </p><br>
    
    <form method="get">
    <label>Lijst API-url of Search API-url:</label><input type="text" name="zoekurl" id="invoerveld">
    <input type="submit">
    </form><br>

<?php 
    //opm: foutdetectie voorlopig weggelaten, is voor toekomstige versies
    
    if (isset($_GET["zoekurl"]))
    {
        //we laden de eerste pagina in en maken een lokale kopie
        $zoekstring = $_GET["zoekurl"];
        echo "Je gaf dit in:" . $zoekstring;
        $xml = file_get_contents($zoekstring);
        file_put_contents('local_copy_of_feed.xml', $xml);
        
        //we checken in de lokale kopie of er meer dan 10 resultaten zijn en er dus meer dan 1 xml-pagina moet opgehaald worden. Als dat zo is slaan we ook die paginas lokaal op
        $xmlresult = simplexml_load_file('local_copy_of_feed.xml');
        $aantalitems = (int) $xmlresult->meta->count;
        if ($aantalitems > 10){
                //omdat de api niet consistent is, grrr, moeten we een variant inbwouwen voor de paginering bij 'mijn lijsten' of de search api
                if(strpos($zoekstring, 'search') !== false){
                $zoekstring .= "&page=2";}
                else {$zoekstring .= "?page=2";}
            $xml = file_get_contents($zoekstring);
            file_put_contents('local_copy_of_feed_page2.xml', $xml);
        }
        if ($aantalitems > 20){
            $zoekstring = substr( $zoekstring, 0, -1 ) ."3";
            $xml = file_get_contents($zoekstring);
            file_put_contents('local_copy_of_feed_page3.xml', $xml);
        }
        //je kunt op dezelfde manier nog ifs toevoegen om meer dan 30 resultaten te gaan verwerken, maar dan wordt de lijst of carrousel te lang vind ik, dus nu expres beperkt op 30 items
        
    //link naar resultaat (je zou alternatief ook automatisch dat document in de browser kunnen laden)
    echo "<br><p><a href='result.html'>Bekijk het resultaat</a></p>";
    }
    
?>
    
</body>
</html>
