function ResgistrarUsuario(){

//alert("hola");
 var datos=$("#form_registrar").serialize();
//  alert(datos);

 $.ajax({
    method:'POST',
    url:'../wp-content/plugins/PluginBBDD/nuevo.php',
    data:datos,
    success: function (e) {
    
//alert("Registrado");
location.reload(true);
        
    }
    
 });
 
 //location.reload(forceGet);
 }

 function EliminarUsuario(){
   // //var datos=$("#form_actualizar").serialize();
 }
 function LlenarDatos(datos){
    d=datos.split("||");
    for (var i = 0; i < d.length; i++){
     // console.log(d[i]);
  }
    $("#aid").val(d[0]);
    $("#anombre").val(d[1]);
    $("#aapellido").val(d[2]);
    $("#adni").val(d[3]);
    $("#atln").val(d[4]);
    $("#aemail").val(d[5]);
    $("#afechanacimiento").val(d[6]);
    $("#afecharegistro").val(d[7]);
 }
 function ActualizarUsuario(){

   var datos=$("#form_actualizar").serialize();
   location.reload(true);

   /*$.ajax({
      method:'POST',
      url:'../wp-content/plugins/Plugin_basededatos/includes/actualizar.php',
      data:datos,
      success: function (e) {
        alert("Actualizado");
        location.reload(true);
      }
      
   });
   return false;*/
   }
  