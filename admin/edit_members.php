<?php
include('header.php');
checkAuth();
$data = $_POST["change"];
if ($data != '') {
    file_put_contents('../lib/team.json', $data);
    echo "Done";
} else {
    return false;
}
?>