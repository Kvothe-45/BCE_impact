<?php

$ancien = "";
if (file_exists("commentaires.txt")) {
    $vieux = fopen("commentaires.txt", "r+");
    if ($vieux) {
        $ancien = fread($vieux, filesize("commentaires.txt"));// fread lit le nombre d'octet et filesize le nombre de caractères ici on ouvre le bloc note ou y a les commentaires
        fclose($vieux);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/styl_commentaire.css">

    <title>Document</title>
</head>
<body>

<?php include "header.php"; ?>
<h1 class="title"> Commentaires</h1>
<p class="ameliorer"> Partie commentaires pour améliorer le </br> site BCE IMPACT ! Cependant pour pouvoir mettre un commentaire vous devez être connecté</p>
</div>
  <button type="submit" name="connexion" class="connexion">Connexion</button>
<div >
    <?php echo ($ancien); ?>  
</div> <footer>
    <a href="Home.html">
        <img src="images/logo.png" alt="Logo de BCE Impact">
    </a>
    <h2>Projet L3 MIASHS</h2>
    <ul>
        <li><a>Pour aller plus loin</a></li>
        <li><a>Commentaires</a></li>
        <li><a>Sources</a></li>
        <li><a>Contact</a></li>
    </ul>
</footer>

</body>
</html>

