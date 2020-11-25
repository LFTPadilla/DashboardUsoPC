<?php

if($_POST['edition']){
    $query = "usermod -c \"".$_POST['name'].",".$_POST['hab']."\" ".$_POST['username'];
    echo($_POST['password']);
    if($_POST['password']){
        echo("cambiar contra".$_POST['password']))
    }
}else{
    $query = "useradd -c \"".$_POST['name'].",".$_POST['hab']."\" ".$_POST['username'];
}


echo($query);
?>
