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
<link rel="stylesheet" media="screen" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=120,height=300,scrollbars=SI") 
} 
</script> 
</head>

<body>

<div class="divTitulo">
  <h1>&nbsp;</h1>
  <?php
$nivel2List=$_GET["nivel2List"];
$nivel3List=$_GET["nivel3List"];
if (isset($_POST['buscar1'])){

$nivel2List=$_POST["nivel2List"];
$nivel3List=$_POST["nivel3List"];

}
$sql="SELECT nombre FROM instu WHERE idInst=$nivel2List";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{			
			$nombreI=$row ['nombre'];	
		}
		$sql1="SELECT nombre FROM sectoruniversitario WHERE idSector=$nivel3List";
		$ejecutar_sql1=mysql_query($sql1);
		
		/**************************************************************************/
		
		while($row1=mysql_fetch_array($ejecutar_sql1))
		{			
			$nombreS=$row1 ['nombre'];	
		}
?>
  <h1>Documentos iniciados por <?php echo $nombreI." - "; echo $nombreS; ?></h1>
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


?>
<!--------------------------------------Busqueda libre---------------------------------------------------->

<!--------------------------------------Busqueda Avanzada---------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------->
		<?php
		
//La tabla solo muestra 20 registros
$registros = 6;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
} 
else { 
$inicio = ($pagina - 1) * $registros; }



/*********************Arma la consulta correspondientes*******************/


$resultado = mysql_query("SELECT * FROM documento  where idInstUni='$nivel2List' AND idSectorIniciador='$nivel3List'  LIMIT $inicio, $registros ");

$resultados = mysql_query("SELECT * FROM documento  where idInstUni='$nivel2List' AND idSectorIniciador='$nivel3List' "); 

$total_registros = mysql_num_rows($resultados);

$total_paginas = ceil($total_registros / $registros); 


/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultado)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>
			<p>&nbsp;</p>
			<p>No se encontraron resultados.</p>";
		echo"<p>&nbsp;</p>
			</fieldset>
			<p>&nbsp;</p>
			</form>
			";
		 
		
	}
else{

echo"<p>&nbsp;</p>";
echo"<table width='50%' class='CSS_Table_Example' align='center'  >";
echo"<tr >
		<td>Nro. Doc</td>
		<td>Año creaci&oacute;n</td>
		<td>Estado</td>
		<td>Ubicaci&oacute;n actual</td>
		<td>Instituci&oacute;n y sector actual</td>		
	</tr>";
   
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
			echo "<td>".$r["estado"]."</td>"; 
			echo "<td> P:".$r["pasillo"]."-E:".$r["estante"]."-A:".$r["anaquel"]."-C:".$r["caja"]."</td>"; 
			echo "<td>$UniActual - $sectorA</td>";			
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
	echo"<input type='hidden' name='nivel2List' value='".$nivel2List."'/>";
	
	echo"<input type='hidden' name='nivel3List' value='".$nivel3List."'/>";
	echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
		
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
	echo"No se encuentran resultados";
	}
	else{//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) 
	{ 
		echo "<a href='iniciados.php?pagina=".($pagina-1)."&nivel2List=$nivel2List&nivel3List=$nivel3List'>< Anterior</a> "; 
		
	}
//  muestra la cantidad de paginas...

	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='iniciados.php?pagina=$i&nivel2List=$nivel2List&nivel3List=$nivel3List'>$i</a> "; 
				}
    	}
	
	}//fin if si registros en menor q 10
	 

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='iniciados.php?pagina=".($pagina+1)."&nivel2List=$nivel2List&nivel3List=$nivel3List'>Siguiente ></a>"; 
}}
echo"</p>";
	
	
	if(mysql_num_rows($resultado)!=0)
	{
	echo"<label><p>";
		echo " <a href='pdfAreas.php?nivel2List=$nivel2List&nivel3List=$nivel3List' target='_blank' >Crear PDF</a></p></label>
		"; 
	 //echo "<a href='javascript:ventanaSecundaria('pdfAreas.php?nivel2List=$nivel2List&nivel3List=$nivel3List')'> Pincha en este enlace para abrir la ventana secundaria</a>
	
	echo " "; 
	}
 echo " <label><p><a href='area.php?info=$info'>Volver a seleccionar &Aacute;rea</a> <a> &nbsp;</a> <a> &nbsp;</a><a href='reportes.php?info=$info'>Volver a seleccionar reporte</a></p></label>";
  ?>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>




