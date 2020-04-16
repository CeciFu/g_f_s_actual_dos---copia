<?php 
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;}
	else{
	$usuario =$_SESSION["user"];
	$id =$_SESSION["idUsuarios"];

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
  <h1>Búsqueda Movimientos </h1>
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
$info=$_GET['info'];
$remitob =$_GET['remitob'];
$fechab =$_GET['fechab'];
$yearb =$_GET['yearb'];
$nivel2Listb=$_GET['nivel2Listb'];//istitucion1
$nivel2List1b=$_GET['nivel2List1b'];//institucion2
$nivel3Listb=$_GET['nivel3Listb'];//sectorORIGEN
$nivel3List1b=$_GET['nivel3List1b'];
$estadob=$_GET['estadob'];//sectorDESTINO
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


$remitob =$_POST['remito'];


$fecha=$_REQUEST['datepicker'];

$fechas=explode("/", $fecha);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
$fechab="$anno-"."$mes-"."$dia";
if ($fechab== "--" ){
$fechab="";

}

$yearb =$_POST['year'];
$nivel2Listb=$_POST['nivel2List'];//istitucion1
$nivel2List1b=$_POST['nivel2List1'];//institucion2
$nivel3Listb=$_POST['nivel3List'];//sectorORIGEN
$nivel3List1b=$_POST['nivel3List1'];//sectorDESTINO
$estadob=$_POST['estado'];//estado

}
if(!empty($remitob))
		{
			$condicion="where remito='$remitob'";
			
			if($yearb!=0)	
			{
				$condicion.="and anio='$yearb'";
			}
			if(!empty($fechab))//fecha
			{
				$condicion.="and fecha='$fechab'";
			}
			if($nivel2Listb!=0)//institucion1
			{
				$condicion.="and institucion1 ='$nivel2Listb '";
			}
			if($nivel2List1b!=0)//institucion2
			{
				$condicion.="and institucion2= ' $nivel2List1b '";
			}
			if($nivel3Listb!=0)//sector1
			{
				$condicion.="and idSectorOrigen = ' $nivel3Listb '";
			}
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino =' $nivel3List1b '";
			}
			if($estadob!=0)//estado
			{
				$condicion.="and estador =' $estadob '";
			}
									
		}
else  if($yearb!=0)	
			{
				$condicion.="where anio= $yearb ";
			
			if(!empty($fechab))//fecha
			{
				$condicion.="and fecha='$fechab'";
			}
			if($nivel2Listb!=0)//institucion1
			{
				$condicion.="and institucion1 = ' $nivel2Listb '";
			}
			if($nivel2List1b!=0)//institucion2
			{
				$condicion.="and institucion2 = ' $nivel2List1b '";
			}
			if($nivel3Listb!=0)//sector1
			{
				$condicion.="and idSectorOrigen = ' $nivel3Listb '";
			}
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino = ' $nivel3List1b '";
			}
			if($estadob!=0)//estado
			{
				$condicion.="and estador ='$estadob'";
			}
									
		}
		
	else if(!empty($fechab))//fecha
			{
				$condicion.="where fecha='$fechab'";
			
			if($nivel2Listb!=0)//institucion1
			{
				$condicion.="and institucion1 = ' $nivel2Listb '";
			}
			if($nivel2List1b!=0)//institucion2
			{
				$condicion.="and institucion2 = ' $nivel2List1b '";
			}
			if($nivel3Listb!=0)//sector1
			{
				$condicion.="and idSectorOrigen ='$nivel3Listb '";
			}
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino = ' $nivel3List1b '";
			}
			if($estadob!=0)//estado
			{
				$condicion.="and estador='$estadob'";
			}
									
		}
