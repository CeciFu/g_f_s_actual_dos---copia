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
  <h1> Eliminar Instituci&oacute;n Universtaria  </h1>
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
$info=$_GET["info"];
$nombreb=$_GET["nombreb"];
$estadob=$_GET["estadob"];
$ciudadb=$_GET["ciudadb"];
$descripcionb=$_GET["descripcionb"];
/***************************************************************************************************/

if (isset($_GET["idInst"])){
$id=$_GET["idInst"];

echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";
$res=mysql_query("DELETE FROM instu WHERE idInst='$id' ");

	if($res)
	{
		echo"<p>El registro ha sido eliminado con �xito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>La operaci�n no se pudo realizar. Por favor vuelva a intentarlo</p>";
		$result=mysql_query("SELECT * FROM sectoruniversitario where `idInstu`='$id'");
        $total = mysql_num_rows($result);
		if($total!=0){
		echo"<p>La Instituci�n tiene Sectores asociados.</p>";
		}
		$result=mysql_query("SELECT * FROM documento where `idInstUni`='$id'");
        $total1 = mysql_num_rows($result);
		if($total1!=0){
		echo"<p>La Instituci�n tiene Documentos asociados.</p>";
		}
		echo"<p>&nbsp;</p>";
	}


echo"</fieldset>
</form>";

}
 echo"<p>&nbsp;</p>";
 echo " <b><a href='busquedaI.php?info=$info&nombreb=$nombreb&estadob=$estadob&ciudadb=$ciudadb&descripcionb=$descripcionb'>Volver a la b�squeda</a></b>";
 echo"<p>&nbsp;</p>";
 echo " <b><a href='institucion_universitaria.php'>Volver a la p�gina de Instituci�n Universitaria</a></b>";

?>

</body>
</html>
