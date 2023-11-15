<?php

class User
{
    private $conn;
    private $agency = 'agency';
    private $users = 'users';
    private $reffered = 'referred_user';

    // agency
    public $agent_id;
    public $agent_name;
    public $agency_name;
    public $agency_address;
    public $agency_email;
    public $agency_contact;

    // user
    public $user_id;
    public $first_name;
    public $surname;
    public $contact_number;
    public $address;
    public $postcode;
    public $receipt_of_benefit;
    public $benefit_comment;
    public $household_demographic;
    public $ethnicity;
    public $age;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    function registerUser()
    {
        //create query
        // Check if the user with the given contact number already exists
        $search_query = "SELECT * FROM $this->users WHERE contact_number='$this->contact_number'";
        $result = $this->conn->query($search_query);
        $row_count = $result->num_rows;
        // If the user already exists, return an error response
        if ($row_count > 0 && $result) {
            http_response_code(409);
            echo 'Contact number already registered';
            return false;
        }

        // Insert the new user data into the 'users' table
        $insert_query = "INSERT INTO $this->users (first_name, surname, contact_number, address, postcode, receipt_of_benefit, benefit_comment, household_demographic, ethnicity, age)
        VALUES
        ('$this->first_name', '$this->surname', '$this->contact_number', '$this->address', $this->postcode, '$this->receipt_of_benefit', '$this->benefit_comment', '$this->household_demographic', '$this->ethnicity', '$this->age')
        ";
        $query_result = $this->conn->query($insert_query);

        // Check if the user registration is successful
        if ($query_result) {
            return true;
        } else {
            // If there is an error during the insertion, print the error message
            http_response_code(400);
            printf("Error %s. \n", $this->conn->error);
            return false;
        }
    }
}
