
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
                    <div class="info-box"><strong>Membre : </strong> <span><?php echo $pays['membre']; ?></span></div>
                    <div class="info-box"><strong>Liste de médias : </strong> <span><?php echo $pays['media']; ?></span></div>
                    <div class="info-box"><strong>Dette publique : </strong> <span><?php echo $pays['dette']; ?></span></div>
                    <div class="info-box"><strong>Déficit publique : </strong> <span><?php echo $pays['deficit']; ?></span></div>
                    <div class="info-box"><strong>ZES : </strong> <span><?php echo $pays['zes']; ?></span></div>
                </div>
            </section>
            
            <section class="section-contenu">
                <?php echo $pays['histoire']; ?>
            </section>

            <section class="section-contenu">
                <?php echo $pays['geographie']; ?>
            </section>

            <section class="section-contenu">
                <?php echo $pays['economie']; ?>
            </section>

            <section class="section-contenu">
                <?php echo $pays['societe']; ?>
            </section>

            <section class="section-contenu">
                <?php echo $pays['politique']; ?>
            </section>

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