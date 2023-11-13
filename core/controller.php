<?php
class Box
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

    // referral
    public $referred_id;
    public $referral_consent;
    public $availability;
    public $reason_for_referral;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }



    function userExist()
    {
        $search_query = "SELECT * FROM $this->users WHERE contact_number='$this->contact_number'";
        $result = $this->conn->query($search_query);
        $row_count = $result->num_rows;
        if ($row_count > 0 && $result) {
            http_response_code(409);
            echo 'Contact number already registered';
            return false;
        }
    }

    function getAgent()
    {
        $query = "SELECT * FROM $this->agency";
        $result = $this->conn->query($query);

        if ($result) {
            $fetch_result = $result->fetch_all(MYSQLI_ASSOC);
            $result->free_result();
            return $fetch_result;
        } else {
            echo json_encode('error occured');
        }
    }

    function registerAgency()
    {
        $search_query = "SELECT * FROM $this->agency WHERE agency_email='$this->agency_email' ";
        $result = $this->conn->query($search_query);
        $row_count = $result->num_rows;
        if ($row_count > 0 && $result) {
            http_response_code(409);
            echo 'Email already exists';
            return false;
        }
        $insert_query = "INSERT INTO $this->agency (agency_name,agency_address,agency_email,agency_contact,agent_name) VALUES 
        ('$this->agency_name', '$this->agency_address', '$this->agency_email', $this->agency_contact, '$this->agent_name')
        ";
        $query_result = $this->conn->query($insert_query);

        if ($query_result) {
            return true;
        } else {
            printf("Error %s. \n", $this->conn->error);
            return false;
        }
    }


    function registerUser()
    {
        //create query

        $search_query = "SELECT * FROM $this->users WHERE contact_number='$this->contact_number'";
        $result = $this->conn->query($search_query);
        $row_count = $result->num_rows;
        if ($row_count > 0 && $result) {
            http_response_code(409);
            echo 'Contact number already registered';
            return false;
        }

        $insert_query = "INSERT INTO $this->users (first_name, surname, contact_number, address, postcode, receipt_of_benefit, benefit_comment, household_demographic, ethnicity, age)
        VALUES
        ('$this->first_name', '$this->surname', '$this->contact_number', '$this->address', $this->postcode, '$this->receipt_of_benefit', '$this->benefit_comment', '$this->household_demographic', '$this->ethnicity', '$this->age')
        ";
        $query_result = $this->conn->query($insert_query);

        if ($query_result) {
            return true;
        } else {
            http_response_code(400);
            printf("Error %s. \n", $this->conn->error);
            return false;
        }
    }


    function registerUsingReferral()
    {

        if ($this->userExist()) {
            http_response_code(409);
            echo 'Email address is already in use';
            die("Query failed: " . $this->conn->error);
            return false;
        } else {
            // create query
            $search_query = "SELECT * FROM $this->agency WHERE agency_email='$this->agency_email' ";
            $result = $this->conn->query($search_query);
            if ($result && $result->num_rows > 0) {
                // Fetch the first row as an associative array
                $fetch_result = $result->fetch_assoc();
                if (!$fetch_result) {
                    return false;
                }
                // Access the 'agent_id' value from the array
                $agent_id = $fetch_result['agent_id'];
                $insert_user = "INSERT INTO $this->users (first_name, surname, contact_number, address, postcode, receipt_of_benefit, benefit_comment, household_demographic, ethnicity, age, agent_id)
            VALUES
            ('$this->first_name', '$this->surname', '$this->contact_number', '$this->address', $this->postcode, '$this->receipt_of_benefit', '$this->benefit_comment', '$this->household_demographic', '$this->ethnicity', '$this->age', $agent_id)
            ";

                $query_result = $this->conn->query($insert_user);

                if ($query_result) {
                    $search_query = $search_query = "SELECT * FROM $this->users WHERE contact_number='$this->contact_number'";;
                    $result = $this->conn->query($search_query);
                    if (!$result) {
                        die("Query failed: " . $this->conn->error);
                    }
                    $user_data = $result->fetch_assoc();
                    $user_id = $user_data['user_id'];

                    $insert_referred = "INSERT INTO $this->reffered (agent_id, referral_consent,availability, user_id, reason_for_referral) VALUES
                ($agent_id, '$this->referral_consent', '$this->availability', $user_id, '$this->reason_for_referral')
                ";
                    $query_result = $this->conn->query($insert_referred);

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
}
