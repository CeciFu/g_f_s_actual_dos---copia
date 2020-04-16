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
  <h1>Docentes designados por asignatura según a&ntilde;o</h1>
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
//$nombre=$_GET["nombre"];
//$info=$_GET["info"];
//$anio=$_GET["anio"];
//Datos de Institucion busqueda

?>
<!--------------------------------------Busqueda libre---------------------------------------------------->
<?php

if (isset($_POST['buscar1'])){

//$nombre=$_POST['nombre'];
$info=$_POST["info"];
$anio=$_POST["anio"];
/*echo "valor";
echo $info;
echo "anio";
echo $anio;
*/
}
?>
<!--------------------------------------Busqueda Avanzada---------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------->
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

//echo "valor de info".$info;

/*********************Arma la consulta correspondientes*******************/


$resultados = mysql_query("SELECT * FROM documento  where asignatura='$info' and anioCreacion='$anio'  LIMIT $inicio, $registros ");
//echo "valor de resultados";
//echo $resultados; 
$resul = mysql_query("SELECT * FROM documento  where asignatura='$info' and anioCreacion='$anio' "); 
//echo "valor de resul";

$total_registros = mysql_num_rows($resul);
//echo $total_registros; 
$total_paginas = ceil($total_registros / $registros); 


/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultados)==0)
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


echo"<table width='60%' class='CSS_Table_Example'  align='center' >";
echo"<tr><td>Nro. Doc / Año</td>
		<td>Docente</td>
		<td>Materia</td>
		<td>Sector Inicial</td>
		<td>Sector Actual</td>
	</tr>";
   
  
   
   }
$i=0;
while($r=mysql_fetch_array($resultados)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
	echo"<tr>";

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
				echo "<td>"."/"."</td>"; 
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
			
			echo "<td>".$r["nombreDocente"]." ".$r["apellDocente"]."</td>"; 
			echo "<td>".$r["asignatura"]."</td>"; 
			echo "<td> $UniInic - $sectorI</td>";
			echo "<td>$UniActual - $sectorA </td>";
			echo "<tr><td>Extracto</td>";
			echo "<td colspan='5'>".$r["Extracto"]." </td></tr>";
			echo"</tr>";
		
	
	
	/**********************************Datos de Busqueda**************************************************************/
	//echo"<input type='hidden' name='nombre' value='".$nombre."'/>";
	//echo $sectorI;
	echo"<input type='hidden' name='info' value='".$info."'/>";
echo "</tr>";
		
echo "</form>";
}
echo"</table>";
/*********************************************************************************************************************/
echo"<p align='center'>";
/*PAGINACIO*/
	if (empty($resultados)){ 
	//
	}
	else{
	
	//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
	echo "<a href='designadosAnioMateria.php?pagina=".($pagina-1)."&info=$info'>< Anterior </a> ";  
	}
	
	
	//  muestra la cantidad de paginas...
	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='designadosAnioMateria.php?pagina=$i&info=$info'>$i</a> ";  
				}
    	}
	
	}//fin if si registros en menor q 10
	else
	{
		//nada
	}
	 
	 
	 
	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
	echo " <a href='designadosAnioMateria.php?pagina=".($pagina+1)."&info=$info'>Siguiente ></a>"; 
	}
	
	if(mysql_num_rows($resultados)!=0)
	{
	
		echo"<label><p>";
		echo " <a href='pdfDocentesMateriaAnio.php?info=$info&anio=$anio'>Crear PDF</a></label></p>"; 
	 
	
	echo " "; 
	}
}//fin else de resultados positivos
	
	
	//<input type="submit" name="Enviar" value="Imprimir" onclick="window.print();" class="inputBoton"/>
	 
	 
  echo "<label><p><a href='docentesMateriaAnio.php'>Volver a ingresar datos</a> <a> &nbsp;</a> <a> &nbsp;</a><a href='reportes.php'>Volver a seleccionar reporte</a></p></label>";
  ?>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>


