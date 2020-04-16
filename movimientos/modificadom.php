<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');


session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;}
	else{
	$usuario =$_SESSION["user"];
	$idUsu =$_SESSION["idUsuarios"];
	$sector =$_SESSION["idSec"];
	$date= date("d/m/Y");
			
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>modificar</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<link href="../principal/estilo.css" rel="stylesheet" type="text/css" />
<!----------------------------------------------------------------------------------!-->

<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<!----------------------------------------------------------------------------------!-->
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script language="JavaScript">
function vaciar(control)
{
  control.value='';
}
</script>
<script src="../principal/js/fecha.js"></script>
<style type="text/css">
<!--
.Estilo3 {
	color: #000000;
	font-size: large;
}
.Estilo4 {
	font-size: large;
	color: #006666;
}
.Estilo5 {
	font-size: 14%;
	color: #000099;
}
.Estilo7 {
	font-size: 11px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Movimiento </h1>
  <?php  
   $tipo = $_SESSION['tipo'];
  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
     ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
 
<p>
<?php
//datos de la busqueda/
$yearb =$_GET['yearb'];
$info =$_GET['info'];
$remitob=$_GET['remitob'];
$nivel2Listb=$_GET['nivel2Listb'];//istitucion1
$nivel2List1b=$_GET['nivel2List1b'];//institucion2
$nivel3Listb=$_GET['nivel3Listb'];//sectorORIGEN
$nivel3List1b=$_GET['nivel3List1b'];//sectorDESTINO
$observacionesb =$_GET['observacionesb'];
$observaciones1b =$_GET['observaciones1b'];
$estadob =$_GET['estadob'];

if (isset($_GET['Guardar'])){


echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";
$year =$_GET['year'];
$remito=$_GET['remito'];

$observaciones1=$_GET['observaciones1'];
$fechas=explode("/", $date);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fechaD="$anno"."$mes"."$dia";
//echo" informacion $info" ;
$res = mysql_query("UPDATE `gfs`.`movimiento` SET  `observacionD`='$observaciones1' ,`idUsuarioD`='$idUsu', `fechaD`='$fechaD', `estador`='Confirmado' WHERE `remito` = '$remito' and `anio`='$year' ");

	if($res)
	{
	
   	echo"<p>El registro se ha guardado con éxito.</p>";


    echo"</fieldset>";
		
	}
	else
	{
		echo"<p>No se pudo realizar la operación. Por favor vuelva a intentarlo.</p>";
		
	}
			
echo"<p>&nbsp;</p>";	
echo"</fieldset>";
echo"</form>";   

	}
else{

/**********************************************************************************************************************************/
$idremito=$_GET['idremito'];
$info=$_GET['info'];
$remito =$_GET['remito'];
$year =$_GET['year'];
$nombreUsuario =$_GET['nombreUsuario'];
$sectorUsuario =$_GET['sectorUsuario'];
$institucionUsuario =$_GET['institucionUsuario'];
$nivel2List=$_GET['nivel2List'];//istitucion1
$nivel2List1=$_GET['nivel2List1'];//institucion2
$nivel3List=$_GET['nivel3List'];//sectorORIGEN
$nivel3List1=$_GET['nivel3List1'];//sectorDESTINO
$observaciones=$_GET['observaciones'];
$observaciones1=$_GET['observaciones1'];
$fecha=$_REQUEST['datepicker'];
$estado=$_GET['estado'];
/****************************************************************************************************************************************/
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN instu WHERE idRmov='". $idremito ."' and movimiento.institucion1=instu.IdInst ");
while($r=mysql_fetch_array($resultados)) {
$io=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN instu WHERE idRmov='". $idremito ."' and movimiento.institucion2=instu.IdInst ");
while($r=mysql_fetch_array($resultados)) {
$id=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN sectoruniversitario WHERE idRmov='". $idremito ."' and 
movimiento.idSectorOrigen=sectoruniversitario.idSector ");
while($r=mysql_fetch_array($resultados)) {
$so=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN sectoruniversitario WHERE idRmov='". $idremito ."' and 
movimiento.idSectorDestino=sectoruniversitario.idSector ");
while($r=mysql_fetch_array($resultados)) {
$sd=$r["nombre"];
}
/******************************************************************************************************************************************/
/*****************************************Recibe los registros********************************************/
//echo" $info ";
?>
<form id="remito" name="remito" method="GET" action="modificadom.php">
  <fieldset id="fs"  class="fieldset">
  <legend >Datos del Remito </legend>
  <table width="750" class="tabla">
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo4">
        <?php if($estado =="Confirmado"){echo"Remito Confirmado";};?> 
        </span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="203"><span class="Estilo3">N&deg; Remito * </span></td>
      <td width="223"><label>
      <span class="Estilo3"><?php echo "$remito";?> /<?php echo" $year "; ?> </span></label></td>
      <td colspan="2"> <label>    </label></td>
    </tr>
    <tr>
      <td>Fecha*</td>
      <td><?php echo"$fecha";?>&nbsp;</td>
      <td> Fecha de Recepci&oacute;n</td>
      <td><?php echo"$date";?></td>
    </tr>
    <tr>
      <td>Usuario</td>
	  <?php
	  $sql = mysql_query("SELECT nombre, apellido  FROM usuarios  WHERE  userName= '".$nombreUsuario ."'" );
    while ($row=mysql_fetch_array($sql))  
   {
    $nombre=$row['nombre'];
	$apellido=$row['apellido'];
    }
	
	/*
	$sql = mysql_query("SELECT *  FROM sectoruniversitario  WHERE  idSector= '".$idSec."'" );
    while ($row=mysql_fetch_array($sql))  
   { 
	$nombre1=$row['nombre'];
    } */  
	  ?>
      <td><label><?php echo"$nombre $apellido";?></label>
        -    
          <label><span> <?php echo"$sectorUsuario";?></span></label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Instituci&oacute;n Origen* </td>
      <td><label> <?php echo"$io";?>   </label></td>
      <td width="171">Sector Origen* </td>
      <td width="133"><?php echo"$so";?></td>
    </tr>
    <tr>
      <td>Instituci&oacute;n Destino*</td>
      <td><?php echo"$id";?></td>
      <td>Sector Destino * </td>
      <td><?php echo"$sd";?></td>
    </tr>
    <tr>
	<?php
	
	?>
      <td height="61">Observaci&oacute;n De Origen </td>
      <td colspan="3"><textarea name="observaciones"  disabled id ='observaciones' cols="80" ><?php echo"$observaciones";?></textarea></td>
    </tr>
    <tr>
   <?php
   /*********************************************************************************************************************/
$query = mysql_query("SELECT * FROM usuarios WHERE userName ='". $usuario ."'");
while ($row=mysql_fetch_array($query)){
$idse =$row["idSec"];}
 
$query = mysql_query("SELECT * FROM sectoruniversitario WHERE idSector ='". $idse ."'");
while ($row=mysql_fetch_array($query)){
$nombreS =$row["nombre"];}
 /*********************************************************************************************************************/
   if(($estado =="Confirmado") or ($sd != $nombreS )){
   $disabled="disabled ";
   }
		?>
      <td height="61">Observaci&oacute;n de Destino </td>
      <td colspan="3"><label>
        <textarea name="observaciones1" <?php echo" $disabled"; ?>  id ='observaciones1' cols="80" ><?php echo"$observaciones1";?></textarea>
      </label></td>
	  
    </tr>
  </table>
  <div>
    <?php
$resultados = mysql_query("SELECT * FROM   registros WHERE idremito='". $idremito ."'" );
?>
<table width="398" class="tabla">
<tr>
  <td colspan="3"><span class="Estilo3">Documentos adjuntos al Remito </span></td>
  </tr>
<tr><td width="90">Documento</td><td width="43">Año</td><td width="43" >Copias</td><td width="43" >Folios</td>
<td width="249">Serie Documental </td>
</tr>
<?php
$j=1;
while($r=mysql_fetch_array($resultados)) {
	$iddocumento=$r["documento"];// id del Documento
	$doc[$j]=$r["documento"];
	$descripcion=$r["descripcion"];
	$observaciones =$r["descripcion"];
	$info1 = mysql_query("SELECT * FROM   documento WHERE idDocumento='". $iddocumento ."'"  );
	while($i=mysql_fetch_array($info1)) {
	
			$documento=$i["numDoc"];
			$document[$j]=$i["numDoc"];
			$anio=$i["anioCreacion"];
			$annio[$j]=$i["anioCreacion"];
			$copias = $i['cantidadCopias'];
			
			$folios = $i['cantidadFolios'];
			$idSerie=$i["idSerie"];
			$query5 = mysql_query("SELECT * FROM seriedocumental WHERE idserie ='". $idSerie ."'");
			while ($row5=mysql_fetch_array($query5)){
				$nombreSerie =$row5["nombre"];
				}
	
	}
	$i=$i+1; 
	
	echo "<tr>";
	
	echo "<td> $documento </td>"; 
	echo "<td>$anio</td>";
	echo "<td align='center'>$copias</td>";
	echo "<td>$folios</td>";
	echo"<td>$nombreSerie </td> ";

	echo "</tr>";

 	$j++;
}

  ?>
  </table>

  <p>&nbsp;</p>
  </fieldset>
  <p>
    <label></label>
    <label></label>
  <span class="Estilo5">
	<?php
	
	if($estado=="Confirmado") {
	
	}
	else if(($estado=="No Confirmado") or ($sd != $nombreS ) ) {
?>

<table  width="689"  id="tab1"  class="tabla">
   
<tr>
          <td width="677" height="39"><div class="ayuda">Solo podr&aacute; confirmar la recepción del Remito si su Usuario pertenece al sector de destino del mismo.</div></td>
</tr>
</table>
     
	<?php
	   }
	  else{
	?>
	</span>    
	<input name="Guardar" type="submit" class="inputBoton" id="Guardar" value="Aceptar Remito" />
	
	<?php
	}

	echo "<a href='PDFremito.php?remito=$remito&idremito=$idremito&fecha=$fecha&year=$year&nivel2List=$nivel2List&nivel2List1=$nivel2List1&nivel3List=$nivel3List&nivel3List1=$nivel3List1&observaciones=$observaciones&documento1=$document[1]&documento2=$document[2]&documento3=$document[3]&documento4=$document[4]&documento5=$document[5]&documento6=$document[6]&documento7=$document[7]&documento8=$document[8]&documento9=$document[9]&documento10=$document[10]&year1=$annio[1]&year2=$annio[2]&year3=$annio[3]&year4=$annio[4]&year5=$annio[5]&year6=$annio[6]&year7=$annio[7]&year8=$annio[8]&year9=$annio[9]&year10=$annio[10]&doc1=$doc[1]&doc2=$doc[2]&doc3=$doc[3]&doc4=$doc[4]&doc5=$doc[5]&doc6=$doc[6]&doc7=$doc[7]&doc8=$doc[8]&doc9=$doc[9]&doc10=$doc[10]' target='_blank' ><input name='PDF' type='button' class='inputBoton' id='Imprimir' value='Imprimir' /></a>";
	?>
	
  </p>
<p>&nbsp;</p>
<?php
     echo"<input type='hidden' name='remito' value='".$remito."'/>";
	echo"<input type='hidden' name='year' value='".$year."'/>";

    echo"<input type='hidden' name='remitob' value='".$remitob."'/>";
	echo"<input type='hidden' name='yearb' value='".$yearb."'/>";
    echo"<input type='hidden' name='info' value='".$info."'/>";
	echo"<input type='hidden' name='fechab' value='".$fechab."'/>";
	echo"<input type='hidden' name='nivel2Listb' value='".$nivel2Listb."'/>";
	echo"<input type='hidden' name='nivel2List1b' value='".$nivel2List1b."'/>";
	echo"<input type='hidden' name='nivel3Listb' value='".$nivel3Listb."'/>";
	echo"<input type='hidden' name='nivel3List1b' value='".$nivel3List1b."'/>";
	echo"<input type='hidden' name='estadob' value='".$estadob."'/>";
	?>	
</form>

<?php
/*********************************************************************************************************/
}

echo"<b><a href='busquedaM.php?info=$info&estadob=$estadob&remitob=$remitob&yearb=$yearb&nivel2Listb=$nivel2Listb&nivel2List1b=$nivel2List1b&nivel3Listb=$nivel3Listb&nivel3List1b=$nivel3List1b'>Volver a la búsqueda</a></b>";
echo"<p>&nbsp</p>";
echo "<b><label><a href='movimiento.php'>Volver a la Página Movimientos</a></label></b>";
 ?>
</body>
</html>
