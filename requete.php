<?php
    header('Content-Type: application/json');
    include 'bd.php';
    $bdd = getBD();
    $pays = $_POST['pays'];
    $table = $_POST['indicateur'];
    if($table == "chomage"){
        $ind = $table."_pourcent";
    }else{
        $ind = $table;
    }
    if($table == "chomage" || $table == "dette"){
        $time = "annee";
    }else{
        $time = "date";
    }
    $sql = "SELECT $time AS date, $ind AS valeur 
            FROM $table 
            WHERE pays = :pays
            ORDER BY date ASC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['pays' => $pays]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>