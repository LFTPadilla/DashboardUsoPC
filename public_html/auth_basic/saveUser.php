<?php
$msg = 'No se ejecuto ningun comando';


if(isset($_POST['import_data'])){
	$msg = "Se crearon los usuarios ";
	// validate to check uploaded file is a valid csv file
	$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
	if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
		if(is_uploaded_file($_FILES['file']['tmp_name'])){
			$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
			//fgetcsv($csv_file);
			// get data records from csv file
			while(($emp_record = fgetcsv($csv_file)) !== FALSE){
				
				//$query = "sudo ../php/crearusuario.sh 1 ".$emp_record[0]." \"".$emp_record[1]."\" ".$emp_record[2];
				exec("sudo ../php/crearusuario.sh 1 ".$emp_record[0]." \"".$emp_record[1]."\" ".$emp_record[2],$salida);
				$msg = $msg.$emp_record[0]." ";
				
			}
			fclose($csv_file);
			
		} else {
			$msg = 'Error con archivo csv';
		}
	} else {
		$msg = 'Error:Archivo invalido';
	}
	
	
}else{

	$name = $_POST['name'];
	$hab = $_POST['hab'];
	$username = $_POST['username'];

	if(isset($_POST['edition']) && $_POST['edition']=='true'){
	    exec("sudo ../php/crearusuario.sh 2 ".$username." \"".$name."\" ".$hab,$salida);
	    $msg = 'Se editó correctamente el usuario '.$username;
	}else if (isset($_POST['edition']) &&  $_POST['edition']=='false'){
		exec("sudo ../php/crearusuario.sh 1 ".$username." \"".$name."\" ".$hab,$salida);
	    $msg = 'Se creó correctamente el usuario '.$username;
	}else if(isset($_GET['username'])){
	    exec("sudo ../php/crearusuario.sh 3 ".$_GET['username'],$salida);
	    $msg = 'Se eliminó el usuario '.$_GET['username'];
	}


	echo(" 1 ".$salida);

	//DESPUES QUE SE GUARDO O MODIFICO EL USUARIO
	if(isset($_POST['password'])){
		//echo("sudo ../php/crearusuario.sh 4 ".$_POST['username']." ".$_POST['password']);
	    exec("sudo ../php/crearusuario.sh 4 ".$_POST['username']." ".$_POST['password'],$salida);
	    echo(" 2 ".$salida);
	    $msg = $msg.' y se asignó la contraseña';
	}

}
echo "Llego a redir";
header("Location: users.php?msg=".$msg);
die();

?>
