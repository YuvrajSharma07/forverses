<?php
$name = $_POST['name'];
$email = $_POST['email'];
$sub_type = $_POST['sub_type'];
$file_url = $_POST['file_location'];
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if($name == "" || $email == "" || $sub_type == ""){
    echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Submission failed! Please fill in the form properly.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
} else {
    if($file_url == ""){
        echo '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">Submission failed! Please upload your file.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        $dbconnect = mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
        if (!$dbconnect) {
            die("Connection failed: ".mysqli_connect_error());
        }
        $sql_update = "INSERT INTO submissions (name, email, submission_type, attachment_link)
        VALUES ('".test_input($name)."', '".test_input($email)."', '".test_input($sub_type)."', '".test_input($file_url)."')";
        if (mysqli_query($dbconnect, $sql_update)) {
            echo '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">Form submitted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        } else {
            echo "Error: ".$sql_update."<br>".mysqli_error($dbconnect);
        }
        mysqli_close($dbconnect);
    }
}
?>