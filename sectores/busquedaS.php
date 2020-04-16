<?php 
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}

$oper=array(); 
$oper=$_SESSION["operaciones"];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Busqueda</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="stylesheet" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Búsqueda Sectores </h1>
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
$info=$_GET["info"];
//Datos de Institucion busqueda
$nombreb=$_GET["nombreb"];
$institucionb=$_GET["institucionb"];
$desb=$_GET["desb"];

?>
<!--------------------------------------Busqueda libre---------------------------------------------------->
<?php

if (isset($_POST['buscar1'])){

$info=$_POST['info'];

}
?>
<!--------------------------------------Busqueda Avanzada---------------------------------------------------->
<?php 

if(isset($_POST['buscar2'])){

$nombreb=$_POST['nombre'];
$institucionb=$_POST['institucion'];
$desb=$_POST['des'];

}
if(!empty($nombreb))
		{
			$condicion="where instu.nombre like '%".$nombreb."%'";
			
			if($institucionb!=0)	
			{
				$condicion.="and sectoruniversitario.idInstu='$institucionb'";
			}
			     if(!empty($desb))	
		     {
				$condicion.="and sectoruniversitario.descripcion like '%".$desb."%'";
			}
							
		}
else  if($institucionb!=0)
          {
           $condicion="where sectoruniversitario.idInstu='$institucionb'";
			
		
		if(!empty($desb)){
				$condicion.=" and sectoruniversitario.descripcion like '%".$desb."%'";
			}
			}
				
			
	else if(!empty($desb))	
			{
				$condicion.=" where sectoruniversitario.descripcion like '%".$desb."%'";
			}
			
		?>
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



/*********************Arma la consulta correspondientes*******************/
if(empty($info)){

$resultados = mysql_query("SELECT  idSector, idInst , sectoruniversitario.nombre AS nombreS ,idInstu, sectoruniversitario.descripcion AS dess from sectoruniversitario INNER JOIN instu $condicion  and instu.idInst=sectoruniversitario.idInstu  LIMIT $inicio, $registros ");
 $resul = mysql_query("SELECT * FROM sectoruniversitario INNER JOIN instu $condicion and instu.idInst=sectoruniversitario.idInstu"); 
}
else if(!empty($info)){
$condicion=" where nombre like '%" . $info . "%' ";
$resultados = mysql_query("SELECT  idSector,`instu`.`nombre` AS nombrei , sectoruniversitario.nombre AS nombreS ,idInstu, sectoruniversitario.descripcion AS dess,idInst , ciudad ,estado FROM sectoruniversitario $condicion  LIMIT $inicio, $registros ");
$resul = mysql_query("SELECT idSector FROM sectoruniversitario $condicion"); 
}
if(mysql_num_rows($resultados)==0)
{
$resultados = mysql_query("SELECT   idSector,`instu`.`nombre` AS nombrei , sectoruniversitario.nombre AS nombreS ,idInstu, sectoruniversitario.descripcion AS dess,idInst , ciudad ,estado FROM `sectoruniversitario` INNER JOIN `instu`  ON sectoruniversitario.idInstu=instu.idInst and instu.nombre like '%".$info."%' LIMIT $inicio, $registros");
$resul = mysql_query("SELECT  idSector FROM `sectoruniversitario` INNER JOIN `instu`  ON sectoruniversitario.idInstu=instu.idInst and instu.nombre like '%".$info."%'"); 
}
 
 

$total_registros = mysql_num_rows($resul);
$total_paginas = ceil($total_registros / $registros); 


/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultados)==0)
	{
		echo
		"<FORM  action='' method='GET'>
		<p>&nbsp<p>
			<fieldset id='fs'  class='fieldset'>
				<legend>Mensaje</legend>
				<p>&nbsp<p>
				<p>No se encontraron resultados</p>
				<p>&nbsp<p>
			</fieldset>
		
		</form>
		";
		 
		
	}
else{

echo"<p>&nbsp;</p><div class='CSS_Table_Example' align= 'center''>";
echo"<table width='100%'  class='CSS_Table_Example' align='center'  border='1px' cellpadding='0px'  cellspacing='1px'>";
	echo"<tr><td>Nombre del Sector </td><td>Institución</td><td>Descripción</td>";
	if(in_array('Modificacion Sector Universitario', $oper) || in_array('Baja Sector Universitario',$oper)){
	    echo"<td colspan='2'>Operaciones</td></tr>";
}     
   else{
   echo "</tr>";
   
   }
   
   }
$i=0;
while($r=mysql_fetch_array($resultados)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
echo"<tr>";

$idI=$r["idInstu"];
		$query =mysql_query("SELECT nombre FROM instu where idInst='$idI'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$nombreInstitucion=$row['nombre'];
		
			}
			
	echo "<td>".$r["nombreS"]."</td>"; 
	echo "<td>".$nombreInstitucion."</td>"; 
 	echo "<td>".$r["dess"]." </td>";
	?>
	<?php
	if(in_array('Modificación Sector Universitario', $oper))
	{ ?>
	<td><input type="image" value="modificar" onclick="this.form.action='modificar.php'; this.form.submit()"src="../images/edit.png" title="Modificar Sector"/></td>
		<?php }		
	if(in_array('Baja Sector Universitario', $oper))
	{ ?>	
	
    <td><input type="image" onclick="if (confirm('¿Desea confirmar la eliminación?')){ 
  this.form.action='eliminar.php'; this.form.submit()}return false " value="eliminar" src="../images/delete.png" name="eliminar" title="Eliminar Sector" > 
</td>
		<?php
		}
	
	echo"<input type='hidden' name='id' id='id' value='".$r['idSector']."'/>";
	echo"<input type='hidden' name='nombre' value='".$r['nombreS']."'/>";
	echo"<input type='hidden' name='institucion' value='".$nombreInstitucion."'/>";
	echo"<input type='hidden' name='idI' value='".$idI."'/>";
	echo"<input type='hidden' name='descripcion' value='".$r['dess']."'/>";
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='info' value='".$info."'/>";
	echo"<input type='hidden' name='nombreb' value='".$nombreb."'/>";
	echo"<input type='hidden' name='institucionb' value='".$institucionb."'/>";
	echo"<input type='hidden' name='descripcionb' value='".$descripcionb."'/>";
	echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
echo"</tr>";
echo "</form>";
}
echo"</table></div>";
/*********************************************************************************************************************/
/*PAGINACIO*/
	if (empty($resultados)){
	//echo"No se encuentran resultados";
	}
	else{
	echo"<p align='center'>";
	//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
	echo "<b><a href='busquedaS.php?pagina=".($pagina-1)."&info=$info&nombreb=$nombreb&institucionb=$institucionb'>< Anterior</a></b> ";   
	}
	
	
	//  muestra la cantidad de paginas... 
	for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	//echo "<b>".$pagina."</b> "; 
	echo $pagina . " "; 
	} else { 
echo "<b><a href='busquedaS.php?pagina=$i&info=$info&nombreb=$nombreb&institucionb=$institucionb'>$i</a></b> ";
	}
 }
	 
	 
	 
	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
echo " <b><a href='busquedaS.php?pagina=".($pagina+1)."&info=$info&nombreb=$nombreb&institucionb=$institucionb'>Siguiente ></a></b>"; 
	}}
	echo"</p>";
	
	 ?>
	 
  <label><b><a href="sector.php">Volver a la página Sector Universitario</a></b></label>
</body>
</html>
