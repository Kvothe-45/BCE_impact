<?php
	include 'bd.php';
	$bdd = getBD();
	$rep = $bdd->query("select nom_pays from pays");
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
        <label><input type="checkbox" value="inflation" checked> Inflation (%)</label>
        <label><input type="checkbox" value="dette"> Dette publique (% du PIB)</label>
        <label><input type="checkbox" value="chomage"> Chômage (%)</label>
      </div>
      <h3>Pays</h3>
      <div id="pays">
        <?php while ($ligne = $rep->fetch()) { ?>
          <label><input type="checkbox" value="<?php echo strtolower(str_replace(' ', '-', $ligne['nom_pays'])); ?>" <?php if ($ligne['nom_pays'] == 'France') echo 'checked'; ?>> <?php echo $ligne['nom_pays']; ?></label>
			  <?php } 
			  $rep -> closeCursor(); ?>
      </div>
      <button id="update">Mettre à jour le graphique</button>
    </div>

  <script>
    const ctx = document.getElementById('graph').getContext('2d');
    let chart;

    //charger les données depuis la base
    async function chargerInflation() {
      const resp = await fetch('requete.php');
      const data = await resp.json();

    //convertir les données SQL en format lisible pour Chart.js
      const labels = data.map(row => new Date(row.date));
      const valeurs = data.map(row => parseFloat(row.inflation));
      return { labels, valeurs };
    }

    //dessiner le graphique
    async function afficherGraphique() {
      const { labels, valeurs } = await chargerInflation();

      if (chart) chart.destroy();

      chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'France – Inflation (%)',
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
            title: { display: true, text: 'Inflation - France' }
          },
          scales: {
            x: {
              type: 'time',
              time: {
                unit: 'year',
                displayFormats: {
                  year: 'yyyy'
                }
              },
              title: { display: true, text: 'Année' }
            },
            y: { title: { display: true, text: 'Taux d’inflation (%)' } }
          }
        }
      });
    }
    afficherGraphique();
</script>
</body>
</html>