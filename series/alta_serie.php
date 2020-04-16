<?php
error_reporting(E_PARSE);
include ('../Conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
$nombre = $_GET['nombre']; 
$valorTiempo= $_GET['valorTiempo']; 
$tipoTiempo = $_GET['tipoTiempo'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NuevaSerieDocumental</title>
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>

<script language="javascript" type="text/javascript">
function d1(selectTag){
 if(selectTag.value == 'dias'){
document.getElementById('valorTiempo').disabled = false;
document.form1.valorTiempo.value = "";
 }
  if(selectTag.value == 'meses'){
document.getElementById('valorTiempo').disabled = false;
document.form1.valorTiempo.value = "";
 }
  if(selectTag.value == 'años'){
document.getElementById('valorTiempo').disabled = false;
document.form1.valorTiempo.value = "";
 }
  if(selectTag.value == 'permanente'){
document.getElementById('valorTiempo').disabled = true;
document.form1.valorTiempo.value = "";
 }
   if(selectTag.value == 'otro'){
document.getElementById('valorTiempo').disabled = true;
document.form1.valorTiempo.value = "";

 }
}
</script> 
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>

<body>

  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nueva Serie Documental</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
   
  <form id="form1" name="form1" method="post"  action="nueva_serie.php">
  <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
    <p>&nbsp;</p>
  <table width="552" class="tabla" align="center">
        <tr>
          <td height="25" colspan="3"><div align="left">Los campos marcados con * son obligatorios</div></td>
        </tr>
        <tr>
          <td width="121" height="34">Nombre(*)  </td>
          <td width="404"><input name="nombre" type="text" class="estilotextarea4" id="nombre" value="<?php echo "$nombre"; ?>" /></td>
          <td width="11">&nbsp;</td>
        </tr>
        <tr>
          <td height="44">Tiempo de conservaci&oacute;n(*) </td>
          <td colspan="2"><select name="tipoTiempo" id="tiempo" onchange="d1(this)">
		  <option value="0" selected="selected"> SELECCIONAR</option>
           <?php 
			 
		 if( $tipoTiempo=='dias'){
			 echo"<option value'dias' selected='selected'>dias</option>
                  <option value='meses'>meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro'>otro</option> ";
			    }
				 if( $tipoTiempo=='meses'){
			 echo"<option value'dias'>dias</option>
                  <option value='meses'  selected='selected'>meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro'>otro</option> ";
			    }
				 if( $tipoTiempo=='años'){
			 echo"<option value'dias'>dias</option>
                  <option value='meses' >meses</option>
				  <option value='años' selected='selected'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro'>otro</option> ";
			    }
				  if( $tipoTiempo=='permanente'){
			 echo"<option value'dias'>dias</option>
                  <option value='meses' >meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'  selected='selected'>permanente</option> 
				   <option value='otro'>otro</option> ";
			    }
				 if( $tipoTiempo=='otro'){
			 echo"<option value'dias'>dias</option>
                  <option value='meses' >meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro'  selected='selected'>otro</option> ";
				}
				if( $tipoTiempo==''){
			 echo"<option value'dias'>dias</option>
                  <option value='meses' >meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro'>otro</option> ";
				}
				?>
          </select>            
		  <input name="valorTiempo" type="text" id="valorTiempo" disabled="true"  value="<?php echo" $valorTiempo"; ?>" /></td>
        </tr>
        <tr>
          <td height="44">Descripci&oacute;n</td>
          <td colspan="2"><textarea   name="descripcion" cols="80"  maxlength="600" class="textarea" id="descripcion"  ><?php echo" $descripcion"; ?></textarea></td>
        </tr>
        <tr>
          <td height="44">&nbsp;</td>
          <td colspan="2"><input name="Crear" type="submit" class="inputBoton" value="Crear" />
            <label>
            <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
          </label></td>
        </tr>
  </table>
      <p>
        <label></label></p>
      <div align="center">
        <label></label>
  </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </fieldset >
  </form>
   <script type="text/javascript">
 		var frmvalidator = new Validator("form1");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("nombre","req", "El campo nombre de la serie documental es requerido");
		frmvalidator.addValidation("nombre","maxlen=100", "La máxima longitud para el nombre de serie documental es 50 caracteres");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("tipoTiempo","dontselect=0", "Seleccione un tiempo de conservación destinado a la serie documental");
	
		frmvalidator.addValidation("valorTiempo","maxlen=5", "La longitud máxima para el valor de tiempo es de 5 dígitos");
		frmvalidator.addValidation("valorTiempo","req", "El valor del tiempo de conservación no puede ser nulo");
		frmvalidator.addValidation("valorTiempo","greaterthan=0", "El valor del tiempo de conservación no puede ser cero");
		
	</script>

 <label><p><a href="series.php">Volver a la Página Series Documentales</a></p>

</body>
</html>