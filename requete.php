<?php
    header('Content-Type: application/json');
    include 'bd.php';
    $bdd = getBD();
    $sql = "SELECT date, inflation FROM inflation 
            WHERE pays = 'France'
            ORDER BY date ASC";
    $stmt = $bdd->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
?>