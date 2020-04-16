<?php
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
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
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>


<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<link rel="stylesheet" type="text/css" href="../principal/css/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
	
 
<script language="JavaScript">
function vaciar(control)
{
  control.value='';
}
</script>
<script language="javascript" src="../principal/js/fecha.js"></script>

	
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>modificar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Modificar Documento </h1>
   <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>

</div>
 
<?php
$info=$_GET["info"];
$idb=$_GET['idb'];
$pagina = $_GET['pagina'];
$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$institucionAb=$_GET['institucionAb'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];		
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$dniProfb= $_GET['dniProfb']; 
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nomCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$obsb=$_GET['obsb'];
	$extractob=$_GET['extractob'];
	$fechaElimb=$_GET['fechaElimb'];

if (isset($_GET['guardar']))
{
$db= new conexion();

echo"<FORM  action='' method='GET'>
<p>&nbsp;<p>
<fieldset id='fs'  class='fieldset'>
<legend>Mensaje</legend>";

$id=$_GET['id'];
$pagina = $_GET['pagina'];
$numeroDoc=$_GET['numeroDoc'];
$anio=$_GET['anio'];
$serie=$_GET['serie'];
//echo "ID de serie ".$serie;
$institucion=$_GET['nivel2List'];
$institucionA=$_GET['nivel2List1'];
$sectorInicia=$_GET['nivel3List'];
$sectorActual=$_GET['nivel3List1'];
$fecha=$_GET['datepicker'];
$extracto=$_GET['extracto'];
$obs=$_GET['obs'];	
$dni= $_GET['dni']; 
$nombreAlumno = $_GET['nombreAlumno']; 
$apellidoAlumno = $_GET['apellidoAlumno'];
$dniProf= $_GET['dniProf']; 
$nombreProf = $_GET['nombreProf']; 
$apellidoProf = $_GET['apellidoProf'];
$codCarrera=$_GET['codCarrera'];
$nomCarrera=$_GET['nomCarrera'];
$cantiCopias = $_GET['cantiCopias']; 
$cantiFolios = $_GET['cantiFolios']; 
$asignatura = $_GET['asignatura']; 
$pasillo = $_GET['pasillo'];
$estante=$_GET['estante'];
$anaquel=$_GET['anaquel'];
$caja= $_GET['caja'];
$estado=$_GET['estado'];
$fechaElim=$_GET['fechaElim'];
$idb=$_GET['idb'];

 $fc = explode("/", $fecha);
			$dia1 = $fc[0];
			$mes1 = $fc[1];
		   $anno1 = trim($fc[2]);
			
	$feC="$anno1-"."$mes1-"."$dia1";
$feE = explode("/", $fechaElim);
			$dia = $feE[0];
			$mes = $feE[1];
		   $anno = trim($feE[2]);
			
	$fEE="$anno-"."$mes-"."$dia";
	
	
$res = mysql_query("UPDATE `documento` SET `idInstUni` ='$institucion' , `idSerie`='$serie' , `idSectorIniciador`='$sectorInicia' , `Extracto`='$extracto' , `fechaCreacion`='$feC' , `dniAlum`='$dni' , `nomAlum`='$nombreAlumno' , `apellAlum`='$apellidoAlumno' , `codCarrera`='$codCarrera' , `nomCarrera`='$nomCarrera' , `cantidadCopias`='$cantiCopias' , `cantidadFolios`='$cantiFolios' , `dniDocente`='$dniProf' ,`nombreDocente`='$nombreProf' , `apellDocente`='$apellidoProf' , `idSectorActual`='$sectorActual' , `pasillo`='$pasillo' , `estante`='$estante' , `anaquel`='$anaquel' , `caja`='$caja' , `estado`='$estado' , `asignatura`='$asignatura' , `fechaEliminacion`='$fEE' , `Extracto`='$extracto' , `Observaciones`='$obs' , `idInstUniActual`='$institucionA'   WHERE `documento`.`idDocumento` = '$id' ");

	if($res)
	{
		echo"<p>El registro se ha guardado con éxito</p>";
		echo"<p>&nbsp;</p>";
		
			
	}
	else
	{
		echo"<p>La operación no se pudo realizar</p>";
		echo"<p>&nbsp;</p>";
	}

echo"</fieldset>

</form>";
}//fin guardar

