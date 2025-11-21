<?php
session_start();

if (!isset($_SESSION['client']) || !is_array($_SESSION['client'])) {
    echo "Vous devez être connecté.";
    exit;
}
$prenom = isset($_SESSION['client']['prenom']) ? ($_SESSION['client']['prenom']) : '';
$nom = isset($_SESSION['client']['nom']) ? ($_SESSION['client']['nom']) : '';

$ancien = "";
if (file_exists("commentaires.txt")) {
    $vieux = fopen("commentaires.txt", "r+");
    if ($vieux) {
        $ancien = fread($vieux, filesize("commentaires.txt"));// fread lit le nombre d'octet et filesize le nombre de caractères ici on ouvre le bloc note ou y a les commentaires
        fclose($vieux);
    }
}

if (isset($_POST['envoyer'])) {
    $commentaires = $_POST['commentaires'];
    $texte = 
"<div class='daniel'><span class='pseudo' >Pseudo : ".$prenom." " .$nom."</span><br><br>
<p class='message' >".$commentaires."</p><br>
    <span class='date'> Message envoyé le : ".date("Y/m/d")." | ".date("h:i A")."</span><br>
    
    
</div>\n<br>"
.$ancien;
    

    $ecrire = fopen("commentaires.txt", "w+");// w+ permet de supprimer l'historique
    fwrite($ecrire, $texte);
    fclose($ecrire);
    $ancien = $texte;
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
<p class="ameliorer"> Partie commentaires pour améliorer le </br> site BCE IMPACT !</p>
<div class="lecommentaire">
<form action="" method="post">
    <textarea rows="15" cols="75" name="commentaires">Rejoindre la discussion </textarea>
    <input type="submit" name="envoyer" value="Envoyer" class="envoyer">
</form>
</div>
<div >
    <?php echo ($ancien); ?>  
</div> 

<footer>
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

