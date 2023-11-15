<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

$referred = new Referred($conn);


$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $referred->agency_email = $data->agency_email;
    $referred->agent_name = $data->agent_name;
    $referred->agency_name = $data->agency_name;
    $referred->agency_address = $data->agency_address;
    $referred->agency_contact = $data->agency_contact;

    $referred->first_name = $data->first_name;
    $referred->surname = $data->surname;
    $referred->contact_number = $data->contact_number;
    $referred->address = $data->address;
    $referred->postcode = $data->postcode;
    $referred->receipt_of_benefit = $data->receipt_of_benefit;
    $referred->benefit_comment = $data->benefit_comment;
    $referred->household_demographic = $data->household_demographic;
    $referred->ethnicity = $data->ethnicity;
    $referred->age = $data->age;

    $referred->referral_consent = $data->referral_consent;
    $referred->availability = $data->availability;
    $referred->reason_for_referral = $data->reason_for_referral;


    $result = $referred->registerUsingReferral();

    if ($result !== false) {
        echo json_encode(array(
            "message" => "Registration Successful",
            "status" => true,
        ));
    } else {
        // If registration fails, set a 500 Internal Server Error response.
        http_response_code(500);
        echo json_encode(array(
            "message" => "Error Occurred While Registering User",
            "status" => false,
        ));
    }
} else {
    // If no data is provided in the request, set a 500 Internal Server Error response.
    http_response_code(500);
    echo json_encode(['message' => 'No data provided']);
    exit;
}
