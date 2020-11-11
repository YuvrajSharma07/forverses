<?php
include('header.php');
checkAuth();
$db_connection = dbConnect("forverses");
if (isset($_POST["show"])){    
    if (isset($_POST["categ"])){
        $sql_query = "SELECT * FROM submissions WHERE submission_type='".$_POST["categ"]."'";
    } else if (isset($_POST["approved"])) {
        $sql_query = "SELECT * FROM submissions WHERE status=".$_POST["approved"]."";
    } else {
        $sql_query = "SELECT * FROM submissions";
    }
    $result = mysqli_query($db_connection, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if(isset($_POST["approved"])){
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["submission_type"]."</td><td><a href='../".$row["attachment_link"]."' target='_blank'>View <i class='fa fa-external-link'></i></a></td><td><div class='btn-group td_grp'><button type='button' class='btn btn-outline-success' onclick='makeSub($(this))'><i class='fa fa-paperclip'></i> Make</button></div></td></tr>";
            } else {
                $status = 'Approved';
                if ($row["status"] == 0) {
                    $status = 'Pending';
                }
                echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["submission_type"]."</td><td><a href='../".$row["attachment_link"]."' target='_blank'>View <i class='fa fa-external-link'></i></a></td><td>".$status."</td><td><div class='btn-group td_grp'><button type='button' class='btn btn-outline-success' onclick='approveSub($(this))'><i class='fa fa-check'></i></button><button type='button' class='btn btn-outline-danger' onclick='disapproveSub($(this))'><i class='fa fa-close'></i></button></div></td></tr>";
            }
        }
    } else {
        echo "0 results";
    }
}
if (isset($_POST["action"])) {
    if($_POST["action"] == "delete") {
        $query = "DELETE FROM submissions WHERE id=".$_POST['item']."";
        if(isset($_POST["link"])){
            unlink($_GET["link"]);
        }
    } else if ($_POST["action"] == "approve"){
        $query = "UPDATE submissions SET status=1 WHERE id=".$_POST['item']."";
    }
    if(mysqli_query($db_connection, $query)){
        echo "Success";
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
}
mysqli_close($db_connection);
?>