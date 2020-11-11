<?php
include('header.php');
checkAuth();
function showPage($url){
    $file = fopen('../lib/'.$url.'.css', 'r') or die("Unable to open file.");
    while(!feof($file)){
        echo fgets($file);
    }
    fclose($file);
}
function writePage($url, $content){
    $file = fopen('../lib/'.$url.'.css','w') or die("Unable to open file.");
    fwrite($file, $content);
    fclose($file);
    echo 'Success';
}
if (isset($_POST["show"])){
    showPage($_POST['item']);
}
if (isset($_POST["write"])){
    writePage($_POST["item"], $_POST["contents"]);
}
?>