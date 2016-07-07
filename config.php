<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Kris De Winter">
    <title>Instellingenscherm</title>
<style>
body {
    font-family: Montserrat, Calibri, sans-serif;
    }
    h1 {
        margin-left: 25px;
    }
    .configform {
        width: 600px;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border-top: 5px solid #77cbf0;
        border-left: 1px solid #9a9797;
        border-right: 1px solid #9a9797;
        border-bottom: 1px solid #9a9797;
        margin-left: 25px;
    }
    .configform h3 {
        text-align: center;
        color: #000;
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }
    .configform p {
        text-align: left;
        color: #000;
        font-size: 14px;
        margin-top: 0;
        margin-bottom: 20px;
    }
    .formpart1 {
        border-bottom: 1px solid #ccc;
    }
    label {
        padding-right: 10px;
        padding-bottom: 2px;
    }
    input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 14px;
        padding: 0 20px 0 5px;
        outline: none;
    }
    input:active, input:focus {
    border: 1px solid #77cbf0;
    }
    .submit {
        width: 100%;
        height: 40px;
        background: #77cbf0;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
        font-family: Montserrat;
        outline: none;
        cursor: pointer;
    }
    .submit:hover {
    background: #55bcea;
    }
    #waiting {
        position: absolute;
        z-index: 100000;
        background: rgba(204, 204, 204, 0.93);
        top: 275px;
        left: 125px;
        width: 440px;
        height: 190px;
        text-align: center;
    }
</style>
<script>
    function ToonLoader(){
        document.getElementById('waiting').style.visibility = 'visible'; 
    }
</script>
</head>
<body>
<!-- We kijken na of er een gebruiker is ingelogd. Wie zonder inloggen rechtstreeks naar deze pagina surft sturen we terug naar het loginscherm-->

<?php
    session_start();
    $gebruiker = $_SESSION["userbibapiding"];
    
    if ($gebruiker == "ingelogdeBADgebruiker") {
        //doe niks - ga verder
    }
    
    else { header("location:login.php"); }
?>

<!--Het configuratieformulier-->
<h1>Bepaal de inhoud van de lijst/carrousel</h1>
    <div class="configform">
        <h3>Kies één van deze twee opties</h3>

        <p>Wil je een lijst, gemaakt met 'Mijn Lijsten' tonen in de carrousel? Geef in onderstaand zoekveld dan de API-url in die je in de Mijn Bibliotheek administratie bij je lijst kunt terugvinden, bv. <i>http://mijn.bibliotheek.be/list/api/1831</i></p>
        <form method="get" class="formpart1">
        <label>Lijst API-url:</label><input type="text" name="zoekurl"><br>
        <label>Titel voor carrousel:</label><input type="text" name="titel"><br>
        <input type="submit" class="submit" onclick="ToonLoader()">
        </form><br>

        <p>Wil je in de carrousel het resultaat van een cataloguszoekvraag tonen? Geef in het zoekveld dan je cataloguszoekvraag in, je kunt die gewoon copy-pasten uit het zoekvak van de aquabrowser. Daarnaast heb je ook een authorization key nodig. Die kun je verkrijgen bij <a href="http://www.cultuurconnect.be" target="_blank">Cultuurconnect</a>. Zie ook de <a href="https://docs.google.com/spreadsheets/d/1IMSaNgcQNpE6KC_tgzyCRkXh6yUBF8rn_lyjrd6bUaM/edit#gid=9" target="_blank">API-documentatie</a>.</p>
        <form method="get" class="formpart2">
        <label>Aquabrowser zoekvraag:</label><input type="text" name="ablzoekvraag"><br>
        <label>Authorization key:</label><input type="text" name="ablkey"><br>
        <label>Titel voor carrousel:</label><input type="text" name="titel"><br>
        <input type="submit" class="submit" onclick="ToonLoader()">
        </form>
    </div>
    
<!--Een verborgen 'loading' element dat getoond wordt terwijl de zoekvraag verwerkt wordt-->
    <div id="waiting" style="visibility:hidden">
        <img src="spin.gif"><br>
        <p>De resultaten worden opgehaald en verwerkt, even geduld a.u.b.<br>Je wordt zo dadelijk automatisch doorgestuurd naar de resultatenpagina.</p>
    </div>
    
<!--Verwerken van de in het formulier ingegeven data -> zoekvraag naar api sturen -> resultaat lokaal bewaren. Hier en daar zie je 'sleep' om overbelasting aquabrowser api te voorkomen-->
<?php
    
    //code voor Mijn Lijsten API
    if ( (isset($_GET["zoekurl"])) && (isset($_GET["titel"])) )
    {
        $zoekstring = $_GET["zoekurl"];
        $titel = $_GET["titel"];
        file_put_contents('carrouseltitel.txt', $titel);
       
        //download xml versie lijst, incl. foutcontrole
        $xml = file_get_contents("$zoekstring") or exit("<script>alert('Je gaf geen geldige url in of de aquabrowser retourneerde geen resultaat');</script>");
        file_put_contents('local_copy_of_feed.xml', $xml);
        
        $xmlresult = simplexml_load_file('local_copy_of_feed.xml');
        $aantalitems = (int) $xmlresult->meta->count;
        
        if ($aantalitems > 20){
            $zoekstring .= "?page=2";
            sleep(3);
            $xml = file_get_contents("$zoekstring");
            file_put_contents('local_copy_of_feed_page2.xml', $xml);
        }
        if ($aantalitems > 40){
            $zoekstring = substr( $zoekstring, 0, -1 ) ."3";
            sleep(3);
            $xml = file_get_contents("$zoekstring");
            file_put_contents('local_copy_of_feed_page3.xml', $xml);
        }

        sleep(2);
        //uitloggen gebruiker en automatisch doorsturen naar resultatenpagina
        session_start();
        session_unset();
        session_destroy();
        echo "<script>document.location = 'result.html'</script>";
    }
    
    //code voor ABL search API
    elseif ( (isset($_GET["ablzoekvraag"])) && (isset($_GET["titel"])) && (isset($_GET["ablkey"])) )
    {
        $zoekstring = rawurlencode($_GET["ablzoekvraag"]);
        $titel = $_GET["titel"];
        $ablauthkey = $_GET["ablkey"];
        file_put_contents('carrouseltitel.txt', $titel);
        
        // vervang in onderstaande url 'gemeente' door jouw bib/gemeentenaam
        $ablsearch = "http://zoeken.gemeente.bibliotheek.be/api/v0/search/?q=" . $zoekstring . "&authorization=" . $ablauthkey;  
                
        $xml = file_get_contents("$ablsearch") or exit("<script>alert('Je gaf geen geldige zoekterm in of de aquabrowser retourneerde geen resultaat');</script>");
        file_put_contents('local_copy_of_feed.xml', $xml);
        
        $xmlresult = simplexml_load_file('local_copy_of_feed.xml');
        $aantalitems = (int) $xmlresult->meta->count;
        
        if ($aantalitems > 20){            
            $ablsearch .= "&page=2";
            sleep(3);
            $xml = file_get_contents("$ablsearch");
            file_put_contents('local_copy_of_feed_page2.xml', $xml);
        }
        if ($aantalitems > 40){
            $ablsearch = substr( $ablsearch, 0, -1 ) ."3";
            sleep(3);
            $xml = file_get_contents("$ablsearch");
            file_put_contents('local_copy_of_feed_page3.xml', $xml);
        }

        sleep(2);
        session_start();
        session_unset();
        session_destroy();
        echo "<script>document.location = 'result.html'</script>";
    }
?>
</body>
</html>
