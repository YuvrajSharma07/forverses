<?php
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
        <title>Forbidden Verses | Upload</title>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            * {
                font-family: 'Open Sans', sans-serif;
                font-weight: 300
            }
        </style>
    </head>
    <body>
        <div class="jumbotron lead">
            If the prompt doesn't open automatically, <a class="btn btn-link">click here</a>.
        </div>
        <form class="d-none" method="post" enctype="multipart/form-data">
            <input type="file" name="attachment" id="attachment">
        </form>
        <?php
        if(isset($_FILES['attachment'])){
            $errors = array();
            $extensions = array("jpeg", "jpg", "png", "docx", "pdf");
            if(in_array($file_ext,$extensions)=== false){
                array_push($errors, "Extension not allowed, please choose a valid file.");
            }
            if(empty($errors) == true){
                move_uploaded_file($file_tmp,"lib/submissions/".$file_name);
        ?>
        <div class="alert alert-success fade show" role="alert">Upload Successful! The window will close soon so you can proceed to submitting your form.</div>
        <script>
            window.localStorage.setItem('attachment_url', window.location.origin + "/forverses/lib/submissions/<?php echo $file_name; ?>");
            setTimeout(function(){
                window.close()
            }, 3000)
        </script>
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
        <script src="lib/upload.js"></script>
    </body>
</html>