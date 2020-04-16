<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}

$nombre = $_GET['nombre']; 
$ciudad= $_GET['ciudad']; 
$estado = $_GET['estado'];
$descripcion = $_GET['descripcion'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AltaInsitucionUniv</title>

<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>

  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nueva Instituci&oacute;n Universitaria</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>


  <FORM  action="nueva_institucion.php" method="POST" name="altaInstUniv" id="altaInstUniv">
 <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
    
	      <table  width="515"  id="tab1" align="center" class="tabla">
   
        <tr>
          <td height="19" colspan="3"><div align="left">Los campos marcados con * son obligatorios</div></td>
          </tr>
        <tr> 
          <td width="112" height="53"><p>Nombre (*) </p></td>
          <td width="312"><input name="nombreInst" type="text" class="estilotextarea1" id="nombreInst"  value="<?php echo"$nombre";?>"/></td>
          <td width="75">&nbsp;</td>
        </tr>
        <tr> 
          <td height="46"><p>Estado(*)</p></td>
          <td colspan="2"><font size="4">
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
          <td colspan="2"><input name="ciudad" type="text" class="estilotextarea1" id="ciudad" value="<?php echo" $ciudad";?>" /></td>
        </tr>
        <tr>
          <td height="46">Descripci&oacute;n</td>
          <td colspan="2"><textarea   name="descripcion"  class="textarea" id="descripcion" ><?php echo" $descripcion"; ?></textarea></td>
        </tr>
        <tr>
          <td height="46">&nbsp;</td>
          <td colspan="2"><input  name="Crear" type="submit" class="inputBoton" value="Crear" />
            <label>
            <input name="Limpiar"  type="reset" class="inputBoton" value="Limpiar" />
          </label></td>
        </tr>
  </table>
    <p align="center">
      <label></label>
   
  </fieldset>
  </form>
 <?php

 echo" <h1>&nbsp;</h1>";
 echo " <b><a href='institucion_universitaria.php'>Volver a la página de Institución Universitaria</a></b>";
 ?>
 <script type="text/javascript">
 		var frmvalidator = new Validator("altaInstUniv");
		frmvalidator.addValidation("nombreInst","req", "El nombre está vacío.\nPor favor, complete la información e intente de nuevo");
        frmvalidator.addValidation("nombreInst","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("ciudad","req", "El campo ciudad está vacío.\nPor favor, complete la información e intente de nuevo");
		frmvalidator.addValidation("ciudad","alpha_s", "Solo se permiten caracteres alfabéticos para la ciudad");
		frmvalidator.addValidation("descripcion", "maxlen=100", "La descripción tiene un máximo de 100 caracteres");
	</script>
</body>
</html>
