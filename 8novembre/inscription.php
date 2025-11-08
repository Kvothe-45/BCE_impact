<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="inscription2.css" type="text/css" media="screen">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<h1> Inscription</h1>
<div class="contenant">
<form id="formemail" action="enregistrement.php" method="post" autocomplete="off">
  <div class="content">

  <div id="message"></div> 
    <div class="input-box">
  <p> Nom : <input type="text" name="n"></p>
    <p>Prenom <input type="text" name="p"></p>
  <p>Email <input type="mail" id="mail" name="mail" ></p>
    <div class="password-requirements">
      <p class="requirement hidden error" id="email-error">Adresse mail invalide </p>
    </div>
    <div class="savanier">
      <p class="requirement hidden success" id="mail-reussit">Adresse mail valide !</p>
    </div>

  <p>Mot de passe <input type="password" id='mdp1' name="mdp1"></p>
  <div class="password-requirements">
      <p class="requirement hidden error" id="mdp-error">Le mot de passe doit contenir 1 majuscule, 1 caractere special et 1 chiffre </p>
  </div>
  <div class="savanier">
      <p class="requirement hidden success" id="mdp-reussit">Mot de passe valide !</p>
  </div>



  <button type="submit" class="envoyer">Enregistrement</button>
</form>

<script>
const matchMDP = document.getElementById("mdp-error"); 
const matchMail = document.getElementById("email-error");
const matchConfirm = document.getElementById("match"); 
const mdpbon = document.getElementById("mdp-reussit");
const mailbon = document.getElementById("mail-reussit");
const mdpbonConfirm = document.getElementById("mdp-reussit-confirm");

$(document).ready(function() {
  $('#formemail').submit(function(e) {
    e.preventDefault();

    const email = $('#mail').val().trim();
    const mdp1 = $('#mdp1').val().trim();
    const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const regexMdp = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    document.querySelectorAll('.requirement').forEach(el => el.classList.add('hidden'));
    $('#message').html('');

    var bool = true;

    if (!regexEmail.test(email)) { matchMail.classList.remove('hidden'); bool= false; } 
    else { mailbon.classList.remove('hidden'); }

    if (!regexMdp.test(mdp1)) { matchMDP.classList.remove('hidden'); bool = false; } 
    else { mdpbon.classList.remove('hidden'); }



    if (!bool) return;


    $.ajax({
      url: "enregistrement.php",
      type: "POST",
      data: $('#formemail').serialize(),
      dataType: "json",
      success: function(response) {
        if (response.success) {
          $('#message').html('<p class="success">' + response.message + '</p>');
          setTimeout(() => { window.location.href = 'index.php'; }, 1000);
        } else {
          $('#message').html('<p class="error">' + response.message + '</p>');
        }
      },
    });
  });
});
</script>


</body>
</html>
