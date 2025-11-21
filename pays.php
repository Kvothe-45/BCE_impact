
<?php

if (isset($_GET['pays'])) {
    $codePays = $_GET['pays'];
} else {
    $codePays = 'none';
}

?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BCE IMPACT</title>
</head>

<body>
    <?php include 'header.php'; ?> 

    <h2 id="h2his">Informations sur le pays : <?php echo $codePays; ?></h2>

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