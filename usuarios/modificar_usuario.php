<?php
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>

<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>modificar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Usuario </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
 
<?php
//Datos asociados a la busqueda
$info=$_GET["info"];
$id=$_GET["id"];
$dnib= $_GET['dnib']; 
$nombreb = $_GET['nombreb']; 
$apellidob = $_GET['apellidob'];
$telb = $_GET['telb']; 
$mailb = $_GET['mailb']; 
$userb = $_GET['userb']; 
$passb = $_GET['passb'];
$claveb = md5($passb);
$estadob=$_GET['estadob'];
$idUserb=$_GET['idUserb'];
$sectorb= $_GET['sectorb'];//falta sector
$institucionb=$_GET['institucionb'];
$pagina = $_GET['pagina'];

if (isset($_GET['guardar'])){
$db= new conexion();



echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";

$id=$_GET['id'];
$dni= $_GET['dni']; 
$nombre = $_GET['nombre']; 
$apellido = $_GET['apellido'];
$tel = $_GET['tel']; 
$mail = $_GET['mail']; 
$user = $_GET['user']; 
$password = $_GET['contra'];
$clave = md5($password);
$estado=$_GET['estado'];
$tipo=$_GET['tipo'];
$sector= $_GET['nivel3List'];
$institucion= $_GET['nivel2List'];

$pagina = $_GET['pagina'];
if(empty($password))
{
	$res = mysql_query("UPDATE `usuarios` SET `email`='$mail' , `telefono`='$tel' , `idInstu`='$institucion', `estado`='$estado' , `tipoUsuario`='$tipo' , `idSec`='$sector'   WHERE `usuarios`.`idUsuarios` = '$id' ");

	if($res)
	{
		echo"<p>El registro se ha guardado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>La operación no se pudo realizar, por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
	}
}
else
{
$res = mysql_query("UPDATE `usuarios` SET `password`='$clave' , `email`='$mail' , `telefono`='$tel' , `idInstu`='$institucion' , `estado`='$estado' , `tipoUsuario`='$tipo' , `idSec`='$sector'   WHERE `usuarios`.`idUsuarios` = '$id' ");

	if($res)
	{
		echo"<p>El registro se ha guardado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>La operación no se pudo realizar, por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
	}

}
echo"</fieldset>
</form>";




/*Datos asociados a la busqueda
$id=$_GET["id"];
$info=$_GET["info"];
$dnib= $_GET['dnib']; 
$nombreb = $_GET['nombreb']; 
$apellidob = $_GET['apellidob'];
$telb = $_GET['telb']; 
$mailb = $_GET['mailb']; 
$userb = $_GET['userb']; 
$passb = $_GET['passb'];
$claveb = md5($passb);
$estadob=$_GET['estadob'];
$idUserb=$_GET['idUserb'];
$sectorb= $_GET['sectorb'];//falta sector
$pagina = $_GET['pagina'];
echo "dni q esta ".$dnib;
//echo "dni q ingresa el usuario".$dni;
//echo "usuario ".$user;
echo "variables en guardar dni ".$dnib."usuario ".$idUserb."sector".$sectorb."Estado".$estadob;*/
}//fin guardar
else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$dni= $_GET['dni']; 
$pagina= $_GET['pagina'];
$nombre = $_GET['nombre']; 
$apellido = $_GET['apellido'];
$tel = $_GET['tel']; 
$mail = $_GET['mail']; 
$user = $_GET['user']; 
$password = $_GET['contra'];
$clave = md5($password);
$estado=$_GET['estado'];
$tipo=$_GET['tipo'];
$sector=$_GET['sector'];//falta sector
$institucion=$_GET['institucion'];//falta sector
$copiaDni=$dni;

//echo"id cargar".$id;





