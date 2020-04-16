<?php
//require('conexion.php');
	$con=new conexion();
//$sql="SELECT idSector,nombre FROM sectoruniversitario where idInstu=$busqueda";
	$ejecutar_sql=mysql_query($sql);
	   
	if (mysql_num_rows($ejecutar_sql)!=0){
		echo "<option >Seleccione...</option>";
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];
			echo "<option value='".$id."' >".$nombre."</option>";      
		}
	}
	else
	{
		echo "<option >---</option>";
	}

?>
