<?php
include('header.php');
checkAuth();
$file_name = $_FILES['attachment']['name'];
$file_size = $_FILES['attachment']['size'];
$file_tmp = $_FILES['attachment']['tmp_name'];
$file_type = $_FILES['attachment']['type'];
$file_ext = strtolower(end(explode('.',$_FILES['attachment']['name'])));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Upload Member</title>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            * {
                font-family: 'Open Sans', sans-serif;
                font-weight: 300
            }
        </style>
    </head>
    <body>
        <div class="jumbotron lead">
            <button type="button" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
        </div>
        <form class="d-none" method="post" enctype="multipart/form-data">
            <input type="file" name="attachment" id="attachment">
        </form>
        <div class="w-100 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width:10%">Preview</th>
                        <th scope="col">File name</th>
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        $dir = opendir('../lib/assets');
        while (false !== ($entry = readdir($dir))) {
            if ($entry != "." && $entry != ".." && $entry != "index.php") {
                echo '<tr><td><img src="../lib/assets/'.$entry.'" class="img-fluid"></td><td>'.$entry.'</td><td><button class="btn btn-outline-danger" type="button" onclick="deleteImg(\'../lib/assets/'.$entry.'\')"><i class="fa fa-trash"></i></button><button class="btn btn-outline-info" type="button"><i class="fa fa-upload"></i></button></td></tr>';
            }
        }
        closedir($dir);
        ?>
                </tbody>
            </table>
        </div>
        <?php
        if(isset($_FILES['attachment'])){
            $errors = array();
            $extensions = array("jpeg", "jpg", "png");
            if(in_array($file_ext,$extensions) === false){
                array_push($errors, "Extension not allowed, please choose a valid file.");
            }
            if(empty($errors) == true){
                move_uploaded_file($file_tmp,"../lib/assets/".$file_name);
        ?>
        <div class="alert alert-success fade show" role="alert">Upload Successful!</div>
        <?php
            } else {
                foreach ($errors as $error) {
        ?>
        <div class="alert alert-danger fade show" role="alert">
            Error: <?php echo $error; ?>
        </div>
        <?php
                }
            }
        }
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
//            window.onload = function() {
//                $('#attachment').trigger('click')
//            }
            $('i.fa-upload').parent().on('click', function() {
                $('#attachment').trigger('click')
            })
            $('#attachment').on('input', function() {
                $('form').submit()
            });

            function deleteImg(value) {
                $.ajax({
                    url: 'show_imgs.php',
                    method: 'POST',
                    data: {delete: 1,file: value}
                }).done(function(response) {
                    if (response == "success") {
                        $('.table').find('img[src="' + value + '"]').parents('tr').remove();
                    }
                });
            }
        </script>
    </body>
</html>