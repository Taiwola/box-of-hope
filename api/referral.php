<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

$box = new Box($conn);

$results =

    $data = json_decode(file_get_contents("php://input"));

if ($data) {
    $box->agency_email = $data->agency_email;
    $box->agent_name = $data->agent_name;
    $box->agency_name = $data->agency_name;
    $box->agency_address = $data->agency_address;
    $box->agency_contact = $data->agency_contact;

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

    $box->referral_consent = $data->referral_consent;
    $box->availability = $data->availability;
    $box->reason_for_referral = $data->reason_for_referral;


    if ($result = $box->registerUsingReferral()) {

        if ($result == true) {
            echo json_encode(array(
                "message" => "Registration Successful",
                "status" => true,
            ));
        } else {
            echo json_encode(array(
                "message" => "Error Occurred While Registering User",
                "status" => false,
            ));
        }
    } else {
        http_response_code(500);
        echo json_encode(array(
            "message" => "Error Occurred",
        ));
    }
} else {
    http_response_code(500);
    echo json_encode(['message' => 'No data provided']);
    exit;
}
