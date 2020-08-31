<?php
$admin_request = $_POST["request"];
function dbConnect($dbname){
    $host = "localhost";
    $username = "forverses";
    $password = "forverses";
    $database = $dbname;
    $connection = mysqli_connect($host, $username, $password, $database);
    if (!$connection){
        return mysqli_connect_error();
    } else {
        return $connection;
    }
}
function authenticate($additional){
    session_start();
    // do something here
    if ($additional == "logOut"){
        session_destroy();
    }
}
if ($admin_request == "exit") {
    authenticate("logOut");
}
?>