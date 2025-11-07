<?php
	include 'bd.php';
	$bdd = getBD();
	$rep = $bdd->query("SELECT nom_pays FROM pays ORDER BY nom_pays ASC");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Graphique</title>
    <link rel="stylesheet" href="style_graph.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <h1>Graphique</h1>
    <div id="graphique">
      <canvas id="graph"></canvas>
      <p id="vide"></p>
    </div>
    <div id="filters">
      <h3>Indicateurs</h3>
      <div id="indicateurs">
        <label><input type="checkbox" onclick="afficherGraphique()" name="ind" value="inflation"> Inflation (%)</label>
        <label><input type="checkbox" onclick="afficherGraphique()" name="ind" value="dette"> Dette publique (% du PIB)</label>
        <label><input type="checkbox" onclick="afficherGraphique()" name="ind" value="chomage"> Chômage (%)</label>
      </div>
      <h3>Pays</h3>
      <div id="pays">
        <?php while ($ligne = $rep->fetch()) { ?>
          <label><input type="checkbox" onclick="afficherGraphique()" name="pays" value="<?php echo $ligne['nom_pays']; ?>"><?php echo $ligne['nom_pays']; ?></label>
			  <?php } 
			  $rep -> closeCursor(); ?>
      </div>
    </div>

  <script>
    const ctx = document.getElementById('graph').getContext('2d');
    var chart;

    async function chargerDonnees(pays, indicateur) {
      const resp = await fetch('requete.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'pays=' + pays + '&indicateur=' + indicateur
      });
      const data = await resp.json();
      return {pays, indicateur, data};
    }

    async function afficherGraphique() {
      const paysChoisi = Array.from(document.querySelectorAll('input[name="pays"]:checked')).map(cb => cb.value);
      const indChoisi = Array.from(document.querySelectorAll('input[name="ind"]:checked')).map(cb => cb.value);
      $("#vide").html("");
      if (paysChoisi.length === 0 || indChoisi.length === 0) {
        if (chart){
          chart.destroy();
        }
        let mes;
        if (paysChoisi.length === 0){
          mes = "Veuillez sélectionner au moins un pays.";
        }
        if (indChoisi.length === 0){
          mes = "Veuillez sélectionner au moins un indicateur.";
        }
        if (paysChoisi.length === 0 && indChoisi.length === 0){
          mes = "Veuillez sélectionner au moins un pays et un indicateur.";
        }
        $("#vide").html(mes);
        return;
      }
      const couleurs = [
        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
        '#393b79', '#637939', '#8c6d31', '#843c39', '#7b4173',
        '#5254a3', '#9c9ede', '#6b6ecf', '#e6550d', '#fd8d3c',
        '#31a354', '#74c476', '#9e9ac8', '#a1d99b', '#ff9896',
        '#c7c7c7', '#98df8a'
      ];
      function ajusterCouleur(couleur, facteur) {
        let r = parseInt(couleur.substring(1, 3), 16);
        let g = parseInt(couleur.substring(3, 5), 16);
        let b = parseInt(couleur.substring(5, 7), 16);
        r = Math.min(255, Math.max(0, r + (255 - r) * facteur));
        g = Math.min(255, Math.max(0, g + (255 - g) * facteur));
        b = Math.min(255, Math.max(0, b + (255 - b) * facteur));
        return `#${Math.round(r).toString(16).padStart(2, '0')}${Math.round(g).toString(16).padStart(2, '0')}${Math.round(b).toString(16).padStart(2, '0')}`;
      }
      const datasets = [];
      const scales = {};
      const variationIndicateur = {
        inflation: 0,
        dette: 0.5,
        chomage: -0.5
      };
      for (let j = 0; j < indChoisi.length; j++) {
        const ind = indChoisi[j];
        const axeId = `y${j === 0 ? '' : j}`;
        scales[axeId] = {
          type: 'linear',
          position: j % 2 === 0 ? 'left' : 'right',
          title: {display: true, text: ind},
          grid: {drawOnChartArea: j === 0}
        };
        for(let i = 0; i < paysChoisi.length; i++) {
          const pays = paysChoisi[i];
          const { data } = await chargerDonnees(pays, ind);
          const points = data.map(row => ({
            x: new Date(row.date),
            y: parseFloat(row.valeur)
          }));
          const baseCouleur = couleurs[i % couleurs.length];
          const facteur = variationIndicateur[ind] ?? 0;
          const couleurModifiee = ajusterCouleur(baseCouleur, facteur);
          datasets.push({
            label: pays + ' – ' + ind,
            data: points,
            borderColor: couleurModifiee,
            backgroundColor: couleurModifiee + '33',
            fill: false,
            tension: 0.3,
            yAxisID: axeId
          });
        }
      }

      if (chart) chart.destroy();
      chart = new Chart(ctx, {
        type: 'line',
        data: {
          datasets: datasets
        },
        options: {
          responsive: true,
          interaction: {mode: 'index', intersect: false},
          stacked: false,
          plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: 'Indicateurs : ' + indChoisi.join(', ') + ' | Pays : ' + paysChoisi.join(', ') }
          },
          scales: {
            x: {
              type: 'time',
              time: {
                unit: 'year',
                displayFormats: { year: 'yyyy' }
              },
              title: { display: true, text: 'Année' }
            },
            ...scales
          }
        }
      });
    }
    afficherGraphique();
  </script>
</body>
</html>