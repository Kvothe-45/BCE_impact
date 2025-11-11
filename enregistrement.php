
<?php
header('Content-Type: application/json');
include 'bd.php';
$pdo = getBD();

$p = $_POST["p"] ?? '';
$n = $_POST["n"] ?? '';
$mail = $_POST["mail"] ?? '';
$mdp1 = $_POST["mdp1"] ?? '';

if ($p=="" || $n=="" || $mail==""  || $mdp1=="" ) {
    echo json_encode(['success'=>false,'message'=>"Veuillez remplir tous les champs et vérifier vos mots de passe."]);
    exit;
}

try {
    $req = $pdo->prepare('INSERT INTO clients (nom, prenom, email, mdp) 
                          VALUES (:nom, :prenom, :email, :mdp)');
    $req->execute([
        'nom'    => $n,
        'prenom' => $p,
        'email'   => $mail,
        'mdp'    => password_hash($mdp1, PASSWORD_DEFAULT)
    ]);

    session_start();
    $_SESSION['mail'] = $mail;

echo json_encode(['success'=>true,'message'=>"Compte créé avec succès !"]);
} catch(PDOException $e) {
echo json_encode(['success'=>false,'message'=>"Erreur lors de l'inscription : " . $e->getMessage()]);
}
exit;
?>