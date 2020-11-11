<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$message = test_input($_POST['message']);
if($name == "" || $email == "" || $message == ""){
    echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Submission failed! Please fill in the form properly.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
} else {
    $dbconnect = 
//        mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
    if (!$dbconnect) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $name = mysqli_real_escape_string($dbconnect, $name);
    $email = mysqli_real_escape_string($dbconnect, $email);
    $message = mysqli_real_escape_string($dbconnect, $message);
    $sql_update = "INSERT INTO messages (name, email, message)
    VALUES ('".$name."', '".$email."', '".$message."')";
    if (mysqli_query($dbconnect, $sql_update)) {
        echo '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">Form submitted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        echo "Error: ".$sql_update."<br>".mysqli_error($dbconnect);
    }
    mysqli_close($dbconnect);
}
?>