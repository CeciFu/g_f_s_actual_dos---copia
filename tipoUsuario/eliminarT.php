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

<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Eliminar</title>
</head>
<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1> Eliminar tipo de usuario</h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<?php

/*******************************************datos de la busqueda**********************************/
//Datos asociados a la busqueda
$info=$_GET["info"];
$nombreb=$_GET["nombreb"];
$descripcionb=$_GET["descripcionb"];
/***************************************************************************************************/

if (isset($_GET["idTipo"])){
$id=$_GET["idTipo"];
echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";


$result=mysql_query("SELECT * FROM usuarios  where `tipoUsuario`='$id'");
$total = mysql_num_rows($result);

if($total==0){
$res=mysql_query("DELETE FROM tipousuariofuncion WHERE idTipoUsuario='$id'");


$r=mysql_query("DELETE FROM tipousuario WHERE idTipo='$id'");
	if($r)
	{
	echo"<p>El registro ha sido eliminado con éxito</p>";
		echo"<p>&nbsp;</p>";
	}
	else{

        echo"<p>La operación no se pudo realizar. Por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
      }
	  
 }
 
 else{
 echo"<p>La operación no se pudo realizar."; 
 echo"Existen usuarios asociados.</p>";
		echo"<p>&nbsp;</p>";
 
 
 }
echo"</fieldset>";
echo"</form>";

}

 echo"<p>&nbsp;</p>";
  echo " <b><a href='busquedaT.php?info=$info&nombreb=$nombreb&descripcionb=$descripcionb'>Volver a la búsqueda</a></b>";
  echo"<p>&nbsp;</p>";
  echo " <b><a href='tipo_usuario.php'>Volver a la página  Tipo Usuario</a></b>";
 ?>

</body>
</html>
