<?php include("../connection/conn.php");

if (isset($_POST['register_user'])) {
    $first_name = $_POST['first_name'];
    //echo $first_name;
    $surname = $_POST['surname'];
    //echo $surname;
    $contact_number = $_POST['contact_number'];
    //echo $contact_number;
    $address = $_POST['address'];
    //echo $address;
    $postcode = $_POST['postcode'];
    //echo $postcode;
    $receipt_benefit = $_POST['receipt_benefit'];
    //echo $receipt_benefit;
    $household_demographic = $_POST['household_demographic'];
    $benefit_comment = $_POST['benefit_comment'];
    //echo $benefit_comment;
    $ethnicity = $_POST['ethnicity'];
    //echo $ethnicity;
    $age = $_POST['age'];
    //echo $age;

    $insert_usr = "INSERT INTO users (first_name, surname, contact_number, address, postcode, receipt_of_benefit, benefit_comment, household_demographic, ethnicity, age) VALUES 
    ('$first_name', '$surname', $contact_number, '$address', $postcode, '$receipt_benefit', '$benefit_comment', '$household_demographic', '$ethnicity', $age )
    ";
    try {
        $result = mysqli_query($conn, $insert_usr);
        echo "<h4 style='color:green;'>User has being inserted succesfully</h4>";
    } catch (mysqli_sql_exception) {
        echo mysqli_errno($conn);
        echo "<h4 style='color:red;'>something went wrong</h4>";
        // echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-3">
        <h1 class="text-center">Register users</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="first_name" class="form-label">First name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" name="surname" id="surname" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="contact_number" class="form-label">Contact number</label>
                <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="mobile number or landline" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" cols="30" rows="5" placeholder="Door number, street name, city..." class="form-control"></textarea>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="psotcode" class="form-label">Postcode</label>
                <input type="text" name="postcode" id="postcode" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="receipt_benefit" class="form-label">Are they in receipt of Benefits?</label>
                <div>
                    <input type="checkbox" name="receipt_benefit" value="yes" id="yes">
                    <label for="reciept_of_benefit" class="form-label">Yes</label>
                </div>
                <div>
                    <input type="checkbox" name="receipt_benefit" value="no" id="no">
                    <label for="reciept_of_benefit" class="form-label">No</label>
                </div>
                <div>
                    <input type="checkbox" name="receipt_benefit" value="No recourse to public fund" id="no">
                    <label for="reciept_of_benefit" class="form-label">No recourse to public fund</label>
                </div>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="benefit_comment" class="form-label">If Yes, please list below. If No, put N/A</label>
                <textarea name="benefit_comment" id="benefit_comment" cols="30" rows="5" class="form-control" required></textarea>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="benefit_comment" class="form-label">House Demographic</label>
                <textarea name="household_demographic" id="household_demographic" cols="30" rows="5" placeholder="e.g Number of adult & children in your household" class="form-control" required></textarea>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="ethnicity" class="form-label">Ethnicity</label>
                <select name="ethnicity" class="form-control">
                    <option value="">please select...</option>
                    <option value="White- English / Welsh / Scottish / Northern Irish / British">White - English / Welsh / Scottish / Northern Irish / British </option>
                    <option value="White - Irish">White - Irish </option>
                    <option value=">White - Gypsy or Irish Traveller">White - Gypsy or Irish Traveller </option>
                    <option value="white">White - Any other white background </option>
                    <option value="White - Any other white background">Mixed - White & Black Caribbean </option>
                    <option value="Mixed - White & Black Caribbean">Mixed - White & Black Caribbean </option>
                    <option value="Mixed - White & Black African">Mixed - White & Black African </option>
                    <option value="Mixed - White & Asian">Mixed - White & Asian </option>
                    <option value="Mixed - Any other Mixed / Multiple Ethnic background">Mixed - Any other Mixed / Multiple Ethnic background </option>
                    <option value="Black - African">Black - African</option>
                    <option value="Black - Caribbean">Black - Caribbean</option>
                    <option value="Black - Any other Black African / Caribbean Background">Black - Any other Black African / Caribbean Background</option>
                    <option value="Asian - Indian">Asian - Indian</option>
                    <option value="Asian - Pakistani">Asian - Pakistani</option>
                    <option value="Asian - Bangladeshi">Asian - Bangladeshi</option>
                    <option value="Asian - Chinese">Asian - Chinese</option>
                    <option value="Asian - Any other asian background">Asian - Any other asian background</option>
                    <option value="Other - Arab">Other - Arab</option>
                </select>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="age" class="form-label">Age</label>
                <div>
                    <input type="checkbox" name="age" value="18-24" id="no">
                    <label for="age" class="form-label">18-24</label>
                </div>
                <div>
                    <input type="checkbox" name="age" value="25-34" id="yes">
                    <label for="age" class="form-label">25-34</label>
                </div>
                <div>
                    <input type="checkbox" name="age" value="35-44" id="no">
                    <label for="age" class="form-label">35-44</label>
                </div>
                <div>
                    <input type="checkbox" name="age" value="45-54" id="no">
                    <label for="age" class="form-label">45-54</label>
                </div>
                <div>
                    <input type="checkbox" name="age" value="55-64" id="no">
                    <label for="age" class="form-label">55-64</label>
                </div>
                <div>
                    <input type="checkbox" name="age" value="over-65" id="no">
                    <label for="age" class="form-label">Over - 65</label>
                </div>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="register_user" class="btn btn-info" value="Register user">
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>