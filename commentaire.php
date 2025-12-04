<?php
session_start();
include "bd.php";
$pdo = getBD(); 

$prenom = $_SESSION['client']['prenom'] ?? '';
$nom = $_SESSION['client']['nom'] ?? '';

if (isset($_POST['envoyer'])) {
    $message = $_POST['commentaires'] ?? '';

    if (!empty(trim($message))) {
        $stmt = $pdo->prepare("INSERT INTO commentaires (prenom, nom, message) VALUES (?, ?, ?)");
        $stmt->execute([$prenom, $nom, $message]);
    }

    header("Location: ".$_SERVER['PHP_SELF']); 
    exit;
}

if (isset($_POST['supprimer']) && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM commentaires WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

$stmt = $pdo->query("SELECT * FROM commentaires ORDER BY date_envoi DESC");
$commentaires = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styl_commentaire.css">
    <title>Commentaires</title>
</head>
<body>

<?php include "header.php"; ?>
<h1 class="title"> Commentaires</h1>

<div class="lecommentaire">
<?php if (isset($_SESSION['client']['prenom'])) : ?>
    <form action="" method="post">
        <p class="ameliorer"> Partie commentaires pour améliorer le <br> site BCE IMPACT !</p>
        <textarea rows="15" cols="75" name="commentaires"></textarea>
        <input type="submit" name="envoyer" value="Envoyer" class="envoyer">
    </form>
<?php else: ?>
    <p class="ameliorer"> Partie commentaires pour améliorer le <br> site BCE IMPACT ! Cependant pour pouvoir mettre un commentaire vous devez être connecté</p>
    <form method="post">
        <button type="submit" name="connexion" class="connexion">Connexion</button>
    </form>
<?php
    if (isset($_POST['connexion'])) {
        header('Location: connexion.php');
    }
endif;
?>

<div>
<?php
foreach ($commentaires as $row) {
    echo "<div class='daniel'>";
    echo "<span class='pseudo'>Pseudo : {$row['prenom']} {$row['nom']}</span><br><br>";
    echo "<p class='message'>{$row['message']}</p><br>";
    echo "<span class='date'>Message envoyé le : ".date("Y/m/d H:i", strtotime($row['date_envoi']))."</span><br>";

 
    echo "<form method='post' style='display:inline;'>
            <input type='hidden' name='delete_id' value='{$row['id']}'>
            <button type='submit' name='supprimer'>Supprimer</button>
          </form>";

    echo "</div><br>";
}
?>
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
