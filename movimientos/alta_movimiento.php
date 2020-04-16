<?php
error_reporting(E_PARSE);
include ('../conexion/funciones.php');


session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;}
	else{
	$usuario =$_SESSION["user"];
	$id =$_SESSION["idUsuarios"];

}
 
 

//***********************Recibe los datos********************************************************************************//
$remito =$_GET['remito'];
$dia=$_GET['dia'];
$mes=$_GET['mes'];
$anno=$_GET['anno'];
if($dia!=""){
$fecha="$dia/"."$mes/"."$anno";
}
$valor=$_GET['valor'];//para controlar la carga de los select
$nivel2List=$_GET['nivel2List'];//istitucion1
$nivel2List1=$_GET['nivel2List1'];//institucion2
$nivel3List=$_GET['nivel3List'];//sectorORIGEN
$nivel3List1=$_GET['nivel3List1'];//sectorDESTINO

$observaciones =$_GET['observaciones'];
$documento1=$_GET['documento1'];
$year1=$_GET['year1'];
$idDoc1=$_GET['doc1'];
$documento2=$_GET['documento2'];
$year2=$_GET['year2'];
$idDoc2=$_GET['doc2'];
$documento3=$_GET['documento3'];
$year3=$_GET['year3'];
$idDoc3=$_GET['doc3'];
$documento4=$_GET['documento4'];
$year4=$_GET['year4'];
$idDoc4=$_GET['doc4'];
$documento5=$_GET['documento5'];
$year5=$_GET['year5'];
$idDoc5=$_GET['doc5'];
$documento6=$_GET['documento6'];
$year6=$_GET['year6'];
$idDoc6=$_GET['doc6'];
$documento7=$_GET['documento7'];
$year7=$_GET['year7'];
$idDoc7=$_GET['doc7'];
$documento8=$_GET['documento8'];
$year8=$_GET['year8'];
$idDoc8=$_GET['doc8'];
$documento9=$_GET['documento9'];
$year9=$_GET['year9'];
$idDoc9=$_GET['doc9'];
$documento10=$_GET['documento10'];
$year10=$_GET['year10'];
$idDoc10=$_GET['doc10'];
$me1=$_GET['me1'];
$me2=$_GET['me2'];
$me3=$_GET['me3'];
$me4=$_GET['me4'];
$me5=$_GET['me5'];
$me6=$_GET['me6'];
$me7=$_GET['me7'];
$me8=$_GET['me8'];
$me9=$_GET['me9'];
$me10=$_GET['me10'];
$copias1=$_GET['copias1'];
$copias2=$_GET['copias2'];
$copias3=$_GET['copias3'];
$copias4=$_GET['copias4'];
$copias5=$_GET['copias5'];
$copias6=$_GET['copias6'];
$copias7=$_GET['copias7'];
$copias8=$_GET['copias8'];
$copias9=$_GET['copias9'];
$copias10=$_GET['copias10'];
$folios1=$_GET['folios1'];
$folios2=$_GET['folios2'];
$folios3=$_GET['folios3'];
$folios4=$_GET['folios4'];
$folios5=$_GET['folios5'];
$folios6=$_GET['folios6'];
$folios7=$_GET['folios7'];
$folios8=$_GET['folios8'];
$folios9=$_GET['folios9'];
$folios10=$_GET['folios10'];
//*********************************************************************************************************************//
$tipo = $_SESSION['tipo'];
$consultaSector = mysql_query("SELECT idSec FROM usuarios WHERE idUsuarios = $id");
$sector = mysql_fetch_array($consultaSector);
$idSector = $sector['idSec'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Movimientos</title>
<link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
<link href="jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>

<script type="text/javascript" src="autocomplete.js"></script>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script language="javascript" src="../principal/js/fecha.js"></script>
<link href="../principal/estilo.css" rel="stylesheet" type="text/css" />
<!----------------------------------------------------------------------------------!-->

<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<!----------------------------------------------------------------------------------!-->


<style type="text/css">

.suggestions {display:none;}

.suggest-element{
margin-left:5px;
margin-top:5px;
width:350px;
cursor:pointer;
}
.suggestions {
width:350px;
height:250px;

}



.Estilo1 {color: #FF0000}
</style>
</head>
<body>
<div class="divTitulo">
  <p>&nbsp;</p>
  <h1>Nuevo Movimiento </h1>
  <?php  
  

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser);
  $tipoUsuario = $row['nombreTipo'];
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
 <input id = tipoUsuario type="hidden" value= <?php echo $tipo; ?> />
 <input id = idSectorUsuario type="hidden" value= <?php echo $idSector; ?> />
</div>

<form id="remito" name="remito" method="POST" action='nuevo.php'>
  <fieldset id="fs"  class="fieldset">
 <legend >Datos del Remito </legend>
 

 <table width="996" class="tabla">
    <tr>
     <td width="113">N&deg; Remito * </td>
     <td width="134"><label>
       <input name="remito" type="text" class="estilotextarea2" id="remito" value="<?php echo "$remito";?>"/>
     </label></td>
     <td colspan="2"> A&ntilde;o
       <label>
       <select name="year"  id="year" >
         <option value="0" selected="selected" >Seleccione...</option>
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
     <td>Fecha*</td>
     <td colspan="3"><input name="datepicker" placeholder="dd/mm/aaaa" type="text" class="estilotextarea2" id="datepicker" title="al ingresar el valor de la fecha, el sistema le proporcionar&aacute; autom&aacute;ticamente el formato dd-mm-aaaa, impidi&eacute;ndole ingresar otro formato" onfocus="vaciar(this)" onblur="esFechaValida(this);" value="<?php if(!empty($fecha))echo"$fecha"; else echo date("d/m/Y"); ?>"> 
      <span  class="">Ej. 06/09/2001</span></td>
    </tr>
   <tr>
     <td>Usuario</td>
     <td colspan="3"><label>
       <input name="usuario" type="text" class="estilotextarea2" id="usuario"  readonly value="<?php echo "$usuario";?> "/>
     </label></td>
   </tr>
   <tr>
     <td>Instituci&oacute;n Origen* </td>
     <td><label>
     <select name="nivel2List" id="nivel2List" onchange="return nivel2OnChange()">
       <option value="0" selected="selected">seleccionar</option>
       <?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if($valor==0)//inicial
		{
			
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$id=$row ['idInst'];
				$nombreIn=$row ['nombre'];
				if ($nombreIn=='UNPA UARG'){
				echo "<option value='".$id."' selected='selected' >".$nombreIn."</option>";    } 
				else{
				echo "<option value='".$id."' >".$nombreIn."</option>";}
				
			}
			
		}
		else//vuelve del error
		{
			$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$idI=$row ['idInst'];
				$nombreI=$row ['nombre'];
				if ($idI==$nivel2List){
				echo "<option value='".$idI."' selected='selected' >".$nombreI."</option>";    } 
				else{
				echo "<option value='".$idI."' >".$nombreI."</option>";}
				
			}
			
		}
	 ?>
     </select>
     </label></td>
     <td width="182">Sector Origen*      </td>
     <td width="547"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
       <option value="0"> Seleccione...</option>
       <?php
		if($valor==0)//si es la primera
		{
		
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{   
				$id=$row ['idSector'];
				$nombreSe=$row ['nombre'];			
				echo "<option value='".$id."' >".$nombreSe."</option>";
				
			}
					
		}
		else//vuelve
		{
			$sql="SELECT * FROM sectoruniversitario  WHERE idInstu='". $nivel2List ."'  ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{  
				
				$idS=$row ['idSector'];
				$nombreS=$row ['nombre'];			
				if($idS==$nivel3List) 
				 {
				 	echo "<option value='".$idS."' selected='selected' >".$nombreS."</option>";
				 }
				 else
				 {
				 	echo "<option value='".$idS."' >".$nombreS."</option>";
				}
			}
				
		}
	   ?>
     </select></td>
   </tr>
   <tr>
     <td>Instituci&oacute;n Destino*</td>
     <td><select name="nivel2List1" id="nivel2List1" onchange="return nivel2OnChange1()">
       <option value="0" selected="selected">seleccionar</option>
       <?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if($valor==0)//inicial
		{
			
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$id=$row ['idInst'];
				$nombreIn=$row ['nombre'];
				if ($nombreIn=='UNPA UARG'){
				echo "<option value='".$id."' selected='selected' >".$nombreIn."</option>";    } 
				else{
				echo "<option value='".$id."' >".$nombreIn."</option>";}
				
			}
			
		}
		else//vuelve del error
		{
			$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$idIn=$row ['idInst'];
				$nombreIn=$row ['nombre'];
				if ($idIn==$nivel2List1){
				echo "<option value='".$idIn."' selected='selected' >".$nombreIn."</option>";    } 
				else{
				echo "<option value='".$idIn."' >".$nombreIn."</option>";}
				
			}
			
		}
	 ?>
     </select></td>
     <td>Sector Destino *  </td>
     <td><select name="nivel3List1" id="nivel3List1" onchange="return nivel3OnChange()">
       <option value="0"> Seleccione...</option>
       <?php
		if($valor==0)//si es la primera
		{
		
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{   
				$id=$row ['idSector'];
				$nombre=$row ['nombre'];			
				echo "<option value='".$id."' >".$nombre."</option>";
				
			}
					
		}
		else//vueleve
		{
			$sql="SELECT * FROM sectoruniversitario  WHERE idInstu='". $nivel2List1 ."'  ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{  
				
				$idS=$row ['idSector'];
				$nombreS=$row ['nombre'];			
				if($idS==$nivel3List1) 
				 {
				 	echo "<option value='".$idS."' selected='selected' >".$nombreS."</option>";
				 }
				 else
				 {
				 	echo "<option value='".$idS."' >".$nombreS."</option>";
				}
			}
				
		}
	   ?>
     </select></td>
   </tr>
   <tr>
     <td width="300" height="61">Observaci&oacute;n De Origen </td>
     <td colspan="3"><label>
       <textarea name="observaciones" cols="80" class="estilotextarea5"  id ='observaciones' ><?php echo"$observaciones";?></textarea>
     </label></td>
   </tr>
 </table>
 
  <p>Registros del Remito</p>
  <table width="1001" class="tabla">
    <tr>
      <td width="26">&nbsp;</td>
      <td width="70">N&deg; Doc </td>
      <td width="107">a&ntilde;o</td>
      <td width="182">&nbsp;</td>
      <td width="29">&nbsp;</td>
      <td width="67">N&deg; Doc </td>
      <td width="104">a&ntilde;o</td>
      <td width="367">&nbsp; </td>
    </tr>
    <tr>
      	<td>1<span class="Estilo1"><?php echo"$me1"; ?></span></td>
      	<td>
        	<input name="documento1" type="text" class="sugerencias" id="documento1" value="<?php echo "$documento1";?>"  />
            <input name="idDoc1" class="infoDoc" type="hidden" id="idDoc1"  value="<?php echo "$idDoc1";?>" />			
          <div id="suggestions" ></div>
			
	  </td>
      	<td>
		<input type="text" class="estilotextareachico" id="anio1" name="year1" readonly="true" value="<?php echo "$year1";?>" />
