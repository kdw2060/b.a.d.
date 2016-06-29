# b.a.d.  

Dit project (b.a.d., kort voor bib API ding, ja ik hou van flauwe woordspelingen) is een voorbeeldimplementatie van hoe de [bibportalen API](http://www.cultuurconnect.be/diensten/bibliotheekportalen/open-data) gebruikt kan worden voor het tonen van bibcatalogusdata op een website.

In de projectbestanden is veel commentaar opgenomen om het makkelijker te maken om dit project te gaan hergebruiken voor je eigen toepassingen. Een beetje basiskennis van html/css/jquery is wel aan te raden.

[Hier zie je een demo](http://geaplamp2.cipal.be/bibapiding/result_sprinters.html)

## HOE GEBRUIKEN

##### A Standalone
Het idee is dat je één van de voorbeeldweergaves uit het project op een scherm kunt tonen. De full-hd versie van de carrousel is hiervoor de meest voor de hand liggende keuze. Deze kan bv. op een display in de bib gebruikt worden om aanwinsten, themaselecties, enz. te adverteren. Als het scherm touchbediening ondersteunt, dan kan met een druk op een cover het detailscherm van dat item opgeroepen worden.

- Kopieer de projectbestanden naar je webserver. Die moet php ondersteunen voor het configuratiescherm.
- Schrap in het result.html bestand de intro div + de div's en stukjes code van de weergaves (zie stap 3 comment in dat bestand) die je niet wenst te gebruiken.
- Pas styling.css aan naar wens. Verwijder bv. de klasse .wrapper om de marges omheen de full-hd carrousel weg te halen.
- Surf op je webserver naar config.php om een url in te geven van hetzij een api-link van 'Mijn Lijsten', hetzij een aquabrowser-zoekopdracht via de search-api. Op het configuratiescherm staan ter illustratie twee voorbeeldlinks.
- Als je geen foutmelding ziet na het klikken op 'verzenden' dan is het verwerken van de xml met de resultaten normaalgezien geslaagd.
- Surf naar result.html om het resultaat te zien / Stel deze pagina in op het systeem dat je gebruikt om bv. een disaplay aan te sturen.

*Wat als je webserver geen php ondersteunt?* --> het is ook mogelijk om result.html zonder het configuratiescherm te gebruiken. Dit is wel iets omslachtiger. Je moet dan in je browser manueel naar de api-url's surfen en 'opslaan als' kiezen wanneer de xml-resultaten in de browser getoond worden. Sla het bestand op met exact dezelfde bestandsnaam als in mijn voorbeeldcode (`local_copy_of_feed.xml`) en bewaar dit in dezelfde map als result.html. Als je vervolgens result.html opent zal je opgeslagen xml bestand weergegeven worden. Voor het opslaan van meerdere xml-pagina's: zie in de code wat je achter de api-url moet typen om de 2de, 3de enz. pagina op te roepen en volg ook daarbij de bestandsnaming die je in de code ziet staan.

##### B Integreren in je eigen website
De drie overige voorbeeldweergaves (small en medium carrousel en de lijstweergave) zijn eerder bedoeld om te integreren in een bestaande website. Ik ga er van uit dat je weet hoe je daarop zelf de aanwezige html-files of template-files kunt aanpassen.

- Begin ook hier met het kopiëren van de projectbestanden naar je webserver.
- Neem de links naar de scripts en stylesheets uit de <head> sectie van result.html op in de <head> sectie van je eigen webpagina. Pas waar nodig de verwijzingen aan aan de mappenstructuur die je gebruikt.
- Voorzie zelf een lege <div> in je bestaande webpagina, daar waar je de carrousel of lijst wil gaan laten verschijnen en geef die een id of klassenaam naar keuze of gebruik voor het gemak de benamingen uit mijn demopagina.
-Kopieer het deel tussen de script-tags op het einde van result.html naar je eigen webpagina, plaats dit daar ook op het einde voor de afsluitende body-tag.
- Verwijder de code-stukjes van de voorbeeldweergaves die je niet wenst te gebruiken (zie stap 3 comment in dat code-stuk)
- Indien jouw <div> een zelfgekozen id of klasse gebruikt, pas dan in het code-stuk dat je overhoudt de jquery-selector aan en verwijs naar de lege div die je eerder creëerde. Pas in dat geval ook in scripts.js de jquery-selector aan.
- Run config.php (moet in dezelfde map staan als de webpagina waarop je de carrousel of lijst hebt geïntegreerd, zoniet moet je na het uitvoeren van config.php de gegenereerde xml bestanden manueel kopiëren naar de map van de webpagina).
- Open je webpagina, de carrousel of lijst zou daar nu in moeten verschijnen.
- Speel met styling.css voor een weergave die mooi aansluit bij je eigen website.

*Wat als je webserver geen php ondersteunt?* --> zie de werkwijze beschreven bij punt A hierboven

## GEPLANDE WIJZIGINGEN
* een gebruiksvriendelijker en beter gelay-out configuratiescherm
* foutdetectie in de scripts (voor het geval een foute url wordt ingegeven of deze geen resultaten geeft), nu zal de site hier op vastlopen
* placeholders voor wanneer een catalogusrecord geen cover of korte inhoud heeft

## THANKS TO
Dit project maakt gebruik van:
* [jquery](https://jquery.com/)
* [slick](http://kenwheeler.github.io/slick/)
* [colorbox](http://www.jacklmoore.com/colorbox/)

En ook bedankt aan Jeroen Cortvriendt voor de voorbeeldcode die hij mij eerder bezorgde.


## ONDERSTEUNING
Ik bied gratis ondersteuning aan openbare bibliotheken uit Vlaanderen en Brussel die van dit project gebruik wensen te maken, maar ergens vastlopen. [Contacteer me](http://www.provincieantwerpen.be/content/modules/nl/contactpersonen/provinciaal/dcul/provinciaal-bibliotheekcentrum-vrieselhof/kris-de-winter.html) via e-mail vanaf een bibliotheek e-mailadres.

Voor de rest mag iedereen die dat wil de code gebruiken, hergebruiken enz. Een kleine bronvermelding wordt geapprecieerd.
