<?php
if(isset($_POST["show"])){
    $dbconnect = 
//        mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
    if (!$dbconnect) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql_query = "SELECT * FROM journal WHERE id=(SELECT MAX(id) FROM journal);";
    $result = mysqli_query($dbconnect, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo $row["journal"];
        }
    } else {
        echo "Coming Soon";
    }
}
?>