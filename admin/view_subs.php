<?php
include('header.php');
$db_connection = dbConnect("forverses");
if (isset($_POST["categ"])){
    $sql_query = "SELECT * FROM submissions WHERE submission_type='".$_POST["categ"]."'";
} else {
    $sql_query = "SELECT * FROM submissions";
}
$result = mysqli_query($db_connection, $sql_query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["submission_type"]."</td><td><a href='".$row["attachment_link"]."' target='_blank'>View <i class='fa fa-external-link'></i></a></td></tr>";
    }
} else {
    echo "0 results";
}
mysqli_close($db_connection);
?>