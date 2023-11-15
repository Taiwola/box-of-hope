<?php
// Allow cross-origin resource sharing from any domain.
header('Access-Control-Allow-Origin: *');

// Set the response content type to JSON.
header('Content-Type: application/json');

// Allow only POST requests.
header('Access-Control-Allow-Methods: POST');

// Define the allowed headers for the request.
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

// Include the initialization file that contains constants and sets up the database connection.
include_once('../core/initialize.php');

// Create a new instance of the Agency class, which conatains methods for agency-related operations.
$agency = new Agency($conn);

// Decode the JSON data received in the request body.
$data = json_decode(file_get_contents("php://input"));

// Check if valid data was received.
if ($data) {
    // Set properties of the Agency instance with the data received.
    $agency->agent_name = $data->agent_name;
    $agency->agency_name = $data->agency_name;
    $agency->agency_address = $data->agency_address;
    $agency->agency_email = $data->agency_email;
    $agency->agency_contact = $data->agency_contact;

    // Attempt to register the agency and respond accordingly.
    if ($agency->registerAgency()) {
        echo json_encode(array('message' => 'Agent registered successfully'));
    } else {
        // If registration fails, set a 500 Internal Server Error response.
        http_response_code(500);
        echo json_encode(array('error' => true, 'message' => 'Unable to register agent'));
    }
} else {
    // If no data is provided in the request, set a 500 Internal Server Error response.
    http_response_code(500);
    echo json_encode(array('error' => true, 'message' => 'No data provided'));
}
