<?php
 if(isset($_GET['key'])){
    require 'db.hndlr.php';
    $statementi = "SELECT * FROM events where evnt_id = ? ";
    $queryi = $db->prepare($statementi);
    $queryi->execute([$_GET['key']]);
    $resulti = $queryi->fetch(PDO::FETCH_ASSOC);  
    echo json_encode($resulti);
    //var_dump($resulti);
}

if(isset($_GET['about'])){
    require 'db.hndlr.php';
    $statementi = "SELECT * FROM content where alias != ?";
    $queryi = $db->prepare($statementi);
    $queryi->execute(['homepage']);
    $resulti = $queryi->fetchall(PDO::FETCH_ASSOC);  
    echo json_encode($resulti);
}

