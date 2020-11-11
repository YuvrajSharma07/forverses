<?php
include('header.php');
checkAuth();
$db_connection = dbConnect("forverses");
if(isset($_POST["show"])){
    $sql_query = "SELECT * FROM messages";
    $result = mysqli_query($db_connection, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td><td><button type='button' class='btn btn-outline-danger' id='msg_".$row["id"]."' onclick='deleteMessage($(this))'><i class='fa fa-trash'></i></button></td></tr>";
        }
    } else {
        echo "0 results";
    }
}
if(isset($_POST["del"])){
    $sql_query = "DELETE FROM messages WHERE id=".$_REQUEST['item']."";
    $result = mysqli_query($db_connection, $sql_query);
    if($result) {
        echo "Success";
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
}
mysqli_close($db_connection);
?>