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
<title>Documento sin t&iacute;tulo</title>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
</head>
<body>
 <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Sector Universitario</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>

  <?php
if (isset($_POST['Crear'])){


$nombre = $_POST['nombre']; 
$institucion= $_POST['institucion']; 
$descripcion = $_POST['des'];

$result=mysql_query("SELECT * FROM sectoruniversitario  where `nombre`='$nombre' and `idInstu`='$institucion'");
$total = mysql_num_rows($result);
if ($total!=0){	 //if1
  
 	echo"<p>&nbsp;</p>";
	echo"<fieldset id='fs'  class='fieldset'>";
	echo"<legend>Mensaje</legend>";
		echo"<p>&nbsp;</p>";
		echo"<p>No se pudo realizar la operación. El nombre del Sector ya existe, por favor ingrese otro nombre.</p>";
		echo"<p>&nbsp;</p>";
	echo"</fieldset>";	
  	echo"<p>&nbsp;</p>";
	echo " <b><a href='alta_sector.php?nombre=$nombre&institucion=$institucion&descripcion=$descripcion'>Nuevo Sector Universitario</a></b>";

}//fin if1
else{//else1


$que='INSERT INTO sectoruniversitario (`nombre`, `descripcion`, `idInstu`)';
$que.="VALUES ('$nombre','$descripcion','$institucion')";	
	
	$res=mysql_query($que);
	  
	if($res)
	{
	
	echo"<FORM  action='' method='GET'>
    <p>&nbsp;<p>
    <fieldset id='fs'  class='fieldset'>
    <legend>Mensaje</legend>";
		echo"<p>&nbsp;</p>";
     echo"<p>Los datos del nuevo sector se han guardado con éxito</P>";
	 echo"<p>&nbsp;</p>";
     echo"</fieldset>";
	 echo"<p>&nbsp;</p>";
	 echo " <b><a href='alta_sector.php'>Nuevo Sector Universitario</a></b>";
			
	}
	else
	{
		echo"<p>&nbsp;</p>";
	    echo"<fieldset id='fs'  class='fieldset'>";
		echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
		echo"</fieldset>";	
		echo"<p>&nbsp;</p>";
		echo "<b><a href='alta_sector.php'>Nuevo Sector Universitario</a></b>";
	}
	


}
}
echo"<p>&nbsp;</p>";

echo " <b><a href='sector.php'>Volver a la página de Sector Universitario</a></b>";

?>

</body>
</html>
