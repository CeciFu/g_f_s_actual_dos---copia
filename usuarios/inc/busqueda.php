<?php
require('../../conexion/funciones.php');

$busqueda=$_POST['busqueda'];

if ($busqueda<>' ') {  
	$sql="SELECT idSector,nombre FROM sectoruniversitario where idInstU=".$busqueda." ORDER BY `nombre` ASC ";

}
require('muestraConsulta.php');
?>

