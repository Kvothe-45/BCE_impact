<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/connecter.css"
type="text/css" media="screen" />
</head>
<body>
    

<?php
session_start();
if (!isset($_SESSION['CSRF_TOKEN'])) {
    $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32));
}
?>
<form action="connecter.php" method="post" autocomplete="off">




<h1>Connexion</h1>
<div class="contenant">
  <form action="">
    <div class="input-box">
      <p>Email<input type="mail" name="email" value=""  /></p>
      <i class="ri-user-fill"></i>
      <p>Mot de passe <INPUT type="text" name="mdp" value=""></p>
    </div>


<p><input  type="submit" value="Connexion" class='envoyer'></p>
<input type="hidden" name="csrf_token" value="<?php ($_SESSION['CSRF_TOKEN']); ?>">

</body>
</html>