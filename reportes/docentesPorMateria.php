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
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Reporte: Docentes designados por Asignatura. </h1>
 <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

 
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="docentesdesignados.php" method="post"  name="docentes_materia" >
<p >&nbsp;</p>
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Ingresar datos</legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">Ingrese la asignatura correspondiente</div></td>
      </tr>
     
	   <tr>
        <td width="200"><p>Asignatura</p></td>
         <td ><label > 
            <input name="info" type="text" class="estilotextarea1" ></input>
            </label></td>
	  </tr>	
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
      
  </fieldset>
	<p >&nbsp;</p>
	 <td align="right"><p><label><a href="reportes.php">Volver a seleccionar reporte</a>
	</form >
	<script type="text/javascript">
 		var frmvalidator = new Validator("docentes_materia");
		
		frmvalidator.EnableMsgsTogether();
		
		//frmvalidator.addValidation("numeroDoc","req", "El campo número de documento es requerido");
	
		//frmvalidator.addValidation("materia","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre de la asignatura");
		frmvalidator.addValidation("info","maxlen=100", "La longitud máxima del nombre de una materia es de 100 caracteres");
		frmvalidator.addValidation("info","req", "El campo asignatura es obligatorio");
	
	</script>

  
  </body>
</html>
