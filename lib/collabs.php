<?php
if(isset($_POST["show"])){
    $dbconnect = 
//        mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
    if (!$dbconnect) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql_query = "SELECT * FROM collabs";
    $result = mysqli_query($dbconnect, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="carousel-item">
                                <div class="col-12 col-md-11">
                                    <div class="card">
                                        <div class="card-body clearfix w-100">
                                            <div class="float-right w-50">
                                                <img src="'.$row["mainimage"].'" class="img-fluid">
                                            </div>
                                            <div class="float-left w-50 py-5">
                                                <h3 class="card-title">'.$row["name"].'</h3>
                                                <p class="lead">'.$row["description"].'</p>
                                                <button class="btn btn-outline-info stretched-link" onclick="showCollabSlides($(this))" id="collab_'.$row["id"].'" type="button">View More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        }
    } else {
        return false;
    }
    mysqli_close($dbconnect);
}
if(isset($_POST["slides"])){
    $dbconnect = 
//        mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
    if (!$dbconnect) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql_query = "SELECT * FROM collabs WHERE id=".$_POST["item"]."";
    $result = mysqli_query($dbconnect, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        $webpage_con = '';
        while($row = mysqli_fetch_assoc($result)) {
            $slideshow = explode(',', $row['images']);
            foreach($slideshow as $value){
                $webpage_con .= '<div class="carousel-item">
                <img class="d-block w-100" src="'.$value.'">
                </div>';
            }
        }
        echo $webpage_con;
    } else {
        echo "Error: ".mysqli_error($db_connection);
    }
    mysqli_close($dbconnect);
}
?>