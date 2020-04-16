<?php
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ingresoSistema.php');
    exit;
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BajaSectorUniv</title>
 <script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<style type="text/css">
<!--
body {
	background-color: #D6EBD6;
}

p {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 90%;
	font-style: normal;
	font-weight: bold;
	color: #666666;  /* falta font-type */
}
h1
{
	margin:0;
	padding:0;
	font-family: "Gill Sans MT";
	font-size: 24px;
	color: #FFFFFF;
}
h2 {
	font-size: 24px;
	border-top-style: doble;
	border-right-style: doble;
	border-bottom-style: doble;
	border-left-style: doble;
	font-family: "Book Antiqua";
	color: #000000;
}
h3 {
	font-size: 24px;
	border-top-style: doble;
	border-right-style: doble;
	border-bottom-style: doble;
	border-left-style: doble;
	font-family: "Book Antiqua";
	color: #009999;
}
hr {
	color: #FFCC33;
	background-color: #FFCC66;
	height: auto;
	width: auto;
	margin: 0 auto;
	text-align: center;
	border-top-width: 1;
	border-right-width: 1;
	border-bottom-width: 1;
	border-left-width: 1;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}
.uno a {
	text-align:center;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	background-color: #CCCCCC;
	text-decoration: underline;
	color: #006633;
	line-height: normal;
	}
.estilotextarea1 {
width:300px;height:20px;border: 1px dotted #000099;
}

.estilotextarea2 {
width:130px;height:20px;border: 1px dotted #000099;
}
.estilotextarea4 {
width:300px;height:50px;border: 1px dotted #000099;
}

.divTitulo {
	background-color: #009D9D;
	border: thin solid #FFFFCC;
	height: 100px;
}
.divFinal {
	background-color: #009D9D;
	border: thin solid #FFFFCC;
	height: 100px;
}
#Layer1 {
	position:absolute;
	width:575px;
	height:651px;
	z-index:1;
	left: 5px;
	top: 6px;
	background-color: #FFFFFF;
}
#Layer2 {
	position:absolute;
	width:504px;
	height:294px;
	z-index:2;
	left: 16px;
	top: 121px;
	background-color: #FFFFCC;
}
#Layer3 {
	position:absolute;
	width:531px;
	height:350px;
	z-index:2;
	left: 551px;
	top: 142px;
	background-color: #FFFFCC;
}
-->
</style>
</head>

<body>
<div id="Layer1"> 
  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Eliminación Sector Universitario</h1>
  </div>
  <form id="form1" name="form1" method="post" action="baja_sector_univ.php">
    <p>&nbsp;</p>
    <div id="Layer2"> 
      <table  width="517"  id="tab1">
        <tr> 
          <td width="170" height="37"> <p>Identificador </p></td>
          <td width="335"> <input name="textfield" type="text" class="estilotextarea1" /></td>
        </tr>
        <tr> 
          <td height="55"> <p>Nombre </p></td>
          <td><input name="textfield2" type="text" class="estilotextarea1" /></td>
        </tr>
        <tr> 
          <td  height="46" align="center" valign="baseline"> <p align="left">Institución 
              perteneciente</p></td>
          <td><input name="textfield4" type="text" class="estilotextarea1" value=""></td>
        </tr>
        <tr> 
          <td height="46"><p>Descripción</p></td>
          <td><textarea name="textfield3" class="estilotextarea4"></textarea></td>
        </tr>
      </table>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	 <p>&nbsp;</p>
    <p><br>
    </p>
    <p align="center">&iquest;Desea continuar con la eliminación?</p>
    <p align="center"> 
      <label> 
      <input type="submit" name="Submit" value="Aceptar" />
      <input type="submit" name="Submit" value="Cancelar" />
      </label>
    </p>
  </form>
  <blockquote><a href="#" class="uno"></a> 
    <p>&nbsp;</p>
  </blockquote>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h3>&nbsp;</h3>

</body>
</html>