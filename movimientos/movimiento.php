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
<title>Documento sin t&iacute;tulo</title>

<!--<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="jquery.form.js"></script> 
<link href="../principal/estilo.css" rel="stylesheet" type="text/css" />

-->
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>

<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<!----------------------------------------------------------------------------------!-->

<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<!----------------------------------------------------------------------------------!-->

<script language="JavaScript">
function vaciar(control)
{
  control.value='';
}
</script>
<script language="javascript" src="../principal/js/fecha.js"></script>

</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Movimiento</h1>
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
		
	if(in_array('Movimientos', $oper))
	{  
	
	echo"</p>
<form id='form1' name='form1' method='post' action=''>
  <fieldset id='fs'  class='fieldset'>
<legend >Nuevo</legend>
  <table width='400' class='tabla'>
    <tr>
      <td width='350' height='56'><p>Agregar un nuevo movimiento</P> </td>
      <td width='50'><a href='alta_movimiento.php' > <img src='../images/agregar.png'></a></td>
    </tr>
  </table>
 </fieldset>
 </form>
 <p >&nbsp;</p>"
 
 ;
}
 ?>  
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="busquedaM.php" method="post"  name="form2" id="form2">
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Búsqueda Libre </legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">La siguiente es una b&uacute;squeda libre, Ud. puede ingresar cualquier dato relacionado a un movimiento, por ejemplo: numero de Remito,a&ntilde;o, etc.</div></td>
      </tr>
      <tr>
        <td width="200"><p>Ingrese dato para la búsqueda </p></td>
        <td width="478"><label>
          <input name="info" type="text" class="estilotextarea1" id="info" />
        </label></td>
	</tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
       <label>
       <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
       </label>
  </fieldset>
	<p >&nbsp;</p>
	</form >
	<form action="busquedaM.php" method="post"  name="form3" id="form3">
<fieldset id="fs"  class="fieldset">


<!------Busqueda avanzada----------------------------------------------------------------------------------->
<legend >Búsqueda Avanzada</legend>
<table  width="689"  id="tab1"  class="tabla">
   
        <tr>
          <td width="677" height="39"><div class="ayuda">Ingrese en cada opci&oacute;n el dato correspondiente, este tipo de b&uacute;squeda permite que ingrese uno o m&aacute;s datos.</div></td>
        </tr>
  </table>
     
       <table width="690" class="tabla">
         <tr>
           <td width="113">N&deg; Remito </td>
           <td width="134"><label>
             <input name="remito" type="text" class="estilotextarea2" id="remito"/>
           </label></td>
           <td colspan="2"> A&ntilde;o
             <label>
               <select name="year"  id="year" >
                 <option value="0" >Seleccione...</option>
                 <?php 
		 $y=date('Y');
		 for ($i= date(' Y'); $i>=1900; $i--) {
				
					 
        			if($i ==$year){
					 
					echo "<option value='$year' selected=selected >$year</option>";
					}			
                	
					else if($i ==$y){
					
					echo "<option value='$y' selected=selected >$y</option>";
					
					}
					
					else{
					echo "<option value='$i' >$i</option>";
					}
					
							
   					
					
				}
				
  				 ?>
               </select>
             </label></td>
         </tr>
         <tr>
           <td>Fecha</td>
           <td colspan="3"><input name="datepicker" placeholder="dd/mm/aaaa" type="text" class="estilotextarea2" id="datepicker" title="al ingresar el valor de la fecha, el sistema le proporcionar&aacute; autom&aacute;ticamente el formato dd-mm-aaaa, impidi&eacute;ndole ingresar otro formato" onfocus="vaciar(this)" onblur="esFechaValida(this);" value="<?php echo"$fecha";?>">
           <span class="Estilo1">Ej. 28/12/1982 </span></td>
         </tr>

         <tr>
           <td>Instituci&oacute;n Origen</td>
           <td><label>
             <select name="nivel2List" id="nivel2List" onchange="return nivel2OnChange()">
               <option  value="0" selected="selected">Seleccione...</option>
               <?php
		//$con=new conexion();
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		//**************************************************************************
		if ($_POST[Agregar]){
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
		
		//**************************************************************************
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			
			echo "<option value='".$id."' >".$nombre."</option>";     
			
		}
	
	 ?>
             </select>
           </label></td>
           <td width="182">Sector Origen</td>
           <td width="241"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
               <?php
	  
		
		//**************************************************************************
		if ($_POST[Agregar]){
		echo "<option >Seleccione...</option>";
		
		$sql="SELECT idSector,nombre FROM sectorUniversitario where idInstu= '". $nivel2List ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];
			if ($nivel3List==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
		
		}
		else {?>
               <option value="0">---</option>
               <?php	}
	   ?>
           </select></td>
         </tr>
         <tr>
           <td>Instituci&oacute;n Destino</td>
           <td><select name="nivel2List1" id="nivel2List1" onchange="return nivel2OnChange1()">
             <option selected="selected" value="0" >Seleccione...</option>
             <?php
		
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		//**************************************************************************
		if ($_POST[Agregar]){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if ($nivel2List1==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
		
		}
		
		//**************************************************************************
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			
			echo "<option value='".$id."' >".$nombre."</option>";     
			
		}
		
	 ?>
           </select></td>
           <td>Sector Destino</td>
           <td><select name="nivel3List1" id="nivel3List1" onchange="return nivel3OnChange()">
             <?php
	  
		
		//**************************************************************************
		if ($_POST[Agregar]){
		echo "<option >Seleccione...</option>";
		
		$sql="SELECT idSector,nombre FROM sectorUniversitario where idInstu= '". $nivel2List ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];
			if ($nivel3List==$id){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
		
		}
		else {?>
             <option value="0">---</option>
             <?php	}
	   ?>
           </select></td>
         </tr>
         <tr>
           <td>Estado</td>
           <td><select name="estado" id="estado">
		      <option value="0"selected="selected" >Seleccione...</option>
             <option value="Confirmado" >Confirmado</option>
			 <option value="No confirmado">No confirmado</option>
             </select></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
       </table>
       <p>&nbsp;</p>
       <label>
       <input name="buscar2" type="submit" class="inputBoton" value="Buscar" />
       </label>
  
     
       <label>
       <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
       </label>
</fieldset>
</form>
<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Debe ingresar un dato para la búsqueda libre");
	</script>
	<script type="text/javascript">
 		var frmvalidator = new Validator("form3");
	
		frmvalidator.addValidation("remito","numeric", "Solo se permiten números en el remito");
		frmvalidator.addValidation("remito","gt=0", "El campo de número de remito no puede tomar valores negativos");
		frmvalidator.addValidation("datepicker","fecha", "El texto ingresado no es una fecha o no tiene el formato correspondiente dd/mm/aaaa");

	</script>

</p>
</body>
</html>
<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Ingrese un dato para la busqueda");
		
	</script>