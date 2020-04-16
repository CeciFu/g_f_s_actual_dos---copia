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
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
<title>modificar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Instituci&oacute;n Universitaria </h1>
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
$nombreb=$_GET["nombreb"];
$estadob=$_GET["estadob"];
$ciudadb=$_GET["ciudadb"];
$descripcionb=$_GET["descripcionb"];

/***************************************************************************************************************************************/
if (isset($_GET['guardar'])){
$id=$_GET['id'];
$nombre = $_GET['nombre']; 
$ciudad= $_GET['ciudad']; 
$estado = $_GET['estado'];
$descripcion = $_GET['descripcion'];

echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";


$res = mysql_query("UPDATE `gfs`.`instu` SET `nombre` ='$nombre' , `ciudad`='$ciudad' ,  `estado`='$estado' , `descripcion`='$descripcion' WHERE `instu`.`idInst` = '$id' ");

	if($res)
	{
		echo"<p>El registro ha sido guardado con éxito</p>";
		echo"<p>&nbsp;</p>";	
		echo"<p>&nbsp;</p>";	
         echo"</fieldset>";
	}
	else
	{
		echo"<p>La operación no se pudo realizar. Por favor vuelva a intentarlo</p>";
		
		$result=mysql_query("SELECT * FROM instu where `nombre`='$nombre'");
        $total = mysql_num_rows($result);
		while($r=mysql_fetch_array($result)) {
        $id2=$r['id'];
        }
            if ($total!=0 && $id2!=$id){
			echo"<p>Ya existe una Institución con ese nombre, ingrese otro diferente.</p>";
			

echo"</fieldset>";
echo"<p>&nbsp;</p>";
echo "<b><a href='modificar.php?id=$id&nombre=$nombre&estado=$estado&ciudad=$ciudad'&descripcion=$descripcion'>Volver a Modificar Institución</a></b>";
			}
    

	}

echo"</form>";

}
/**************************************************************************************************************************************/
else{
//Datos del Registro elegido para modificar

$id=$_GET['idInst'];
$nombre = $_GET['nombre']; 
$ciudad= $_GET['ciudad']; 
$estado = $_GET['estado']; 
$descripcion = $_GET['descripcion'];
?>

<FORM  action="modificar.php" method="GET" id="altaInstUniv" name="altaInstUniv">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>
    <input name="id"  type="hidden" class="estilotextarea3" id="id"  readonly value="<?php echo"$id";?>" />
	      <table  width="517"  id="tab1" align="center" class="tabla">
           <tr> 
          <td height="53"><p>Nombre (*) </p></td>
          <td><input name="nombre" type="text" class="estilotextarea1" id="nombre"  value="<?php echo"$nombre";?>"/></td>
        </tr>
        <tr> 
          <td height="46"><p>Estado(*)</p></td>
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
        <tr> 
          <td height="46"><p>Cuidad(*)</p></td>
          <td><input  name="ciudad"  class="estilotextarea1" id="ciudad" value="<?php echo"$ciudad";?>" /></td>
        </tr>
        <tr>
          <td height="46">Descripci&oacute;n</td>
          <td><textarea   name="descripcion" maxlength="600"  class="textarea" id="descripcion" ><?php echo" $descripcion"; ?></textarea></td>
        </tr>
      </table>
    <p align="center">
        <label>
        <input name="guardar" type="submit" class="inputBoton"  id="Aceptar" value="Guardar "/>
      </label>
    
</fieldset>
<!----------------------------------Datos Asociados a la Busqueda------------------------------------------------------->
<input type="hidden" name="info" value="<?php echo"$info";?>"/>
<input type="hidden" name="nombreb" value="<?php echo"$nombreb";?>"/>
<input type="hidden" name="ciudadb" value="<?php echo"$ciudadb";?>"/>
<input type="hidden" name="estadob" value="<?php echo"$estadob";?>"/>
<input type="hidden" name="descripcionb" value="<?php echo"$descripcionb";?>"/>
</form>
 <script type="text/javascript">
 		var frmvalidator = new Validator("altaInstUniv");
		frmvalidator.addValidation("nombre","req", "El nombre está vacío.\nPor favor, complete la información e intente de nuevo");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("ciudad","req", "El campo ciudad está vacío.\nPor favor, complete la información e intente de nuevo");
		frmvalidator.addValidation("ciudad","alpha_s", "Solo se permiten caracteres alfabéticos para la ciudad");
		frmvalidator.addValidation("descripcion", "maxlen=100", "La descripción tiene un máximo de 100 caracteres");
	</script>
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
 echo"<p>&nbsp;</p>";
  echo "<b><a href='busquedaI.php?info=$info&nombreb=$nombreb&estadob=$estadob&ciudadb=$ciudadb&descripcionb=$descripcionb'>Volver a la búsqueda</a></b>";
  echo"<p>&nbsp;</p>";
  echo " <b><a href='institucion_universitaria.php'>Volver a la página de Institución Universitaria</a></b>";
 ?>
 
</body>
</html>
