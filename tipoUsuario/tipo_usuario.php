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
<title>Tipo Usuario</title>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Tipo de Usuario </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
 <!--Nuevo--Se cnsulta si el usuario tiene el permiso para poder agregar un nuevo registro---->
  <p>
<?php
		$oper=array(); 
		$oper=$_SESSION["operaciones"];
		
	if(in_array('Alta Tipo Usuario', $oper))
	{  
	
	echo"</p>
<form id='form1' name='form1' method='post' action=''>
  <fieldset id='fs'  class='fieldset'>
<legend >Nuevo</legend>
  <table width='400' class='tabla'>
    <tr>
      <td width='350' height='56'><p>Agregar nuevo Tipo de Usuario</P> </td>
      <td width='50'><a href='alta_tipo_usuario.php' ><img src='../images/agregar.png'></a></td>
    </tr>
  </table>
 </fieldset>
 </form>
 <p >&nbsp;</p>"
 
 ;
}
 ?>  
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="busquedaT.php" method="post"  name="form2" id="form2">
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Búsqueda Libre </legend>
<table width="692" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">La siguiente es una b&uacute;squeda libre, Ud. puede ingresar cualquier dato relacionado a un Tipo de Usuario, por ejemplo: Nombre  o datos relacionados a la descripci&oacute;n. </div></td>
      </tr>
      <tr>
        <td width="201"><p>Ingrese dato para la búsqueda </p></td>
        <td width="479"><label>
          <input name="info" type="text" class="estilotextarea1" id="info" />
        </label></td>
	</tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
       <label>
       <input name="Submit" type="reset" class="inputBoton" value="Limpiar" />
       </label>
  </fieldset>
	<p >&nbsp;</p>
</form>	
<form action="busquedaT.php" method="post"  name="form3" id="form3">	
<fieldset id="fs"  class="fieldset">

<!------Busqueda avanzada----------------------------------------------------------------------------------->
<legend >Búsqueda Avanzada</legend>
<table  width="688"  id="tab1"  class="tabla">
   
        <tr>
          <td height="59" colspan="2"><div class="ayuda">Ingrese en cada opci&oacute;n el dato correspondiente, este tipo de b&uacute;squeda permite que ingrese uno o m&aacute;s datos.</div></td>
        </tr>
        <tr> 
          <td width="206" height="31">Nombre </td>
          <td width="470"><input name="nombre" type="text" class="estilotextarea1" id="nombre" /></td>
        </tr>
        <tr>
          <td height="48">Descripci&oacute;n</td>
          <td><label>
            <input name="descripcion" type="text" class="estilotextarea1" id="descripcion" />
          </label></td>
        </tr>
  </table>
     <p>
       <label>
       <input name="buscar2" type="submit" class="inputBoton" value="Buscar" />
       </label>
       <label>
       <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
       </label>
  </p>
     <p align="left">&nbsp;</p>
</fieldset>
</form>
<script type="text/javascript">
        //validadcion formulario 2
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Debe ingresar un dato para la búsqueda libre");
		
		
	
	</script>
	<script type="text/javascript">
 		var frmvalidator = new Validator("form3");
		
		frmvalidator.EnableMsgsTogether();
				
		frmvalidator.addValidation("nombre","maxlen=30", "La máxima longitud para el nombre es 30");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("descripcion","maxlen=200", "La descripción no puede superar los 200 caracteres");
	</script>
  <p>
  </body>
</html>


