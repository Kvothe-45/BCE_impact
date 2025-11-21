<?php
header('Content-Type: application/json');
include 'bd.php';
$pdo = getBD();

$prenom = $_POST["p"] ?? '';
$nom = $_POST["n"] ?? '';
$mail = $_POST["mail"] ?? '';
$mdp1 = $_POST["mdp1"] ?? '';

if ($prenom=="" || $nom=="" || $mail=="" || $mdp1=="" ) {
    echo json_encode(['success'=>false,'message'=>"Veuillez remplir tous les champs."]);
    exit;
}

try {

    $req = $pdo->prepare('INSERT INTO clients (nom, prenom, email, mdp) 
                          VALUES (:nom, :prenom, :email, :mdp)');

    $req->execute([
        'nom'    => $nom,
        'prenom' => $prenom,
        'email'  => $mail,  
        'mdp'    => password_hash($mdp1, PASSWORD_DEFAULT)
    ]);

   session_start();
$_SESSION['client'] = [
    "nom" => $nom,
    "prenom" => $prenom,
    "email" => $mail
];

    echo json_encode(['success'=>true,'message'=>"Compte créé avec succès !"]);

} catch(PDOException $e) {
    echo json_encode(['success'=>false,'message'=>"Erreur : " . $e->getMessage()]);
}
exit;
?>
