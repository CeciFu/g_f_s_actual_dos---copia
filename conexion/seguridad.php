<?
//Inicio la sesión
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($HTTP_COOKIE_VARS["autentificado"]!="si") 
	{
	//si no existe, envio a la página de autentificacion
	header("Location: ../principal/ingreso_sistema.php");
	//ademas salgo de este script
	exit();
	
}	
// guarda la hora y fecha de inicio de la sesión para posterior calculo del tiempo transcurrido
else{
 //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 120) {
     //si pasaron 10 minutos o más
      session_destroy(); // destruyo la sesión
      header("Location: index.php"); //envío al usuario a la pag. de autenticación
      //sino, actualizo la fecha de la sesión
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }

}


?>