else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$pagina= $_GET['pagina'];
$numeroDoc=$_GET['numeroDoc'];
$anio=$_GET['anio'];
$serie=$_GET['serie'];
$institucion=$_GET['institucion'];
$sectorInicia=$_GET['sectorInicia'];
$institucionA=$_GET['institucionA'];
$sectorActual=$_GET['sectorActual'];
$fecha=$_GET['fecha'];
$obs=$_GET['obs'];
$extracto=$_GET['extracto'];	
$dni = $_GET['dni']; 
$nombreAlumno = $_GET['nombreAlumno']; 
$apellidoAlumno = $_GET['apellidoAlumno'];
$dniProf = $_GET['dniProf']; 
$nombreProf = $_GET['nombreProf']; 
$apellidoProf = $_GET['apellidoProf'];
$codCarrera=$_GET['codCarrera'];
$nomCarrera=$_GET['nomCarrera'];
$cantiCopias = $_GET['cantiCopias']; 
$cantiFolios = $_GET['cantiFolios']; 
$asignatura = $_GET['asignatura']; 
$pasillo = $_GET['pasillo'];
$estante=$_GET['estante'];
$anaquel=$_GET['anaquel'];
$caja= $_GET['caja'];
$estado=$_GET['estado'];
$fechaElim=$_GET['fechaElim'];



?>
<FORM  action="modificar_documento.php" method="GET" id="modif_Doc">
 <fieldset id="fs"  class="fieldset">
