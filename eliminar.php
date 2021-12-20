<?php
	
   /* $database_name = 'prueba'; // nombre de la base de datos
	$database_user = 'root';
	$database_pass = '';
	$database_server = 'localhost';

	$table_name = 'Cliente'; // nombre de la tabla
	$slug_page = 'clientes'; //slug de la página en donde se mostrará la tabla

	// if (is_page($slug_page)){

		$mydb = new wpdb($database_user, $database_pass, $database_name, $database_server);*/
		// $servername = "localhost";
		// $database = "prueba1";
		// $username = "root";
		// $password = "";
		// // Create connection
		// $conn = mysqli_connect($servername, $username, $password, $database);
		// Check connection
		include 'conexion.php';
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
	
		//mysqli_close($conn);
		
    extract($_GET);
	

	echo $id_cliente;
	
	$sql = "DELETE FROM cliente where id_cliente=$id_cliente";
	$resultado = mysqli_query( $conn, $sql);	
	echo "<script>location.href='/wp-admin/admin.php?page=prueba2'</script>";
?>
