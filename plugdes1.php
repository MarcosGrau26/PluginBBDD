<!-- Latest minified bootstrap css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest minified bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="..\wp-content\plugins\PluginBBDD\funciones.js"></script>
<?php
/*
Plugin Name: Plugdes1
Plugin URL: www.google.es
Description: Descripción del plugin
Version: 1.0
Author: Marcos Grau Sánchez
Author URL: www.google.es
License: GPLv2
*/
//

/* 
  Frontend
*/

// add_filter( 'the_content', 'dcms_list_data_front' );
add_shortcode('bbddfront','dcms_list_data_front');

function dcms_list_data_front( $content ) {
	$database_name = 'prueba1'; // nombre de la base de datos
	$database_user = 'root';
	$database_pass = '';
	$database_server = 'localhost';

	$table_name = 'Cliente'; // nombre de la tabla
	$slug_page = 'clientes'; //slug de la página en donde se mostrará la tabla

	// if (is_page($slug_page)){

		$mydb = new wpdb($database_user, $database_pass, $database_name, $database_server);
		$items = $mydb->get_results("SELECT * FROM `$table_name`");
    $result = "";
		// nombre de los campos de la tabla
		foreach ($items as $item) {
			$result .= '<tr>
				<td>'.$item->id_cliente.'</td>
				<td>'.$item->nombre.'</td>
				<td>'.$item->apellido.'</td>
        <td>'.$item->dni.'</td>
				<td>'.$item->tlf.'</td>
				<td>'.$item->email.'</td>
        <td>'.$item->fechanacimiento.'</td>
        <td>'.$item->fecharegistro.'</td>
			</tr>';
		}

		$template = '<table class="table-data">
			          <tr>
			            <th>ID</th>
			            <th>Nombre</th>
			            <th>Apellido</th>
                  <th>DNI</th>
                  <th>TELEFONO</th>
                  <th>EMAIL</th>
                  <th>FECHA NACIMIENTO</th>
                  <th>FECHA REGISTRO</th>
			          </tr>
			          {data}
			        </table>';

	    return $content.str_replace('{data}', $result, $template);
	// }

	return $content;
}

/* 
  Backend
*/
add_action( 'admin_menu', 'mfp_Add_My_Admin_Link' );
 
function mfp_Add_My_Admin_Link()
{

      add_menu_page(
        'Mi primera página',
        'Mi primer plugin',
        'manage_options',
        'prueba',
        'output_menu'
    );
      add_submenu_page(
        'prueba',
        'Mi segunda página',
        'Mi segundo plugin',
        'manage_options',
        'prueba2',
        'output_submenu'
    );

    function output_menu() {
      ?>
     
      <h1>Este es el backend editado en github</h1>
      <p>Prueba</p>
      

      <?php
    }

    add_filter('the_content2','output_submenu');

    function output_submenu($content) {
      ?>
      <h1>Base de datos</h1>
      <p>Datos de una base de datos externa</p>
      <?php
		  $mydb = new wpdb('root', '', 'prueba1', 'localhost');
      $items = $mydb->get_results("SELECT * FROM `Cliente`"); 
      $result = "";
      echo('<form role="form" id="form_actualizar" method="post">');
      echo('<table border="1">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>DNI</th>
          <th>TELEFONO</th>
          <th>EMAIL</th>
          <th>FECHA NACIMIENTO</th>
          <th>FECHA REGISTRO</th>
          <th></th>
        </tr>');
      foreach ($items as $item) {
        echo ('<tr>
          <td>'.$item->id_cliente.'</td>
          <td>'.$item->nombre.'</td>
          <td>'.$item->apellido.'</td>
          <td>'.$item->dni.'</td>
          <td>'.$item->tlf.'</td>
          <td>'.$item->email.'</td>
          <td>'.$item->fechanacimiento.'</td>
          <td>'.$item->fecharegistro.'</td>
          <td><button type="submit" name="btn_actualizar" id="btn_actualizar" class="btn btn-warning submitBtn">Editar</button></td>
          <td><a href="../wp-content/plugins/PluginBBDD/eliminar.php">Borrar</a></td>');
      }
      echo('</table>
            </form>');
      ?>
      <h1>Añadir nueva fila</h1>
      <form role="form" id="form_registrar" method="post">
      <table border="1">
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>DNI</th>
          <th>TELEFONO</th>
          <th>EMAIL</th>
          <th>FECHA NACIMIENTO</th>
          <th></th>
        </tr>
        <tr>
          <td><input type="text" name="nombre"></td>
          <td><input type="text" name="apellido"></td>
          <td><input type="text" name="dni"></td>
          <td><input type="number" name="tlf"></td>
          <td><input type="text" name="email"></td>
          <td><input type="date" name="fechanacimiento"></td>
          <button type="submit" name="btn_reguistrar" id="btn_registrar" class="btn btn-primary submitBtn">Registrar</button>
        </tr>
      </table>
      </form>
      <script type="text/javascript">
	  $(document).ready(function(){
		  $("#btn_registrar").on('click', function(e){
			  e.preventDefault();
			  ResgistrarUsuario();
		  });
	  });

  </script>
      <?php
    }
  }