</td>
        <td>&nbsp;</td>
        <td>6<span class="Estilo1"><?php echo"$me6";?></span></td>
      <td>
		  <input name="documento6" type="text" class="sugerencias" id="documento6" value="<?php echo "$documento6";?>"  />
		  <input name="idDoc6" class="infoDoc" type="hidden" id="idDoc6"  value="<?php echo "$idDoc6";?>" />
			<div id="suggestions"   ></div>
	  </td>
      <td><input type="text" class="estilotextareachico" id="anio6" name="year6" readonly="true" value="<?php echo "$year6" ;?>"/></td>
      <td>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Copias   
      <input name="copias1" type="text" class="estilotextareachico" value="<?php echo "$copias1";?>" /></td>
      <td>Folios
      <input id="folios1" name="folios1" type="text" class="estilotextareachico" value="<?php echo "$folios1";?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Copias
      <input name="copias6" type="text" class="estilotextareachico" id="copias62" value="<?php echo "$copias6";?>" /></td>
      <td>Folios
      <input  id="folios6" name="folios6" type="text" class="estilotextareachico" value="<?php echo "$folios6";?>" /></td>
      <td>&nbsp;</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td>2<span class="Estilo1"><?php echo"$me2";?></span></td>
      <td><label>
        <input name="documento2" type="text" class="sugerencias" id="documento2" value="<?php echo "$documento2";?>" />
        <input name="idDoc2" class="infoDoc" type="hidden" id="idDoc2" value="<?php echo "$idDoc2";?>" />
		<div id="suggestions2"   ></div>
      </label></td>
      <td><input type="text" class="estilotextareachico" id="anio2" name="year2" readonly="true" value="<?php echo "$year2";?>"/></td>
      <td>&nbsp;</td>
      <td>7<span class="Estilo1"><?php echo"$me7";?></span></td>
      <td>
	 	 <input name="documento7" type="text" class="sugerencias" id="documento7" value="<?php echo "$documento7";?>" />
	 	 <input name="idDoc7" class="infoDoc" type="hidden" id="idDoc7" value="<?php echo "$idDoc7";?>" />
	 
	  	<div id="suggestions7"   ></div>
	  </td>
      <td><input type="text" class="estilotextareachico" id="anio7" name="year7" readonly="true" value="<?php echo "$year7"; ?>" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p>Copias 
          <input name="copias2" type="text" class="estilotextareachico" id="copias22" value="<?php echo "$copias2";?>" />
        </p>      </td>
      <td><p>Folios 
          <input name="folios2" type="text" class="estilotextareachico" id="folios2" value="<?php echo "$folios2";?>" />
        </p>      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Copias
      <input name="copias7" type="text" class="estilotextareachico" id="copias72" value="<?php echo "$copias7";?>" /></td>
      <td>Folios
      <input name="folios7" type="text" class="estilotextareachico" id="folios7" value="<?php echo "$folios7";?>" /></td>
      <td>&nbsp;</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td>3<span class="Estilo1"><?php echo"$me3";?></span></td>
      <td><label>
        <input name="documento3" type="text" class="sugerencias" id="documento3" value="<?php echo "$documento3";?>" />
        <input name="idDoc3" class="infoDoc" type="hidden" id="idDoc3" value="<?php echo "$idDoc3";?>" />
		<div id="suggestions3"   ></div>
      </label></td>
      <td><input type="text" class="estilotextareachico" id="anio3" name="year3" readonly="true" value="<?php echo "$year3"; ?>" /></td>
      <td>&nbsp;</td>
      <td>8<span class="Estilo1"><?php echo"$me8";?></span></td>
      <td><input name="documento8" type="text" class="sugerencias" id="documento8" value="<?php echo "$documento8";?>" />
        <input name="idDoc8" class="infoDoc" type="hidden" id="idDoc8" value="<?php echo "$idDoc8";?>" />
	  <div id="suggestion8"></div>
	  </td>
      <td><input type="text" class="estilotextareachico" id="anio8" name="year8" readonly="true" value="<?php echo "$year8"; ?>" /></td>
      <td><label>