else  if($nivel2Listb!=0)//institucion1
			{
				$condicion.="where institucion1 = ' $nivel2Listb'";
			
			if($nivel2List1b!=0)//institucion2
			{
				$condicion.="and institucion2 ='$nivel2List1b '";
			}
			if($nivel3Listb!=0)//sector1
			{
				$condicion.="and idSectorOrigen = ' $nivel3Listb '";
			}
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino ='$nivel3List1b'";
			}
			if($estadob!=0)//estado
			{
				$condicion.="and estador =' $estadob '";
			}
									
		}
		else  if($nivel2Listb1!=0)//institucion2
			{
				$condicion.="where institucion2 = ' $nivel2List1b'";
			
			if($nivel3Listb!=0)//sector1
			{
				$condicion.="and idSectorOrigen =' $nivel3Listb '";
			}
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino = '$nivel3List1b '";
			}
			if($estadob!=0)//estado
			{
				$condicion.="and estador =' $estadob '";
			}
									
		}
		else if($nivel3Listb!=0)//sector1
			{
				$condicion.="where idSectorOrigen = '$nivel3Listb'";
			
			if($nivel3List1b!=0)//sector2
			{
				$condicion.="and idSectorDestino = ' $nivel3List1b'";
			}
			if($estadob!="")//estado
			{
				$condicion.="and estador =' $estadob '";
			}
									
		}
		else if($nivel3Listb1!=0)//sector2
			{
				$condicion.="where idSectorDestino = ' $nivel3List1b '";
			  if($estadob!="")//estado
			{
				$condicion.="and estador ='$estadob'";
			}	
			
			}
        else if($estadob!=0)//estado
			{
			
				$condicion.="where estador ='$estadob'";
			}
		?>
<!---------------------------------------------------------------------------------------------------------->
		<?php
		
//La tabla solo muestra 20 registros
$registros =4;
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

$resultados = mysql_query("SELECT * FROM movimiento $condicion  LIMIT $inicio, $registros ");
$resul = mysql_query("SELECT * FROM movimiento  $condicion  ");
//echo" $estadob ,,, $condicion";

}
/**************************************************Busqueda 1 **********************************************************/
else if(!empty($info) ){

$condicion=" where remito like '%" . $info . "%' or anio like '%" . $info . "%' or institucion1 like '%" . $info . "%'  or institucion2 like '%" . $info . "%' or fecha='$info' or idsectorOrigen like '%" . $info . "%' or idSectorDestino like '%" . $info .  "%' or estador='$info' ";
$resultados = mysql_query("SELECT * FROM movimiento $condicion LIMIT $inicio, $registros ");
$resul = mysql_query("SELECT idRmov FROM movimiento $condicion"); 
  
if(mysql_num_rows($resultados)==0){		
		$resultados = mysql_query("SELECT * FROM movimiento m INNER JOIN instu i WHERE i.nombre LIKE  '%" . $info . "%' AND m.institucion1 = i.idInst OR i.nombre LIKE  '%" . $info . "%' AND m.institucion2 = i.idInst LIMIT $inicio, $registros ");
		$resul= mysql_query("SELECT idRmov FROM movimiento m INNER JOIN instu i WHERE i.nombre LIKE  '%" . $info . "%' AND m.institucion1 = i.idInst OR i.nombre LIKE  '%" . $info . "%' AND m.institucion2 = i.idInst");
			}	
if(mysql_num_rows($resultados)==0){		
		$resultados = mysql_query("SELECT * FROM movimiento m INNER JOIN sectoruniversitario i WHERE i.nombre LIKE  '%" . $info . "%' AND m.idSectorOrigen = i.idSector OR i.nombre LIKE  '%" . $info . "%' AND m.idSectorDestino = i.idSector LIMIT $inicio, $registros ");
		$resul= mysql_query("SELECT idRmov FROM movimiento m INNER JOIN sectoruniversitario i WHERE i.nombre LIKE  '%" . $info . "%' AND m.idSectorOrigen = i.idSector OR i.nombre LIKE  '%" . $info . "%' AND m.idSectorDestino = i.idSector");
			}
if(mysql_num_rows($resultados)==0){		
$resultados = mysql_query("SELECT * FROM movimiento m INNER JOIN usuarios i WHERE i.userName LIKE  '%" . $info . "%' AND m.idUsuario = i.idUsuarios LIMIT $inicio, $registros ");
$resul= mysql_query("SELECT * FROM movimiento m INNER JOIN usuarios i WHERE i.userName LIKE  '%" . $info . "%' AND m.idUsuario = i.idUsuarios ");
			}
 }
 
 
 /*************************************************************************************************************************************************/

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
echo"<table width='60%' class='CSS_Table_Example' align='center' border='3px' cellpadding='2px' bordercolor='#009D9D' cellspacing='2px'>";
echo"<tr><td> Usuario</td><td> N°remito </td><td>Año</td><td>Fecha</td><td>Origen</td><td> Destino</td><td>Estado</td>";	
echo"<td>Operaciones</td></tr>";
   }
