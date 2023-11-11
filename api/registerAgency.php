<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

$box = new Box($conn);


$data = json_decode(file_get_contents("php://input"));


if ($data) {
    $box->agent_name = $data->agent_name;
    $box->agency_name = $data->agency_name;
    $box->agency_address = $data->agency_address;
    $box->agency_email = $data->agency_email;
    $box->agency_contact = $data->agency_contact;

    if ($box->registerAgency()) {
        echo json_encode(array('message' => 'Agent registered successfully'));
    } else {
        http_response_code(500);
        echo json_encode(array('error' => true, 'message' => 'Unable to register agent'));
    }
} else {
    http_response_code(500);
    echo json_encode(array('error' => true, 'message' => 'No data provided'));
}
