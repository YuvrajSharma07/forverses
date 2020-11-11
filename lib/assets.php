<?php
if(isset($_POST["show"])){
    $handle = glob('assets/'.$_POST["item"].'.*');
    if($handle){
        echo $handle[0];
    }
}
?>