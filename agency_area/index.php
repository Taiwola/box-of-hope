<?php
include("../connection/conn.php");

if (isset($_POST['register_agent'])) {
    $agent_name = $_POST['agent_name'];
    //echo $agent_name;
    $agent_organisation = $_POST['agent_organisation'];
    //echo $agent_organisation;
    $agency_address = $_POST['agency_address'];
    //echo $agency_address;
    $agency_email = $_POST['agency_email'];

    $agency_contact = $_POST['agency_contact'];

    $email_exist = "SELECT * FROM agency WHERE agency_email='$agency_email'";
    $email_result = mysqli_query($conn, $email_exist);

    if (mysqli_num_rows($email_result) > 0) {
        echo "<script>alert('email already exist') </script>";
    }

    $insert_agent = "INSERT INTO agency (agent_name, agency_name, agency_address, agency_email, agency_contact) VALUES (
        '$agent_name', '$agent_organisation', '$agency_address', '$agency_email', $agency_contact
    )";

    try {
        $result = mysqli_query($conn, $insert_agent);
        echo "<h4 style='color:green;'>Agency has being inserted succesfully</h4>";
    } catch (mysqli_sql_exception) {

        echo "<h4 style='color:red;'>something went wrong</h4>";
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-3">
        <h1 class="text-center">Register agency</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="agent_name" class="form-label">Agent name</label>
                <input type="text" name="agent_name" id="agent_name" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="agent_organisation" class="form-label">Agent organisataion</label>
                <input type="text" name="agent_organisation" id="agent_organisation" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="agency_address" class="form-label">Agency address</label>
                <textarea name="agency_address" id="agency_address" cols="30" rows="5" placeholder="Door number, street name, city..." class="form-control"></textarea>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="agency_email" class="form-label">Agency Email</label>
                <input type="text" name="agency_email" id="agent_email" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="agency_contact" class="form-label">Agency Contact</label>
                <input type="text" name="agency_contact" id="agent_contact" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="register_agent" class="btn btn-info" value="Register user">
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>