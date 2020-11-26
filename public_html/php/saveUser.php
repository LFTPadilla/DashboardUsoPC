<?php
$msg = 'No se ejecuto ningun comando';
if(isset($_POST['edition']) && $_POST['edition']=='true'){
    $query = "usermod -c \"".$_POST['name'].",".$_POST['hab']."\" ".$_POST['username'];
    $msg = 'Se editó correctamente el usuario '.$_POST['name'];
}else if (isset($_POST['edition']) &&  $_POST['edition']=='false'){
    $query = "useradd -c \"".$_POST['name'].",".$_POST['hab']."\" ".$_POST['username'];
    $msg = 'Se creó correctamente el usuario '.$_POST['name'];
}else if(isset($_GET['username'])){
    $query = "userdel ".$_GET['username'];
    $msg = 'Se eliminó el usuario '.$_POST['name'];
}

echo($query);
//DESPUES QUE SE GUARDO O MODIFICO EL USUARIO
/* 
#> passwd sergio
Changing password for user prueba.
New UNIX password:
Retype new UNIX password:
*/

if(isset($_POST['password'])){
    echo("passwd ".$_POST['username']);
    echo(" cambiar contra".$_POST['password']);
    $msg = $msg.' y se asignó la contraseña';
}

header("Location: ../users.php?msg=".$msg);
die();

?>
