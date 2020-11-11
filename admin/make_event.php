<?php
include('header.php');
checkAuth();
$db_connection = dbConnect('forverses');
if(isset($_POST["make"])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $content = $_POST["content"];
    $fileName = $_POST["fileName"];
    $poster = $_POST["poster"];
    
    $webpage_con = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Forbidden Verses">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Forbidden Verses | '.$name.'</title>
        <link rel="shortcut icon" href="../lib/assets/logo.png" type="image/x-icon">
        <link rel="apple-touch-icon" href="../lib/assets/logo.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://YuvrajSharma07.github.io/Web_Development_Folder/templates/animate.css">
        <link rel="stylesheet" href="../lib/index.css">
    </head>
    <body class="full">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand"><img src="../lib/assets/logo.png" class="img-fluid"></a>
            <button class="navbar-toggler m-1" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-end" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../events.html">Events <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../journal.html">Marketplace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../submit.html">Submissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.html">Contact us</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main>
            <div class="card" id="event_title">
                <img class="card-img-top" src="'.$poster.'" alt="'.$name.' poster">
                <div class="card-body">
                    <h1 class="display-3">'.$name.'</h1>
                </div>
            </div>
            <div id="event_content">
                <p>'.$content.'</p>
            </div>
            <div id="event_gallery">
                <h1 class="text-center pb-5">Gallery</h1>
                <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        ';
    $slideshow = explode(',', $_POST["slides"]);
    foreach($slideshow as $value){
        $webpage_con .= '<div class="carousel-item">
                            <img class="d-block w-100" src="'.$value.'">
                        </div>';
    }
    $webpage_con .= '</div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </main>
        <footer class="p-5">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="pl-2 mb-3">Get in touch</h4>
                    <a href="https://www.instagram.com/forverses/" target="_blank"><i class="fa fa-instagram fa-2x"></i> @forverses</a>
                    <h6 class="mt-3">Connect with us at:</h6>
                    <ul style="list-style-type: none; padding-left: 1rem">
                        <li><a href="mailto: anureet@forbiddenverses.com" target="_blank">anureet@forbiddenverses.com</a></li>
                        <li><a href="mailto: chetna@forbiddenverses.com" target="_blank">chetna@forbiddenverses.com</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>For Collaborations</h6>
                    <ul style="list-style-type: none; padding-left: 1rem">
                        <li><a href="mailto: collaborations@forbiddenverses.com" target="_blank">collaborations@forbiddenverses.com</a></li>
                    </ul>
                    <h6>For Marketplace queries</h6>
                    <ul style="list-style-type: none; padding-left: 1rem">
                        <li><a href="mailto: marketplace@forbiddenverses.com" target="_blank">marketplace@forbiddenverses.com</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4 class="pl-2 mb-3">Website</h4>
                    <ul style="list-style-type: none; padding-left: 1rem">
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../events.html">Events</a></li>
                        <li><a href="../journal.html">Marketplace</a></li>
                        <li><a href="../submit.html">Submissions</a></li>
                        <li><a href="../contact.html">Contact us</a></li>
                    </ul>
                </div>
                <div class="col-12 text-center">
                    <span></span>
                </div>
            </div>
        </footer>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../lib/index.js"></script>
        <script>
            $(".carousel .carousel-inner .carousel-item").first().addClass("active");
        </script>
    </body>
</html>';
    $handle = fopen('../events/'.$fileName, 'x') or die("File already exists.");
    if(fwrite($handle, $webpage_con)){
        fclose($handle);
        $name = mysqli_real_escape_string($db_connection,$name);
        $description = mysqli_real_escape_string($db_connection,$description);
        $poster = mysqli_real_escape_string($db_connection,$poster);
        $fileName = mysqli_real_escape_string($db_connection,'events/'.$fileName);
        $query = "INSERT INTO events (name, description, poster, url)
        VALUES ('".$name."', '".$description."','".$poster."' , '".$fileName."')";
        if(mysqli_query($db_connection, $query)){
            echo "Success";
        } else {
            echo "Error: ".mysqli_error($db_connection);
        }
    } else {
        echo "An unknown error has occured, check the following:
        <ul>
            <li>The file doesn't exist already.</li>
            <li>The file name doesn't have any unconventional characters</li>
        </ul>";
    }
}
if(isset($_POST["show"])){
    $sql_query = "SELECT * FROM events";
    $result = mysqli_query($db_connection, $sql_query);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["description"]."</td><td>".$row["url"]."</td><td><button type='button' class='btn btn-outline-danger' id='eve_".$row["id"]."' onclick='deleteEvent($(this))'><i class='fa fa-trash'></i></button></td></tr>";
        }
    } else {
        echo "0 results";
    }
}
if(isset($_POST["del"])){
    $query1 = "SELECT url FROM events WHERE id=".$_POST["item"]."";
    $result1 = mysqli_query($db_connection, $query1);
    if($result1){
        $del_url = mysqli_fetch_assoc($result1);
        if(unlink('../'.$del_url["url"])){
            $sql_query = "DELETE FROM events WHERE id=".$_POST['item']."";
            $result = mysqli_query($db_connection, $sql_query);
            if($result) {
                echo "Success";
            } else {
                echo "Error: ".mysqli_error($db_connection);
            }
        }
    }
}
mysqli_close($db_connection);
?>