<?php
require('../../conexion/funciones.php');

$busqueda=$_POST['busqueda'];

if ($busqueda<>' ') {  
	$sql="SELECT idSector,nombre FROM sectoruniversitario where idInstu=".$busqueda;

}
require('muestraConsulta.php');
?>

