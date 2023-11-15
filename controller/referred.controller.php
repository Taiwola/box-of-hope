<?php
class Referred
{
    private $conn;
    private $agencyTableName = 'agency';
    private $usersTableName = 'users';
    private $referredTableName = 'referred_user';

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

    // agency
    public $agent_id;
    public $agent_name;
    public $agency_name;
    public $agency_address;
    public $agency_email;
    public $agency_contact;

    public $referred_id;
    public $referral_consent;
    public $availability;
    public $reason_for_referral;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerUsingReferral()
    {
        // Search for the agency using the provided agency email
        $search_query = "SELECT * FROM $this->agencyTableName WHERE agency_email='$this->agency_email'";
        $result = $this->conn->query($search_query);

        // Check if there are results and the number of rows is greater than 0
        if ($result && $result->num_rows > 0) {
            // Fetch the agency data as an associative array
            $fetch_result = $result->fetch_assoc();

            // Check if fetching the agency data was successful
            if (!$fetch_result) {
                return false;
            }

            // Get the 'agent_id' from the fetched agency data
            $agent_id = $fetch_result['agent_id'];

            // Insert user data into the 'users' table
            $insert_user = "INSERT INTO $this->usersTableName (first_name, surname, contact_number, address, postcode, receipt_of_benefit, benefit_comment, household_demographic, ethnicity, age, agent_id)
            VALUES
            ('$this->first_name', '$this->surname', '$this->contact_number', '$this->address', $this->postcode, '$this->receipt_of_benefit', '$this->benefit_comment', '$this->household_demographic', '$this->ethnicity', '$this->age', $agent_id)
            ";

            $query_result = $this->conn->query($insert_user);

            // Check if user insertion was successful
            if ($query_result) {
                // Search for the newly inserted user using the contact number
                $search_query = "SELECT * FROM $this->usersTableName WHERE contact_number='$this->contact_number'";
                $result = $this->conn->query($search_query);

                // Check if the search for the user was successful
                if (!$result) {
                    die("Query failed: " . $this->conn->error);
                }

                // Fetch user data as an associative array
                $user_data = $result->fetch_assoc();
                $user_id = $user_data['user_id'];

                // Insert data into the 'referred_user' table
                $insert_referred = "INSERT INTO $this->referredTableName (agent_id, referral_consent, availability, user_id, reason_for_referral) VALUES
                ($agent_id, '$this->referral_consent', '$this->availability', $user_id, '$this->reason_for_referral')
                ";

                $query_result = $this->conn->query($insert_referred);

                // Check if the referral insertion was successful
                if ($query_result) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            http_response_code(400);
            echo 'No matching record found';
        }
    }
}
