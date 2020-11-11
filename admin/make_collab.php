<?php
include('header.php');
checkAuth();
$db_connection = dbConnect('forverses');
if(isset($_POST["show"])){
    $sql_query = "SELECT * FROM collabs";
    $result = mysqli_query($db_connection, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td><button type='button' class='btn btn-outline-danger' id='collab_".$row["id"]."' onclick='deleteCollab($(this))'><i class='fa fa-trash'></i></button></td></tr>";
        }
    } else {
        echo "0 results";
    }
}
if(isset($_POST["make"])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $poster = $_POST["poster"];
    $images = $_POST["slides"];
    $name = mysqli_real_escape_string($db_connection,$name);
    $description = mysqli_real_escape_string($db_connection,$description);
    $mainImage = mysqli_real_escape_string($db_connection,$poster);
    $images = mysqli_real_escape_string($db_connection,$images);
    $query = "INSERT INTO collabs (name, description, images, mainimage)
    VALUES ('".$name."', '".$description."', '".$images."', '".$mainImage."')";
    if(mysqli_query($db_connection, $query)){
        echo "Success";
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
}
if(isset($_POST["del"])){
    $sql_query = "DELETE FROM collabs WHERE id=".$_POST['item']."";
    $result = mysqli_query($db_connection, $sql_query);
    if($result) {
        echo "Success";
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
}
mysqli_close($db_connection);
?>