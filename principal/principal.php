<?php
//include ("../conexion/seguridad.php");
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
 ?>
 
<html>
<head>
<title>Menú principal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="icon" type="image/png" href="../images/favicon.ico"   />
</head>

<frameset rows="*" cols="270,*" col=*>
  <frame src="menu.php" noresize  name="izqda">
  <frame src="info_system.php" name="dcha" noresize >
</frameset>
<noframes>
<body background="#D6EBD6">
Su navegador no soporta frames.<a href="http://www.microsoft.com">Pulse Aquí</a>, para ir a la página de Microsoft y descargar un nuevo navegador
</body>

</noframes>
<noframe>
No soporta Frame
</noframe>

<body>

</body>
</html>
