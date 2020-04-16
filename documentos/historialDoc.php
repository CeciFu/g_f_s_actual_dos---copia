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
	$valor=$_GET["valor"];
	$documento=$_GET["documento"];
		$year=$_GET["year"];
		$serie=$_GET["serie"];
		if (isset($_POST['buscar1'])){

		$documento=$_POST["documento"];
		$year=$_POST["year"];
		$serie=$_POST["serie"];
		
		}
	$info=$_GET["info"];
	
	$pagina = $_GET['pagina'];
	$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$institucionAb=$_GET['institucionAb'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];		
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$dniProfb= $_GET['dniProfb']; 
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nomCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$obsb=$_GET['obsb'];
	$extractob=$_GET['extractob'];
	$fechaElimb=$_GET['fechaElimb'];
	//echo "valorrrrr id documento".$idD;
	
	$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento=$valor" );
	while ($row=mysql_fetch_array($sql))  
	{
		$anio =$row["anioCreacion"];
		$serie=$row["idSerie"];
		$numeroDoc=$row["numDoc"];
		$documento=$row["numDoc"];
		$year=$row["anioCreacion"];
		
			
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

//Datos de Institucion busqueda


$db= new conexion();
$info=$_GET["info"];
	
	$pagina = $_GET['pagina'];
	$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$institucionAb=$_GET['institucionAb'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];		
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$dniProfb= $_GET['dniProfb']; 
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nomCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$obsb=$_GET['obsb'];
	$extractob=$_GET['extractob'];
	$fechaElimb=$_GET['fechaElimb'];
//Datos asociados a la busqueda

		
	$info=$_GET["info"];
	
	$pagina = $_GET['pagina'];
	$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$institucionAb=$_GET['institucionAb'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];		
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$dniProfb= $_GET['dniProfb']; 
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nomCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$obsb=$_GET['obsb'];
	$extractob=$_GET['extractob'];
	$fechaElimb=$_GET['fechaElimb'];



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

/*********************Arma la consulta correspondientes*******************/
//busca el id del documento

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento=$valor" );
while ($row=mysql_fetch_array($sql))  
{
	$id =$row['idDocumento'];
	$cantiFolios=$row['cantidadFolios'];
			
}

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
			<legend>Mensaje</legend>
			<p>&nbsp;<p>";
		echo"<p>No se encontraron resultados</p>";
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
	$idMov=$r["idRmov"];
	$idUReceptor=$r["idUsuarioD"];
	$estado=$r["estador"];
	
	
	
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
$resultados = mysql_query("SELECT * FROM  registros WHERE idremito='". $idMov ."'");
while($r=mysql_fetch_array($resultados)) {
$remitFolios=$r["foliosM"];
}
/**************************muestra datos**************************************************************************/
					
			echo"<td>$idu</td>";
			echo "<td>".$fecha." </td>";
			echo "<td>$documento/$year</td>"; 					
			echo "<td>$io - $so</td>"; 
			echo "<td>$id - $sd</td>";
			if($estado=="Confirmado")			
			{
				echo "<td>$fRecepcion</td>";			
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

echo "</tr>";
	echo"<input type='hidden' name='info' value='".$info."' />";

	echo"<input type='hidden' name='valor' value='".$valor."' />";
		echo"<input type='hidden' name='idb' value='".$idb."' />";
		echo"<input type='hidden' name='numeroDocb' value='".$numeroDocb."' />";
		echo"<input type='hidden' name='aniob' value='".$aniob."' />";
		echo"<input type='hidden' name='serieb' value='".$serieb."' />";
		echo"<input type='hidden' name='sectorIniciab' value='".$sectorIniciab."' />";
		echo"<input type='hidden' name='sectorActualb' value='".$sectorActualb."' />";
		echo"<input type='hidden' name='estadob' value='".$estadob."'/>";
		echo"<input type='hidden' name='extractob' value='".$extractob."' />";
		echo"<input type='hidden' name='institucionb' value='".$institucionb."' />";
		echo"<input type='hidden' name='institucionAb' value='".$institucionAb."' />";
		echo"<input type='hidden' name='fechab' value='".$fechab."' />";
		echo"<input type='hidden' name='dnib' value='".$dnib."' />";
		echo"<input type='hidden' name='nombreAlumnob' value='".$nombreAlumnob."' />";
		echo"<input type='hidden' name='apellidoAlumnob' value='".$apellidoAlumnob."' />";
		echo"<input type='hidden' name='dniProfb' value='".$dniProfb."' />";
		echo"<input type='hidden' name='nombreProfb' value='".$nombreProfb."' />";
		echo"<input type='hidden' name='apellidoProfb' value='".$apellidoProfb."' />";
		echo"<input type='hidden' name='codCarrerab' value='".$codCarrerab."' />";
		echo"<input type='hidden' name='nomCarrerab' value='".$nomCarrerab."' />";
		echo"<input type='hidden' name='cantiCopiasb' value='".$cantiCopiasb."' />";
		echo"<input type='hidden' name='cantiFoliosb' value='".$cantiFoliosb."' />";
		echo"<input type='hidden' name='asignaturab' value='".$asignaturab."' />";
		echo"<input type='hidden' name='pasillob' value='".$pasillob."' />";
		echo"<input type='hidden' name='estanteb' value='".$estanteb."' />";
		echo"<input type='hidden' name='anaquelb' value='".$anaquelb."' />";
		echo"<input type='hidden' name='cajab' value='".$cajab."' />";
		echo"<input type='hidden' name='fechaElimb' value='".$fechaElimb."' />";
		echo"<input type='hidden' name='obsb' value='".$obsb."' ></input>";
		echo"<input type='hidden' name='pagina' value='".$pagina."' ></input>";
		echo"<input type='hidden' name='documento' value='".$documento."' ></input>";
		echo"<input type='hidden' name='year' value='".$year."' ></input>";
		echo"<input type='hidden' name='serie' value='".$serie."' ></input>";
	
				
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
	echo "<b><a href='historialDoc.php?pagina=".($pagina-1)."&valor=$valor&info=$info&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>< Anterior</a></b> ";   
	}
	//  muestra la cantidad de paginas... 
	for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	echo $pagina . " "; 
	} else { 
    echo "<b><a href='historialDoc.php?pagina=$i&valor=$valor&info=$info&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>$i</a></b> ";
	}
 }	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
	echo " <b><a href='historialDoc.php?pagina=".($pagina+1)."&valor=$valor&info=$info&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>Siguiente ></a></b>"; 
	}}
	echo"</p>";
	/**************************************enlaces********************************************************************/
	if(mysql_num_rows($resul)!=0){
		echo"<p>&nbsp;</p>";
	echo "<label><p><a href='../reportes/pdfhistorial.php?documento=$documento&serie=$serie&year=$year' target='_blank' >Crear PDF</a></p></label>"; }
	
   	echo"<p>&nbsp;</p>";
 	
	echo "<p><label><a href='busqueda.php?info=$info&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>Volver a la Búsqueda</a></label></p>";
	echo"<p>&nbsp;</p>";
  	echo " <p><label><a href='documento.php?info=$info'>Volver a la Página Documento</a></label></p>";
	/****************************************************************************************************************/
   ?>
  <p align="center">
		<label> 		
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>