<legend >Datos </legend>
    <input name="id"  type="hidden" class="estilotextarea3" id="id"   value="<?php echo"$id";?>" ></input>
	    <table  width="517" class="tabla"  id="tab1">
        
        <tr> 
          <td><p>Nro. Documento</p></td>
          <td>
              <input name="numeroDoc" type="text" class="estilotextarea1" disabled="false" value="<?php 
			  if($numeroDoc!=0)
			  {
			  echo"$numeroDoc";
			  }
			  else
			  {
			  	echo"";	
			  }
			  
			  ?>" ></input>
          </td>
        </tr>
        <tr> 
          <td> <p>A&ntilde;o </p></td>
          <td> <select name="anio" disabled="false">
              <?php 
			  for ($i=2100; $i>=1900; $i--) {
				if($i==$anio)
					{					
					echo "<option value='$i' selected='selected'>$i</option>";
					
					}
					else if($anio==0) 
					{
   					echo "<option value='0'>S/A</option>";
					}
					else
					{
						echo "<option value='$i'>$i</option>";
					}
					
					
								   }
   				?>
            </select> </td>
        </tr>
        <tr> 
          <td ><p>Serie Documental </p></td>
          <td > <select name="serie">
              
              <?php
					  $query ='SELECT * FROM seriedocumental ORDER BY  `nombre` ASC ';

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
					
					if($row['idserie']==$serie)
        				{
											
						?>
            	 			<option value="<?php echo $row['idserie'];?>" selected="selected"> <?php echo $row['nombre'];?></option>
              
    <?php 					} 
					else
					{ 

					?>
					
					<option value="<?php echo $row['idserie'];?>"> <?php echo $row['nombre'];?></option>
					
					<?php }  
					} 
    				?>
            </select> </td>
        </tr>
		<tr> <td ><div><p>Institución (*)</p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option >seleccionar</option>		
  		<?php
		
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		if (mysql_num_rows($ejecutar_sql)!=0){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idI=$row ['idInst'];
			$nombre=$row ['nombre'];
			if($idI==$institucion)
			{
			echo "<option value='".$idI."' selected='selected '>".$nombre."</option>";     
			}
			else
			{
			echo "<option value='".$idI."' >".$nombre."</option>";     
			}
		}
		}
	 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector Iniciador (*)</p></td>
		<td>
		<select name="nivel3List" id="nivel3List" onChange="return nivel3OnChange()">
	<?php
	  
		
		//**************************************************************************
		if ($institucion!=0){
		//echo "entra a distinto cero";
		
		$sql="SELECT * FROM sectoruniversitario where idInstu= '". $institucion ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idS=$row ['idSector'];
			$nombreS=$row ['nombre'];
			if ($sectorInicia==$idS){
			echo "<option value='".$idS."' selected='selected' >".$nombreS."</option>";    } 
			else{
			echo "<option value='".$idS."' >".$nombreS."</option>";}
			
		}
		
		}
		else{
		?>
		<select name="nivel3List" id="nivel3List" onChange="return nivel3OnChange()">
	  	<option value=0>seleccionar</option>
		</select>
		<?php 
		}
		?>
	   
	

		</td>
        </tr>      
        <tr> <td ><div><p>Institución Actual (*)</p></div></td>
		<td><select name="nivel2List1" id="nivel2List1" onChange="return nivel2OnChange1()">
		  <option >seleccionar</option>		
  		<?php
		//$con=new conexion();
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		if (mysql_num_rows($ejecutar_sql)!=0){
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idI1=$row ['idInst'];
			$nombreI1=$row ['nombre'];
			if($idI1==$institucionA)
			{
			echo "<option value='".$idI1."' selected='selected '>".$nombreI1."</option>";     
			}
			else
			{
			echo "<option value='".$idI1."' >".$nombreI1."</option>";     
			}
		}
		}
	 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector actual (*)</p></td>
		<td>
		<select name="nivel3List1" id="nivel3List1" onChange="return nivel3OnChange1()">
	<?php
	  
		
		//**************************************************************************
		if ($institucionA!=0){
		//echo "entra a distinto cero";
		
		$sql="SELECT * FROM sectoruniversitario where idInstu= '". $institucionA ."' ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$idS1=$row ['idSector'];
			$nombre1=$row ['nombre'];
			if ($sectorActual==$idS1){
			echo "<option value='".$idS1."' selected='selected' >".$nombre1."</option>";    } 
			else{
			echo "<option value='".$idS1."' >".$nombre1."</option>";}
			
		}
		
		}
		else{
		?>
		<select name="nivel3List1" id="nivel3List1" onChange="return nivel3OnChange1()">
	  	<option value=0>seleccionar</option>
		</select>
		<?php 
		}
		?>
	   
	

		</td>
        </tr>        <tr> 
          <td><p>Fecha de Creación</p></td>
		  <?php $ff = explode("-", $fecha);
			$anno = $ff[0];
			$mes = $ff[1];
			$dia = $ff[2];		   
			
	?>

          <td > <input name="datepicker" type="text" class="estilotextarea2" id="datepicker"  title="al ingresar el valor de la fecha, el sistema le proporcionará automáticamente el formato dd-mm-aaaa, impidiéndole ingresar otro formato" onFocus="vaciar(this)" onBlur="esFechaValida(this);" value="<?php 
			if( $dia!="00" && $mes!="00" && $anio!="0000")
			{
		  echo"$dia/$mes/$anno";
		   } ?>
          ">
          </input> </td>
        </tr>
		<tr> 
          <td height="24"><p>Cantidad Copias </p></td>
          <td width="102"><label> 
            <input name="cantiCopias" type="text" class="estilotextarea3" value="<?php echo"$cantiCopias";?>"></input>
            </label></td>
		</tr>
          <tr><td width="90"><p>Cantidad Folios</p></td>
          <td width="231"><input name="cantiFolios" type="text" class="estilotextarea3" value="<?php echo"$cantiFolios";?>"></input></td>
        </tr>
  </table>
		<table  width="518"  >
        <tr> 
          <td width="110" height="98" ><p>Extracto </p></td>
		  
		  <?php 
		
		  
		 
		  $query ="SELECT Extracto FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						 
						$valorExtracto=$row['Extracto'];
					}
					$valorExtracto=ltrim($valorExtracto);
		  ?>
          <td width="396"><textarea name='extracto' cols="110" rows="3" class="textarea" maxlength="600" ><?php echo $valorExtracto;?></textarea></td>
        </tr>
		<tr> 
          <td ><p>Observaciones </p></td>
		  
		  <?php 
		  
		  $query ="SELECT Observaciones FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						 
						$valorObs=$row['Observaciones'];
					}
					$valorObs=ltrim($valorObs);
		  ?>
          <td><textarea name='obs' cols="110" rows="3" class="textarea" maxlength="600"  ><?php echo $valorObs;?></textarea></td>
        </tr>			
      </table>
    
	  <table width="508">	  
        <tr> 
          <td><p>Estado (*)</p>
            <p> 
			<select name="estado" id="estado">
			<?php 
			if($estado=='Activo' || empty($estado))
			{
			?>
				<option selected="true">Activo</option>
				<option >Inactivo</option>
				<option >Eliminado</option>
              </select>
			  <?php
			  }
			  else if($estado=='Inactivo')
			  {
			  ?>
			  <option selected="true">Inactivo</option>
				<option >Activo</option>
				<option >Eliminado</option>		
              </select>
			  <?php 
			  }
			  else
			  {?>
				<option selected="true">Eliminado</option>		
			  	<option >Inactivo</option>
				<option >Activo</option>

              <?php 	
			  }
			  ?>
            </p></td></tr>		
      </table>
	  <table width="508">
	  <tr>
		<td width="158"><p>Fecha de Eliminación</p></td>
		<td width="333">
		<?php 
		$fes = explode("-", $fechaElim);
			$diass = $fes[2];
			$messs = $fes[1];
		   $annoss = $fes[0];
		if(empty($diass))
		{
		
		}
		else
		{	
		$feEs="$diass/$messs/$annoss";
		}
		?>
		<input name="fechaElim" type="text" class="estilotextarea2"  title="al ingresar el valor de la fecha, el sistema le proporcionará automáticamente el formato dd-mm-aaaa, impidiéndole ingresar otro formato" onFocus="vaciar(this)" onBlur="esFechaValida(this);" value="<?php 
			if( $diass!="00" && $messs!="00" && $annoss!="0000")
			{
		  echo $feEs;
		   } ?>
          "> 
		  
		
		</td>		
		</tr>	
  </table>
      <table width="508"  id="tab1" >
        <tr> 
          <td height="19" colspan="2"><p>Datos Alumnos </p></td>
        </tr>
        <tr> 
          <td width="110" height="24"><p>DNI</p></td>
          <td width="386" ><label> 
            <input name="dni" type="text" class="estilotextarea1" value="<?php 
			if($dni!=0){
			echo"$dni";
			}?>"></input>
            </label></td>
        </tr>
        <tr> 
          <td height="24"><p>Nombre</p></td>
          <td ><label> 
		   <?php 
		  $query ="SELECT nomAlum FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorNombreA=$row['nomAlum'];
					}
		  ?>
          <input name="nombreAlumno" type="text" class="estilotextarea1" value="<?php echo $valorNombreA;?>"></input>
            </label> </td>
        </tr>
        <tr> 
          <td height="24"><p>Apellido</p></td>
           <td ><label> 
		   <?php 
		   $query ="SELECT apellAlum FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorApellA=$row['apellAlum'];
					}
		  ?>
          <input name="apellidoAlumno" type="text" class="estilotextarea1" value="<?php echo $valorApellA;?>"></input>
                    
            </label> </td>
        </tr>
      </table>
     
      <table width="508" height="86"  id="tab2" >
        <tr> 
          <td height="19" colspan="2"><p>Datos Profesor </p></td>
        </tr>
        <tr> 
          <td width="111" height="24"><p>Nombre</p></td>
          <td width="384"><label> 
		   <?php 
		   $query ="SELECT nombreDocente FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorNombreD=$row['nombreDocente'];
					}
		  ?>
            <input name="nombreProf" type="text" class="estilotextarea1" value="<?php echo $valorNombreD;?>"></input>
            </label></td>
        </tr>
        <tr> 
          <td height="24"><p>Apellido</p></td>
          <td><label> 
		   <?php 
		   $query ="SELECT apellDocente FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorApellD=$row['apellDocente'];
					}
		  ?>
            <input name="apellidoProf" type="text" class="estilotextarea1" value="<?php echo $valorApellD;?>"></input>
            </label></td>
        </tr>
		  <tr> 
          <td height="24"><p>DNI</p></td>
          <td ><label> 
            <input name="dniProf" type="text" class="estilotextarea1" value="<?php 
			if($dniProf!=0){
			echo"$dniProf";
			}?>"></input>
            </label></td>
        </tr>
      </table>
    
      <table width="508" >
        <tr> 
          <td height="19" colspan="6"><p>Carrera 
             
            
            </p></td>
        </tr>
        <tr> 
          <td width="108" height="24"><p>Código Carrera </p></td>
          <td colspan="3"><label> 
            <input name="codCarrera" type="text" class="estilotextarea1" value="<?php 
			if($codCarrera!=0){
			echo"$codCarrera";
			}
			?>" ></input>
            </label></td>
        </tr>
        <tr> 
          <td height="24"><p>Nombre</p></td>
          <td colspan="3"><label> 
		   <?php 
		   $query ="SELECT nomCarrera FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorNombreCarrera=$row['nomCarrera'];
					}
		  ?>
            <input name="nomCarrera" type="text" class="estilotextarea1"   value="<?php echo $valorNombreCarrera;?>"></input>
            </label></td>
        </tr>
        
        <tr> 
          <td height="24"><p>Asignatura</p></td>
		   <?php 
		   $query ="SELECT asignatura FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
   					 while ($row=mysql_fetch_array($result))    
    				{
						$valorAsig=$row['asignatura'];
					}
		  ?>
          <td colspan="3"> <input name="asignatura" type="text" class="estilotextarea1"  maxlength="18" value="<?php echo $valorAsig;?>"></input></td>
        </tr>	
  </table>
    
      <table width="640" >
        <tr> 
          <td height="19" colspan="8"><p>Ubicación</p></td>
        </tr>
        <tr> 
          <td><p>Pasillo</p></td>
          <td> <input name="pasillo" type="text" class="estilotextarea3"  value="<?php echo"$pasillo";?>"></input></td>
          <td><p>Estante</p></td>
          <td><input name="estante" type="text" class="estilotextarea3"  value="<?php echo"$estante";?>"></input></td>
          <td><p>Anaquel</p></td>
          <td > <input name="anaquel" type="text" class="estilotextarea3"  value="<?php echo"$anaquel";?>"></input></td>
          <td><p>Caja</p></td>
          <td> <input name="caja" type="text" class="estilotextarea3"  value="<?php echo"$caja";?>"></input></td>
        </tr>   
	  
      </table>
    <p align="center">
        <label>
        <input type="submit" name="guardar" value="Guardar Cambios"  id="Aceptar" class="inputBoton"></input>
      </label>
    </p>


