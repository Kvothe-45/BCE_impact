<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "header.php";
session_start();



if(isset($_POST['envoyer'])){

    $commentaires = $_POST['commentaires'];
    $vieux = fopen("commentaires.txt", "r+"); // je recupere mes anciens commentaires , r+ permet de ne pas supprimer l'historique
    if ($vieux) {
        $vieuxcommentaires = fread($vieux, filesize("commentaires.txt")); // fread lit le nombre d'octet et filesize le nombre de caractères
        fclose($vieux);
    } else {
        $vieuxcommentaires = "";
    }
    $texte = "<span>".$commentaires."</span>\n".$vieuxcommentaires;
    $ecrire = fopen("commentaires.txt", "w+"); // w+ permet de supprimer l'historique
    fwrite($ecrire, $texte);
    fclose($ecrire);
    echo nl2br($texte); // nl12br permet de faire un saut de ligne a chaque fois
}
?>


</body>
</html>