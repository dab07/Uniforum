<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");

//Check for required fields from the form
if( ($_POST['fname']=="") || ($_POST['lname']=="") || ($_POST['username']=="") || ($_POST['password']=="")){
    header("Location: Initial/createAccount.php");
    exit;
}

$display_block="";


//Clean the input
$safe_fname = mysqli_real_escape_string($conn, $_POST['fname']);
$safe_lname = mysqli_real_escape_string($conn, $_POST['lname']);
$safe_username = mysqli_real_escape_string($conn, $_POST['username']);
$safe_password = mysqli_real_escape_string($conn, $_POST['password']);

$id = CalcId();

$sql = "INSERT INTO uf_auth_user VALUES(".$id.", '".$safe_fname."', '".$safe_lname."', '".$safe_username."', '".$safe_password."');";

$verify_result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($verify_result){
    $display_block = "Your account has been created!";
}
else{
    $display_block = "Error: Your account could not be created.";
}

//Calculate a unique UserId for the new user
function CalcId(){
    //$mysqli = mysqli_connect("localhost:3306", "lisabalbach_tarkowr", "CIT1802511", "lisabalbach_testdb");
    $mysqli = mysqli_connect("localhost", "root", "", "user007");

    $verify_sql = "SELECT UserId FROM uf_auth_user ORDER BY UserId ASC";

    $result = mysqli_query($mysqli, $verify_sql) or die(mysqli_error($mysqli));

    while($user_info = mysqli_fetch_array($result)){
        $user_id = $user_info['UserId'];
    }

    return $user_id + 1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/html_css/css/forms.css">
    <title>Account</title>
    <style>
        body{
            text-align: center;
            font-size: 18px;
        }
        a{
            color: #4286f4;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header id = "top">
    <h1> Login to UniForum </h1>
</header>
<p> <?php echo $display_block ?> </p>
<p> <a href = "/html_css/html/login.html">Return to Login</a> </p>

</body>
</html>