</fieldset>
<!----------------------------------Datos Asociados a la Busqueda------------------------------------------------------->
	<?php 
		echo"<input type='hidden' name='info' value='".$info."' />";
		echo"<input type='hidden' name='idb' value='".$idb."' />";
		echo"<input type='hidden' name='numeroDocb' value='".$numeroDocb."' />";
		echo"<input type='hidden' name='aniob' value='".$aniob."' />";
		echo"<input type='hidden' name='serieb' value='".$serieb."' />";
		echo"<input type='hidden' name='sectorIniciab' value='".$sectorIniciab."' />";
		echo"<input type='hidden' name='sectorActualb' value='".$sectorActualb."' />";
		echo"<input type='hidden' name='estadob' value='".$estadob."'/>";
		echo"<input type='hidden' name='extractob' value='".$extractob."' />";
		echo"<input type='hidden' name='institucionb' value='".$institucionb."' />";
		echo"<input type='hidden' name='institucionAb' value='".$institucionAb."' />";
		echo"<input type='hidden' name='fechab' value='".$fechab."' />";
		echo"<input type='hidden' name='dnib' value='".$dnib."' />";
		echo"<input type='hidden' name='nombreAlumnob' value='".$nombreAlumnob."' />";
		echo"<input type='hidden' name='apellidoAlumnob' value='".$apellidoAlumnob."' />";
		echo"<input type='hidden' name='dniProfb' value='".$dniProfb."' />";
		echo"<input type='hidden' name='nombreProfb' value='".$nombreProfb."' />";
		echo"<input type='hidden' name='apellidoProfb' value='".$apellidoProfb."' />";
		echo"<input type='hidden' name='codCarrerab' value='".$codCarrerab."' />";
		echo"<input type='hidden' name='nomCarrerab' value='".$nomCarrerab."' />";
		echo"<input type='hidden' name='cantiCopiasb' value='".$cantiCopiasb."' />";
		echo"<input type='hidden' name='cantiFoliosb' value='".$cantiFoliosb."' />";
		echo"<input type='hidden' name='asignaturab' value='".$asignaturab."' />";
		echo"<input type='hidden' name='pasillob' value='".$pasillob."' />";
		echo"<input type='hidden' name='estanteb' value='".$estanteb."' />";
		echo"<input type='hidden' name='anaquelb' value='".$anaquelb."' />";
		echo"<input type='hidden' name='cajab' value='".$cajab."' />";
		echo"<input type='hidden' name='fechaElimb' value='".$fechaElimb."' />";
		echo"<input type='hidden' name='obsb' value='".$obsb."' ></input>";
		echo"<input type='hidden' name='pagina' value='".$pagina."' ></input>";
