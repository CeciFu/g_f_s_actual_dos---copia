<?php 
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
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
<title>Documento sin t&iacute;tulo</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<script language='javascript' src="../principal/popcalendar.js"></script> 
<link rel="stylesheet" media="screen" type="text/css" href="../principal/table_reportes.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<script language="JavaScript">
function vaciar(control)
{
  control.value='';
}
</script>
</head>
<body>
<div class="divTitulo"> 
  <h1>&nbsp;</h1>
  <h1>Listado de reportes</h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<form id='form1' name='form1' method='post' action=''>
  	<fieldset id='fs'  class='fieldset'>
	<legend >Documentos</legend>
  <table width='100%' class='CSS_Table_Reportes' align="center">
  	<tr >		
	 <td   align="justify">Documentos iniciados por un &aacute;rea específica
	<a href="area.php"><img name="reporte Área" onclick="this.form.action='area.php'; this.form.submit()" src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)" /  align="right"></a></td>
	<td  align="justify">Documentos iniciados por una fecha específica
	<a href="fechaEspecifica.php"  ><img name="reporte mes"  onclick="this.form.action='fechaEspecifica.php'; this.form.submit()" src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)" align="right"/></a></td>
	</tr>
	<tr>
	<td width='50%'  align="justify">Documentos creados por a&ntilde;o
	<a href="ingresadosXAnio.php"><img name="reporte año"  onclick="this.form.action='ingresadosXAnio.php'; this.form.submit()" src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)" align="right"/></a></td>
	<td width='50%'  align="justify">Documentos ingresados al archivo por a&ntilde;o
	<a href="ingresadosArchivo.php"><img name="reporte consultas"  src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)"  align="right"/></a></td>
	</tr>
	
	</table>
 </fieldset>
&nbsp; 

	&nbsp;
<fieldset id='fs'  class='fieldset'>

<legend >Movimientos</legend>
<table  class='CSS_Table_Reportes' >
  	<tr align="center">	
	<td width='50%'  align="justify">Historial de Movimientos <a href="historialmovimientos.php">
	<img name="movimientos"  onclick="this.form.action='historialmovimientos.php'; this.form.submit()" src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)" align="right"	/></a></td>
	</tr>
</table>
 </fieldset>
 &nbsp;
<fieldset id='fs'  class='fieldset'>

<legend >Tiempo de conservaci&oacute;n</legend>
<table  class='CSS_Table_Reportes' >
  	<tr align="center">	
	<td width='50%'  align="justify">Tiempo de conservaci&oacute;n <a href="">
	<img name="tiempo de conservacion"  onclick="this.form.action='tiempodeconservacion.php'; this.form.submit()" src="../images/logoReporte.jpg" onmouseover="mostrar(this)" onmouseout="ocultar(this)" align="right" title="En construcción"/></a></td>
	</tr>
</table>
 </fieldset>
 </form>
</body>
</html>
