<?php

    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    
    include_once 'mongodb_config.php';

    $dbname = 'abogadosLP';
    $collection = 'datos';


    
    $db = new DbManager();
    $conn = $db->getConnection();

    
    $filter = [];
    $option = [];
    $read = new MongoDB\Driver\Query($filter, $option);

 
    $records = $conn->executeQuery("$dbname.$collection", $read);

    echo json_encode(iterator_to_array($records));

?>