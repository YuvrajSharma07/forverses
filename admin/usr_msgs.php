<?php
include('header.php');
$db_connection = dbConnect("forverses");
$sql_query = "SELECT * FROM messages";
$result = mysqli_query($db_connection, $sql_query);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td></tr>";
    }
} else {
    echo "0 results";
}
mysqli_close($db_connection);
?>