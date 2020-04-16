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
<title>Expedientes iniciados</title>
<link rel="stylesheet" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
<?php
		$documento=$_GET["documento"];
		$year=$_GET["year"];
		$serie=$_GET["serie"];
		if (isset($_POST['buscar1'])){

		$documento=$_POST["documento"];
		$year=$_POST["year"];
		$serie=$_POST["serie"];
		
		}

		$sql="SELECT nombre FROM seriedocumental WHERE idserie=$serie";
				$ejecutar_sql=mysql_query($sql);
				
				/**************************************************************************/
				
				while($row=mysql_fetch_array($ejecutar_sql))
				{			
					$nombreSerie=$row ['nombre'];	
				}
		
		
?>
  <h1>&nbsp;</h1>
  <h1 align="center">Historial de movimientos Documento NRO:<?php echo $documento."/"; echo $year ."-".$nombreSerie; ?></h1>
<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
 </div>
<h1>&nbsp;</h1>
<?php
//pide las variables para la consulta enviados por URL
$documento=$_GET["documento"];
$year=$_GET["year"];
$serie=$_GET["serie"];
//Datos de Institucion busqueda

?>
<!--------------------------------------Busqueda libre---------------------------------------------------->
<?php

if (isset($_POST['buscar1'])){

$documento=$_POST['documento'];
$year = $_POST['year'];
$serie = $_POST['serie'];

}
?>
<!--------------------------------------Busqueda Avanzada---------------------------------------------------->
<?php
		
//La tabla solo muestra 20 registros
$registros = 10;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
} 
else { 
$inicio = ($pagina - 1) * $registros; }
/*echo "Nro doc ".$documento;
echo "serie ".$serie;
echo "anio ".$year;
/*********************Arma la consulta correspondientes*******************/
//busca el id del documento

$sql = mysql_query("SELECT * FROM documento WHERE idSerie='".$serie."' and numDoc='".$documento."' and  anioCreacion='".$year."'" );
while ($row=mysql_fetch_array($sql))  
{
$id =$row['idDocumento'];
$cantiFolios=$row['cantidadFolios'];		
}

//echo "nro idDocumento ".$id;
$resultados = mysql_query("SELECT * FROM movimiento INNER JOIN registros WHERE registros.documento='". $id ."' and  idRmov=idremito  ");
$resul = mysql_query("SELECT * FROM movimiento INNER JOIN registros WHERE registros.documento='". $id ."' and  idRmov=idremito ORDER BY movimiento.idRmov DESC  LIMIT $inicio, $registros"); 
$total_registros = mysql_num_rows($resultados);
$total_paginas = ceil($total_registros / $registros); 


/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resul)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>";
		echo"<p>Este documento no registra movimientos</p>";
		echo"<p>&nbsp;</p>
			</fieldset>
			</form>
			";
		 
		
	}
else{

echo"<p>&nbsp;</p><div class='CSS_Table_Example' align= 'center''>";
echo"<table width='60%' class='CSS_Table_Example' align='center' border='3px' cellpadding='2px' bordercolor='#009D9D' cellspacing='2px'>";
echo"<tr BGCOLOR='#B3C8FF' ><td>Emisor</td><td>Emisión</td><td>Documento<td>Origen</td><td>Destino</td><td>Recepción</td><td>Receptor</td><td>Folios</td><td>Estado</td></tr>";
   
  
   
   }
$i=0;


