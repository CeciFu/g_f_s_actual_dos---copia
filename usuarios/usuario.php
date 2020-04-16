<?php 
error_reporting(E_PARSE);
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>

</head>
<body>
<div class="divTitulo"> 
  <h1>&nbsp;</h1>
  <h1>Usuario	
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


<?php
		session_start();
			$oper=array(); 
			$oper=$_SESSION["operaciones"];

	if(in_array('Alta usuario', $oper))
	{  
	 echo"</p>
	<form id='form1' name='form1' method='post' action=''>
  	<fieldset id='fs'  class='fieldset'>
	<legend >Nuevo</legend>
  <table width='400' class='tabla'>
    <tr>
      <td width='350' height='56'><p>Agregar nuevo Usuario</P> </td>
      <td width='50'><a href='Alta_Usuario.php' > <img src='../images/agregar.png'></a></td>
    </tr>
	<tr> 
	<td>
	
	</td>
	</tr>
  </table>
 </fieldset>
 </form>
 <p >&nbsp;</p>"
 
 	;
	}
?>
	
<!------Busquedas----------------------------------------------------------------------------------->	 
  
<form action="busqueda.php" method="post"  name="form2" id="form2">
<fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Búsqueda Libre </legend>
<table width="693" class="tabla">
<tr><td colspan="2" align="justify"><div class="ayuda">La siguiente es una búsqueda libre, Ud. puede ingresar cualquier dato relacionado a un usuario, por ejemplo: nombre,apellido, nombre de usuario, sector universitario en el que trabaja, etc.</div></td></tr>
      <tr>
        <td width="201"><p>Ingrese dato para la búsqueda </p></td>
        <td width="480"><label>
          <input name="info" type="text" class="estilotextarea1" id="info" ></input>
        </label></td>
	</tr>
	<tr>
<td align="center" colspan="2"></td>
</tr>
  </table>
  
<input type="submit" name="buscar1" value="Buscar" id="2" class="inputBoton" />
<input type="reset" name="Reset" value="Limpiar" class="inputBoton"></input>

 </fieldset>
</form>      
 <form action="busqueda.php" method="post"  name="form3" id="form3">  

 
	<p >&nbsp;</p>
<fieldset id="fs"  class="fieldset">
	<!------Busqueda avanzada----------------------------------------------------------------------------------->
<legend >Búsqueda Avanzada</legend>
<table  id="tab1"  class="tabla">
<tr><td colspan="3"><div class="ayuda">Ingrese en cada opción el dato correspondiente, este tipo de búsqueda permite que ingrese uno o más datos. </div></td></tr>

<tr>

<tr>
<td>DNI</td><td><input type="text" name="dni" id="dni" class="estilotextarea1"></input></td>
</tr>
<tr>
<td >Apellido </td><td ><input type="text" name="apellido" id="apellido" class="estilotextarea1"></input></td>
</tr>
<tr>
<td >Nombre</td>
<td><input type="text" name="nombre" id="nombre" class="estilotextarea1"></input></td>
</tr>
 <tr> <td ><div><p>Institución </p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option value="0" selected="selected">seleccionar</option>		
  		<?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if ($nombre=='UNPA UARG'){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
	
		
		
	 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector</p></td>
		
		<td width="547"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
	  
	 <option value="0"> Seleccionar</option>
		<?php
		/*$sql1="SELECT * FROM instu ";
		$ejecutar_sql1=mysql_query($sql1);
		
		while($row1=mysql_fetch_array($ejecutar_sql1))
		{
			$nombreI=$row1 ['nombre'];
			if ($nombreI=="UNPA UARG"){
			$idI==$row1 ['idInst'];
			}
		}
		*/
		$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{   
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];			
			echo "<option value='".$id."' >".$nombre."</option>";
			
		}	
	   ?>
     </select>

		</td>
         </tr>
<tr>
<td width="205">Tipo de Usuario </td>
<td width="582"><p> 
              <label></label>
              <label> 
              <select name="selectTipo">
                <option value="0" selected="selected">seleccionar</option>
                <?php
					  $query ='SELECT * FROM tipousuario';

					$result = mysql_query($query);
				?>
                <?php    
   					 while ($row=mysql_fetch_array($result) )    
    				{
        				?>
                <option value=" <?php echo $row['idTipo']; ?>" > <?php echo $row['nombreTipo']; ?> 
                </option>
                <?php
    				}    

    				?>
              </select>
              </label>
      </p></td>
</tr>
<tr>
<td >Nombre de Usuario <td><input type="text" name="nombreUser" id="nombreUser" class="estilotextarea1"></input></td>
</tr>
<tr>
<td >Estado </td><td><p> 
              <label> 
			   <font size="4"><select name="estado" id="estado">
                  <option value="Activo" selected="selected">Activo</option>
                  <option value="Inactivo" >Inactivo</option>                
                </select></font>
              </label>
              
            </p></td>
</tr>
<tr>

</tr>
<td align="left" colspan="2"><input type="submit" name="Buscar2" value="Buscar" id="2" class="inputBoton"></input>   <input type="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
</td>

</table>

  </fieldset>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Debe ingresar un dato para la búsqueda libre");
		
		
			
	</script>
	<script type="text/javascript">
 		var frmvalidator = new Validator("form3");
		
		frmvalidator.EnableMsgsTogether();
		
		
		frmvalidator.addValidation("dni","num", "El valor del campo DNI debe ser numérico");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dni","gt=0", "El campo de número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("apellido","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido");
		frmvalidator.addValidation("apellido","maxlen=50", "La máxima longitud para el apellido es 50");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombre","maxlen=50", "La máxima longitud para el nombre es 50");		
		frmvalidator.addValidation("user","maxlen=20", "La máxima longitud para el nombre de usuario es 20");
		
			
	</script>
    <h1>&nbsp;</h1>
 <!-- ***************************Tabla con los registross*******************************************-->
 </body>
</html>