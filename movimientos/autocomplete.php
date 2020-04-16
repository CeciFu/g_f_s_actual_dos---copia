<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
include('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;}
	else{
	$usuario =$_SESSION["user"];

}

//defino una clase para los elementos del campo autocompletar
class ElementoAutocompletar {
   //propiedades de los elementos
   var $value;
   var $label;
   var $id;
   var $anio;
   var $sector;
   var $folios;
   //constructor que recibe los datos para inicializar los elementos
   function __construct($id, $anio, $sector, $folios, $label, $value ){

	  $this->id = $id;
      $this->label = $label;
      $this->value = $value;
	  $this->anio = $anio;
	  $this->sector = $sector;
	  $this->folios = $folios;

   }
}


 $term=$_GET['term'];
$arrayElementos = array();

$query_services = mysql_query("SELECT idDocumento,numDoc,cantidadfolios, s.nombre serie,idSectorActual sector, anioCreacion FROM documento d, seriedocumental s WHERE numDoc like '".$term ."%' AND d.idSerie = s.idSerie ORDER BY idDocumento,nombre DESC") or die("Error de base de datos: ".mysql_error());

while ($row_services = mysql_fetch_array($query_services)) {
 $numero_serie = $row_services["numDoc"]."-".$row_services["serie"];
 array_push(
 $arrayElementos, new ElementoAutocompletar(
 											$row_services["idDocumento"],  $row_services["anioCreacion"],$row_services["sector"] ,$row_services["cantidadfolios"] , utf8_encode($numero_serie), $row_services["numDoc"]
											)
 );
	
}

echo json_encode($arrayElementos);
?>