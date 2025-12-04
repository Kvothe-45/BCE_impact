





<DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BCE IMPACT</title>
    <link rel="stylesheet" href="styles/style_home.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
</head>
    
<body>
    <?php include 'header.php'?>
    <h1 id="h2his">Carte intéractive des pays de l'Union Européenne</h1>
    <div id="map"></div>

    <div id="boite_info">
        <h3 id="title_boite">La Banque centrale européenne : le gardien de l’euro</h3>
        <p id="par1">La Banque centrale européenne (BCE) est l'institution chargée de mener la politique monétaire au sein de la zone euro. La politique monétaire de la zone euro est définie par l'Eurosystème qui rassemble la BCE et les banques centrales des États membres de la zone euro. Ainsi, chaque banque d'Europe dispose d'un compte auprès de la BCE.
        </p>
        <p id="par3">La BCE a pour mission de maintenir la stabilité des prix, gérer les réserves et conduire les opérations de change. La BCE est une institution indépendante vis-à-vis du pouvoir politique.
        </p>
        <p id="par2">
        La BCE dispose de plusieurs outils pour agir sur l’économie, et chacun a un impact direct ou indirect sur la vie quotidienne des citoyens et des entreprises. 
        </p>
        <ul>
            <li class="outils">1. Les taux directeurs et les réserves obligatoires</li>
            <li class="listetitre">La BCE impose à toutes les banques commerciales de « déposer » sur leur compte (auprès d'elle) un pourcentage des dépôts qu'elles collectent. Si le taux des réserves obligatoires est de 1 % et qu'elle accorde un crédit de 100€, elle doit alors déposer 1€ à la BCE. Elle fixe également les taux d'intérêts auxquels elle prête aux banques commerciales de la zone euro, ce qui permet de contrôler la masse monétaire et l'inflation. Pour cela, elle dispose de 3 taux directeurs :
            </li>
            <li class="mesuresBCE">Facilité de dépôt : taux applicable à la facilité de dépôt, que les banques peuvent utiliser pour effectuer des dépôts au jour le jour auprès de l'Eurosystème à un taux d'intérêt prédéfini.(Il est de 2.00% aujourd'hui)</li>
            <li class="mesuresBCE">Opérations principales de refinancement : taux d'intérêt appliqué aux opérations principales de refinancement. Dans le cadre de ces opérations, les banques peuvent emprunter des fonds à la BCE contre des garanties larges sur une base hebdomadaire à un taux d'intérêt prédéterminé. Ce taux est fixé au-dessus du taux de la facilité de dépôt. (Il est de 2.15% aujourd'hui)</li>
            <li class="mesuresBCE">Facilité de prêt marginal : taux appliqué à la facilité de prêt marginal, qui offre aux banques des crédits au jour le jour contre des garanties larges à un taux d'intérêt prédéterminé. Ce taux est fixé au-dessus du taux des opérations principales de refinancement.(Il est de 2.40% aujourd'hui)</li>
            <li class="listetitre">Pour mieux comprendre leurs impacts, voici les conséquences en cas de variation des taux directeurs : </li>
            <li class="mesuresBCE">Taux élevés → emprunter coûte plus cher → les ménages dépensent moins, les entreprises investissent moins → l’inflation ralentit.
            </li><li class="mesuresBCE">Taux bas → emprunter coûte moins cher → les ménages dépensent davantage, les entreprises investissent plus → l’économie se stimule, ce qui augmente l'inflation.
            </li>
            <li class="outils">2. Les opérations sur les marchés financiers</li>
            <li class="listetitre">La BCE peut acheter ou vendre des obligations, qui sont des prêts consentis aux États ou aux entreprises :
            </li>
            <li class="mesuresBCE">Acheter des obligations injecte de l’argent dans l’économie, favorisant la consommation et l’investissement.
            </li><li class="mesuresBCE">Vendre des obligations retire de l’argent, aidant à freiner l’inflation si elle devient trop élevée.
            </li>
            <li class="outils">3. Les mesures exceptionnelles</li>
            <li class="listetitre">En période de crise — comme lors de la crise des subprimes en 2008 ou plus récemment de la pandémie de covid de 2020 — la BCE peut utiliser de nouveaux instruments spéciaux tel que : </li>
            <li class="mesuresBCE">Le "forward guidance" qui consiste à rendre public l'orientation future de la politique monétaire</li>
            <li class="mesuresBCE">Proposer des taux d'intérêts négatifs aux banques (sous conditions)</li>
            <li class="mesuresBCE">Des achats d'actifs en grande quantité qui contribuent à stimuler l'activité de prêt, les dépenses et les investissements dans l’économie </li>
            <li class="mesuresBCE">Des "opérations de refinancement à plus long terme ciblées" qui conciste en des prêts à des taux favorables (sous conditions).
            </li>
            </ul>
        <p>
        La BCE est ainsi le gardien de la stabilité de l’euro. Grâce à tous ses outils (plus d'info <a href="https://www.ecb.europa.eu/mopo/strategy/strategy-review/html/monetary-policy-instruments.fr.html">ici</a>), elle influence la quantité d’argent dans l’économie. Elle a pour objectif principal de veiller à la stabilité des prix, étayant ainsi la croissance économique et la création d'emplois. Néanmoins, elle doit aussi jongler avec d'autres objectifs tel que l'écologie, la pollution, etc...
        </p>
        <p>
        Pour plus d'information sur la BCE, cliquez <a href="https://www.ecb.europa.eu/ecb/all-about-us/html/index.fr.html">ICI</a>
      </p>
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
    const unionEuropeenne = [
      "FRA","DEU","ITA","ESP","BEL","NLD","LUX","IRL","PRT","GRC",
      "AUT","FIN","SWE","DNK","CZE","POL","HUN","SVK","SVN","HRV",
      "EST","LVA","LTU","ROU","BGR","CYP","MLT"
    ];

    const zoneEuro = [
      "FRA","DEU","ITA","ESP","BEL","NLD","LUX","IRL","PRT","GRC",
      "AUT","FIN","EST","LVA","LTU","SVK","SVN","CYP","MLT","HRV"
    ];
    const candidatsUE = [
        "ALB", "MKD", "MNE", "SRB", "BIH", "UKR", "MDA"
        //"GEO", // Géorgie, candidature suspendue
        //"TUR", // Turquie, candidature suspendue
    ];
    const paysQuitteUE = [
    "GBR", "GRL"  
    ];
    // Initialisation de la carte centrée sur l'Europe
    var map = L.map('map', {
      worldCopyJump: false,
      maxBounds: [
          [-85, -180],
          [85, 180]
      ],
      maxBoundsViscosity: 1.0
    }).setView([46, 15], 3.5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 8,
      minZoom: 3,
    }).addTo(map);

    //Couleur des pays en fonction de leur statut vis-à-vis de l'UE
    function styleCountries(feature) {
      const iso = feature.properties.adm0_a3;
      if (zoneEuro.includes(iso)) {
          return { color: "#02354dff", fillColor: "#23189bff", weight: 1, fillOpacity: 0.8 }; // vert
      } else if (unionEuropeenne.includes(iso)) {
          return { color: "#02354dff", fillColor: "#04a381ff", weight: 1, fillOpacity: 0.8 }; // rouge
      }else if (paysQuitteUE.includes(iso)) {
          return { color: "#02354dff", fillColor: "#5b784cff", weight: 1, fillOpacity: 0.8 }; // rouge
      }else if(candidatsUE.includes(iso)){
          return { color: "#02354dff", fillColor: "#73e144ff", weight: 1, fillOpacity: 0.8 }; // jaune
      }
      return { color: "#02354dff", fillColor: "#bdc184ff", weight: 1, fillOpacity: 0.8 }; // autres pays
    }

    // Gestionnaire de clic pour chaque pays : redirection vers URL basée sur le code ISO
    function onEachCountry(feature, layer) {
      layer.bindTooltip(feature.properties.name, {
      sticky: true
      });
      
      layer.on('click', function(e) {
        var iso = feature.properties.adm0_a3;
        if (iso) {
            window.location.href = "pays.php?pays=" + iso;
        }
      });
    }

    var legend = L.control({ position: "bottomright" });
    legend.onAdd = function (map) {
      var div = L.DomUtil.create("div", "info legend");
      
      div.innerHTML += "<h4>Statut</h4>";
      div.innerHTML += '<i style="background:#23189bff"></i> Zone Euro<br>';
      div.innerHTML += '<i style="background:#04a381ff"></i> Union Européenne (hors Zone Euro)<br>';
      div.innerHTML += '<i style="background:#73e144ff"></i> Candidats à l\'Union Européenne<br>';
      div.innerHTML += '<i style="background:#5b784cff"></i> Pays ayant quitté l\'UE <br>';
      div.innerHTML += '<i style="background:#bdc184ff"></i> Pays faisant partie de l\'Europe (hors UE)<br>';

      return div;
};

legend.addTo(map);

    // Chargement ici du GeoJSON des pays d'Europe (provenant de Natural Earth) 
    fetch('custom.geojson')
      .then(res => res.json())
      .then(data => {
        L.geoJSON(data, {
          style: styleCountries,
          onEachFeature: onEachCountry
        }).addTo(map);
      });
  </script>

</body>

</html>