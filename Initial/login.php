<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");


//Check for required fields from the form
if(($_POST['username']=="") || ($_POST['password']=="")){
    header("Location: login.html");
    exit;
}

$display_block="";

//Clean the input
$safe_username = mysqli_real_escape_string($conn, $_POST['username']);
$safe_password = mysqli_real_escape_string($conn, $_POST['password']);

//Store the query
$sql = "SELECT Fname, Lname FROM rj_authorize_users WHERE UserName = '".$safe_username."' AND Password = '".$safe_password."'";

//Store the result of the query
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//Get the number of rows in the result set
if(mysqli_num_rows($result) == 1){
    $_SESSION["user"] = $safe_username;
    $_SESSION["password"] = $safe_password;
    header("Location:discussionMenu.html"); //success
    exit;
}
else{
    session_destroy();
    $display_block = "<p style = 'text-align: center; color: red; font-size: 20px;'>Username and/or password are invalid.</p>
    <p id = 'return' style = 'text-align: center;'><a href = '/html_css/html/login.html' style = 'color: #4286f4; text-decoration: underline;'>Return to login</a></p>";
}

//Close the connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel = "stylesheet" href = "../html_css/css/menu.css">
</head>
<body>
<header id = "top">
    <h1> Menu </h1>
</header>
<?php echo $display_block?>
</body>
</html>