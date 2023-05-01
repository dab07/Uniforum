<?php

if (empty($_POST['Username'])) {
    $msg = '<font color ="red"><b> Field for Username is empty!</b></font>';
    include("LoginPage.php");
    exit;
} 

else if (empty($_POST['Password'])) {
    $msg = '<font color ="red"><b> Field for Password is empty!</b></font>';
    include("LoginPage.php");
    exit;
}

else{
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'credentials');

$mysqli = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
    echo "Database Connection Failed! " . mysqli_connect_errno();
    exit();
}

$query = "SELECT password FROM user_details where username='" . $_POST['Username'] . "'";
$pass = $mysqli->query($query);

$passwd = $_POST['Password'];
$row = mysqli_fetch_assoc($pass);

if ($row['password'] == $passwd) {
    echo ("login successful");
}
else{
    echo ("Login Failed!, Try again");
}
}
?>