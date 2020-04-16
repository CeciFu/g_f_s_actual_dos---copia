<?php
//include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FileStore Administrador</title>
<link rel="StyleSheet" media="screen" type="text/css" href="estilo.css">
</head>

<body>

  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1 align="center" im><?php  $id=$_SESSION["nombre"];echo $id;?> <!-- <?php echo $id; ?> -->ha ingresado al Sistema </h1>
  </div>
   <h1>&nbsp;</h1>
  <form id="form1" name="form1" method="post" >
  <fieldset id="fs"  class="fieldset">

   
      <table  width="719" height="106" align="center" class="tabla"  id="tab1">
        <tr> 
          <td colspan="2" align="center"><img src="../images/info.png" width="70" height="70" /></td>
        </tr>
		<tr>
		  <td colspan="2" align="center">Informaci&oacute;n del Sistema </td>
	    </tr>
		<tr> 
          <td colspan="2" align="center"><div class="info"> 

            <p align="justify">El sistema Filestore fue implementado con el objetivo de gestionar la ubicaci&oacute;n de los distintos tipos de documentos que se manejan  dentro de la Unidad Académica UNPA-UARG y mejorar la eficiencia en las tareas de b&uacute;squeda y control de documentos. </p>
            <p align="justify">El desarrollo de la aplicaci&oacute;n se realiz&oacute; dentro del marco de la asignatura Laboratorio de Desarrollo de Software de la Carrera Analista de Sistema de la UNPA-UARG.</p>
            <p></p>
          </div> </td>
        </tr>
		<tr>
		  <td width="346"  align="right"><img src="../images/Filestore.jpg" width="98" height="120" /></td>
	      <td width="361" align="left"><img src="../images/unpa.jpg" width="70" height="100" /></td>
		</tr>
    </table>
</fieldset>
  </form>



</body>
</html>

