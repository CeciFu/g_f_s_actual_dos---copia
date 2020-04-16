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
<link rel="stylesheet" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Búsqueda Instituciones </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

<?php
//pide las variables para la consulta enviados por URL
$info=$_GET["info"];
//Datos de Institucion busqueda
$nombreb=$_GET["nombreb"];
$estadob=$_GET["estadob"];
$ciudadb=$_GET["ciudadb"];
$descripcionb=$_GET["descripcionb"];
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
$ciudadb=$_POST['ciudad'];
$estadob=$_POST['estado'];
$descripcionb=$_POST['descripcion'];
}
if(!empty($nombreb))
		{
			$condicion="where nombre like '%".$nombreb."%'";
			
			if(!empty($estadob))	
			{
				$condicion.="and estado='$estadob'";
			}
			if(!empty($ciudadb))
			{
				$condicion.="and ciudad='$ciudadb'";
			}
			if(!empty($descripcionb))
			{
				$condicion.="and descripcion like '%" . $descripcionb . "%'";
			}
						
		}
else  if(!empty($estadob))
          {
           $condicion="where estado='$estadob'";
			
			if(!empty($ciudadb))	
			{
				$condicion.="and ciudad='$ciudadb'";
			}
			if(!empty($descripcionb))
			{
				$condicion.="and descripcion like '%" .  $descripcionb  . "%'";
			}
		}
		
	else if(!empty($ciudadb))
			{
				$condicion.="where ciudad='$ciudadb'";
				
				if(!empty($descripcionb))
			{
				$condicion.="and descripcion like '%" . $descripcionb  . "%'";
			}
			}
else  if(!empty($descripcionb))
          {
           $condicion="where descripcion like '%" .  $descripcionb  . "%'";
		   
			
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

$resultados = mysql_query("SELECT * FROM instu  $condicion  LIMIT $inicio, $registros ");

}
else if(!empty($info)){
$condicion=" where nombre like '%" . $info . "%' or ciudad like '%" . $info . "%' or estado='$info' or descripcion like '%" . $info . "%'";
$resultados = mysql_query("SELECT * FROM instu  $condicion  LIMIT $inicio, $registros ");
 
 }
$resul = mysql_query("SELECT idInst FROM instu $condicion"); 
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
echo"<tr><td>Nombre de Institución </td><td>Ciudad</td><td>Estado</td><td>Descripción</td>";
	if(in_array('Modificacion Institución', $oper) || in_array('Baja Institución',$oper)){
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
	echo "<td>".$r["nombre"]."</td>"; 
	echo "<td>".$r["ciudad"]." </td>"; 
 	echo "<td>".$r["estado"]." </td>";
	echo "<td>".$r["descripcion"]." </td>";

	?>
	<?php
		
		
	if(in_array('Modificación Institución', $oper))
	{ ?>
	<td><input type="image" value="modificar" onclick="this.form.action='modificar.php'; this.form.submit()"src="../images/edit.png" title="Modificar Institución"/></td>
	
	<?php }		
	if(in_array('Baja Institución', $oper))
	{ ?>	
    <td><input type="image" onclick="if (confirm('¿Desea confirmar la eliminación?')){ 
  this.form.action='eliminar.php'; this.form.submit()}return false " value="eliminar" src="../images/delete.png" name="eliminar" title="Eliminar Insitución" > 
</td>
	<?php 
	}
	echo"<input type='hidden' name='idInst' value='".$r['idInst']."'/>";
	echo"<input type='hidden' name='nombre' value='".$r['nombre']."'/>";
	echo"<input type='hidden' name='ciudad' value='".$r['ciudad']."'/>";
	echo"<input type='hidden' name='estado' value='".$r['estado']."'/>";
	echo"<input type='hidden' name='descripcion' value='".$r['descripcion']."'/>";
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='info' value='".$info."'/>";
	echo"<input type='hidden' name='nombreb' value='".$nombreb."'/>";
	echo"<input type='hidden' name='ciudadb' value='".$ciudadb."'/>";
	echo"<input type='hidden' name='estadob' value='".$estadob."'/>";
	echo"<input type='hidden' name='descripcionb' value='".$descripcionb."'/>";echo"</tr>";
echo "</form>";
}
echo"</table></div>";
/*********************************************************************************************************************/
/*PAGINACIO*/
	if (empty($resultados)){
	echo"No se encuentran resultados";
	}
	else{
	echo"<p align='center'>";
	//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
echo "<b><a href='busquedaI.php?pagina=".($pagina-1)."&info=$info&nombreb=$nombreb&estadob=$estadob&ciudadb=$ciudadb&descripcionb=$descripcionb'>< Anterior</a></b> ";  
	}
	
	
	//  muestra la cantidad de paginas... 
	for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	//echo "<b>".$pagina."</b> "; 
	echo $pagina . " "; 
	} else { 
echo "<b><a href='busquedaI.php?pagina=$i&info=$info&nombreb=$nombreb&estadob=$estadob&ciudadb=$ciudadb&descripcionb=$descripcionb'>$i</a></b> ";  
	}
 }
	 
	 
	 
	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
echo " <b><a href='busquedaI.php?pagina=".($pagina+1)."&info=$info&nombreb=$nombreb&estadob=$estadob&ciudadb=$ciudadb&descripcionb=$descripcionb'>Siguiente ></a></b>"; 
	}
	echo"</p>";
	}
	
	
	
	
	 ?>
	 
  <label><p><a href="institucion_universitaria.php">Volver a la Página Institución Universitaria</a></p></label>
</body>
</html>
















