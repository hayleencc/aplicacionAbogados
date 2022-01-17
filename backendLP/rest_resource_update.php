<?php


    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once 'mongodb_config.php';

    $dbname = 'abogadosLP';
    $collection = 'datos';


    $db = new DbManager();
    $conn = $db->getConnection();


    $data = json_decode(file_get_contents("php://input", true));

    $fields = $data->{'fields'};

    $set_values = array();

    foreach ($fields as $key => $fields) {
        $arr = (array)$fields;
        foreach ($fields as $key => $value) {
            $set_values[$key] = $value;
        }
    }


    $id = $data->{'where'};


    $update = new MongoDB\Driver\BulkWrite();
    $update->update(
        ['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $set_values], ['multi' => false, 'upsert' => false]
    );

    $result = $conn->executeBulkWrite("$dbname.$collection", $update);


    if ($result->getModifiedCount() == 1) {
        echo json_encode(
            array("mensaje" => "Se actualizó exitosamente el registro")
        );
    } else {
        echo json_encode(
                array("mensaje" => "Error al actualizar el registro")
        );
    }

?>