<?php
    $database_name = 'prueba1'; // nombre de la base de datos
	$database_user = 'root';
	$database_pass = '';
	$database_server = 'localhost';
    $mydb = new wpdb($database_user, $database_pass, $database_name, $database_server);
?>