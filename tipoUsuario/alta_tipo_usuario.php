<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ingreso_sistema.php');
    exit;
}

$nombre = $_GET['nombre']; 
$descripcion = $_GET['descripcion'];

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>AltaTipoUsuario</title>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
<script language="javascript" src="../movimientos/jquery-1.11.2.min.js"></script>
<script language="javascript" src="../movimientos/jquery-ui.js"></script>
<script language="javascript" src="control funciones.js"></script>
<script type="text/javascript">
function marcar(obj) { 
    elem=obj.elements; 
    for (i=0;i<elem.length;i++) 
        if (elem[i].type=="checkbox") 
            elem[i].checked=true; 
}
function desmarcar(obj) { 
    elem=obj.elements; 
    for (i=0;i<elem.length;i++) 
        if (elem[i].type=="checkbox") 
            elem[i].checked=false; 
}
</script>
</head>

<body>
<div id="Layer1"> 
  <div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Tipo de Usuario</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
  <form id="form1" name="form1" method="post" action="nuevo_tipo.php">
    <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
      <table  width="517" align="center" class="tabla"  id="tab1">
        
        <tr>
          <td height="19" colspan="2">Los campos marcados con * son obligatorios</td>
        </tr>
        <tr> 
          <td width="102" height="37"> <p>Nombre (*) </p></td>
          <td width="403"><input name="nombre" type="text" class="estilotextarea1" id="nombre" value="<?php echo"$nombre"; ?>" /></td>
        </tr>
        <tr> 
          <td height="53"><p>Descripci&oacute;n</p></td>
          <td><textarea name="descripcion" class="estilotextarea4" id="descripcion"> <?php echo"$descripcion"; ?></textarea></td>
        </tr>
      </table>
    </fieldset>
	<p>&nbsp;</p>
	<fieldset id="fs"  class="fieldset">
	  <table width="648" height="161" border='1' cellpadding='2px' cellspacing='2px' bordercolor='#009D9D' class="tabla">
        <tr>
           <td width="91" height="155"><p>Operaciones </p>
            <p><input name="radiobutton" type="radio" value="radiobutton" onclick="marcar(this.form)"/>Seleccionar todo</p>
          <p><input name="radiobutton" type="radio" value="radiobutton" onclick="desmarcar(this.form)" />Desseleccionar todo</p>          </td>
        </tr>
		 
        <?php function array_recibe($url_array) { 
                 $tmp = stripslashes($url_array); 
                 $tmp = urldecode($tmp); 
                 $tmp = unserialize($tmp); 

                   return $tmp; 
                    } 
               $array= $_GET['array'];
               $array=array_recibe($array); 
		   
		  
				$query ='SELECT * FROM funciones ORDER BY  `funciones`.`idFunciones` ASC ';
				$result = mysql_query($query);
				
   	while($row=mysql_fetch_array($result)){
	$f=$row['idFunciones'];
	if (in_array($f , $array)){
							 
	echo" <tr><td><input type='checkbox' checked='checked' name='funciones' id='".$row['idFunciones']."'>". $row['nombreFuncion']."</td></tr>"; 
							 }	 
													 
	else {
	   echo" <tr><td><input type='checkbox' name='funciones' id='".$row['idFunciones']."'>". $row['nombreFuncion']."</td></tr>";
		}	
  }      
    				?>
    </table>
	</fieldset>
      <p>
        <input name="Crear" type="submit" class="inputBoton" value="Crear" />
        <label>
        <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
        </label>
    </p>
  </form>
  
  
  
  <script type="text/javascript">
 		var frmvalidator = new Validator("form1");
		
		frmvalidator.EnableMsgsTogether();
		
		
		
		frmvalidator.addValidation("nombre","req", "El campo nombre es requerido");
		frmvalidator.addValidation("nombre","maxlen=30", "La máxima longitud para el nombre es 30");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("descripcion","maxlen=200", "La descripción no puede superar los 200 caracteres");
		
		
		
	</script>
  
  <b><a href="tipo_usuario.php">Volver a la Página  Tipo de Usuario</a></b>
</body>
</html>
