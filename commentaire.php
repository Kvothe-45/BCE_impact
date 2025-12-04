<?php
session_start();

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
if (isset($_POST['Deconnexion'])) {
    session_destroy();         
    header("Refresh:0");       
    exit;
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

<div class="lecommentaire">
<?php if (isset($_SESSION['client']['prenom'])) : ?> <form action="" method="post">
    <p class="ameliorer"> Partie commentaires pour améliorer le </br> site BCE IMPACT !</p>
        <textarea rows="15" cols="75" name="commentaires"> </textarea>
        <input type="submit" name="envoyer" value="Envoyer" class="envoyer">
    </form>
    <form method="post">
        <button type="submit" name="Deconnexion" class="deconnexion">Déconnexion</button>
    </form>
<?php 
else: ?>
    <p class="non_connecte">
        
<p class="ameliorer"> Partie commentaires pour améliorer le </br> site BCE IMPACT ! Cependant pour pouvoir mettre un commentaire vous devez être connecté</p>
        <br><br>
        <form method="post">
  <button type="submit" name="connexion" class="connexion">Connexion</button>
  </form>
    </p>
<?php if (isset($_POST['connexion'])) {
    header('Location: connexion.php');
}
?>    
<?php endif; ?>

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
