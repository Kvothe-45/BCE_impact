





<DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BCE IMPACT</title>
    <link rel="stylesheet" href="styles/style_home.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <style>
    #map { width: 90%; 
      height: 400px; 
      margin: auto;
      z-index: 0;
    }
  </style>
</head>
    
<body>
    <?php include 'header.php'?>
    <h2 id="h2his">Carte intéractive des pays de l'Union Européenne</h2>
    <div id="map"></div>

    <div id="boite_info">
        <h3 id="title_boite">La Banque centrale européenne : le gardien de l’euro</h3>
        <p id="par1">La Banque centrale européenne (BCE) est la banque centrale des pays de la zone euro. 
        </p>
        <p id="par2">
        Son rôle principal est d’assurer la stabilité des prix, autrement dit veiller à ce que l’inflation — la hausse des prix — reste sous contrôle. Une inflation trop élevée rend la vie quotidienne chère, tandis qu’une inflation trop faible ou négative peut freiner l’économie.
        </p>
        <p id="par3">
        En pratique, la BCE ne s’occupe pas des magasins ni des entreprises directement. Elle agit en coulisses pour que l’économie européenne reste stable et que l’euro conserve sa valeur.
        </p>
        Comment la BCE influence l’économie
        </p>
        <p id="par2">
        La BCE dispose de plusieurs outils pour agir sur l’économie, et chacun a un impact direct ou indirect sur la vie quotidienne des citoyens et des entreprises.
        </p>
        <ul>
            <li>1. Les taux d’intérêt</li>
            <li class="listetitre">La BCE fixe le taux directeur, c’est-à-dire le taux auquel les banques peuvent emprunter de l’argent auprès d’elle.
            </li>
            <li class="mesuresBCE">Taux élevés → emprunter coûte plus cher → les ménages dépensent moins, les entreprises investissent moins → l’inflation ralentit.
            </li><li class="mesuresBCE">Taux bas → emprunter coûte moins cher → les ménages dépensent davantage, les entreprises investissent → l’économie se stimule.
            </li>
            <li>2. Les opérations sur les marchés financiers</li>
            <li class="listetitre">La BCE peut acheter ou vendre des obligations, qui sont des prêts consentis aux États ou aux entreprises :
            </li>
            <li class="mesuresBCE">Acheter des obligations injecte de l’argent dans l’économie, favorisant la consommation et l’investissement.
            </li><li class="mesuresBCE">Vendre des obligations retire de l’argent, aidant à freiner l’inflation si elle devient trop élevée.
            </li>
            <li>3. Les mesures exceptionnelles</li>
            <li class="listetitre">En période de crise — comme lors de la pandémie de 2020 — la BCE peut lancer des programmes spéciaux pour prêter directement aux banques ou aux États à des conditions avantageuses. Cela garantit que l’argent continue de circuler, évitant un effondrement économique.
            </li>
            L’impact sur notre quotidien
            Même si la BCE agit loin des citoyens, ses décisions ont un effet concret :
            Crédits et emprunts : un taux bas rend les prêts immobiliers et à la consommation moins chers, un taux haut les rend plus coûteux.
            Prix des biens et services : une inflation maîtrisée empêche les hausses excessives des prix.
            Stabilité économique : les entreprises peuvent planifier leurs investissements, et les États financer leurs projets sans que le coût explose.
        </ul>

        La BCE est le gardien de la stabilité de l’euro. Grâce à ses taux d’intérêt, ses achats et ventes de titres et ses mesures exceptionnelles, elle influence la quantité d’argent dans l’économie. Son objectif est simple : maintenir les prix stables pour permettre aux citoyens et aux entreprises de vivre et d’investir sereinement.
        En résumé, quand la BCE agit, elle protège l’euro et soutient l’économie européenne, même si ses décisions semblent lointaines ou abstraites. C’est un acteur clé pour que l’argent circule de manière saine et que l’économie reste équilibrée.

    </div>


<div id="footer">
    <footer>
        <a href="Home.php">
            <img src="images/logo.png" alt="Logo de BCE Impact">
        </a>
        <h2>Projet L3 MIASHS</h2>
        <ul>
            <li><a href="sources.php">Pour aller plus loin</a></li>
            <li><a href="commentaires.php">Commentaires</a></li>
            <li><a href="sources.php">Sources</a></li>
            <li><a href="quisommesnous.php">Contact</a></li>
        </ul>
    </footer>
</div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <script>
    // Initialisation de la carte centrée sur l'Europe
    var map = L.map('map').setView([50, 10], 3.5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 10,
    }).addTo(map);

    // Gestionnaire de clic pour chaque pays : redirection vers URL basée sur le code ISO
    function onEachCountry(feature, layer) {
      layer.on('click', function(e) {
        var iso = feature.properties.adm0_a3_us || feature.id;
        if (iso) {
            window.location.href = "pays.php?pays=" + iso;
        }
      });
    }

    // Chargement ici du GeoJSON des pays d'Europe (provenant de Natural Earth) 
    fetch('custom.geo.json')
      .then(res => res.json())
      .then(data => {
        L.geoJSON(data, {
          style: { color: '#0A8999', weight: 1, fillOpacity: 0.3 },
          onEachFeature: onEachCountry
        }).addTo(map);
      });
  </script>

</body>

</html>