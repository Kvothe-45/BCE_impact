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
    <link rel="stylesheet" href="styles/style_graph.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="graphique.js"></script>
  </head>
  <body>
    <?php include 'header.php'; ?> 
    <div id="contenue">
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
          <label><input type="checkbox" onclick="chomage()" value="chomage"> Chômage</label>
          <div id="chom">
            <label><input type="checkbox" onclick="afficherGraphique()" name="ind" value="chomage_pourcent"> Chômage (%)</label>
            <label><input type="checkbox" onclick="afficherGraphique()" name="ind" value="chomage_nombre"> Chômage (millier de personnes)</label>
          </div>
        </div>
        <h3>Période</h3>
        <div id="periode">
          <label>De :
            <input type="number" id="anneeMin" value="1996" min="1996" max="2025" onchange="afficherGraphique()">
          </label>
          <label>À :
            <input type="number" id="anneeMax" value="2025" min="1996" max="2025" onchange="afficherGraphique()">
          </label>
        </div>
        <h3>Pays</h3>
        <div id="pays">
          <?php while ($ligne = $rep->fetch()) { ?>
            <label><input type="checkbox" onclick="afficherGraphique()" name="pays" value="<?php echo $ligne['nom_pays']; ?>"><?php echo $ligne['nom_pays']; ?></label>
			    <?php } 
			    $rep -> closeCursor(); ?>
        </div>
      </div>
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
  </body>
</html>