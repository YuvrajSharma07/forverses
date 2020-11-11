<?php
if(isset($_POST["show"])){
    $dbconnect = 
//        mysqli_connect('127.0.0.1', 'u215217368_admin', '6b!p6gXZTQ', 'u215217368_forverses');
        mysqli_connect('localhost', 'forverses', 'forverses', 'forverses');
        
    if (!$dbconnect) {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql_query = "SELECT * FROM events";
    $result = mysqli_query($dbconnect, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-12 col-md-5">
                        <div class="card">
                            <img class="card-img-top" src="'.$row["poster"].'" alt="'.$row["name"].' poster">
                            <div class="card-body">
                                <h4 class="card-title">'.$row["name"].'</h4>
                                <p class="card-text">'.$row["description"].'</p>
                                <a class="btn btn-link btn-block stretched-link" href="'.$row["url"].'">See more</a>
                            </div>
                        </div>
                    </div>';
        }
    } else {
        return false;
    }
    mysqli_close($dbconnect);
}
?>