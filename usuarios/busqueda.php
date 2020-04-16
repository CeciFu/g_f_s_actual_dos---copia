<?php 
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
$oper=array(); 
$oper=$_SESSION["operaciones"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<script language="javascript" src="js/jquery-1.2.6.min.js"></script>
<link rel="stylesheet" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>
<body>
<div class="divTitulo" > 
  <h1>&nbsp;</h1>
  <h1>Búsqueda de Usuario	
  </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<!--*****************************Formulrio de Busqueda y boton agregar*************************-->
<p>&nbsp;</p>

 <!-- ***************************Tabla con los registross*******************************************-->
 
 <?php
//<hr />

//pide las variables para la consulta enviados por URL
$info=$_GET["info"];
//Datos de Usu
$id=$_GET["id"];
$dnib=$_GET["dnib"];
$nombreb=$_GET["nombreb"];
$apellidob=$_GET["apellidob"];
$userb=$_GET["userb"];
$passb=$_GET["passb"];
$telb=$_GET["telb"];
$mailb=$_GET["mailb"];
$estadob=$_GET["estadob"];
$idUserb=$_GET["idUserb"];
$sectorb=$_GET["sectorb"];
$institucionb=$_GET["institucionb"];
$idp=$_GET['id'];


//echo "id de usuario".$id;
//echo "id de usuario post".$idp;
?>
<!--------------------------------------Busqueda libre---------------------------------------------------->
<?php

if (isset($_POST['buscar1'])){

$info=$_POST['info'];
$nombres=explode(" ", $info);
			$palabra1 = $nombres[0];
			$palabra2 = $nombres[1];
			$palabra3 = $nombres[2];
      //echo "nombre ".$palabra1;
      //echo "apellido ".$palabra2;
	  //echo" todo ".$info;
	
			
}
?>
<!--------------------------------------Busqueda Avanzada---------------------------------------------------->
<?php 

if(isset($_POST['Buscar2'])){
$dnib=$_POST['dni'];
$id=$_POST['id'];
$nombreb=$_POST['nombreU'];
$apellidob=$_POST['apellido'];
$userb=$_POST['nombreUser'];
$passb=$_POST['pass'];
$telb=$_POST['tel'];
$mailb=$_POST['mail'];
$estadob=$_POST['estado'];
$idUserb=$_POST['selectTipo'];
$institucionb=$_POST['nivel2List'];
$sectorb=$_POST['nivel3List'];

//echo "variables dni ".$dnib."usuario ".$idUserb."sector".$sectorb."Estado".$estadob;
//echo "id de usuario con post".$id;
}

if(!empty($dnib))
		{
			
			$condicion="WHERE `dni`='$dnib'";
			
			if(!empty($nombreb))
			{
				$condicion.="and `nombre`like '%".$nombreb."%'";
			}
			else if(!empty($apellidob))
			{
				$condicion.="and `apellido`like '%".$apellidob."%'";
			}
			else if(!empty($estadob))
			{
				$condicion.="and `estado`='$estadob'";
			}
			else if(!empty($userb))
			{
				$condicion.="and `userName` like '%".$userb."%'";
			}
			else if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstu ='$institucionb'";
			}
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			else if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
			
		}//cierra if tipo usuario
					
		else if(!empty($nombreb))	
		{
			$condicion="where `nombre` like '%".$nombreb."%'";
			
			
			if(!empty($apellidob))
			{
				$condicion.="and `apellido`like '%".$apellidob."%'";
			}
			else if(!empty($estadob))
			{
				$condicion.="and `estado`='$estadob'";
			}
			else if(!empty($userb))
			{
				$condicion.="and `userName` like '%".$userb."%'";
			}
			else if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstu ='$institucionb'";
			}
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			else if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
			
		}//cierra dni
		else if(!empty($apellidob))
		{			
			
			$condicion="where`apellido`like '%".$apellidob."%'";
			
			
			if(!empty($estadob))
			{
				$condicion.=" and `estado`='$estadob'";
			}
			if(!empty($userb))
			{
				$condicion.=" and `userName` like '%".$userb."%'";
			}
			else if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstu ='$institucionb'";
			}
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
		}//cierra nombre
		
		else if(!empty($estadob))
		{			
			
			$condicion="where `estado`='$estadob'";
			
			
			if(!empty($userb))
			{
				$condicion.="and `userName` like '%".$userb."%'";
			}
			else if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstu ='$institucionb'";
			}
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
		}//cierra apellido
		else if(!empty($userb))
		{			
			
			$condicion="where `userName` like '%".$userb."%'";
			
			
			if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstu ='$institucionb'";
			}
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
		}//cierra estado
		//else if(!empty($sectorb))
		else if(!empty($institucionb) && $institucionb!='seleccionar' )
		{			
						
			$condicion="where `idInstu`='$institucionb'";
			//if(!empty($idUserb))
			if($sectorb== "seleccionar" )
			{}
			else if(!empty($sectorb))
			{
				$condicion.=" and idSec ='$sectorb'";
			}
			if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
			
		}//cierra tipo usuario
		else if(!empty($sectorb) && $sectorb!='seleccionar' )
		{
			$condicion="where `idSec`='$sectorb'";
			if(!empty($idUserb))
			{
				$condicion.="and `tipoUsuario`='$idUserb'";
			}
		}
		
		else if(!empty($idUserb))
			{
				$condicion="WHERE `tipoUsuario`='$idUserb'";
			}

