<?php
	$con=new conexion();
//require('../../conexion/funciones.php');
	$ejecutar_sql=mysql_query($sql);
	   
	if (mysql_num_rows($ejecutar_sql)!=0){
		echo "<option value='0' selected='selected'>seleccionar</option>";
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];
			echo "<option value='".$id."' >".$nombre."</option>";      
		}
	}
	else
	{
		echo "<option value='0' selected='selected'>seleccionar</option>";
	}

?>
