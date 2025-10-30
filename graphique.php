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
      return data;
    }

    async function afficherGraphique() {
      const paysChoisi = document.querySelector('input[name="pays"]:checked').value;
      const indChoisi = document.querySelector('input[name="ind"]:checked').value;
      const data = await chargerDonnees(paysChoisi, indChoisi);
      const labels = data.map(row => new Date(row.date));
      const valeurs = data.map(row => parseFloat(row.valeur));
      if (chart) chart.destroy();
      chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: paysChoisi + ' – ' + indChoisi,
            data: valeurs,
            borderColor: '#0055ff',
            backgroundColor: 'rgba(0,85,255,0.1)',
            tension: 0.3
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'bottom' },
            title: { display: true, text: indChoisi + ' - ' + paysChoisi }
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