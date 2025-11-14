<html>
<head>
    
<title>connecter</title>
</head>
<?php include 'header.php'; ?> 

<body>

<?php
include 'bd.php';
$pdo = getBD();

$email = $_POST['email'];
$mdp = $_POST['mdp'];


$stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
$stmt->execute([$email]);  
$req = $stmt;  
$client = $req->fetch();

if ($client && password_verify($mdp, $client['mdp'])) {
    session_start();
    if (!isset($_SESSION['CSRF_TOKEN'])) {
    $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32));
}
    $_SESSION['client']=array(
        "nom" => $client['nom'],
        "prenom" => $client['prenom'],
        "email" => $client['email']
    );

    echo '<meta http-equiv="refresh" content="0;url=index.php">';
} else {
    ?> <script> alert("Mot de passe ou email incorrect")</script><?php
    echo '<meta http-equiv="refresh" content="2;url=connexion.php">';
}
?>
</body>

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
</html>

