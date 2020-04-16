<?php
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}	

	$dni= $_GET['dni']; 
	$nombre = $_GET['nombre']; 
	$apellido = $_GET['apellido'];
	$tel = $_GET['tel']; 
	$mail = $_GET['mail']; 
	$userName = $_GET['userName']; 
	$password = $_GET['contra'];
	$clave = md5($password);
	$estado=$_GET['estado'];
	//echo "el estdo espelotudooo!!!!!".$estado;
	$tipo= $_GET['tipo'];
	$sector= $_GET['sector'];
	//echo "sectorrrr ".$sector;
	$institucion= $_GET['institucion'];
	$valor=$_GET['valor'];
	//echo "instu ".$institucion;
	//$carga=$_GET['carga'];
	//echo"cargaaaa".$carga;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AltaUsuario</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>


</head>
<body>
<div id="Layer1"> 
  <div class="divTitulo"> 
    <h1>&nbsp;</h1>	
    <h1>Nuevo Usuario </h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
  <h1>&nbsp;</h1>
  <form method="post" action="nuevo_usuario.php" name="alta_usuario">
   <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
    
      <table  width="602"  id="tab1">
         <tr><td colspan="2" align="center"><p>Los campos marcados con * son obligatorios</p></td></tr>
        <tr> 
          <td width="142" height="24"> <p>DNI (*)</p></td>
          <td width="448"><input name="dni" type="text" class="estilotextarea1" value="<?php echo"$dni"; ?>" /input></td>
        </tr>
        <tr> 
          <td height="36"><p>Apellido (*)</p></td>
          <td><input name="apellido" type="text" class="estilotextarea1" value="<?php echo"$apellido"; ?>"/input></td>
        </tr>
        <tr> 
          <td height="46"><p>Nombre (*)</p></td>
          <td><input name="nombre" type="text" class="estilotextarea1" value="<?php echo"$nombre"; ?>"/input></td>
        </tr>
    </table>
      
      <hr />
      <table width="605" class="tabla">
       
        <tr> 
          <td width="115" height="33"><p>Nombre de Usuario (*)</p></td>
          <td><label> 
            <input name="userName" type="text" class="estilotextarea1" value="<?php echo"$userName"; ?>"/input>
            </label></td>
        </tr>
        <tr> 
          <td><p>Contrase&ntilde;a (*)</p></td>
          <td><label> 
            <input name="contra" type="password" class="estilotextarea1" /input>
            </label></td>
			
        </tr>
		<tr> <td ><div><p>Institución (*)</p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option value="0" selected="selected">seleccionar</option>		
  		<?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if($valor==0)//inicial
		{
			
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$id=$row ['idInst'];
				$nombrei=$row ['nombre'];
				if ($nombrei=='UNPA UARG'){
				echo "<option value='".$id."' selected='selected' >".$nombrei."</option>";    } 
				else{
				echo "<option value='".$id."' >".$nombrei."</option>";}
				
			}
			//echo "<td>ingresa al primero</td>";
		}
		else//vuelve del error
		{
			$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$idI=$row ['idInst'];
				$nombreI=$row ['nombre'];
				if ($idI==$institucion){
				echo "<option value='".$idI."' selected='selected' >".$nombreI."</option>";    } 
				else{
				echo "<option value='".$idI."' >".$nombreI."</option>";}
				
			}
			//echo "<td>ingresa al segundo</td>";
		}
	 ?>
	</select></td>
        </tr>
        <tr> 
		 <td ><p>Sector (*)</p></td>
		
		<td width="385"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
	  
	   <option value="0"> Seleccione...</option>
		<?php
		if($valor==0)//si es la primera
		{
		
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{   
				$id=$row ['idSector'];
				$nombres=$row ['nombre'];			
				echo "<option value='".$id."' >".$nombres."</option>";
				
			}
			//echo "<td>ingresa al primero</td>";		
		}
		else//vueleve
		{
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu='". $institucion ."'  ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{  
				
				$idS=$row ['idSector'];
				$nombreS=$row ['nombre'];			
				if($idS==$sector) 
				 {
				 	echo "<option value='".$idS."' selected='selected' >".$nombreS."</option>";
				 }
				 else
				 {
				 	echo "<option value='".$id."' >".$nombreS."</option>";
				}
			}
			//echo "<td>ingresa al segundo</td>";		
		}
	   ?>
     </select>
 
	

		</td>
        </tr>
          <td><p>Tipo de usuario (*)</p></td>
          <td width="385"><p> 
              <label></label>
              <label> 
              <select name="tipo" id="tipo">
               <?php
			   if(empty($tipo))
			  		{ ?>
                	<option value="0">seleccionar</option>
				 
					<?php 
					}
				
					$query ='SELECT * FROM tipousuario';

					$result =  mysql_query($query);
									 while ($row=mysql_fetch_array($result)  )    
    				{
					if($row['idTipo']==$tipo)
						{?>
							<option value=" <?php echo $row['idTipo']; ?> "> <?php echo $row['nombreTipo']; ?>  </option>
							<?php 
						} 
						else
						{
						?>
					
        		
                		<option value=" <?php echo $row['idTipo']; ?>" selected="selected" > <?php echo $row['nombreTipo']; ?> 
                		</option>
						
                		<?php
    					}    
    				}?>
              </select>
              </label>
            </p></td>
        </tr>
        <tr> 
          <td height="26"><p>Estado (*)</p></td>
          <td><p> 
              <label>
			  <select name="estado" id="estado">
			  <option value="Activo" selected="Activo" >Activo</option>
			  
			  </select>
			 
              </label>
			
            </p></td>
			
	
        </tr>
    </table>
      <hr/>
      
	 <table width="601" class="tabla">
        <tr> 
          <td colspan="2"><p>Contacto </p></td>
        </tr>
        <tr> 
          <td width="141"><p>Teléfono fijo </p></td>
          <td width="448"><label> 
            <input name="tel" type="text" class="estilotextarea2" value="<?php echo"$tel"; ?>"/input>
            </label></td>
        </tr>
        <tr> 
          <td height="44"><p>e-mail</p></td>
          <td><label> 
            <input name="mail" type="text" class="estilotextarea1" value="<?php echo"$mail"; ?>"/input>
            </label></td>
        </tr>
    </table>
      <p align="center"> 
        <label> 
        <input type="submit" name="Enviar" value="Crear" class="inputBoton"/>
		</label>
		<label><input type="hidden" name="action" value="add" />
		<label><input type="hidden" name="carga" value="" />
		<INPUT TYPE="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
        </label>
      </p>
      <p>&nbsp;</p>
    
   
    
    
    </fieldset>
  </form>
  <script type="text/javascript">
 		var frmvalidator = new Validator("alta_usuario");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("dni","req", "El campo DNI es obligatorio");
		frmvalidator.addValidation("dni","num", "El valor del campo DNI debe ser numérico");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dni","gt=0", "El campo de número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("apellido","req", "El campo de apellido es obligatorio");
		frmvalidator.addValidation("apellido","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido");
		frmvalidator.addValidation("apellido","maxlen=50", "La máxima longitud para el apellido es 50");
		frmvalidator.addValidation("nombre","req", "El campo de nombre es obligatorio");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombre","maxlen=50", "La máxima longitud para el nombre es 50");		
		frmvalidator.addValidation("userName","req", "El nombre de usuario está vacío.");
		frmvalidator.addValidation("userName","maxlen=20", "La máxima longitud para el nombre de usuario es 20");
		frmvalidator.addValidation("contra","req", "Por favor, escriba una contraseña");
		
		frmvalidator.addValidation("nivel3List","dontselect=0", "Debe seleccionar un sector");
		frmvalidator.addValidation("tipo","dontselect=0", "Debe seleccionar un tipo de usuario");
		
		frmvalidator.addValidation("nivel2List","dontselect=0", "Debe seleccionar una institución");
		frmvalidator.addValidation("tel","num", "El valor del campo telefono debe ser numérico");
		frmvalidator.addValidation("tel","maxlen=50", "La máxima longitud para el telefono es 50");
		frmvalidator.addValidation("tel","gt=0", "El campo de número de teléfono no puede tomar valores negativos");		
		frmvalidator.addValidation("mail","email", "La dirección de email no es correcta");
		frmvalidator.addValidation("estado","dontselect=Inactivo", "No puede crear un usuario con estado inactivo");
		
	</script>
  <p>&nbsp;</p>
  <p>
    <label><a href="usuario.php">Volver a la Página Usuarios</a></label>
  </p>

</div>
</body>
</html>