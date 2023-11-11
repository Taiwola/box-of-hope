<?php




class Box
{
    private $conn;
    private $agency = 'agency';
    private $users = 'users';
    private $reffered = 'reffered_users';

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
    public $house_demographic;
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

    function registerAgency($data)
    {
    }

    function getUserDetails($userId)
    {
    }
}
