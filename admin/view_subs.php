<?php
include('header.php');
$db_connection = dbConnect("forverses");
if (isset($_REQUEST["show"])){    
    if (isset($_REQUEST["categ"])){
        $sql_query = "SELECT * FROM submissions WHERE submission_type='".$_REQUEST["categ"]."'";
    } else {
        $sql_query = "SELECT * FROM submissions";
    }
    $result = mysqli_query($db_connection, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $status = 'Approved';
            if ($row["status"] == 0) {
                $status = 'Pending';
            }
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["submission_type"]."</td><td><a href='../".$row["attachment_link"]."' target='_blank'>View <i class='fa fa-external-link'></i></a></td><td>".$status."</td><td><div class='btn-group'><button type='button' class='btn btn-outline-success' onclick='approveSub(this)'><i class='fa fa-check'></i></button><button type='button' class='btn btn-outline-danger' onclick='disapproveSub(this)'><i class='fa fa-close'></i></button></div></td></tr>";
        }
    } else {
        echo "0 results";
    }
}
if (isset($_REQUEST["action"])) {
    if($_REQUEST["action"] == "delete") {
        $query = "DELETE FROM submissions WHERE id=".$_REQUEST['item']."";
        if(isset($_REQUEST["link"])){
            unlink($_GET["link"]);
        }
    } else if ($_REQUEST["action"] == "approve"){
        $query = "UPDATE submissions SET status=1 WHERE id=".$_REQUEST['item']."";
    }
    if(mysqli_query($db_connection, $query)){
        echo "Success";
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
}
mysqli_close($db_connection);
?>