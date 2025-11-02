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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
  </head>
  <body>
    <div id="graphique">
      <canvas id="graph"></canvas>
    </div>
    <div id="filters">
      <h3>Indicateurs</h3>
      <div id="indicateurs">
        <label><input type="checkbox" name="ind" value="inflation" checked> Inflation (%)</label>
        <label><input type="checkbox" name="ind" value="dette"> Dette publique (% du PIB)</label>
        <label><input type="checkbox" name="ind" value="chomage"> Chômage (%)</label>
      </div>
      <h3>Pays</h3>
      <div id="pays">
        <?php while ($ligne = $rep->fetch()) { ?>
          <label><input type="checkbox" name="pays" value="<?php echo $ligne['nom_pays']; ?>"<?= $ligne['nom_pays'] == 'France' ? 'checked' : '' ?>><?php echo $ligne['nom_pays']; ?></label>
			  <?php } 
			  $rep -> closeCursor(); ?>
      </div>
      <button id="update" onclick="afficherGraphique()">Mettre à jour le graphique</button>
    </div>

  <script>
    const ctx = document.getElementById('graph').getContext('2d');
    let chart;

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
      if (paysChoisi.length === 0 || indChoisi.length === 0) {
        alert("Veuillez sélectionner au moins un pays et un indicateur.");
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
      const datasets = [];
      
      for (let i = 0; i < paysChoisi.length; i++) {
        const pays = paysChoisi[i];
        for(let j = 0; j < indChoisi.length; j++) {
          const ind = indChoisi[j];
          const { data } = await chargerDonnees(pays, ind);
          const points = data.map(row => ({
            x: new Date(row.date),
            y: parseFloat(row.valeur)
          }));
          datasets.push({
            label: pays + ' – ' + ind,
            data: points,
            borderColor: couleurs[i % couleurs.length],
            backgroundColor: couleurs[i % couleurs.length] + '33',
            fill: false,
            tension: 0.3
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
            y: { title: { display: true, text: indChoisi } }
          }
        }
      });
    }
    afficherGraphique();
  </script>
</body>
</html>