?>
<FORM  action="modificar_usuario.php" method="GET" id="modificar">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>




    <input name="id"  type="hidden" class="estilotextarea3" id="id"  readonly value="<?php echo $id;?>" />
	      <table  width="517"  id="tab1">
		  <tr>
		  <td width="170" height="53" ><p>DNI </p></td>
          <td width="335"><input name="dni" type="text" class="estilotextarea1" id="dni"  disabled="false" value="<?php echo $dni;?>" /></td>
		  </tr>
		  <tr>
		<td height="53"><p>Apellido </p></td>
          <td>
		   <?php 
		  $query ="SELECT * FROM usuarios where idUsuarios='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{?>
						<input name="apellido" type="text" class="estilotextarea1" disabled="false" value="<?php echo $row['apellido'];?>"/>
					<?php }
		  
			//		  <input name="nombre" id="nombre" type="text" class="estilotextarea1" value="<?php echo $nombre;?//" />

		  ?>
		  </td>
		</tr>
           <tr> 
          <td height="53"><p>Nombre </p></td>
           <td>
		  <?php 
		  $query ="SELECT * FROM usuarios where idUsuarios='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{?>
						<input name="nombre" type="text" class="estilotextarea1" disabled="false" value="<?php echo $row['nombre'];?>"/>
					<?php }
		  
			//		  <input name="nombre" id="nombre" type="text" class="estilotextarea1" value="<?php echo $nombre;?//" />

		  ?>

		  </td>
        </tr>
		</table>		
		<hr/>
		<table width="603" class="tabla"  id="tab2">
		 
		<tr>
		<td width="171" height="53"><p>Nombre de Usuario </p></td>
           <td width="420">
		  <?php 
		  $query ="SELECT * FROM usuarios where idUsuarios='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{?>
						<input name="user" type="text" class="estilotextarea1" disabled="false" value="<?php echo $row['userName'];?>"/>
					<?php 
					}		  
		  
		  ?>
		  
		  </td>
		</tr>
		<tr>
		<td height="53"><p>Contraseña </p></td>
          <td><input name="contra" type="password" class="estilotextarea1" id="contra"  >
		  </td>
		  </tr>		 
		<tr>
		<td ><p>Tipo De Usuario</p></td><td><p> 
              <label></label>
              <label> 
             <select name="tipo">
               
                <?php
				$querys ="SELECT tipoUsuario FROM usuarios where idUsuarios='$id'";

					$results = mysql_query($querys);
				   
   					 while ($rows=mysql_fetch_array($results))    
    				{
						$tipo=$rows['tipoUsuario'];
					}
		  
					  $query = "SELECT * FROM `tipousuario`";

					$result =mysql_query($query);
				    
   					 while ($row=mysql_fetch_array($result) )    
    				{
						if($row['idTipo']==$tipo)
						{
							
        				?>
						<option value=" entra"  selected="selected"> entra </option> 
                		<option value=" <?php echo $row['idTipo']; ?> "  selected="selected"> <?php echo $row['nombreTipo']; ?> 
                		</option>
                <?php
						}
						else
						{ ?>
						<option value=" <?php echo $row['idTipo']; ?> " > <?php echo $row['nombreTipo']; ?> 
                		</option>
						
				<?php 		
						}//fin else	
    				} //fin while   
    				?>
              </select>
              </label>
            </p></td>
		
		</tr>
		<tr> <td ><div><p>Institución</p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option >seleccionar</option>		
  		<?php
		
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		
		
		/**************************************************************************/
		if (mysql_num_rows($ejecutar_sql)!=0)
		{
		
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$idI=$row ['idInst'];
				$nombre=$row ['nombre'];
				if($idI==$institucion)
				{
					echo "<option value='".$idI."' selected='selected '>".$nombre."</option>";     
				}
				else
				{
					echo "<option value='".$idI."' >".$nombre."</option>";     
				}
			}
		}
	 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector</p></td>
		<td>
		<select name='nivel3List' id='nivel3List' onChange='return nivel3OnChange()'>
	<?php
	  
		//**************************************************************************
		
		
		if ($institucion==0){
		
				echo "<select name='nivel3List' id='nivel3List' onChange='return nivel3OnChange()'>";
		$sql="SELECT * FROM sectoruniversitario where idInstu= '". $institucion ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idS=$row ['idSector'];
			$nombre=$row ['nombre'];
			if ($sector==$idS){
			echo "<option value='".$idS."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$idS."' >".$nombre."</option>";}
			
		}
		
		}
		else{
				$sql="SELECT * FROM sectoruniversitario where idInstu= '". $institucion ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idS=$row ['idSector'];
			$nombre=$row ['nombre'];
			if ($sector==$idS){
			echo "<option value='".$idS."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$idS."' >".$nombre."</option>";}
			
		}
		?>
		

	  	<option value=0>seleccionar</option>
		</select>
		<?php 
		}
		?>
	   
	

		</td>
        </tr>
		<tr> 
          <td height="46"><p>Estado</p></td>
          <td><font size="4">
		  
		         <select name="estado" id="estado">
                 <?php if( $estado==Inactivo){
			 echo"<option value'Activo' >Activo</option>
                <option value='Inactivo' selected='selected'>Inactivo</option>";
			    }
				else{
				 echo "<option value='Activo' selected='selected'>Activo</option>
                     <option value='Inactivo' >Inactivo</option>";
			
				}
				?>
                 </select></font></td>
        </tr>
  </table>		
     	 <hr/>
		<table width="594"  id="tab3">
		<tr>
		<td width="172" height="53"><p>Teléfono </p></td>
          <td width="410">
		 <?php
		 if($tel!=0)
		 {
		 	
			echo" <input name='tel' id='tel' type='text' class='estilotextarea1' value='$tel' />";
		 
		 }
		 else
		 {
		 		echo" <input name='tel' id='tel' type='text' class='estilotextarea1' value='' />";
		 
		 }		 
		 ?>
		
		  </td>
		</tr>
		<tr>
		<td height="53"><p>Email </p></td>
          <td>
		   <?php
		 if($mail!="/")
		 {
		 	
			echo" <input name='mail' id='mail' type='text' class='estilotextarea1' value='$mail'/>";
		 
		 }
		 else
		 {
		 	echo" <input name='mail' id='mail' type='text' class='estilotextarea1' value=''/>";
		 }		 
		 ?>
		 
		  </td>
		
		</tr>
		
      </table>
    <p align="center">
        <label>
        <input type="submit" name="guardar" value="Guardar"  id="Aceptar" class="inputBoton"/>
      	</label></p>
    


