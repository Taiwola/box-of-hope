<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

$box = new Box($conn);


$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $box->first_name = $data->first_name;
    $box->surname = $data->surname;
    $box->contact_number = $data->contact_number;
    $box->address = $data->address;
    $box->postcode = $data->postcode;
    $box->receipt_of_benefit = $data->receipt_of_benefit;
    $box->benefit_comment = $data->benefit_comment;
    $box->household_demographic = $data->household_demographic;
    $box->ethnicity = $data->ethnicity;
    $box->age = $data->age;

    if ($box->registerUser()) {
        echo json_encode(array("message" => "Registration Successful!", "status" => true));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Error Registering User.", "status" => false));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to register user.", "status" => false));
}
