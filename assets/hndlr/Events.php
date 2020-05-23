<?php
 if(isset($_POST['page'])){
    require 'db.hndlr.php';
    $start_from = '';
    $page = $_POST['page'];
    $page != '' ? $start_from = ($_POST['page'] - 1) * 5 : $start_from = '1';
    $statementi = "SELECT * FROM events ORDER BY end_date ASC LIMIT $page, 5";
    $queryi = $db->prepare($statementi);
    $queryi->execute();
    $resulti = $queryi->fetchall(PDO::FETCH_ASSOC);  
    
    echo json_encode($resulti);
    // var_dump($resulti);
}


if(isset($_GET['data'])){
    require 'db.hndlr.php';
   
    $statementi = "SELECT * FROM events ORDER BY end_date ASC";
    $queryi = $db->prepare($statementi);
    $queryi->execute();
    $resulti = $queryi->fetchall(PDO::FETCH_ASSOC);  
    $row = $queryi -> rowCount();
    //echo json_encode($resulti);
    // var_dump($resulti);
    echo $row;
}