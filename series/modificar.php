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

</script>

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
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>modificar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Serie Documental </h1>
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
$tipoTiempob=$_GET["tipoTiempob"];
$valorTiempob=$_GET["valorTiempo"];
//numero de pagina
$pagina = $_GET["pagina"];




if (isset($_GET['guardar'])){
echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";

$id=$_GET['id'];
$nombre = $_GET['nombre']; 
$tipoTiempo= $_GET['tipoTiempo']; 
$valorTiempo = $_GET['valorTiempo'];
$descripcion = $_GET['descripcion'];
if($valorTiempo=="" or $tipoTiempo=="permanente" or $tipoTiempo=="otro"){
$valorTiempo=0;
}

$res = mysql_query("UPDATE `gfs`.`seriedocumental` SET `nombre` ='$nombre' , `valorTiempo`='$valorTiempo' ,  `tipoTiempo`='$tipoTiempo',`descripcion`='$descripcion' WHERE `idserie` = '$id' ");

	if($res)
	{
		echo"<p>El registro se ha guardado con éxito</p>";
		echo"<p>&nbsp;</p>";
		echo"</fieldset>";
	
	}
	else
	{
		echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo</p>";
		
        $result=mysql_query("SELECT * FROM seriedocumental where `nombre`='$nombre'");
        $total = mysql_num_rows($result);
		while($r=mysql_fetch_array($result)) {
        $id2=$r['idSerie'];
        }
            if ($total!=0 && $id2!=$id){
			echo"<p>Ya existe una Serie Documental con ese nombre, ingrese un nombre diferente.</p>";
			
         echo"<p>&nbsp;</p>";	
         echo"</fieldset>";
        echo " <a href='modficar.php?id=$id&nombre=$nombre&tipoTiempo=$tipoTiempo&valorTiempo=$valorTiempo'></a>";
			}
    
echo"</form>";
	}


}

else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$nombre = $_GET['nombre']; 
$valorTiempo= $_GET['valorTiempo']; 
$tipoTiempo = $_GET['tipoTiempo']; 
$descripcion = $_GET['descripcion']; 
$pagina = $_GET["pagina"];

?>

<FORM  action="modificar.php" method="GET" id="form1" name="form1">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>
    <input name="id"  type="hidden" class="estilotextarea3" id="id"  readonly value="<?php echo"$id";?>" />
	
    <table width="651" class="tabla" align="center">
      <tr>
        <td width="129" height="34">nombre (*) </td>
        <td colspan="2"><input name="nombre" type="text" class="estilotextarea4" id="nombre" value="<?php echo"$nombre";?>" /></td>
      </tr>
      <tr>
        <td>Tiempo de conservacion(*) </td>
        <td width="154"><select name="tipoTiempo" id="tipoTiempo" onchange="d1(this)">
		 <option value="0" selected="selected">seleccionar</option>
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
				   <option value='otro' selected='selected'>otro</option> ";
				}
				   if( $tipoTiempo==''){
			 echo"<option value'dias'>dias</option>
                  <option value='meses' >meses</option>
				  <option value='años'>años</option>
				  <option value='permanente'>permanente</option> 
				   <option value='otro' >otro</option> ";
				}
			    
				?>
        </select></td>
        <td width="352"><input name="valorTiempo" type="text" id="valorTiempo"  value="<?php echo"$valorTiempo";?>" ></td>
      </tr>
      <tr>
        <td>Descripci&oacute;n</td>
        <td colspan="2"><textarea   name="descripcion" cols="80"  maxlength="600" class="textarea" id="descripcion"  ><?php echo" $descripcion"; ?></textarea></td>
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
<input type="hidden" name="tipoTiempob" value="<?php echo"$tipoTiempob";?>"/>
<input type="hidden" name="valorTiempob" value="<?php echo"$valorTiempob";?>"/>
<input type="hidden" name="pagina" value="<?php echo"$pagina";?>"/>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form1");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("nombre","req", "El campo nombre de serie docmental es requerido");
		frmvalidator.addValidation("nombre","maxlen=100", "La máxima longitud para el nombre de serie documental es 50 caracteres");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("tipoTiempo","dontselect=0", "Seleccione un tiempo destinado al serie documental");
	    
	</script>
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
 echo"<p>&nbsp;</p>";
  echo " <p><a href='busqueda.php?pagina=$pagina&info=$info&nombreb=$nombreb&tipoTiempob=$tipoTiempob&valorTiempob=$valorTiempob'>Volver a la búsqueda</a></p>";
  echo"<p>&nbsp;</p>";
  echo " <p><a href='series.php'>Volver a la página de Series Documentales</a></p>";
 ?>
</body>


</html>



</html>