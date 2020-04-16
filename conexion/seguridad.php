<?
//Inicio la sesi�n
session_start();
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($HTTP_COOKIE_VARS["autentificado"]!="si") 
	{
	//si no existe, envio a la p�gina de autentificacion
	header("Location: ../principal/ingreso_sistema.php");
	//ademas salgo de este script
	exit();
	
}	
// guarda la hora y fecha de inicio de la sesi�n para posterior calculo del tiempo transcurrido
else{
 //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 120) {
     //si pasaron 10 minutos o m�s
      session_destroy(); // destruyo la sesi�n
      header("Location: index.php"); //env�o al usuario a la pag. de autenticaci�n
      //sino, actualizo la fecha de la sesi�n
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }

}


?>