$i=0;
while($r=mysql_fetch_array($resultados)) {
//Variable solo lectura
$i=$i + 1;
/******************************************************************/
$idusuario=$r["idUsuario"];
		$query =mysql_query("SELECT * FROM usuarios where idUsuarios='".$idusuario."'");
	 	while ($row=mysql_fetch_array($query))    
			{
			$nombreUsuario=$row['userName'];
		    $institucionUsuario=$row['idInstu'];
			$sectorUsuario=$row['idSec'];
			}
		$query =mysql_query("SELECT * FROM sectoruniversitario where idSector='".$sectorUsuario."'");
		while ($row=mysql_fetch_array($query))    
			{
			$sectorUsuario=$row['nombre'];
			}
		$query =mysql_query("SELECT * FROM instu where idInst='".$institucionUsuario."'");
		while ($row=mysql_fetch_array($query))    
			{
			$institucionUsuario=$row['nombre'];
			}
			
/**************************************************************/		
		
$idI=$r["institucion1"];
		$query =mysql_query("SELECT nombre FROM instu where idInst='$idI'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$nombreInstitucion=$row['nombre'];
		
			} 
$idI2=$r["institucion2"];
		$query =mysql_query("SELECT * FROM instu where idInst='$idI2'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$nombreInstitucion2=$row['nombre'];
			
		
			} 
$ids1=$r["idSectorOrigen"];
		$query =mysql_query("SELECT nombre FROM sectoruniversitario where idSector='$ids1'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$sector1=$row['nombre'];
		
			} 
$ids2=$r["idSectorDestino"];
		$query =mysql_query("SELECT nombre FROM sectoruniversitario where idSector='$ids2'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$sector2=$row['nombre'];
		
			} 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
echo"<tr>";
     echo "<td>".$nombreUsuario." </td>";
	echo "<td>".$r["remito"]."</td>"; 
	echo "<td>".$r["anio"]." </td>"; 
	$fecha=$r["fecha"];
	$fechas=explode("-", $fecha);
			$anno = $fechas[0];
			$mes = $fechas[1];
			$dia = $fechas[2];
	$fecha="$dia/"."$mes/"."$anno";
 	echo "<td>".$fecha." </td>";
	echo "<td>".$nombreInstitucion."-".$sector1." </td>";
	echo "<td>".$nombreInstitucion2."-".$sector2." </td>";
	echo "<td>".$r["estador"]." </td>";
	/***************************************************************************************************/
	$sql = mysql_query("SELECT *  FROM usuarios  WHERE  userName= '".$usuario ."'" );
    while ($row=mysql_fetch_array($sql))  
   {
    $idInstu1=$row['idInstu'];
	$idSec1=$row['idSec'];
    }
	
	if( ($idI2==$idInstu1) && ($idSec1==$ids2) && (in_array('Modificación movimiento', $oper)) ){
      ?>
	 
	<td><input type="image" value="modificar" onclick="this.form.action='modificadom.php'; this.form.submit()"src="../images/edit.png" title="Modificar Movimiento"/></td>
	<?php }
	
	else { ?>
	 
	<td><input type="image" value="ver" onclick="this.form.action='modificadom.php'; this.form.submit()"src="../images/text_page.png" title="Ver Movimiento"/></td>
	
	<?php }

	
	echo"<input type='hidden' name='idremito' value='".$r["idRmov"]."'/>";
	echo"<input type='hidden' name='nombreUsuario' value='$nombreUsuario'/>";
	echo"<input type='hidden' name='sectorUsuario' value='$sectorUsuario'/>";
	echo"<input type='hidden' name='institucionUsuario' value='$institucionUsuario'/>";
	echo"<input type='hidden' name='remito' value='".$r["remito"]."'/>";
	echo"<input type='hidden' name='year'  value='".$r["anio"]."'/>";
	$fecha=$r["fecha"];
	$fechas=explode("-", $fecha);
			$anno = $fechas[0];
			$mes = $fechas[1];
			$dia = $fechas[2];
	$fecha="$dia/"."$mes/"."$anno";
    echo"<input type='hidden' name='estado'  value='".$r["estador"]."'/>";
	
	echo"<input type='hidden' name='datepicker' value='".$fecha."'/>";
	echo"<input type='hidden' name='nivel2List' value='".$r["institucion1"]."'/>";
	echo"<input type='hidden' name='nivel2List1' value='".$r["institucion2"]."'/>";
	echo"<input type='hidden' name='nivel3List' value='".$r["idSectorOrigen"]."'/>";
	echo"<input type='hidden' name='nivel3List1' value='".$r["idSectorDestino"]."'/>";
	echo"<input type='hidden' name='observaciones' value='".$r["observacionO"]."'/>";
	echo"<input type='hidden' name='observaciones1' value='".$r["observacionD"]."'/>";
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='info' value='".$info."'/>";
	echo"<input type='hidden' name='remitob' value='".$remitob."'/>";
	echo"<input type='hidden' name='yearb' value='".$yearb."'/>";
	echo"<input type='hidden' name='fechab' value='".$fechab."'/>";
	echo"<input type='hidden' name='nivel2Listb' value='".$nivel2Listb."'/>";
	echo"<input type='hidden' name='nivel2List1b' value='".$nivel2List1b."'/>";
	echo"<input type='hidden' name='nivel3Listb' value='".$nivel3Listb."'/>";
	echo"<input type='hidden' name='nivel3List1b' value='".$nivel3List1b."'/>";
	echo"<input type='hidden' name='estadob'  value='".$r["estadob"]."'/>";
	echo"</form>";
}
echo"</table></div>";

