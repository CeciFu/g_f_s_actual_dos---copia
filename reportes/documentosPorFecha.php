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
<title>Docentes designados por asignatura</title>
<link rel="stylesheet" media="screen" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>  
  <?php
$dia=$_GET["dia"];
$mes=$_GET["mes"];
$anio=$_GET["anio"];
$info=$_GET["info"];
if (isset($_POST['buscar1'])){


$dia=$_POST["dia"];
$mes=$_POST["mes"];
$anio=$_POST["anio"];

if($dia<10 ){
$dia="0".$dia;

}
if($mes<10)
{
	$mes="0".$mes;
}

if($anio==0)
{
	if($dia==0 && $mes!=0)//se pregunta por mes
	{
		
		$info="%-".$mes."-%";
	}
	else if($dia!=0 && $mes==0)//solo por dia
	{
		
		$info="%-".$dia;
	}
	else if($dia!=0 && $mes!=0)
	{
		$info="%-".$mes."-".$dia;
	}
	
	
}
else 
{
	if($mes==0 && $dia==0)//solo año
	{
		$info=$anio."-%";
	}
	else if($mes!=0 && $dia==0)//año y mes
	{
		$info=$anio."-".$mes."-%";
	}
	else if($mes==0 && $dia!=0)//año y dia
	{
		$info=$anio."-%-".$dia;
	}
	else//año dia y mes
	{
		$info=$anio."-".$mes."-".$dia;
	}
}
}



?>
  <h1>Documentos iniciados por fecha </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<h1>&nbsp;</h1>

<!--------------------------------------Busqueda libre---------------------------------------------------->

<!--------------------------------------Busqueda Avanzada---------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------->
		<?php
		
//La tabla solo muestra 10 registros
$registros = 5;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
} 
else { 
$inicio = ($pagina - 1) * $registros; }


/*********************Arma la consulta correspondientes*******************/

		$resultado = mysql_query("SELECT * FROM documento  where fechaCreacion like '$info' LIMIT $inicio, $registros ");
		 
		$resultados = mysql_query("SELECT * FROM documento  where fechaCreacion like '$info'"); 
		
		
		$total_registros = mysql_num_rows($resultados);
		
		$total_paginas = ceil($total_registros / $registros); 
		

/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultado)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>
			<p>&nbsp;</p>";
		echo"<p>No se encontraron resultados</p>";
		echo"<p>&nbsp;</p>
			</fieldset>
			<p>&nbsp;</p>
			</form>
			";
		 
		
	}
else{


echo"<table width='50%' cellpadding='15'  class='CSS_Table_Example' align='center'  border='1px' cellspacing='1px'>";
echo"<tr><td>Nro. Doc / Año</td><td>Fecha</td><td>Estado</td><td>Instituci&oacute;n y sector Inicial</td><td>Instituci&oacute;n y sector Actual</td><td>Ubicaci&oacute;n</td></tr>";
   
  
   
   }
$i=0;
while($r=mysql_fetch_array($resultado)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
	

	
			
			$valor=$r["idDocumento"];	
			$idSectorI=$r["idSectorIniciador"];
			$idUniIni=$r["idInstUni"];
			$idSectorA=$r["idSectorActual"];		
			$Uniactual=$r["idInstUniActual"];		
			
			$query =mysql_query("SELECT * FROM sectoruniversitario where idSector='$idSectorI'");
	
	 		while ($row=mysql_fetch_array($query))    
			{
			$sectorI=$row['nombre'];
			//echo $row['nombreTipo'];
			}
				$query=mysql_query("SELECT *  FROM instu where idInst='$idUniIni'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$UniInic=$row['nombre'];
					
				}
			$query=mysql_query("SELECT *  FROM sectoruniversitario where idSector='$idSectorA'");

		
			while ($row=mysql_fetch_array($query))    
				{
					$sectorA=$row['nombre'];
					
				}		
			$query=mysql_query("SELECT *  FROM instu where idInst='$Uniactual'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$UniActual=$row['nombre'];
					
				}
		
			$doc=$r["numDoc"];
			$anioC=$r["anioCreacion"];
			echo "<tr>";
			if($doc==0 && $anioC==0)
			{
				echo "<td>"." / "."</td>"; 
			}
			else if($doc==0 && $anioC!=0)
			{
				echo "<td> /$anioC</td>";
			}
			else if($doc!=0 && $anioC==0)
			{
				echo "<td> $doc/</td>";
			}
			else
			{
				echo "<td> $doc/$anioC</td>";
			
			}
			$fechab=$r["fechaCreacion"];
			$fechas=explode("-", $fechab);
			$dias = $fechas[2];
			$mess = $fechas[1];
			$annos = $fechas[0];
			$fechaC=$dias."-".$mess."-".$annos;
			
						
						
								
			echo "<td>$fechaC</td>"; 
			echo "<td>".$r["estado"]."</td>"; 
			echo "<td> $UniInic - $sectorI</td>";
			echo "<td>$UniActual - $sectorA </td>";
			echo "<td> P:".$r["pasillo"]."-E:".$r["estante"]."-A:".$r["anaquel"]."-C:".$r["caja"]."</td></tr>"; 
			echo "<tr><td>Extracto</td>";
			$extracto=$r["Extracto"];
			if(!empty($extracto))
			{
	
				echo"<td colspan='7'>".substr($r["Extracto"],0,140).'...' ."</td>";
	
			}
			else
			{
				echo"<td colspan='7'>El presente documento no contiene extracto</td>";
			}
		
	
	
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='pagina' value='".$pagina."'/>";	
	echo"<input type='hidden' name='anio' value='".$anio."'/>";
	echo"<input type='hidden' name='mes' value='".$mes."'/>";
	echo"<input type='hidden' name='dia' value='".$dia."'/>";
	echo"<input type='hidden' name='info' value='".$info."'/>";
echo "</tr>";
		
echo "</form>";
}
echo"</table>";
/*********************************************************************************************************************/

	echo"<p align='center'>";
	/*PAGINACIO*/
	echo"<p align='center'>";
	/*PAGINACIO*/
	if (empty($resultado))
	{
	//echo"No se encuentran resultados";
	}
	else{//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) 
	{ 
		echo "<a href='documentosPorFecha.php?pagina=".($pagina-1)."&anio=$anio&mes=$mes&dia=$dia&info=$info'>< Anterior</a> "; 
	}
//  muestra la cantidad de paginas...

	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='documentosPorFecha.php?pagina=$i&anio=$anio&mes=$mes&dia=$dia&info=$info'>$i</a> "; 
				}
    	}
	
	}//fin if si registros en menor q 10
	 

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='documentosPorFecha.php?pagina=".($pagina+1)."&anio=$anio&mes=$mes&dia=$dia&info=$info'>Siguiente ></a>"; 
}}
echo"</p>";
	
	
	if(mysql_num_rows($resultado)!=0)
	{
	echo"<label><p>";
		echo " <a href='pdfDocumentosFecha.php?anio=$anio&mes=$mes&dia=$dia' target='_blank' >Crear PDF</a></p></label>"; 
	 
	
	echo " "; 
	} 
 
   ?>
	
	 
  <label><p><a href="fechaEspecifica.php">Volver a ingresar datos</a> <a> &nbsp;</a> <a> &nbsp;</a><a href="reportes.php">Volver a seleccionar reporte</a></p></label>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>

