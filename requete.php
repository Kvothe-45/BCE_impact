<?php
    header('Content-Type: application/json');
    include 'bd.php';
    $bdd = getBD();
    $pays = $_POST['pays'];
    $sql = "SELECT date, inflation 
            FROM inflation 
            WHERE pays = :pays
            ORDER BY date ASC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['pays' => $pays]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>