while($r=mysql_fetch_array($resul)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
    
echo"<tr>";

	$fecha=$r["fecha"];
	$fechas=explode("-", $fecha);
			$anno = $fechas[0];
			$mes = $fechas[1];
			$dia = $fechas[2];
	$fecha="$dia-"."$mes-"."$anno";
	$idUsuario=$r["idUsuario"];	
	$idDocumento=$r["documento"];
	$institucion1=$r["institucion1"];
	$institucion2=$r["institucion2"];
	$idSectorOrigen=$r["idSectorOrigen"];		
	$idSectorDestino=$r["idSectorDestino"];
	$fRecepcion=$r["fechaD"];
	$fechasD=explode("-", $fRecepcion);
			$annod = $fechasD[0];
			$mesd = $fechasD[1];
			$diad = $fechasD[2];
	$fechadd="$diad-"."$mesd-"."$annod";		
	$idUReceptor=$r["idUsuarioD"];
	$estado=$r["estador"];
	$idMov=$r["idRmov"];		
/*************************************************************************************************************************************/			
$resultados= mysql_query("SELECT * FROM usuarios WHERE  idUsuarios='". $idUsuario ."'" );
while ($r=mysql_fetch_array($resultados)){
$idu =$r['userName'];
}
$resultados= mysql_query("SELECT * FROM usuarios WHERE  idUsuarios='". $idUReceptor ."'" );
while ($r=mysql_fetch_array($resultados)){
$iduR =$r['userName'];
}
$resultados = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucion1 ."'");
while($r=mysql_fetch_array($resultados)) {
$io=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucion2 ."'");
while($r=mysql_fetch_array($resultados)) {
$id=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorOrigen ."'");
while($r=mysql_fetch_array($resultados)) {
$so=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorDestino ."'");
while($r=mysql_fetch_array($resultados)) {
$sd=$r["nombre"];
}
$resultados6 = mysql_query("SELECT * FROM  registros WHERE idremito='". $idMov ."'");
	while($r6=mysql_fetch_array($resultados6)) {
	$remitFolios=$r6["foliosM"];
	}
/**************************muestra datos**************************************************************************/
					
			echo"<td>$idu</td>";
			echo "<td>$fecha</td>";	
			echo "<td>$documento/$year</td>"; 					
			echo "<td>$io - $so</td>"; 
			echo "<td>$id - $sd</td>";
			if($estado=="Confirmado")			
			{
				echo "<td>$fechadd</td>";			
				echo "<td>$iduR</td>";
			}
			else
			{
				echo "<td>No Confirmado</td>";			
				echo "<td>No Confirmado</td>";
			
			}
			echo "<td>$remitFolios</td>";	//$cantiFoliosb
			echo "<td>$estado</td>";			
				
	
/**********************************Datos de Busqueda**************************************************************/
echo"<input type='hidden' name='documento' value='".$documento."'/>";
echo"<input type='hidden' name='year' value='".$year."'/>";
echo"<input type='hidden' name='serie' value='".$serie."'/>";

echo "</tr>";		
echo "</form>";
}//fin del while
echo"</table></div>";

/*********************************************************************************************************************/
echo"<p align='center'>";

	if (empty($resultados)){
	}
	else{
	echo"<p align='center'>";
	
	if(($pagina - 1) > 0) { 
	echo "<b><a href='historial.php?pagina=".($pagina-1)."&documento=$documento&year=$year&serie=$serie'>< Anterior</a></b> ";   
	}
	//  muestra la cantidad de paginas... 
	for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo $pagina . " "; 
	} else { 
    echo "<b><a href='historial.php?pagina=$i&documento=$documento&year=$year&serie=$serie'>$i</a></b> ";
	}
 }	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
echo " <b><a href='historial.php?pagina=".($pagina+1)."&documento=$documento&year=$year&serie=$serie'>Siguiente ></a></b>"; 
	}}
	echo"</p>";
	/**************************************enlaces********************************************************************/
	if(mysql_num_rows($resul)!=0){
	echo "<label><p><a href='pdfhistorial.php?documento=$documento&year=$year&serie=$serie' target='_blank' >Crear PDF</a></p></label>"; }
		echo " "; 
	
    echo "<label><p><a href='historialmovimientos.php?info=$info'>Volver a Historial de Movimientos</a> <a> &nbsp;</a> ";

    echo"<a href='reportes.php?info=$info'>Volver a seleccionar reporte</a></p></label>";
	/****************************************************************************************************************/
   ?>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>