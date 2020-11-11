<?php
$admin_request = $_POST["request"];
function dbConnect($dbname){
    $host = 'localhost';
//        "127.0.0.1";
    $username = 'forverses';
//        "u215217368_admin";
    $password = 'forverses';
//        "6b!p6gXZTQ";
//    $database = 'u215217368_forverses';
    $connection = mysqli_connect($host, $username, $password, 
//                                 $database
                                 $dbname
                                );
    if (!$connection){
        return mysqli_connect_error();
    } else {
        return $connection;
    }
}
function authenticate($additional){
    session_start();
    $con = dbConnect('forverses');
    if (isset($_POST['username'])){
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con,$username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);
        $query = "SELECT * FROM users WHERE username='".$username."'
        and password='".md5($password)."'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            echo 'Invalid credentials';
        }
    }
    if ($additional == "logOut"){
        session_destroy();
        header('Location: index.php');
    }
}
if ($admin_request == "exit") {
    authenticate("logOut");
}
function checkAuth(){
    if(!isset($_SESSION["username"])){
        header('Location: bad.php');
    }
}
authenticate('none');
?>