<?php
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
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
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Eliminar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Eliminar Usuario </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
 
<?php
if (isset($_GET['Eliminar'])){
$db= new conexion();
$id=$_GET["id"];
$dnib=$_GET["dnib"];
$nombreb=$_GET["nombreb"];
$apellidob=$_GET["apellidob"];
$userb=$_GET["userb"];
$passb=$_GET["passb"];
$telb=$_GET["telb"];
$mailb=$_GET["mailb"];
$estadob=$_GET["estadob"];
$idUserb=$_GET["idUserb"];
$sectorb=$_GET["sectorb"];
$institucionb=$_GET["institucionb"];
//echo "entra a la pagina";
$pagina=$_GET['pagina'];

//Datos asociados a la busqueda


}//fin guardar
else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$dni= $_GET['dni']; 
$nombre = $_GET['nombre']; 
$apellido = $_GET['apellido'];
$tel = $_GET['tel']; 
$mail = $_GET['mail']; 
$user = $_GET['user']; 
$password = $_GET['contra'];
$clave = md5($password);
$estado=$_GET['estado'];
$tipo= $_GET['tipo'];
$sector= $_GET['sector'];//falta sector



//Datos asociados a la busqueda
$info=$_GET["info"];
$id=$_GET["id"];
$dnib=$_GET["dnib"];
$nombreb=$_GET["nombreb"];
$apellidob=$_GET["apellidob"];
$userb=$_GET["userb"];
$passb = $_GET['passb'];
$claveb = md5($passb);
$telb=$_GET["telb"];
$mailb=$_GET["mailb"];
$estadob=$_GET["estadob"];
$idUserb=$_GET["idUserb"];
$sectorb=$_GET["sectorb"];
$institucionb=$_GET["institucionb"];
$pagina=$_GET['pagina'];
$id=$_GET['id'];
?>
<FORM  action="eliminar.php" method="GET">
 <fieldset id="fs"  class="fieldset">
<legend >Mensaje </legend>
    <input name="id"  type="hidden" class="estilotextarea3" id="id"  readonly value="<?php echo"$id";?>" />
	     <?php 
		 $res=mysql_query("UPDATE `usuarios` SET `estado`='Inactivo' WHERE idUsuarios='$id' ");

	if($res)
	{
		echo"<p>El registro ha 	sido eliminado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
	}

		 
		 ?>


</fieldset>
<!----------------------------------Datos Asociados a la Busqueda------------------------------------------------------->
<input type="hidden" name="info" value="<?php echo"$info";?>"/>

<input type="hidden" name="dnib" value="<?php echo"$dnib";?>" />
<input type="hidden" name="nombreb" value="<?php echo"$nombreb";?>" />
<input type="hidden" name="apellidob" value="<?php echo"$apellidob";?>" />
<input type="hidden" name="userb" value="<?php echo"$userb";?>" />
<input type="hidden" name="passb" value="<?php echo"$passb";?>" />
<input type="hidden" name="telb" value="<?php echo"$telb";?>"/>
<input type="hidden" name="mailb" value="<?php echo"$mailb";?>" />
<input type="hidden" name="estadob" value="<?php echo"$estadob";?>" />
<input type="hidden" name="idUserb" value="<?php echo"$idUserb";?>" />
<input type="hidden" name="sectorb" value="<?php echo"$sectorb";?>" />
<input type="hidden" name="institucionb" value="<?php echo"$institucionb";?>" />
<input type="hidden" name="pagina" value="<?php echo"$pagina";?>" />

</form>
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
 echo"<p>&nbsp;</p>";
  echo "<p><a href='busqueda.php?pagina=$pagina&id=$id&info=$info&dnib=$dnib&nombreb=$nombreb&apellidob=$apellidob&userb=$userb&passb=$passb&telb=$telb&mailb=$mailb&estadob=$estadob&idUserb=$idUserb&sectorb=$sectorb&institucion=$institucion'>Volver a la búsqueda</a></p>
 <p></a><a href='usuario.php?info=$info'>Volver a la página usuario</a></p>";
 ?>
</body>


</html>