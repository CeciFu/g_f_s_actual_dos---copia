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
  <h1> Eliminar Serie Documental  </h1>
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
$tipoTiempob=$_GET["tipoTiempob"];
$valorTiempob=$_GET["valorTiempob"];
$pagina=$_GET["pagina"];
/***************************************************************************************************/

if (isset($_GET["id"])){
$id=$_GET["id"];
echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";
$res=mysql_query("DELETE FROM seriedocumental WHERE idserie='$id' ");

	if($res)
	{
		echo"<p>El  registro se ha eliminado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo.</p>";
		$result=mysql_query("SELECT * FROM documento where `idSerie`='$id'");
        $total1 = mysql_num_rows($result);
		if($total1!=0){
		echo"<p>La Serie no puede eliminarse porque tiene documentos asociados.</p>";
		echo"<p>&nbsp;</p>";
	}
}

echo"</fieldset>
</form>";

}

 echo"<p>&nbsp;</p>";
  echo " <a href='busqueda.php?pagina=$pagina&info=$info&nombreb=$nombreb&tipoTiempob=$tipoTiempob&valorTiempob=$valorTiempob'>Volver a la búsqueda</a>";
  echo"<p>&nbsp;</p>";
  echo " <p><a href='series.php'>Volver a la página de Series Documentales</a></p>";
 ?>

</body>
</html>
