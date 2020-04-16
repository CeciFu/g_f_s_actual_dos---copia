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
<title>Expedientes ingresados</title>
<link rel="stylesheet" media="screen" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<?php
//pide las variables para la consulta enviados por URL
$info=$_GET["info"];
$anio=$_GET["anio"];
if (isset($_POST['buscar1'])){

$info=$_POST['info'];
$anio=$info."-%";
}
//Datos de Institucion busqueda

?>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Documentos ingresados al archivo hist&oacute;rico en el a&ntilde;o <?php echo $info; ?> </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<h1>&nbsp;</h1>



<!---------------------------------------------------------------------------------------------------------->
		<?php
		
//La tabla solo muestra 20 registros
$registros =5;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
} 
else { 
$inicio = ($pagina - 1) * $registros; }

//echo "valor de info".$info;

/*********************Arma la consulta correspondientes*******************/


$resultado= mysql_query("SELECT * FROM `movimiento` INNER JOIN  `registros` INNER JOIN `documento`  WHERE 
fecha like '$anio' and idSectorDestino='3' and movimiento.idRmov=registros.idremito and 
registros.documento=documento.iddocumento LIMIT $inicio, $registros ");
//echo "valor de resultados ".$anio;
//echo $resultados; 
$resultados = mysql_query("SELECT * FROM `movimiento` INNER JOIN  `registros` INNER JOIN `documento`  WHERE 
fecha like '$anio' and idSectorDestino='3' and movimiento.idRmov=registros.idremito and 
registros.documento=documento.iddocumento "); 
//echo "valor de resul";

$total_registros = mysql_num_rows($resultados);

$total_paginas = ceil($total_registros / $registros); 


/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultado)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>";
		echo"<p>No se encontraron resultados</p>";
		echo"<p>&nbsp;</p>
			</fieldset>
			</form>
			";
		 
		
	}
else{


echo"<table width='50%' cellpadding='15'  class='CSS_Table_Example' align='center'  border='1px' cellspacing='1px'>";
echo"<tr BGCOLOR='#B3C8FF' ><td>Nro. Doc</td><td>A&ntilde;o creaci&oacute;n<td>Instituci&oacute;n y sector Iniciador</td><td>Estado</td><td>Ubicaci&oacute;n</td></tr>";
   
  
   
   }
$i=0;
while($r=mysql_fetch_array($resultado)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";


	echo"<tr>";
			
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
			$query=mysql_query("SELECT *  FROM instu where idInst='$idUniIni'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$UniInic=$row['nombre'];
					
				}
			$doc=$r["numDoc"];
			echo "<tr>";
			echo"<td>$doc</td>";			
			echo "<td>".$r["anioCreacion"]."</td>"; 					
			echo "<td>$UniInic - $sectorI</td>"; 			
			echo "<td>".$r["estado"]."</td>"; 
			echo "<td>P:".$r["pasillo"]."-E:".$r["estante"]."-A:".$r["anaquel"]."-C:".$r["caja"]."</td>"; 
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
	echo"<input type='hidden' name='info' value='".$info."'/>";
	echo"<input type='hidden' name='anio' value='".$anio."'/>";
	echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
echo "</tr>";
		
echo "</form>";
}
echo"</table>";
/*********************************************************************************************************************/
echo"<p align='center'>";
/*PAGINACIO*/
	if (empty($resultado)){
	//
	}
else{
	
	//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
	echo "<a href='archivoPorAnio.php?pagina=".($pagina-1)."&info=$info&anio=$anio'>< Anterior </a> ";  
	}
	
	
	//  muestra la cantidad de paginas...
	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='archivoPorAnio.php?pagina=$i&info=$info&anio=$anio'>$i</a> ";  
				}
    }
	
	}//fin if si registros en menor q 10
	else
	{
		//nada
	}
	 
	 
	 
	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
	echo " <a href='archivoPorAnio.php?pagina=".($pagina+1)."&info=$info&anio=$anio'>Siguiente ></a>"; 
	}
	
	if(mysql_num_rows($resultados)!=0)
	{
	echo"<label><p>";
		echo " <a href='pdfIngresadosArchivo.php?info=$info' target='_blank' >Crear PDF</a></p></label>"; 
	 
	
	echo " "; 
	}
}//fin else de resultados positivos
	//<input type="submit" name="Enviar" value="Imprimir" onclick="window.print();" class="inputBoton"/>
	
	 
  echo "<label><p><a href='ingresadosArchivo.php?info=$info'>Volver a seleccionar Año</a> <a> &nbsp;</a> <a> &nbsp;</a><a href='reportes.php?info=$info'>Volver a seleccionar reporte</a></p></label>";
   ?>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>

