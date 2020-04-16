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
<title>modificar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Tipo de Usuario</h1>
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
$descripcionb=$_GET["descripcionb"];


//*******************************************************************************************************//

if (isset($_GET['guardar'])){
$id=$_GET['idTipo'];
$nombre = $_GET['nombre']; 
$descripcion= $_GET['descripcion'];
/*********************************************************************************************************/
function array_envia($array) { 

     $tmp = serialize($array); 
     $tmp = urlencode($tmp); 

     return $tmp; 
} 
      $query ="SELECT * FROM funciones";
	 $result = mysql_query($query);
	 while ($row=mysql_fetch_array($result))    
    {
        $funcion= $row['idFunciones'];
		if($_GET[''.$funcion.'']==on){
		
		$idFuncion= $row['idFunciones']; 
	
		$array[]=$idFuncion;
		}
      }
$array=array_envia($array); 
/**********************************************************************************************************/
 
$result=mysql_query("SELECT * FROM tipousuario  where `nombreTipo`='$nombre'");
$total = mysql_num_rows($result);
while($r=mysql_fetch_array($result)) {
$id2=$r['idTipo'];
}
if ($total!=0 and $id2!=$id){ 
 echo"<fieldset id='fs'  class='fieldset'>";
echo"<legend>Mensaje</legend>";
		echo"<p>La operación no se pudo realizar. El nombre de Tipo de usuario ya existe. Por favor ingrese otro nombre.</p>";
		echo"<p>&nbsp;</p>";
  echo"</fieldset>";	
 echo " <b><a href='modificarT.php?nombre=$nombre&descripcion=$descripcion&idTipo=$id&array=$array'>Volver a la página Modificar Tipo Usuario</a></b>";
}//fin if1
else{//else1


echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";

$id=$_GET['idTipo'];
$nombre = $_GET['nombre']; 
$descripcion= $_GET['descripcion']; 



$res = mysql_query("UPDATE `tipousuario` SET `nombreTipo` ='$nombre' , `descripcion`='$descripcion' WHERE `idTipo` = '$id' ");

	if($res)//if 1
	{
		echo"<p> El registro se ha guardado con éxito.</p>";
		echo"<p>&nbsp;</p>";
		
		
	 $r=mysql_query("DELETE FROM tipousuariofuncion WHERE idTipoUsuario='$id'");
	  
	 $query ="SELECT * FROM funciones";
	 $result = mysql_query($query);
	 while ($row=mysql_fetch_array($result))    
    {
        $funcion= $row['idFunciones'];
		if($_GET[''.$funcion.'']==on){
		
		$idFuncion= $row['idFunciones']; 
	
		$que='INSERT INTO tipousuariofuncion(`idTipoUsuario`,`idFuncion`)';
        $que.="VALUES ('$id','$idFuncion')";
		$res=mysql_query($que);
		}
    } 	
	            			
	
	}//fin del if1
	else
	{
		echo"<p>La operación no se pudo realizar. Por favor vuelva a intentarlo</p>";
		echo"<p>&nbsp;</p>";
	}
echo"</fieldset>
</form>";

}
}
//****************************************************************************************************************************//
else{
//Datos del Registro elegido para modificar

$id=$_GET['idTipo'];
$nombre = $_GET['nombre']; 
$descripcion= $_GET['descripcion'];



?>

<FORM  action="modificarT.php" method="GET" id="form1" name="form1">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>
    <input name="idTipo"  type="hidden" class="estilotextarea3" id="idTipo"  readonly value="<?php echo"$id";?>" />
    <table  width="517" class="tabla"  id="tab1" align="center">
      <tr>
        <td width="102" height="37"><p>Nombre(*) </p></td>
        <td width="403"><input name="nombre" type="text" class="estilotextarea1" id="nombre" value="<?php echo"$nombre";?>" /></td>
      </tr>
      <tr>
        <td height="53"><p>Descripci&oacute;n</p></td>
        <td><textarea name="descripcion" class="estilotextarea4" id="descripcion"><?php echo"$descripcion";?></textarea></td>
      </tr>
    </table>
  </fieldset>
	 <p>&nbsp;</p>
 <fieldset id="fs"  class="fieldset">
	
<table width="639" border='1' cellpadding='2px' cellspacing='2px' bordercolor='#009D9D' class="tabla">
        <tr>
          <td width="584"><p>Operaciones </p>
            <p>
              <input name="radiobutton" type="radio" value="radiobutton" onclick="marcar(this.form)"/>
              Seleccionar todo</p>
            <p>
              <input name="radiobutton" type="radio" value="radiobutton" onclick="desmarcar(this.form)" />
          Desseleccionar todo</p></td>
        </tr>
       
           <?php
		   
	 function array_recibe($url_array) { 
     $tmp = stripslashes($url_array); 
     $tmp = urldecode($tmp); 
     $tmp = unserialize($tmp); 

    return $tmp; 
} 
$array= $_GET['array'];
$array=array_recibe($array); 

	//funciones 	que estan en la base de datos	   
	  $resultado=mysql_query("SELECT * FROM tipousuariofuncion where `idTipoUsuario`='$id'");
	  
	  	while($row = mysql_fetch_array($resultado)){ 
         $id=$row['idFuncion'];
	     $datos[] = $row['idFuncion']; 
    
		}
	    $dat=array(); 
		$dat=$datos; 
	 //*********************************************
	$query ='SELECT * FROM funciones';
	$result = mysql_query($query);
				
   	while($row=mysql_fetch_array($result)){
	$f=$row['idFunciones'];
	if (in_array($f , $dat)) {
	      	                       
       echo" <tr><td><input type='checkbox' checked='checked' name='".$row['idFunciones']."' id='".$row['idFunciones']."'>". $row['nombreFuncion']."</td></tr>";
				             }
	   else if (in_array($f , $array)){
							 
		echo" <tr><td><input type='checkbox' checked='checked' name='".$row['idFunciones']."' id='".$row['idFunciones']."'>". $row['nombreFuncion']."</td></tr>"; 
							 
							 }	 
							 
							 
	else {
	   echo" <tr><td><input type='checkbox' name='".$row['idFunciones']."' id='".$row['idFunciones']."'>". $row['nombreFuncion']."</td></tr>";
		}	
  }   
   
    	?>
        
  </table>
 </fieldset>
	
    <p align="center">
        <label>
        <input name="guardar" type="submit" class="inputBoton"  id="Aceptar" value="Guardar "/>
      </label>
    

<!----------------------------------Datos Asociados a la Busqueda------------------------------------------------------->
<input type="hidden" name="info" value="<?php echo"$info";?>"/>
<input type="hidden" name="nombreb" value="<?php echo"$nombreb";?>"/>
<input type="hidden" name="descripcionb" value="<?php echo"$descripcionb";?>"/>

</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form1");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("nombre","req", "El campo nombre es requerido");
		frmvalidator.addValidation("nombre","maxlen=30", "La máxima longitud para el nombre es 30");
		frmvalidator.addValidation("nombre","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("descripcion","maxlen=200", "La descripción no puede superar los 200 caracteres");
	</script>
<!----------------------------------------------------------------------------------------------------------------------->
<?php
}
 echo"<p>&nbsp;</p>";
  echo " <b><a href='busquedaT.php?info=$info&nombreb=$nombreb&descripcionb=$descripcionb'>Volver a la búsqueda</a></b>";
  echo"<p>&nbsp;</p>";
  echo"<p>&nbsp;</p>";
  echo " <b><a href='tipo_usuario.php'>Volver a la página Tipo de Usuario</a></b>";
 ?>
</body>


</html>
