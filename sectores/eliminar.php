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
  <h1>Eliminar Sector Universitario  </h1>
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
$institucionb=$_GET["institucionb"];
$desb=$_GET["desb"];
$pagina=$_GET["pagina"];
/***************************************************************************************************/

if (isset($_GET["id"])){
$id=$_GET["id"];
echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";
$res=mysql_query("DELETE FROM sectoruniversitario WHERE idSector='$id' ");

	if($res)
	{
		echo"<p>El registro se ha eliminado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>La operación no se pudo realizar. Por favor vuelva a intentarlo.</p>";
		
		$result=mysql_query("SELECT * FROM movimiento where `idInstu`='$id'");
        $total = mysql_num_rows($result);
		if($total!=0){
		echo"<p>El Sector no puede eliminarse porque tiene Movimientos asociados.</p>";
		}
		$result=mysql_query("SELECT * FROM documento where `idInstUni`='$id'");
        $total1 = mysql_num_rows($result);
		if($total1!=0){
		echo"<p>El Sector no puede eliminarse porque tiene Documentos asociados.</p>";
		echo"<p>&nbsp;</p>";
		}
	}


echo"</fieldset>
</form>";

}
 echo"<p>&nbsp;</p>";
 echo " <b><a href='busquedaS.php?pagina=$pagina&info=$info&nombreb=$nombreb&institucionb=$institucionb'>Volver a la búsqueda</a></b>";
 echo"<p>&nbsp;</p>";
 echo " <b><a href='Sector.php'>Volver a la página de Sector Universitario</a></b>";

?>

</body>
</html>

