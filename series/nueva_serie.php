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
<title>Series Documentales</title>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>
<body>
 <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nueva Serie Documental</h1>
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
$valorTiempo= $_POST['valorTiempo']; 
$tipoTiempo = $_POST['tipoTiempo'];
$descripcion = $_POST['descripcion'];


$result=mysql_query("SELECT * FROM seriedocumental  where `nombre`='$nombre'");
$total = mysql_num_rows($result);
if ($total!=0){	 //if1
 echo"<p>&nbsp;</p>";
 echo"<fieldset id='fs'  class='fieldset'>";
echo"<legend>Mensaje</legend>";
echo"<p>&nbsp;</p>";
		echo"<p>No se pudo realizar la operacion. El nombre de la Serie Documental ya existe, por favor ingrese otro nombre.</p>";
		echo"<p>&nbsp;</p>";
  echo"</fieldset>";
  echo"<p>&nbsp;</p>";	
 echo " <b><a href='alta_serie.php?nombre=$nombre&valorTiempo=$valorTiempo&tipoTiempo=$tipoTiempo'>Nueva Serie Documental</a></b>";

}//fin if1
else{//else1



if($valorTiempo=="" or $tipoTiempo=="permanente" or $tipoTiempo=="otro"){
$valorTiempo=0;
}

$que='INSERT INTO seriedocumental (`nombre`, `valorTiempo`, `tipoTiempo`, `descripcion`)';
$que.="VALUES ('$nombre','$valorTiempo','$tipoTiempo','$descripcion')";	
$res=mysql_query($que);
	  
	if($res)
	{
	
	echo"<FORM  action='' method='GET'>
    <p>&nbsp;<p>
    <fieldset id='fs'  class='fieldset'>
    <legend>Mensaje</legend>";
	echo"<p>&nbsp;</p>";
     echo"<p>Los datos de la Serie Documental  se han guardado con éxito </p>";
	 echo"<p>&nbsp;</p>";
     echo"</fieldset>";
	 echo"<p>&nbsp;</p>";
	  echo " <b><a href='alta_serie.php'>Nueva Serie Documental</a></b>";	
			
	}
	else
	{
	    echo"<fieldset id='fs'  class='fieldset'>";
		echo"<p>&nbsp;</p>";
		echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
		 echo"</fieldset>";
		 echo"<p>&nbsp;</p>";
		 echo " <b><a href='alta_serie.php'>Nueva Serie Documental</a></b>";	
		 }
	


}
}
echo"<p>&nbsp;</p>";
echo "<b><a href='series.php'>Volver a la página de Series Documentales</a></b>";


?>

</body>
</html>
