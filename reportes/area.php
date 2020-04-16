<?php
error_reporting(E_PARSE);
include ("../conexion/funciones.php");

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header("Location: ../principal/ingreso_sistema.php");
    exit;
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Areas</title>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Reporte: Documentos iniciados por &aacute;rea específica. </h1>
<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

 <p >&nbsp;</p>
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="iniciados.php" method="post"  name="form2" id="form2">
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Seleccionar &Aacute;rea</legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">Seleccione &aacute;rea para conocer los documentos que fueron iniciados por la misma</div></td>
      </tr>
      <tr> <td ><div><p>Institución </p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option value="0" selected="selected">seleccionar</option>		
  		<?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if ($nivel2List!=""){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if ($nivel2List==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
	}
		
		//**************************************************************************/
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if( $nombre == "UNPA UARG"){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";     
				} 
		    else echo "<option value='".$id."' >".$nombre."</option>";     
		}
	 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector</p></td>
		
		<td width="547"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
	  
	  
	   <option value="0"> Seleccione...</option>
		<?php
		$sql1="SELECT * FROM instu ";
		$ejecutar_sql1=mysql_query($sql1);
		
		while($row1=mysql_fetch_array($ejecutar_sql1))
		{
			$nombreI=$row1 ['nombre'];
			if ($nombreI=="UNPA UARG"){
			$idI==$row1 ['idInst'];
			}
			}
		$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC" ;
		$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
		{   $idIS=$row['idInstu'];
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];
			if ($idIS==$idI){//Si el id DE INSTU.idInst = a SECTORUNIVERSITARIO.idInstu
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";  }
			
			echo "<option value='".$id."' >".$nombre."</option>";
			
		}
		
	   ?>
     </select>

		</td>
         </tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
      
  </fieldset>
	<p >&nbsp;</p>
	 <td align="right"><p><label><a href="reportes.php">Volver a seleccionar reporte</a></label></p></td>
	</form >
	<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		//frmvalidator.addValidation("numeroDoc","req", "El campo número de documento es requerido");
		frmvalidator.addValidation("nivel2List","dontselect=0", "Debe seleccionar una institución ");
		frmvalidator.addValidation("nivel3List","dontselect=0", "Debe seleccionar un sector ");
	</script>

  
  </body>
</html>