/*********************************************************************************************************************/
/*PAGINACIO*/
	if(mysql_num_rows($resultados)==0){
	//echo"No se encuentran resultados";
	}
	else{

	echo"<p align='center'>";
	//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
	echo "<b><a href='busquedaM.php?pagina=".($pagina-1)."&info=$info&estadob=$estadob&remitob=$remitob&yearb=$yearb&nivel2Listb=$nivel2Listb&nivel2List1b=$nivel2List1b&nivel3Listb=$nivel3Listb&nivel3List1b=$nivel3List1b'>< Anterior</a></b> ";   
	}
	
	
	//  muestra la cantidad de paginas... 
	for ($i=1; $i<=$total_paginas; $i++){ 
	if ($pagina == $i) { 
	//echo "<b>".$pagina."</b> "; 
	echo $pagina . " "; 
	} else { 
echo "<b><a href='busquedaM.php?pagina=$i&info=$info&estadob=$estadob&remitob=$remitob&yearb=$yearb&nivel2listb=$nivel2Listb&nivel2List1b=$nivel2List1b&nivel3Listb=$nivel3Listb&nivel3List1b=$nivel3List1b'>$i</a></b> ";
	}
 }
	 
	 
	 
	// muestra el enlace a la pagina siguiente... 
	
	if(($pagina + 1)<=$total_paginas) { 
echo " <b><a href='busquedaM.php?pagina=".($pagina+1)."&info=$info&estadob=$estadob&remitob=$remitob&yearb=$yearb&nivel2Listb=$nivel2Listb&nivel2List1b=$nivel2List1b&nivel3Listb=$nivel3Listb&nivel3List1b=$nivel3List1b'>Siguiente ></a></b>"; 
	}}
	echo"</p>";
	
	
	 ?>
<p>
  <label> <p><a href="movimiento.php">Volver a la página Movimiento</a></p></label>
</p>	 
</body>
</html>















