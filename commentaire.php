<?php
session_start();
include "bd.php";
$pdo = getBD(); 

$prenom = $_SESSION['client']['prenom'] ?? '';
$nom = $_SESSION['client']['nom'] ?? '';
$email = $_SESSION['client']['email'] ?? '';

#$pdo->query("DELETE FROM commentaires WHERE date_envoi <= DATE_SUB(NOW(), INTERVAL 2 WEEK)");

if (isset($_POST['envoyer'])) {
    $message = $_POST['commentaires'] ?? '';

    if (!empty(trim($message))) {
        $stmt = $pdo->prepare("INSERT INTO commentaires (prenom, nom, message,email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$prenom, $nom, $message, $email]);
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
    <link rel="stylesheet" href="styles/style_commentaire.css">
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
    <a href="deconnexion.php"><button id="deconnexion">Se déconnecter</button></a>
<?php else: ?>
    <p class="ameliorer"> Partie commentaires pour améliorer le site BCE IMPACT !<br> Cependant pour pouvoir mettre un commentaire vous devez être connecté</p>
    <a href="inscription.php"><button type="submit" name="inscription" class="connexion">Inscription</button></a>
    <a href="connexion.php"><button type="submit" name="connexion" class="connexion">Connexion</button></a>
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
    echo "<span class='pseudo'>Pseudo : {$row['prenom']} {$row['nom']}</span>";
    echo "<p class='message'>{$row['message']}</p>";
    echo "<span class='date'>Message envoyé le : ".date("Y/m/d H:i", strtotime($row['date_envoi']))."</span>";

    if ($_SESSION['client']['email']==$row['email']){
    echo "<form method='post' style='display:inline;'>
            <input type='hidden' name='delete_id' value='{$row['id']}'>
            <button type='submit' name='supprimer'>Supprimer</button>
          </form>";
    }
    echo "</div><br>";
}
?>
</div></div>

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