?>
</form>
<!----------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
 		var frmvalidator = new Validator("modif_Doc");
		
		frmvalidator.EnableMsgsTogether();
		
		
		frmvalidator.addValidation("serie","dontselect=0", "seleccione un tipo de serie documental");
		frmvalidator.addValidation("nivel2List","dontselect=0", "seleccione una institución universitaria");
		frmvalidator.addValidation("nivel3List","dontselect=0", "seleccione un sector iniciador");
		frmvalidator.addValidation("sectorActual","dontselect=0", "seleccione un sector iniciador");		
		frmvalidator.addValidation("anio","req", "El campo de anio es obligatorio");
		frmvalidator.addValidation("copias","req", "El campo de copias es obligatorio");
		frmvalidator.addValidation("copias","num", "El campo de copias debe ser numérico");
		frmvalidator.addValidation("copias","maxlen=6", "La longitud máxima del número de copias es de 6 dígitos");
		frmvalidator.addValidation("copias","gt=0", "El campo de copias no puede tomar valores negativos");
		frmvalidator.addValidation("folios","req", "El campo de folios esobligatorio");
		frmvalidator.addValidation("folios","num", "El campo de folios debe ser numérico");
		frmvalidator.addValidation("folios","maxlen=6", "La longitud máxima de cantidad es de 6 dígitos");
		frmvalidator.addValidation("folios","gt=0", "El campo de folios no puede tomar valores negativos");
		
		frmvalidator.addValidation("dni","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dni","gt=0", "El campo de número de documento no puede tomar valores negativos");

		frmvalidator.addValidation("nombreAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre del alumno");
		frmvalidator.addValidation("nombreAlumno","maxlen30", "La máxima longitud para el nombre del alumno es 30 caracteres");
		frmvalidator.addValidation("apellidoAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido del alumno");
		frmvalidator.addValidation("apellidoAlumno","maxlen=30", "La longitud máxima del Apellido del alumno es de 30 caracteres");


		frmvalidator.addValidation("dniProf","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dniProf","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dniProf","gt=0", "El campo de número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("nombreProf","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombreProf","maxlen=30", "La máxima longitud para el nombre es 30 caracteres");

		frmvalidator.addValidation("apellidoProf","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido");
		frmvalidator.addValidation("apellidoProf","maxlen=30", "La longitud máxima de un documento es de 30 caracteres");
		
		
		frmvalidator.addValidation("codCarrera","num", "El campo de codigo debe ser numérico");
		frmvalidator.addValidation("codCarrera","maxlen=5", "La longitud máxima del código de carrera es de 5 dígitos");
		frmvalidator.addValidation("codCarrera","gt=0", "El campo de código de carrera no puede tomar valores negativos");
		frmvalidator.addValidation("nomCarrera","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre de la carrera");
		frmvalidator.addValidation("nomCarrera","maxlen=70", "La longitud máxima del nombre de una carrera es de 70 caracteres");
		
		frmvalidator.addValidation("asignatura","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre de la asignatura");
		frmvalidator.addValidation("asignatura","maxlen=30", "La longitud máxima del nombre de una asginatura es de 30 caracteres");
		
		frmvalidator.addValidation("pasillo","alnum", "Solo se permiten caracteres alfanuméricos para el nombre del pasillo");
		frmvalidator.addValidation("pasillo","maxlen=20", "La longitud máxima del nonmbre de un pasillo es de 20 caracteres");
		frmvalidator.addValidation("pasillo","gt=0", "El campo de pasillo no puede tomar valores negativos");
		frmvalidator.addValidation("estante","alnum", "Solo se permiten caracteres alfanuméricos para el nombre del estante");
		frmvalidator.addValidation("estante","maxlen=20", "La longitud máxima del nombre de un estante es de 20 caracteres");
		frmvalidator.addValidation("estante","gt=0", "El campo de estante no puede tomar valores negativos");
		frmvalidator.addValidation("anaquel","gt=0", "El campo de anaquel no puede tomar valores negativos");
		frmvalidator.addValidation("anaquel","alnum", "Solo se permiten caracteres alfanuméricos para el nombre de un anaquel");
		frmvalidator.addValidation("anaquel","maxlen=20", "La longitud máxima del nombre de un anaquel es de 20 caracteres");
		frmvalidator.addValidation("caja","alnum", "Solo se permiten caracteres alfanuméricos para el nombre de la caja");
		frmvalidator.addValidation("caja","maxlen=20", "La longitud máxima del nombre de una caja de 20 caracteres");
		frmvalidator.addValidation("caja","gt=0", "El campo de caja no puede tomar valores negativos");
		//frmvalidator.addValidation("extracto","req", "El extracto del documentos es obligatorio");
		frmvalidator.addValidation("extracto","maxlen=600", "La longitud máxima del extracto de un documento es de 600 caracteres");
	</script>

<?php
}
 echo"<p>&nbsp;</p>";
  echo "<p><label><a href='busqueda.php?pagina=$pagina&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>Volver a la Búsqueda</a></label></p>";
  
  echo " <p><label><a href='documento.php?info=$info'>Volver a la Página Documento</a></label></p>";
 ?>
</body>
</html>