</fieldset>
<!----------------------------------Datos Asociados a la Busqueda------------------------------------------------------->




<input type="hidden" name="info" value="<?php echo"$info";?>"/>
<input type="hidden" name="id" value="<?php echo"$id";?>"/>

<input type="hidden" name="dnib" value="<?php echo"$dnib";?>" />
<input type="hidden" name="nombreb" value="<?php echo"$nombreb";?>" />
<input type="hidden" name="apellidob" value="<?php echo"$apellidob";?>" />
<input type="hidden" name="userb" value="<?php echo"$userb";?>" />
<input type="hidden" name="passb" value="<?php echo"$passb";?>" />
<input type="hidden" name="telb" value="<?php echo"$telb";?>"/>
<input type="hidden" name="mailb" value="<?php echo"$mailb";?>" />
<input type="hidden" name="estadob" value="<?php echo"$estadob";?>" />
<input type="hidden" name="idUserb" value="<?php echo"$idUserb";?>" />
<input type="hidden" name="sectorb" value="<?php echo"$sectorb";?>" />
<input type="hidden" name="institucionb" value="<?php echo"$institucionb";?>" />
<input type="hidden" name="pagina" value="<?php echo"$pagina";?>"/>
<?php //echo "variables en modificar ultimo dni ".$dnib."usuario ".$idUserb."sector".$sectorb."Estado".$estadob;?>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("modificar");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("dni","req", "El campo de documento es obligatorio");
		frmvalidator.addValidation("dni","num", "El valor del campo documento debe ser numérico");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("apellido","req", "El campo de apellido es obligatorio");
		frmvalidator.addValidation("apellido","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido");
		frmvalidator.addValidation("apellido","maxlen=50", "La máxima longitud para el apellido es 50");
		frmvalidator.addValidation("nombre","req", "El campo de nombre es obligatorio");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombre","maxlen=50", "La máxima longitud para el nombre es 50");		
		frmvalidator.addValidation("user","req", "El nombre de usuario está vacío.");
		frmvalidator.addValidation("user","maxlen=20", "La máxima longitud para el nombre de usuario es 20");
		frmvalidator.addValidation("sector","dontselect=0", "Debe seleccionar un sector");
		frmvalidator.addValidation("tipo","dontselect=0", "Debe seleccionar un tipo de usuario");
		frmvalidator.addValidation("tel","num", "El valor del campo telefono debe ser numérico");

		frmvalidator.addValidation("tel","gt=0", "El campo de número de teléfono no puede tomar valores negativos");
		frmvalidator.addValidation("tel","maxlen=50", "La máxima longitud para el telefono es 50");		
		frmvalidator.addValidation("mail","email", "La dirección de email no es correcta");
		

		
	</script>
	
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
  echo"<p>&nbsp</p>";
  echo "<p><a href='busqueda.php?pagina=$pagina&id=$id&info=$info&dnib=$dnib&nombreb=$nombreb&apellidob=$apellidob&userb=$userb&passb=$passb&telb=$telb&mailb=$mailb&estadob=$estadob&idUserb=$idUserb&sectorb=$sectorb&institucion=$institucion'>Volver a la búsqueda</a></p>";
  echo"<p>&nbsp</p>";
  echo"<p><a href='usuario.php?info=$info'>Volver a la página usuario</a></p>";
 ?>
</body>


</html>