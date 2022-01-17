<?php


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once 'mongodb_config.php';

    $dbname = 'abogadosLP';
    $collection = 'datos';


    $db = new DbManager();
    $conn = $db->getConnection();


    $data = json_decode(file_get_contents("php://input", true));


    $id = $data->{'where'};


    $delete = new MongoDB\Driver\BulkWrite();
    $delete->delete(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['limit' => 0]
    );

    $result = $conn->executeBulkWrite("$dbname.$collection", $delete);


    if ($result->getDeletedCount() == 1) {
        echo json_encode(
            array("mensaje" => "Se eliminó el registro exitosamente")
        );
    } else {
        echo json_encode(
                array("mensaje" => "Error al eliminar registro")
        );
    }

?>