?>

<!-------------------------------------------------------------------------------------->

<?php
		
//La tabla solo muestra 20 registros
$registros = 6;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 
//echo " cuando esta vacio ". $pagina ;
} 
else { 
$inicio = ($pagina - 1) * $registros; 
//echo " cuando no esta vacio ". $pagina ;

}





/*********************Arma la consulta correspondientes*******************/
if(empty($info)){
$resultado = mysql_query("SELECT * FROM usuarios  $condicion  LIMIT $inicio, $registros ");
$resultados = mysql_query("SELECT idUsuarios  FROM usuarios $condicion"); 
$total_registros = mysql_num_rows($resultados);
}
else if(!empty($info)){
//primeo se busca por nombre y apellido de usuario
	//echo"primeo se busca por nombre y apellido de usuario";
	$resultado=mysql_query("SELECT usuarios.idUsuarios , usuarios.dni , usuarios.nombre , usuarios.apellido ,  usuarios.telefono , usuarios.email , usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona 
	FROM usuarios WHERE concat_ws(' ', nombre , apellido)='$info' and  usuarios.estado='Activo' LIMIT $inicio, $registros");
	$resultados=mysql_query("SELECT usuarios.idUsuarios , usuarios.dni , usuarios.nombre , usuarios.apellido ,  usuarios.telefono , usuarios.email , usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona 
	FROM usuarios WHERE concat_ws(' ', nombre , apellido)='$info' and usuarios.estado='Activo'");
	/*$resultado=mysql_query("SELECT usuarios.idUsuarios , usuarios.dni , usuarios.nombre , usuarios.apellido , usuarios.telefono , usuarios.email , 
	usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona FROM usuarios 
	INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec 
	WHERE concat_ws(' ', nombre , apellido)='$info' LIMIT $inicio, $registros");
	$resultados = mysql_query("SELECT usuarios.idUsuarios ,usuarios.dni , usuarios.nombre , usuarios.apellido , usuarios.telefono , usuarios.email , 
	usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona FROM usuarios 
	INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec 
	WHERE concat_ws(' ', nombre, apellido)='$info' "); 	
	
	//$resultado=mysql_query("SELECT CONCAT_WS(  ' ', nombre, apellido ) FROM usuarios WHERE CONCAT_WS(  ' ', nombre, apellido ) =  '$info'");
	*/
	$canti = mysql_num_rows($resultados);
	$c = mysql_num_rows($resultado);
	//echo "cantidad ".$canti;
	//echo " cantidad otra  ".$c;
	$total_registros = mysql_num_rows($resultados);
	
	if($canti==0)//busca por apellido y nombre
	{
		$resultado=mysql_query("SELECT usuarios.idUsuarios , usuarios.dni , usuarios.nombre , usuarios.apellido ,  usuarios.telefono , usuarios.email , usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona 
	FROM usuarios WHERE concat_ws(' ', apellido , nombre)='$info' and usuarios.estado='Activo' LIMIT $inicio, $registros");
	$resultados=mysql_query("SELECT usuarios.idUsuarios , usuarios.dni , usuarios.nombre , usuarios.apellido ,  usuarios.telefono , usuarios.email , usuarios.userName , usuarios.password , usuarios.estado , usuarios.tipoUsuario , usuarios.idSec , usuarios.idInstu , concat_ws(' ', nombre, apellido) as persona 
	FROM usuarios WHERE concat_ws(' ', apellido , nombre)='$info' and usuarios.estado='Activo' ");
		$canti2 = mysql_num_rows($resultados);
		$total_registros = mysql_num_rows($resultados);
	
	
	 if($canti==0 && $canti2==0)
		{
		//echo "busqueda normal";
		$resultado=mysql_query("SELECT usuarios .* FROM usuarios INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec WHERE usuarios.estado='Activo' and (tipousuario.nombreTipo LIKE  '%".$info."%' or sectoruniversitario.nombre LIKE  '%".$info."%' or usuarios.nombre like '%".$info."%' or usuarios.apellido like '%".$info."%' or usuarios.dni='$info' or usuarios.telefono='$info' and usuarios.telefono!=0 or usuarios.email like '%".$info."%' and usuarios.email !='' or usuarios.userName like '%".$info."%' or usuarios.estado like '%".$info."%') LIMIT $inicio, $registros");
		$resultados = mysql_query("SELECT usuarios .* FROM usuarios INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec WHERE usuarios.estado='Activo' and(tipousuario.nombreTipo LIKE  '%".$info."%' or sectoruniversitario.nombre LIKE  '%".$info."%' or usuarios.nombre like '%".$info."%' or usuarios.apellido like '%".$info."%' or usuarios.dni='$info' or usuarios.telefono='$info' and usuarios.telefono!=0 or usuarios.email like '%".$info."%' and usuarios.email !='' or usuarios.userName like '%".$info."%' or usuarios.estado like '%".$info."%')"); 
		$total_registros = mysql_num_rows($resultados);
		$canti3=mysql_num_rows($resultados);//busca por estado
		$c=mysql_num_rows($resultado);
	
		}
     if($canti==0 && $canti2==0 && $canti3==0)//busca por estado
	  {
	  	//echo "busca por estado";
	  	$resultado=mysql_query("SELECT usuarios .* FROM usuarios INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec WHERE usuarios.estado like '%".$info."%' LIMIT $inicio, $registros");
		$resultados = mysql_query("SELECT usuarios .* FROM usuarios INNER JOIN tipousuario ON usuarios.tipoUsuario = tipousuario.idTipo INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = usuarios.idSec WHERE usuarios.estado like '%".$info."%'"); 
		$total_registros = mysql_num_rows($resultados);
		$canti3=mysql_num_rows($resultados);//busca por estado
		$c=mysql_num_rows($resultado);	
	  }
	  	  
	}

}//fin else



$total_paginas = ceil($total_registros / $registros); 



	/***********************************Muesta la tabla con los resultados *********************************/
	
	if(mysql_num_rows($resultado)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>";
		echo"<p>No se encontraron resultados</p>";
		echo"<p>&nbsp;
		</fieldset>
		</form>
		</p>";
		 
		
	}
	else
	{
echo"<p>&nbsp;</p><div class='CSS_Table_Example' align= 'center''>";
	echo"<table width='60%' class='CSS_Table_Example' align='center' border='3px' cellspacing='2px'>";
			echo"<tr height='20px'><td>DNI</td><td>Nombre</td><td>Apellido</td><td>Tipo Usuario</td><td>NombreUsuario</td><td>Sector</td>
			<td>Teléfono</td> <td>Email</td><td>Estado</td><td colspan='2'>Operaciones</td></tr>";
	}
	$i=0;
	$cantidad=0;
	while($r=mysql_fetch_array($resultado)) {
	//Variable solo lectura
	$cantidad=$cantidad+1;
	$i=$i+1; 
	echo "<FORM id=$i  action='#' method='GET'>";
	echo"<tr>";
	
		
			$id=$r["tipoUsuario"];
			$id2=$r["idSec"];
			$query =mysql_query("SELECT * FROM tipousuario where idTipo='$id'");
		
			while ($row=mysql_fetch_array($query))    
				{
				$TipoUsuario=$row['nombreTipo'];
				
				}
			$query =mysql_query("SELECT *  FROM sectoruniversitario where idSector='$id2'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$sector=$row['nombre'];
					
				}		
		
			echo"<td>".$r["dni"]."</td>";
			echo "<td>".$r["nombre"]."</td>"; 
			echo "<td>".$r["apellido"]." </td>"; 
			echo "<td>$TipoUsuario</td>"; 
			echo "<td>".$r["userName"]." </td>";
			echo "<td>$sector </td>"; 
			 if($r["telefono"]!=0) 
			{ 
			echo"<td>".$r["telefono"]." </td>";
			}
			else
			{
				echo"<td></td>";
			}			
			echo "<td>".$r["email"]." </td>";
			echo "<td>".$r["estado"]."</td>";?>
			<?php 
				if(in_array('Modificación Usuario', $oper))
			{ ?>
		
			<td><input type="image" value="modificar" onclick="this.form.action='modificar_usuario.php'; this.form.submit()"src="../images/edit.png" title="Modificar Usuario"/></td>
		
			<?php }		
			if(in_array('Baja Usuario', $oper))
			{ ?>
			<td><input type="image" onclick="if (confirm('¿Desea confirmar la eliminación?')){ 
	  	this.form.action='eliminar.php'; this.form.submit()}return false " value="eliminar" src="../images/delete.png" name="eliminar" title="Eliminar Usuario" > 
		</td>
			<?php
			}
		
			
			
			echo"<input type='hidden' name='info' value='".$info."' />";
			echo"<input type='hidden' name='id' value=".$r["idUsuarios"]." />";
			echo"<input type='hidden' name='dni' value=".$r["dni"]." />";
			echo"<input type='hidden' name='nombre' value=".$r["nombre"]." />";
			echo"<input type='hidden' name='apellido' value=".$r["apellido"]." />";
			echo"<input type='hidden' name='user' value=".$r["userName"]." />";
			echo"<input type='hidden' name='pass' value=".$r["password"]." />";
			echo"<input type='hidden' name='tel' value=".$r["telefono"]." />";
			echo"<input type='hidden' name='mail' value=".$r["email"]." />";
			echo"<input type='hidden' name='estado' value=".$r["estado"]." />";
			echo"<input type='hidden' name='tipo' value=".$r["tipoUsuario"]." />";
			echo"<input type='hidden' name='sector' value=".$r["idSec"]." />";
			echo"<input type='hidden' name='institucion' value=".$r["idInstu"]." />";
	//		echo"<input type='hidden' name='tipo' value='$TipoUsuario' />";
		//	echo"<input type='hidden' name='sector' value='$sector' />";
			echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
		
		/**********************************Datos de Busqueda**************************************************************/
			echo"<input type='hidden' name='info' value='".$info."'/>";
			
			echo"<input type='hidden' name='idb' value='".$idb."' ></input>";
			echo"<input type='hidden' name='dnib' value='".$dnib."' />";
			echo"<input type='hidden' name='nombreb' value='".$nombreb."' />";
			echo"<input type='hidden' name='apellidob' value='".$apellidob."' />";
			echo"<input type='hidden' name='userb' value='".$userb."' />";
			echo"<input type='hidden' name='passb' value='".$passb."' />";
			echo"<input type='hidden' name='telb' value='".$telb."'/>";
			echo"<input type='hidden' name='mailb' value='".$mailb."' />";
			echo"<input type='hidden' name='estadob' value='".$estadob."' />";
			echo"<input type='hidden' name='idUserb' value='".$idUserb."' />";
			echo"<input type='hidden' name='sectorb' value='".$sectorb."' />";
			echo"<input type='hidden' name='institucionb' value='".$institucionb."' />";
		//echo "variables ultimo dni ".$dnib."usuario ".$idUserb."sector".$sectorb."Estado".$estadob;
			echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
	echo"</tr>";
	echo "</form>";
	}


	echo"</table></div>";
	/*********************************************************************************************************************/
	echo"<p align='center'>";
	/*PAGINACIO*/
	echo"<p align='center'>";
	/*PAGINACIO*/
	if (empty($resultado)){
	//echo"No se encuentran resultados";
	}
	else{//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) { 
	echo "<a href='busqueda.php?pagina=".($pagina-1)."&info=$info&institucion=$institucionb&idb=idb&dnib=$dnib&nombreb=$nombreb&apellidob=$apellidob&userb=$userb&passb=$passb&telb=$telb&mailb=$mailb&estadob=$estadob&idUserb=$idUserb&sectorb=$sectorb&institucionb=$institucionb'>< Anterior </a> "; 
	}
	//  muestra la cantidad de paginas... 
	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='busqueda.php?pagina=$i&info=$info&institucion=$institucionb&idb=idb&dnib=$dnib&nombreb=$nombreb&apellidob=$apellidob&userb=$userb&passb=$passb&telb=$telb&mailb=$mailb&estadob=$estadob&idUserb=$idUserb&sectorb=$sectorb&institucionb=$institucionb'>$i</a> "; 
				}
    	}
	
	}//fin if si registros en menor q 10
	 

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='busqueda.php?pagina=".($pagina+1)."&info=$info&institucion=$institucionb&idb=idb&dnib=$dnib&nombreb=$nombreb&apellidob=$apellidob&userb=$userb&passb=$passb&telb=$telb&mailb=$mailb&estadob=$estadob&idUserb=$idUserb&sectorb=$sectorb&institucionb=$institucionb'>Siguiente ></a>"; 
}}
echo"</p>";
	 ?>
	 
  <label><p><a href="usuario.php">Volver a la página de Usuario</a></p></label>
</body>
</html>