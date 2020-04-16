<?php
error_reporting(E_PARSE);
include ("../conexion/funciones.php");

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header("Location: ../principal/ingreso_sistema.php");
    exit;
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Areas</title>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Reporte: Tiempo de conservaci&oacute;n</h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

 <p >&nbsp;</p>
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="reporteTiempo.php" method="post"  name="form2" id="form2">
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Seleccionar opci&oacute;n</legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">Seleccione una opci&oacute;n para conocer los vencimientos</div></td>
      </tr>
      <tr> <td ><div><p>Opciones</p></div></td>
		<td><select name="nivel2List" id="nivel2List">
		  <option value="0" selected="selected">seleccionar</option>
		  <option value="1" >D&iacute;a de la fecha</option>
  		  <option value="2" >Este mes</option>		
  		  <option value="3" >Este a&ntilde;o</option>
       </select>

		</td>
         </tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
      
  </fieldset>
	<p >&nbsp;</p>
	 <td align="right"><p><label><a href="reportes.php">Volver a seleccionar reporte</a></label></p></td>
	</form >
	<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		//frmvalidator.addValidation("numeroDoc","req", "El campo número de documento es requerido");
		frmvalidator.addValidation("nivel2List","dontselect=0", "Debe seleccionar una opción");
		

  
  </body>
</html>
