<?php
error_reporting(E_PARSE);
//include ('../conexion/funciones.php');
?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 


<link rel="StyleSheet" media="screen" type="text/css" href="estilo.css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FileStore</title>

<style type="text/css">
<!--
.Estilo2 {color: #666666}
-->
</style>
<link rel="icon" type="image/png" href="../images/favicon.ico" />
</head>

<body>
  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
	
    <h1 align="center" im>Bienvenido a FileStore </h1>
  </div>
   <h1>&nbsp;</h1> 
   <h1>&nbsp;</h1> 
   <h1>&nbsp;</h1>
 

    <form id="form_ingreso" name="form_ingreso"   method="POST" action="../conexion/verifica.php">
      <p>&nbsp;</p>	  
      <table width="541" height="196" align="center" class="tabla">
<tr> 
<td></td>

          <td colspan="2" align="center" <?php 
		  if ($_GET["errorusuario"]=="si" || $_GET["errorusuario"]=="Inactivo" ){
		  ?> bgcolor="#FFFFCC"><span style="color:FFFFFF" ><b> <?php 
		  if ($_GET["errorusuario"]=="si") { 
		  ?> Datos incorrectos <?php 
		  } 
		  else {
		  ?> Usuario Inactivo <?php 
		  
		  } ?> </b></span>  <?php 
		  } 
		  else{ 
		  ?> bgcolor="#458989"  ><font  color="#FFFFFF" > <strong>Ingrese usuario y 
            contraseña</strong> </font> <?php }?>          </td> 
</tr>

        <tr> 
          <td width="120" rowspan="2"><img src="../images/Filestore.jpg" width="98" height="120" /></td>
          <td width="94" height="63"><p>Usuario</p></td>
		  
          <td width="185"><label> 
            <input name="usuario" type="text" class="estilotextarea2" />	
			
          </label></td>
		
          <td width="122" rowspan="2" align="center"><img src="../images/unpa.jpg" width="70" height="100" /></td>
        </tr>		
        <tr> 
          <td height="39"><p>Contrase&ntilde;a</p></td>
          <td><label> 
            <input name="password" type="password" class="estilotextarea2" />
            </label></td>
      </table>
      <div align="center">
        <input type="submit" name="Submit" value="Ingresar" class="inputBoton"/>
      </div>
      <p>
        <label></label>
      </p>
      <p align="right">&nbsp;</p>
    </form>
<div align="center">
<script type="text/javascript">
 		var frmvalidator = new Validator("form_ingreso");
		

		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("usuario","req", "El campo usuario es requerido");
		frmvalidator.addValidation("usuario","maxlen=20", "La máxima longitud para el usuario es 20 caracteres");
		frmvalidator.addValidation("password","req", "La contraseña es requerida");

	</script> 
	
	  
	  
  <span class="Estilo2">&copy; Sistema de Gesti&oacute;n de Documentos-Lab Group- Laboratorio de Desarrollo de Software -  U.N.P.A-U.A.R.G -Versión 1.0 - 2013</span></div>
</body>
</html>
