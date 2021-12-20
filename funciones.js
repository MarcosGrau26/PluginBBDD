function ResgistrarUsuario(){

//alert("hola");
 var datos=$("#form_registrar").serialize();
//  alert(datos);

 $.ajax({
    method:'POST',
    url:'../wp-content/plugins/PluginBBDD/nuevo.php',
    data:datos,
    success: function (e) {
    
alert("Registrado");
        
    }
    
 });
 location.reload(forceGet);
 }

 function EliminarUsuario(){
    var datos=#("#form_actualizar").serialize();
 }