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
  <h1>Modificar Sector Universitario </h1>
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
$institucionb=$_GET["institucionb"];
$desb=$_GET["desb"];
$pagina = $_GET['pagina'];
/**********************************************************************************************************************************/

if (isset($_GET['guardar'])){
echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";
$id=$_GET['id'];
$nombre = $_GET['nombre']; 
$institucion= $_GET['institucion'];
$idI= $_GET['idI'];
$descripcion = $_GET['des'];
$pagina = $_GET['pagina'];

     
     $result=mysql_query("SELECT * FROM sectoruniversitario where `nombre`='$nombre' and `idInstu`='$idI'");
     $total = mysql_num_rows($result);
     while($r=mysql_fetch_array($result)){
      $id2=$r['idSector'];
      }
	   
     if ($total!=0 && $id2!=$id ){
		echo"<p> La operación no se pudo realizar. El nombre del Sector ya existe. Por favor ingresé otro nombre.</p>";
		echo"<p>&nbsp;</p>";
        echo"</fieldset>";	
        echo " <b><a href='modificar.php?info=$info&nombre=$nombre&idI=$idI&descripcion=$descripcion&id=$id'>Modificar Sector Universitario</a></b>";


                                   }//fin if1
       else{

             $res = mysql_query("UPDATE `gfs`.`sectoruniversitario` SET `nombre` ='$nombre' , `descripcion`='$descripcion' ,  `idInstu`='$idI'  WHERE `sectoruniversitario`.`idSector` = '$id' ");

	         if($res)
	          {
		     echo"<p>El registro ha sido guardado con éxito</p>";
		      echo"<p>&nbsp;</p>";	
	           }
	else
	          {
		echo"<p> La operación no se pudo realizar. Por favor vuelva a intentarlo</p>";
		

              }
echo"</fieldset>
</form>";

                  }
                  }
/***************************************************************************************************************************************/				  
				  
else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$nombre = $_GET['nombre']; 
$institucion= $_GET['institucion']; 
$descripcion = $_GET['descripcion'];
$idI= $_GET['idI'];
$pagina= $_GET['pagina'];



?>

<FORM  action="modificar.php" method="GET" id="form1" name="form1">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>
    <input name="id"  type="hidden" class="estilotextarea3" id="id"   value="<?php echo"$id";?>" />
    <table  width="517"  id="tab1" align="center" class="tabla">
      <tr>
        <td height="39">Nombre (*) </td>
        <td><input name="nombre" type="text" class="estilotextarea1" id="nombre" value="<?php echo"$nombre";?>" /></td>
      </tr>
      <tr>
        <td height="33">Institución perteneciente (*) </td>
        <td><font size="4">
          <select name="institucion" id="institucion">
            <option value="0" selected="selected">seleccionar</option>
            <?php
					  $query ='SELECT * FROM instu';

					$result =mysql_query($query);
				?>
                <?php    
   					 while ($row=mysql_fetch_array($result) )    
    				{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
        	if ($idI==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
    				} //fin while   
    				?>
          </select>
        </font></td>
      </tr>
      <tr>
        <td width="170" height="64"><p>Descripci&oacute;n</p></td>
        <td><textarea   name="des" class="textarea" maxlength="600"  id="des"  ><?php echo"$descripcion";?> </textarea></td>
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
<input type="hidden" name="institucionb" value="<?php echo"$insitucionb";?>"/>
<input type="hidden" name="idI" value="<?php echo"$idI";?>"/>
<input type="hidden" name="desb" value="<?php echo"$desb";?>"/>
<input type="hidden" name="pagina" value="<?php echo"$pagina";?>"/>
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
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
 echo"<p>&nbsp;</p>";
  echo " <b><a href='busquedaS.php?pagina=$pagina&info=$info&nombreb=$nombreb&institucionb=$institucionb'>Volver a la búsqueda</a></b>";
  echo"<p>&nbsp;</p>";
  echo " <b><a href='Sector.php'>Volver a la página de Sector Universitario</a></b>";
 ?>
</body>


</html>
