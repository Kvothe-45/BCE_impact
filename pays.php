
<?php
include 'bd.php';
$bdd = getBD();

$pays = null;
$erreur = null;

if (isset($_GET['pays'])) {
    $code = $_GET['pays'];
    $stmt = $bdd->prepare("SELECT * FROM pays WHERE code = :code");
    $stmt->execute(['code' => $code]);
    $pays = $stmt->fetch();

    if (!$pays) {
        $erreur = "Ce pays n'est pas encore référencé.";
    }
} else {
    $erreur = "Aucun pays sélectionné.";
}

?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style_pays.css">
    <title>BCE IMPACT</title>
</head>

<body>
    <?php include 'header.php'; ?> 

    <div class="container">

        <?php if ($pays) { ?>

            <div class="header-pays">
                <h1><?php echo $pays['nom_pays']; ?></h1>
                <img src="<?php echo $pays['drapeau']; ?>" alt="Drapeau <?php echo $pays['nom_pays']; ?>" class="drapeau">
            </div>

            <section class="carte-identite">
                <h2>Carte d’identité</h2>
                <div class="grid-infos">
                    <div class="info-box"><strong>Superficie : </strong> <span><?php echo $pays['superficie']; ?></span></div>
                    <div class="info-box"><strong>Population : </strong> <span><?php echo $pays['population']; ?></span></div>
                    <div class="info-box"><strong>Capitale : </strong> <span><?php echo $pays['capitale']; ?></span></div>
                    <div class="info-box"><strong>Langue officielle : </strong> <span><?php echo $pays['langue']; ?></span></div>
                    <div class="info-box"><strong>Monnaie : </strong> <span><?php echo $pays['monnaie']; ?></span></div>
                    <div class="info-box"><strong>Forme de l’Etat  : </strong> <span><?php echo $pays['etat']; ?></span></div>
                    <div class="info-box"><strong>Espérance de vie : </strong> <span><?php echo $pays['vie']; ?></span></div>
                    <div class="info-box"><strong>IDH : </strong> <span><?php echo $pays['idh']; ?></span></div>
                    <div class="info-box"><strong>GINI : </strong> <span><?php echo $pays['gini']; ?></span></div>
                    <div class="info-box"><strong>EPI : </strong> <span><?php echo $pays['epi']; ?></span></div>
                    <div class="info-box"><strong>CO2/hab : </strong> <span><?php echo $pays['co2']; ?></span></div>
                    <div class="info-box"><strong>RSF : </strong> <span><?php echo $pays['rsf']; ?></span></div>
                    <div class="info-box"><strong>Indice de perception de la corruption : </strong> <span><?php echo $pays['corruption']; ?></span></div>
                    <div class="info-box"><strong>Salaire minimum : </strong> <span><?php echo $pays['smic']; ?></span></div>
                    <div class="info-box"><strong>PIB : </strong> <span><?php echo $pays['pib']; ?></span></div>
                </div>
            </section>
            
            <div class="actions-graphiques" style="margin: 20px 0; text-align: center;">
                <a href="graphique.php?pays=<?php echo $pays['nom_pays']; ?>&type=inflation" class="btn-graph">Inflation</a>
                <a href="graphique.php?pays=<?php echo $pays['nom_pays']; ?>&type=dette" class="btn-graph">Dette</a>
                <a href="graphique.php?pays=<?php echo $pays['nom_pays']; ?>&type=chomage" class="btn-graph">Chômage</a>
            </div>

            <section class="section-contenu">
                <h3>Histoire</h3>
                <?php echo $pays['histoire']; ?>
            </section>

            <section class="section-contenu">
                <h3>Économie et investissements</h3>
                <?php echo $pays['economie']; ?>
            </section>

            <section class="section-contenu">
                <h3>Santé et Protection Sociale</h3>
                <?php echo $pays['sante']; ?>
            </section>

            <section class="section-contenu">
                <h3>Religions</h3>
                <?php echo $pays['religion']; ?>
            </section>

            <section class="section-contenu">
                <h3>Les modes de vie</h3>
                <?php echo $pays['mode_vie']; ?>
            </section>

            <section class="section-contenu">
                <h3>Géographie</h3>
                <?php echo $pays['geographie']; ?>
            </section>

            <section class="section-contenu">
                <h3>Le Sport</h3>
                <?php echo $pays['sport']; ?>
            </section>

            <section class="section-contenu">
                <h3>Politique</h3>
                <?php echo $pays['politique']; ?>
            </section>
        
        <?php }else if (!isset($_GET['pays'])){ ?>
            <h2 id="h2pays">Pays de l'UE</h2>
            <div class="liste-pays">

            <?php  
            $req = $bdd->query("SELECT nom_pays, drapeau, code FROM pays ORDER BY nom_pays ASC");
            while ($row = $req->fetch()) { ?>
                
                <a href="?pays=<?php echo $row['code']; ?>" class="flag-card">
                    <img src="<?php echo $row['drapeau']; ?>" alt="Drapeau <?php echo $row['nom_pays']; ?>">
                    <p><?php echo $row['nom_pays']; ?></p>
                </a>
            <?php } ?>

            </div>
        
        <?php }else{ ?>
            
            <div class="error-msg">
                <p><?php echo $erreur; ?></p>
            </div>

        <?php } ?>

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