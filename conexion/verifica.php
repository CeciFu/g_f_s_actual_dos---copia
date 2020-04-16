<?php
include ('funciones.php');
//usuario y clave pasados por el formulario
$usuario = $_POST['usuario'];
$clave = $_POST['password'];
	
//usa la funcion conexiones() que se ubica dentro de funciones.php
if (conexiones($usuario, $clave)){
	//si es valido accedemos a Menu principal.php
	$sql = "SELECT estado FROM `usuarios` WHERE `userName`='$usuario'";
	$ejecutar_sql=mysql_query($sql);
	//si existe inicia una sesion y guarda el nombre del usuario
	while($row=mysql_fetch_array($ejecutar_sql))
		{
			if($row['estado']=="Activo")
			{
				header('Location: ../principal/principal.php');
			}
			else
			{
				 session_unset();
				 session_destroy();
				 header("Location: ../principal/ingreso_sistema.php?errorusuario=Inactivo"); 			
			}
		}
	
	
} else {
	//si no es valido volvemos al formulario inicial	 
	    //si no existe le mando otra vez a la portada 
    header("Location: ../principal/ingreso_sistema.php?errorusuario=si"); 

	//header("Location: IngresoSistema.php?errorusuario=si");  // suponiendo 1 es porque no autentico 
	
	
}
?>
