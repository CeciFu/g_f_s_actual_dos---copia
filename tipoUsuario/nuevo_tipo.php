<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tipo Usuario</title>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>
<body>
 <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Tipo de Usuario</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
<?php
if(isset($_POST["Crear"])) { 
/********************************************************************************************************************************/
$nombre = $_POST['nombre']; 
$descripcion= $_POST['descripcion']; 
function array_envia($array) { 

     $tmp = serialize($array); 
     $tmp = urlencode($tmp); 

     return $tmp; 
} 
      $query ="SELECT * FROM funciones";
	 $result = mysql_query($query);
	 while ($row=mysql_fetch_array($result))    
    {
        $funcion= $row['idFunciones'];
		if($_POST[''.$funcion.'']==on){
		
		$idFuncion= $row['idFunciones']; 
	
		$array[]=$idFuncion;
		}
      }
$array=array_envia($array); 

/*******************************************************************************************************************************/
$result=mysql_query("SELECT * FROM tipousuario  where `nombreTipo`='$nombre'");
$total = mysql_num_rows($result);
if ($total!=0){	 //if1
 		echo"<p>&nbsp;</p>";
 echo"<fieldset id='fs'  class='fieldset'>";
echo"<legend>Mensaje</legend>";
		echo"<p>&nbsp;</p>";
		echo"<p>La operación no se pudo realizar.El nombre de Tipo de usuario ya existe. Por favor ingrese otro nombre.</p>";
		echo"<p>&nbsp;</p>";
  echo"</fieldset>";	
  		echo"<p>&nbsp;</p>";
 echo " <b><a href='alta_tipo_usuario.php?nombre=$nombre&descripcion=$descripcion&array=$array'>Alta Tipo Usuario</a></b>";
}//fin if1
else{//else1

$que='INSERT INTO tipousuario (`nombreTipo`, `descripcion`)';
$que.="VALUES ('$nombre','$descripcion')";	
	
	$res=mysql_query($que);
	  
	if($res)
	{
	
	echo"<FORM  action='' method='GET'>
    <p>&nbsp;<p>
    <fieldset id='fs'  class='fieldset'>
    <legend>Mensaje</legend>";
		echo"<p>&nbsp;</p>";
     echo"<p>El nuevo Tipo de usuario ha sido cargado con éxito </P>";
	 		echo"<p>&nbsp;</p>";
	$resultado=mysql_query("SELECT * FROM tipousuario  where `nombreTipo`='$nombre'");
				  
   					 while ($row=mysql_fetch_array($resultado)  )    
     {
	                $idTipo= $row['idTipo'];
					//echo "es $id";
	 }
	 
	 
	 
	 //Guarda las funciones
	 
	 $query ="SELECT * FROM funciones";
	 $result = mysql_query($query);
	 while ($row=mysql_fetch_array($result))    
    {
        $funcion= $row['idFunciones'];
		if($_POST[''.$funcion.'']==on){
		//echo "<p>Funcion:".$row['nombreFuncion']."</p></br>"; 
		$idFuncion= $row['idFunciones']; 
		
		$que='INSERT INTO tipousuariofuncion(`idTipoUsuario`,`idFuncion`)';
        $que.="VALUES ('$idTipo','$idFuncion')";
		$res=mysql_query($que);
		}
    } 
	
	
	 
     echo"</fieldset>";
	 		echo"<p>&nbsp;</p>";
	  echo "<b> <a href='alta_tipo_usuario.php'>Alta tipo Usuario</a></b>";
			
	}
	else
	{
			echo"<p>&nbsp;</p>";
	    echo"<fieldset id='fs'  class='fieldset'>";
            echo"<legend>Mensaje</legend>";
					echo"<p>&nbsp;</p>";
		echo"<p>No se puedo cargar nuevo tipo de usuario</p>";
		echo"<p>&nbsp;</p>";
		echo"</fieldset>";	
		 echo "<b> <a href='alta_tipo_usuario.php'>Alta tipo de Usuario</a></b>";
		 }
	} 
	
}//fin del else1
echo"<p>&nbsp;</p>";
	echo " <b><a href='tipo_usuario.php'>Volver a la página Tipo de Usuario</a></b>";
    
   
?>
