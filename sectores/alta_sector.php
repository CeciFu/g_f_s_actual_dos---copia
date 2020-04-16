<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ingreso_sistema.php');
    exit;
}

$nombre = $_GET['nombre']; 
$institucion= $_GET['institucion']; 
$descripcion = $_GET['descripcion'];

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AltaSectorUniv</title>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
</head>

<body>

  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Sector Universitario</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
  <form id="form1" name="form1" method="post" action="nuevo_sector.php">
  
  <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
        <table  width="517"  id="tab1" align="center" class="tabla">
          <tr>
            <td height="19" colspan="2"><div align="left">Los campos marcados con * son obligatorios</div></td>
          </tr>
          <tr>
            <td height="39">Nombre (*) </td>
            <td width="352"><input name="nombre" type="text" class="estilotextarea1" id="nombre" value="<?php echo"$nombre"; ?>" /></td>
          </tr>
          <tr>
            <td height="33">Institución perteneciente (*) </td>
            <td><font size="4">
            <select name="institucion" id="institucion">
              <option value="0">seleccionar</option>
              <?php
				$query ='SELECT * FROM instu';
				$result = mysql_query($query);
				?>
              <?php    
   					 while ($row=mysql_fetch_array($result)  )    
    				{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
        	if ($institucion==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
    				}    
    				?>
            </select>
</font></td>
          </tr>
        
        <tr> 
          <td width="153" height="64"><p>Descripción</p></td>
          <td><TextArea   name="des" maxlength="600"  class="textarea" id="des" ><?php echo" $descripcion"; ?></textarea></td>
        </tr>
        <tr>
          <td height="64">&nbsp;</td>
          <td><input name="Crear" type="submit" class="inputBoton" id="Enviar" value="Crear" />
          <input name="Limpiar"  type="reset" class="inputBoton" value="Limpiar" /></td>
        </tr>
      </table>
      <p align="center">
        <label></label>
		
        <label></label>
      </p>
      <label></label>
    </fieldset>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form1");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("nombre","req", "El campo nombre de sector universitario es requerido");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombre","maxlen=50", "La máxima longitud para el nombre de sector universitario es 50 caracteres");
		frmvalidator.addValidation("institucion","dontselect=0", "Seleccione una institución de pertenecia del sector");
		frmvalidator.addValidation("des","maxlen=600", "La longitud máxima de la descripción de un sector es de 500 caracteres");
	</script>
	<p>&nbsp;</p>
   <label><b><a href="sector.php">Volver a la página Sector Universitario</a></b></label>
  </body>
</html>