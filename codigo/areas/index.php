<?php
require('inc/conexion.php');
?>
<html>
<head>
<title>Selector de &aacute;reas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script src="js/funciones.js"></script>
</head>
<body>

<select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
  <option >Seleccione</option>		
  <?php
	$con=new conexion();
	$sql="SELECT idInst,nombre FROM instu";
	$ejecutar_sql=mysql_query($sql);
	if (mysql_num_rows($ejecutar_sql)!=0){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			echo "<option value='".$id."' >".$nombre."</option>";     
		}
	}
 ?>
</select>

<select name="nivel3List" id="nivel3List" onChange="return nivel3OnChange()">
  <option value=0>---</option>
</select>


<span id="advice"></span>

</body>
</html>
