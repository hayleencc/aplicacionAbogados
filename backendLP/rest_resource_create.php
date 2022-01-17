<?php


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once 'mongodb_config.php';

    $dbname = 'abogadosLP';
    $collection = 'datos';


    $db = new DbManager();
    $conn = $db->getConnection();


    $data = json_decode(file_get_contents("php://input", true));

    $insert = new MongoDB\Driver\BulkWrite();
    $insert->insert($data);

    $result = $conn->executeBulkWrite("$dbname.$collection", $insert);


    if ($result->getInsertedCount() == 1) {
        echo json_encode(
            array("mensaje" => "Se creó exitosamente el registro")
        );
    } else {
        echo json_encode(
                array("mensaje" => "Error al crear el registro")
        );
    }

?>