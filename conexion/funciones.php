<?php
include ('conexion.php');
$db=new conexion();
//funcion para conectar a la base de datos y verificar la existencia del usuario
function conexiones($usuario, $password) {

	$clave = md5($password);
//	echo "clave: ".$clave;
	//alert(0);
	
	//sentencia sql para consultar el nombre del usuario
	$sql = "SELECT * FROM `usuarios` WHERE `userName`='$usuario' AND `password`='$clave'";
	//ejecucion de la sentencia anterior
	
	
	$ejecutar_sql=mysql_query($sql);
	//si existe inicia una sesion y guarda el nombre del usuario
	
	if (mysql_num_rows($ejecutar_sql)!=0){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$tipoUsuario=$row ['tipoUsuario'];
			$nombre=$row['nombre'];
			$idUsu=$row['idUsuarios'];
			$apellido=$row['apellido'];
			$idSec=$row['idSec'];
		}
		
		
		$sql = "SELECT *  FROM tipousuariofuncion INNER JOIN funciones ON `idFunciones`=`idFuncion` AND `idTipoUsuario`='$tipoUsuario'";
		$ejecutar_sql=mysql_query($sql);
		$datos = array(); 
    
		while($row = mysql_fetch_array($ejecutar_sql)){ 
    
		$datos[] = $row['nombreFuncion']; 
    
		}  
		
		//inicio de sesion
		session_start();
		//configurar un elemento usuario dentro del arreglo global $_SESSION
		$_SESSION['user']=$usuario;
		$_SESSION['idSec']=$sector;
		$_SESSION['idUsuarios']=$idUsu;
		$_SESSION['tipo']=$tipoUsuario;//es el identificador de tipo
		$_SESSION['nombre']=$nombre." ".$apellido;//es el identificador de tipo
		$_SESSION['operaciones']=$datos;//funciones por tipo de usuario

		//retornar verdadero
		return true;
	} else {
		//retornar falso
		return false;
	}
}
//funcion para verificar que dentro del arreglo global $_SESSION existe el nombre del usuario
function verificar_usuario(){
	//continuar una sesion iniciada
	session_start();
	//comprobar la existencia del usuario
	if (isset ($_SESSION["user"])){
		return true;
	}
	else
	{
	 return false;
	}
}
//funcion que devuelve el tipo de usuarrio para cargar el menu

?>
