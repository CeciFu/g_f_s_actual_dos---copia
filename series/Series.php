<?php
error_reporting(E_PARSE);
include ('../Conexion/funciones.php');
include ("../Conexion/conex.php");
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_Sistema.php');
    exit;
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script language="javascript" type="text/javascript">

function d1(selectTag){
 if(selectTag.value == 'dias'){
document.getElementById('valorTiempo').disabled = false;
 }
  if(selectTag.value == 'meses'){
document.getElementById('valorTiempo').disabled = false;
 }
  if(selectTag.value == 'años'){
document.getElementById('valorTiempo').disabled = false;
 }
  if(selectTag.value == 'permanente'){
document.getElementById('valorTiempo').disabled = true;
 }
  if(selectTag.value == 'otro'){
document.getElementById('valorTiempo').disabled = true;
 }
}
</script> 
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Series Documentales </h1>
<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
 <!--Nuevo--Se consulta si el usuario tiene el permiso para poder agregar un nuevo registro---->
  <p>
<?php
		$oper=array(); 
		$oper=$_SESSION["operaciones"];
		
	if(in_array('Alta Serie Documental', $oper))
	{  
	
	echo"</p>
<form id='form1' name='form1' method='post' action=''>
  <fieldset id='fs'  class='fieldset'>
<legend >Nuevo</legend>
  <table width='350' class='tabla'>
    <tr>
      <td width='300' height='56'><p>Agregar nueva Serie Documental</P> </td>
      <td width='50'><a href='alta_serie.php' ><img src='../images/agregar.png'></a></td>
    </tr>
  </table>
 </fieldset>
 </form>
 <p >&nbsp;</p>"
 
 ;
}
 ?>  
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="busqueda.php" method="post"  name="form2" id="form2">
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Búsqueda Libre </legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">La siguiente es una b&uacute;squeda libre, Ud. puede ingresar cualquier dato relacionado a una Serie Documental, por ejemplo: Nombre o datos relacionados al tiempo de conservación. </div></td>
      </tr>
      <tr>
        <td width="201"><p>Ingrese dato para la búsqueda </p></td>
        <td width="477"><label>
          <input name="info" type="text" class="estilotextarea1" id="info" />
        </label></td>
	</tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar"  id="2"/>
       
    
       <label>
       <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
       </label>
  </fieldset>
	<p >&nbsp;</p>
	</form>
	<form action="busqueda.php" method="post"  name="form3" id="form3">
<fieldset id="fs"  class="fieldset">

<!------Busqueda avanzada----------------------------------------------------------------------------------->
<legend >Búsqueda Avanzada</legend>
<table width="684" class="tabla">
  <tr>
    <td colspan="3"><div class="ayuda">Ingrese en cada opci&oacute;n el dato correspondiente, este tipo de b&uacute;squeda permite que ingrese uno o m&aacute;s datos.</div></td>
    </tr>
  <tr>
    <td width="194">Nombre</td>
    <td colspan="2"><input name="nombre" type="text" class="estilotextarea1" /></td>
  </tr>
  <tr>
    <td>Tiempo de conservación </td>
     <td width="145"><select name="tipoTiempo" id="tipoTiempo" onchange="d1(this)">
		  <option value="0" selected="selected">seleccionar</option>
            <option value="dias" >días</option>
            <option value="meses" >meses</option>
            <option value="años">años</option>
            <option value="permanente">permanente</option>
			<option value="otro">otro</option>
          </select></td>
    <td width="329"><input name="valorTiempo" type="text" id="valorTiempo"   /></td>
  </tr>
</table>
<p >
  <label>
    <input name="buscar2" type="submit" class="inputBoton"  value="Buscar"  />
    </label>
  <label>
  <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
  </label>
</p>
<p align="left">&nbsp;</p>
</fieldset>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Debe ingresar un dato para la búsqueda libre");		
	</script>
	<script type="text/javascript">
 		var frmvalidator = new Validator("form3");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
	    frmvalidator.addValidation("nombre","maxlen=50", "La máxima longitud para el nombre de serie documental es 50 caracteres");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("valorTiempo","num", "El valor para el tiempo debe ser numérico");
		frmvalidator.addValidation("valorTiempo","maxlen=5", "La longitud máxima para el valor de tiempo es de 5 dígitos");
	</script>
  <p>
  </body>
</html>