</label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Copias
      <input name="copias3" type="text" class="estilotextareachico" id="copias32" value="<?php echo "$copias3";?>" /></td>
      <td>Folios 
      <input name="folios3" type="text" class="estilotextareachico" id="folios3" value="<?php echo "$folios3";?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Copias
      <input name="copias8" type="text" class="estilotextareachico" id="copias82" value="<?php echo "$copias8";?>" /></td>
      <td>Folios
      <input name="folios8" type="text" class="estilotextareachico" id="folios8" value="<?php echo "$folios8";?>" /></td>
      <td>&nbsp;</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td>4<span class="Estilo1"><?php echo"$me4";?></span></td>
      <td><label>
        <input name="documento4" type="text" class="sugerencias" id="documento4" value="<?php echo "$documento4";?>" />
        <input name="idDoc4" class="infoDoc" type="hidden" id="idDoc4" value="<?php echo "$idDoc4";?>" />
		<div id="suggestions4"   ></div>
      </label></td>
      <td><input  type="text" class="estilotextareachico" id="anio4" name="year4" readonly="true" value="<?php echo "$year4"; ?>" /></td>
      <td>&nbsp;</td>
      <td>9<span class="Estilo1"><?php echo"$me9";?></span></td>
      <td>
	  <input name="documento9" type="text" class="sugerencias" id="documento9" value="<?php echo "$documento9";?>" />
	  <input name="idDoc9" class="infoDoc" type="hidden" id="idDoc9" value="<?php echo "$idDoc9";?>" />
	  <div id="suggestions9"   ></div>
	  </td>
      <td><input  type="text" class="estilotextareachico" id="anio9" name="year9" readonly="true" value="<?php echo"$year9"; ?>" /></td>
      <td><label>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Copias 
      <input name="copias4" type="text" class="estilotextareachico" id="copias42" value="<?php echo "$copias4";?>" /></td>
      <td>Folios 
      <input name="folios4" type="text" class="estilotextareachico" id="folios4" value="<?php echo "$folios4";?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Copias
      <input name="copias9" type="text" class="estilotextareachico" id="copias92" value="<?php echo "$copias9";?>" /></td>
      <td>Folios
      <input name="folios9" type="text" class="estilotextareachico" id="folios9" value="<?php echo "$folios9";?>" /></td>
      <td>&nbsp;</td>
    </tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
    <tr>
      <td>5<span class="Estilo1"><?php echo"$me5";?></span></td>
      <td><label>
        <input name="documento5" type="text" class="sugerencias" id="documento5" value="<?php echo "$documento5";?>" />
        <input name="idDoc5" class="infoDoc" type="hidden" id="idDoc5" value="<?php echo "$idDoc5";?>" />
		<div id="suggestions5"   ></div>
      </label></td>
      <td><input  type="text" class="estilotextareachico" id="anio5" name="year5" readonly="true" value="<?php echo"$year5"; ?>" /></td>
      <td>&nbsp;</td>
      <td>10<span class="Estilo1"><?php echo"$me10";?></span></td>
      <td>
	  <input name="documento10" type="text" class="sugerencias" id="documento10" value="<?php echo "$documento10";?>" />
	  <input name="idDoc10" class="infoDoc" type="hidden" id="idDoc10" value="<?php echo "$idDoc10";?>" />
	  <div id="suggestions10"   ></div>
	  </td>
      <td><input  type="text" class="estilotextareachico" id="anio10" name="year10" readonly="true" value="<?php echo "$year10"; ?>" /></td>
      <td><label>
      </label></td>
    </tr>
	<tr>
			<td>&nbsp;</td>
			<td>Copias 
		    <input name="copias5" type="text" class="estilotextareachico" id="copias53" value="<?php echo "$copias5";?>" /></td>
			<td>Folios 
		    <input name="folios5" type="text" class="estilotextareachico" id="folios5" value="<?php echo "$folios5";?>" /></td>
			<td></td>
			<td></td>
			<td>Copias
		    <input name="copias10" type="text" class="estilotextareachico" id="copias102" value="<?php echo "$copias10";?>" /></td>
	  <td>Folios
		    <input name="folios10" type="text" class="estilotextareachico" id="folios10" value="<?php echo "$folios10";?>" /></td>
			<td></td>
	</tr>
  </table>
  </fieldset>

  
 
 <p>
   <label>
   <input name="Cargar"  type="submit" class="inputBoton" id="Cargar" value="Cargar" " />
   </label>
   <label>
   <input name="Limpiar" type="reset" class="inputBoton" id="Limpiar" value="Limpiar" />
   </label>
 </p>



</form>

<label><b><a href='movimiento.php'>Volver a la Página Movimientos</a></b></label>
</body>
</html>
<script type="text/javascript">
 		var frmvalidator = new Validator("remito");
		
//		frmvalidator.EnableOnPageErrorDisplaySingleBox();
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("datepicker","req", "El campo de fecha es obligatorio");
//		frmvalidator.addValidation("documento1","req", "El primer campo es obligatorio");
		frmvalidator.addValidation("remito","req", "El campo número de Remito es obligatorio");
		frmvalidator.addValidation("remito","gt=0", "El campo de número de remito no puede tomar valores negativos");
		frmvalidator.addValidation("year","dontselect=0", "Seleccione un año");
	    frmvalidator.addValidation("nivel2List","dontselect=0", "Seleccione una institución de origen");
		frmvalidator.addValidation("nivel2List1","dontselect=0", "Seleccione una institución destino");
		frmvalidator.addValidation("nivel3List","dontselect=0", "Seleccione un sector origen");
		frmvalidator.addValidation("nivel3List1","dontselect=0", "Seleccione un sector destino");
		frmvalidator.addValidation("observaciones","maxlen=600", "La longitud máxima de la descripción debe ser de 600 caracteres");
	</script>
