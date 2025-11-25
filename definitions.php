<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style_def.css">
    <title>BCE IMPACT</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include 'header.php';
    include 'bd.php';
    $bdd = getBD();
    $stmt = $bdd->query("SELECT * FROM definitions");
 ?> 

    <div class="container">
        <?php while ($defs = $stmt->fetch()) { ?>
        <h4 class="nom_def"><?php echo $defs['nom']; ?></h4>
        <div class="def"><?php echo $defs['def']; ?></div>
        <?php }?>

    </div>

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

<script>
  $(document).ready(function() {

    function afficheDef(def){
        $(".def").css("display","none");
        def.css("display", "block");
    } 

    $(".nom_def").click(function () {
        afficheDef($(this).next(".def"));
    });


});
    </script>

</body> 

</html>
