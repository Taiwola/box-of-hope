<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

// Create a new instance of the User class
$user = new User($conn);


// Decode the JSON data received in the request body.
$data = json_decode(file_get_contents("php://input"));

// Check if valid data was received.
if ($data) {
    // Set properties of the User instance with the data received.
    $user->first_name = $data->first_name;
    $user->surname = $data->surname;
    $user->contact_number = $data->contact_number;
    $user->address = $data->address;
    $user->postcode = $data->postcode;
    $user->receipt_of_benefit = $data->receipt_of_benefit;
    $user->benefit_comment = $data->benefit_comment;
    $user->household_demographic = $data->household_demographic;
    $user->ethnicity = $data->ethnicity;
    $user->age = $data->age;

    if ($user->registerUser()) {
        echo json_encode(array("message" => "Registration Successful!", "status" => true));
    } else {
        // If registration fails, set a 500 Internal Server Error response.
        http_response_code(500);
        http_response_code(500);
        echo json_encode(array("message" => "Error Registering User.", "status" => false));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to register user.", "status" => false));
}
