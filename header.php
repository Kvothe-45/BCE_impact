
<DOCTYPE html>

<html lang="fr">
<head>
    <link rel="stylesheet" href="styles/style_header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<header>
    <div id ="header-content">
        <a href="Home.html">
            <img src="images/logo.png" alt="Logo de BCE Impact">
        </a>
        <h1>BCE Impact</h1>
        <a href="histoire_BCE.html">
            <img src="images/logo-ue.png" alt="Logo UE">
        </a>
    </div>
    <img id="menu-ferme" src="images/menu_ferme.png" alt="Menu">
    <div id="menu-ouvert">
        <div id="menu-header">
            <img id="img_menu_ouvert" src="images/menu_ferme.png" alt="Menu">
            <h1 id="title-Menu">Menu</h1>
        </div>
        <ul>
            <li><a href="Home.php">Accueil</a></li>
            <li><a href="definitions.php">Définitions</a></li>
            <li><a href="graphique.php">Statistiques</a></li>
            <li><a href="histoire.php">La BCE et son histoire</a></li>
            <li><a href="histoire.php">Les pays de l'UE</a></li>
            <li><a href="Commentaires.php">Commentaires</a></li>
            <li><a href="quisommesnous.php">Contact</a></li>
            <li><a href="sources.php">Sources</a></li>
        </ul>
    </div>
</header>

<script>
    $("#menu-ferme").click(function (){
        $("#menu-ouvert").css("display", "block");
    });
    $("#img_menu_ouvert").click(function (){
        $("#menu-ouvert").css("display", "none");
    });
</script>
</html>















