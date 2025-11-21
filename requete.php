<?php
    header('Content-Type: application/json');
    include 'bd.php';
    $bdd = getBD();
    $pays = $_POST['pays'];
    $ind = $_POST['indicateur'];
    $anneeMin = $_POST['anneeMin'];
    $anneeMax = $_POST['anneeMax'];
    if($ind == "chomage_pourcent" || $ind == "chomage_nombre"){
        $table = "chomage";
    }else{
        $table = $ind;
    }
    if($table == "chomage" || $table == "dette"){
        $time = "annee";
    }else{
        $time = "date";
    }
    if($table == "inflation"){
        $sql = "SELECT $time AS date, $ind AS valeur 
            FROM $table 
            WHERE pays = :pays
            AND YEAR($time) BETWEEN :amin AND :amax
            ORDER BY date ASC";
    }else{
        $sql = "SELECT $time AS date, $ind AS valeur 
            FROM $table 
            WHERE pays = :pays
            AND $time BETWEEN :amin AND :amax
            ORDER BY date ASC";
    }
    $req = $bdd->prepare($sql);
    $req->execute([
        'pays' => $pays,
        'amin' => $anneeMin,
        'amax' => $anneeMax
    ]);
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>