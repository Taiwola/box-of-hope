<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once('../core/initialize.php');

$agency = new Agency($conn);


// Get the list of agencies from the database.
$results = $agency->getAgent();

// Encode the results as JSON and send the response.
echo json_encode($results);
