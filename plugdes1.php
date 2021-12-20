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
	// $database_name = 'prueba1'; // nombre de la base de datos
	// $database_user = 'root';
	// $database_pass = '';
	// $database_server = 'localhost';
  // $mydb = new wpdb($database_user, $database_pass, $database_name, $database_server);
	$table_name = 'Cliente'; // nombre de la tabla
	// $slug_page = 'clientes'; //slug de la página en donde se mostrará la tabla

	// if (is_page($slug_page)){
    include 'conexion.php';
    $where = "";
	
    if(!empty($_POST))
    {
      $valor = $_POST['campo'];
      if(!empty($valor)){
        $where = "WHERE nombre LIKE '%$valor'";
      }
    }

    $sql = "SELECT * FROM cliente";
    $items = mysqli_query($conn, $sql);
    $result = "";
		// nombre de los campos de la tabla
		foreach ($items as $item) {
			$result .= '<tr>
				<td>'.$item['id_cliente'].'</td>
				<td>'.$item['nombre'].'</td>
				<td>'.$item['apellido'].'</td>
        <td>'.$item['dni'].'</td>
				<td>'.$item['tlf'].'</td>
				<td>'.$item['email'].'</td>
        <td>'.$item['fechanacimiento'].'</td>
        <td>'.$item['fecharegistro'].'</td>
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
		  include 'conexion.php';
      // $items = $mydb->get_results("SELECT * FROM `Cliente`");
      $where = "";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE nombre LIKE '%$valor'";
		}
	} 
      $sql = "SELECT * FROM cliente $where";
      $items = mysqli_query($conn, $sql);
      ?>
      <h1>Añadir nueva fila</h1>
      <form role="form" id="form_registrar" method="post">
      <table class="table">
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
          <td><button type="submit" name="btn_reguistrar" id="btn_registrar" class="btn btn-primary submitBtn">Registrar</button></td>
        </tr>
      </table>
      </form>
<div class="modal fade" id="modalactualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form role="form" id="form_actualizar" method="post">
                <div class="form-group">
                        <label for="aid">ID</label>
                        <input type="text" class="form-control" name="aid" id="aid" value="" />
                    </div>
                    <div class="form-group">
                        <label for="inputName">Nombre</label>
                        <input type="text" class="form-control" name="anombre" id="anombre" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Apellido</label>
                        <input type="text" class="form-control" name="aapellido" id="aapellido" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="adni">DNI</label>
                        <input type="text" class="form-control" name="adni" id="adni" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="atln">Telefono</label>
                        <input type="number" class="form-control" name="atln" id="atln" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="aemail">Email</label>
                        <input type="email" class="form-control" name="aemail" id="aemail" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="afechanacimiento">Fecha Nacimiento</label>
                        <input type="date" class="form-control" name="afechanacimiento" id="afechanacimiento" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Fecha Registro</label>
                        <input type="text" class="form-control" name="afecharegistro" id="afecharegistro" value=""/>
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
      <?php
   /*   echo('<form role="form" id="form_actualizar" method="post">
      <table class="table">
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
        </tr>');*/
    /*  foreach ($items as $item) {
        $datos=$item['id_cliente']."||".
                            $item['nombre']."||".
                            $item['apellido']."||".
                            $item['dni']."||".
                            $item['tlf']."||".
                            $item['email']."||".
                            $item['fechanacimiento']."||".
                            $item['fecharegistro'];
        echo ('<tr>
          <td>'.$item['id_cliente'].'</td>
          <td>'.$item['nombre'].'</td>
          <td>'.$item['apellido'].'</td>
          <td>'.$item['dni'].'</td>
          <td>'.$item['tlf'].'</td>
          <td>'.$item['email'].'</td>
          <td>'.$item['fechanacimiento'].'</td>
          <td>'.$item['fecharegistro'].'</td>
          <td><button name="btn_actualizar" id="btn_actualizar" class="btn btn-warning submitBtn" onclick="LlenarDatos($datos)";>Editar</button></td>
          <td><a href="../wp-content/plugins/PluginBBDD/eliminar.php?id_cliente='.$item['id_cliente'].'">Borrar</a></td>');
      }
        echo('</table></form>');///*/
      ?>
  <div class="row table-responsive" >
				<table class="table table-striped" id="tabla_registro">
					<thead>
						<tr>
                        <th>ID</th>
			      <th>Nombre</th>
			      <th>Apellido</th>
                  <th>DNI</th>
                  <th>TELEFONO</th>
                  <th>EMAIL</th>
                  <th>FECHA NACIMIENTO</th>
                  <th>FECHA REGISTRO</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php while($row = $items->fetch_array(MYSQLI_ASSOC)) { 
                            $datos=$row['id_cliente']."||".
                            $row['nombre']."||".
                            $row['apellido']."||".
                            $row['dni']."||".
                            $row['tlf']."||".
                            $row['email']."||".
                            $row['fechanacimiento']."||".
                            $row['fecharegistro'];
                            ?>
							<tr>
                            <td><?php echo $row['id_cliente']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['dni']; ?></td>
                    <td><?php echo $row['tlf']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['fechanacimiento']; ?></td>
                    <td><?php echo $row['fecharegistro']; ?></td>
								<td><button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalactualizar" onclick="LlenarDatos('<?php echo $datos?>')";><span class="glyphicon glyphicon-pencil"></span></button></td>
                <td><a href="../wp-content/plugins/PluginBBDD/eliminar.php?id_cliente='<?php echo $row['id_cliente']?>'">Borrar</a></td>'
                        </tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
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


