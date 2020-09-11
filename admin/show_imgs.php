<?php
if($_POST["show"] == 1 || $_POST["show"] == "del") {
    $dir = opendir('../lib/team');
    while (false !== ($entry = readdir($dir))) {
        if ($entry != "." && $entry != ".." && $entry != "index.php") {
            if ($_POST["show"] == "del"){
                echo '<tr><td><img src="../lib/team/'.$entry.'" class="w-25"> '.$entry.'</td><td><button class="btn btn-outline-danger" type="button" onclick=deleteImg("../lib/team/'.str_replace(" ","_",$entry).'")><i class="fa fa-trash"></i></button></td></tr>';
            } else {
                echo '<a class="dropdown-item" onclick="changeImg(this)"><img src="../lib/team/'.$entry.'" class="w-25"> '.$entry.'</a>';
            }
        }
    }
    closedir($dir);
}
if($_POST["delete"] == 1) {
    unlink(str_replace("_", " ", $_POST["file"]));
    echo "success";
}
?>