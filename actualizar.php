<?php
	
	require 'conexion.php';
	$id_cliente = $_POST['aid'];
	$nombre = $_POST['anombre'];
	$apellido =$_POST['aapellido'];
	$dni =$_POST['adni'];
    $tlf =$_POST['atln'];
    $email =$_POST['aemail'];
    $fechanacimiento =$_POST['afechanacimiento'];
    $fecharegistro =$_POST['afecharegistro'];

	$sql = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', dni='$dni', tlf='$tlf', email='$email', fechanacimiento='$fechanacimiento', fecharegistro='$fecharegistro' where id_cliente='$id_cliente' ";
    echo mysqli_query( $conn, $sql);	
	
?>