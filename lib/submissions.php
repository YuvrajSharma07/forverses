<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$sub_type = test_input($_POST['sub_type']);
$file_url = test_input($_POST['file_location']);
if($name == "" || $email == "" || $sub_type == ""){
    echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Submission failed! Please fill in the form properly.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
} else {
    if($file_url == ""){
        echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Submission failed! Please upload your file.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        $dbconnect = 
//            mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
        if (!$dbconnect) {
            die("Connection failed: ".mysqli_connect_error());
        }
        $name = mysqli_real_escape_string($dbconnect, $name);
        $email = mysqli_real_escape_string($dbconnect, $email);
        $sub_type = mysqli_real_escape_string($dbconnect, $sub_type);
        $file_url = mysqli_real_escape_string($dbconnect, $file_url);
        $sql_update = "INSERT INTO submissions (name, email, submission_type, attachment_link, status)
        VALUES ('".$name."', '".$email."', '".$sub_type."', '".$file_url."', 0)";
        if (mysqli_query($dbconnect, $sql_update)) {
            echo '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">Form submitted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else {
            echo "Error: ".$sql_update."<br>".mysqli_error($dbconnect);
        }
        mysqli_close($dbconnect);
    }
}
?>