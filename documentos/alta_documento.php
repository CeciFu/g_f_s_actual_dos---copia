<?php
error_reporting(E_PARSE);
	
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}
$idDoc=$_GET['idDoc'];
	$numeroDoc=$_GET['numeroDoc'];
	$anio=$_GET['anio'];
	$serie=$_GET['serie'];
	$nivel2List=$_GET['nivel2List'];
	$nivel3List=$_GET['nivel3List'];
	$nivel2List1=$_GET['nivel2List1'];
	$nivel3List1=$_GET['nivel3List1'];
	$datepicker=$_REQUEST['datepicker'];
	$extracto=$_GET['extracto'];
	$obs=$_GET['obs'];
	$dni= $_GET['dni']; 
	$nombreAlumno = $_GET['nombreAlumno']; 
	$apellidoAlumno = $_GET['apellidoAlumno'];
	$dniD= $_GET['dniD']; 
	$nombreProf = $_GET['nombreProf']; 
	$apellidoProf = $_GET['apellidoProf'];
	$codCarrera=$_GET['codCarrera'];
	$nombreCarrera=$_GET['nombreCarrera'];
	$copias = $_GET['copias']; 
	$folios = $_GET['folios']; 
	$asignatura = $_GET['asignatura']; 
	$pasillo = $_GET['pasillo'];
	$estante=$_GET['estante'];
	$anaquel=$_GET['anaquel'];
	$caja= $_GET['caja'];
	$estado=$_GET['estado'];
	$fechas=explode("/", $datepicker);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fechaC="$anno"."$mes"."$dia";
	$valor1=$_GET['valor1'];//inicial
	$valor2=$_GET['valor2'];//actual
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Alta Documento</title>
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
	

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.maskedinput-1.2.2.min.js"></script> 
<script src="../movimientos/jquery-1.11.2.min.js"></script>
<script src="../movimientos/jquery-ui.js"></script>
<script type="text/javascript" src="actas.js"></script>

<script language="javascript" src="../principal/js/fecha.js"></script>

</head>

<body>
<div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Documento</h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>

  </div>
  <form method="post" action="nuevo_documento.php" name="alta_doc">
    <p>&nbsp;</p>
   <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>


      
  <table  width="640">
    <tr> 
      <td colspan="5" align="center"><p>Los campos marcados con * son obligatorios</p></td>
    </tr>
    <tr> 
      <td ><p>Identificador de Documento</p></td>
      <td width="300" > 
        <p> 
          <input name="numeroDoc" type="text"  onclick="vaciar(this)" class="estilotextarea1"  title="Corresponde al nro. identificador de un documento, por ejemplo el nro. de Expediente o el nro. identificador de una nota" value="<?php echo"$numeroDoc"; ?>"/>
      </td >
      <td width="96" >
        <input name="checkbox" type="checkbox" class="estilotextarea3"  tabindex="2" title="Activar para ingresar documento sin nro" onclick="habilita()" value="Sin Nro."  align="left" /input /></td >
      
	  <td width="72" align="left"  > 
        <p>Sin Nro. </p></td> 
      <td width="18" >&nbsp;</td >
      <input name="idDoc" type="hidden" class="estilotextarea1" >
      <td width="0"></input>
      <?php
		  //<input type="checkbox" onClick="habilita()" class="estilotextarea1" ></input>
		  //<div align="center"><strong>ActivarNro</strong>.</div></td >
		  ?>
    </tr>
    <tr> 
      <td> <p>A&ntilde;o (*)</p></td>
      <td colspan="4"> <select name="anio"  id="anio" >
          <?php 
		 $y=date('Y');
		 /*if(empty($anio))
		 {
			echo "<option value='$anio' selected=selected >$anio</option>";		 	
		 }
		 */
		 for ($i= date(' Y'); $i>=1900; $i--) {
				
					 
        			if($i ==$anio){
					 
					echo "<option value='$anio' selected=selected >$anio</option>";
					}			
                	
					else if($i ==$y){
					
					echo "<option value='$y' selected=selected >$y</option>";
					
					}
					
					else{
					echo "<option value='$i' >$i</option>";
					}
					
							
   					
					
				}
				
  				 ?>
        </select> </td>
    </tr>
    <tr> 
      <td ><p>Serie Documental (*)</p></td>
      <td colspan="4" > <select id="serie" name="serie">
          <?php
			   if(empty($serie))
			  		{ ?>
          <option value="0" selected="selected">seleccionar</option>
          <?php 
					}
				
					$query ='SELECT * FROM seriedocumental ORDER BY `nombre` ASC';

					$result =  mysql_query($query);
									 while ($row=mysql_fetch_array($result)  )    
    				{
					if($row['idserie']==$serie)
						{?>
          <option value=" <?php echo $row['idserie']; ?> " selected="selected"> 
          <?php echo $row['nombre']; ?> </option>
          <?php 
						} 
						else
						{
						?>
          <option value=" <?php echo $row['idserie']; ?>" > <?php echo $row['nombre']; ?> 
          </option>
          <?php
    					}    
    				}?>
        </select> </td>
    </tr>
    <tr> 
      <td ><div> 
          <p>Institución iniciadora (*)</p>
        </div></td>
      <td colspan="4"><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
          <option value="0" selected="selected">seleccionar</option>
          <?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if($valor1==0)//inicial
		{
			
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$id=$row ['idInst'];
				$nombre=$row ['nombre'];
				if ($nombre=='UNPA UARG'){
				echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
				else{
				echo "<option value='".$id."' >".$nombre."</option>";}
				
			}
			//echo "<td>ingresa al primero</td>";
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
			//echo "<td>ingresa al segundo</td>";
		}
	 ?>
        </select></td>
    </tr>
    <tr> 
      <td ><p>Sector iniciador (*)</p></td>
      <td colspan="4"> <select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
          <option value="0"> Seleccione...</option>
          <?php
		if($valor1==0)//si es la primera
		{
		
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{   
				$id=$row ['idSector'];
				$nombres=$row ['nombre'];			
				echo "<option value='".$id."' >".$nombres."</option>";
				
			}
			//echo "<td>ingresa al primero</td>";		
		}
		else//vueleve
		{
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu='". $nivel2List ."'  ORDER BY `nombre` ASC ";
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
				 	echo "<option value='".$id."' >".$nombreS."</option>";
				}
			}
			//echo "<td>ingresa al segundo</td>";		
		}
		
	   ?>
        </select> </td>
    </tr>
    <tr> 
      <td ><div> 
          <p>Institución actual (*)</p>
        </div></td>
      <td colspan="4"><select name="nivel2List1" id="nivel2List1" onChange="return nivel2OnChange1()">
          <option value="0" selected="selected">seleccionar</option>
          <?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		if($valor2==0)//inicial
		{
			
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$id=$row ['idInst'];
				$nombre=$row ['nombre'];
				if ($nombre=='UNPA UARG'){
				echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
				else{
				echo "<option value='".$id."' >".$nombre."</option>";}
				
			}
			//echo "<td>ingresa al primero</td>";
		}
		else//vuelve del error
		{
			$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{
				$idI=$row ['idInst'];
				$nombreI=$row ['nombre'];
				if ($idI==$nivel2List1){
				echo "<option value='".$idI."' selected='selected' >".$nombreI."</option>";    } 
				else{
				echo "<option value='".$idI."' >".$nombreI."</option>";}
				
			}
			//echo "<td>ingresa al segundo</td>";
		}
		?>
        </select></td>
    </tr>
    <tr> 
      <td ><p>Sector actual (*)</p></td>
      <td colspan="4"> <select name="nivel3List1" id="nivel3List1" onchange="return nivel3OnChange1()">
          <option value="0"> Seleccione...</option>
          <?php
		if($valor2==0)//si es la primera
		{
		
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
			$ejecutar_sql=mysql_query($sql);
			while($row=mysql_fetch_array($ejecutar_sql))
			{   
				$id=$row ['idSector'];
				$nombres=$row ['nombre'];			
				echo "<option value='".$id."' >".$nombres."</option>";
				
			}
			//echo "<td>ingresa al primero</td>";		
		}
		else//vueleve
		{
			$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu='". $nivel2List1 ."'  ORDER BY `nombre` ASC ";
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
				 	echo "<option value='".$id."' >".$nombreS."</option>";
				}
			}
			//echo "<td>ingresa al segundo</td>";		
		}
		?>
        </select> </td>
    </tr>
    <tr> 
    <tr> 
      <td><p>Fecha</p></td>
      <td colspan="4"><input name="datepicker" type="text"  id="datepicker" placeholder='dd/mm/aaaa' title="al ingresar el valor de la fecha, el sistema le proporcionará automáticamente el formato dd-mm-aaaa, impidiéndole ingresar otro formato" onFocus="vaciar(this)" onBlur="esFechaValida(this);" value="<?php echo"$datepicker"; ?>" >
        Ej: 14/04/1999 </input> </td>
    </tr>
    <tr> 
      <td height="24"><p>Cantidad Copias (*)</p></td>
      <td colspan="4"> <label> 
	  
        <input name="copias" id="copias" type="text" class="estilotextarea3" value="<?php if(!empty($copias)) {echo"$copias";} else echo 1; ?>"/input>
        </label></td>
    </tr>
    <tr> 
      <td width="126"> 
<p>Cantidad Folios(*)</p></td>
      <td colspan="4"> <input name="folios" type="text" class="estilotextarea3" value="<?php echo"$folios"; ?>" /input></td>
    </tr>
    <tr> 
      <td ><p>Extracto (*) </p></td>
      <?php
		  $extracto=ltrim($extracto);
		  ?>
      <td colspan="4" ><textarea name="extracto" cols="55" rows="8" class="textarea" id="extracto" maxlength="600"><?php echo"$extracto";?> </textarea></td>
    </tr>
    <tr> 
      <td ><p>Observaciones</p></td>
      <?php
		  $obs=ltrim($obs);
		  ?>
      <td colspan="4" ><textarea name="obs" cols="55" rows="8" class="textarea" id="obs" maxlength="600"> <?php echo "$obs"; ?> </textarea></td>
    </tr>
  </table>
      <hr/>
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
              </select>
			  <?php
			  }
			  else
			  {
			  ?>
			  <option selected="true">Inactivo</option>
				<option >Activo</option>				
              </select>
			  <?php 
			  }
			  ?>
            </p></td></tr>
		<tr><td>	<p align="center"> 
        <label> 
        <input type="submit" name="Enviar" value="Crear" class="inputBoton" ></input>
        <input type="hidden" name="action" value="add" ></input>
		
        </label>
      
        <label> 
      <INPUT TYPE="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
        <input type="hidden" name="action" value="add"/></input>
		
        </label>
      </p></td>
        </tr>
      </table>
	   <hr/>
      <table width="508"  id="tab1" >
        <tr> 
          <td height="19" colspan="2"><p>Datos Alumnos </p></td>
        </tr>
        <tr> 
          <td width="86" height="24"><p>DNI</p></td>
          <td width="410" align="center" ><label> 
            <input name="dni" type="text" class="estilotextarea1" value="<?php echo"$dni"; ?>" /input>
            </label></td>
        </tr>
        <tr> 
          <td height="24"><p>Nombre</p></td>
          <td align="center"><label> 
            <input name="nombreAlumno" type="text" class="estilotextarea1" value="<?php echo"$nombreAlumno"; ?>" /input>
            </label> <label></label></td>
        </tr>
        <tr> 
          <td height="24"><p>Apellido</p></td>
          <td align="center"><label> 
            <input name="apellidoAlumno" type="text" class="estilotextarea1" value="<?php echo"$apellidoAlumno"; ?>" /input>
            </label></td>
        </tr>
      </table>
      <hr/>
      <table width="508" height="86"  id="tab2" >
        <tr> 
          <td height="19" colspan="2"><p>Datos Profesor </p></td>
        </tr>
		<tr> 
          <td width="132" height="24"><p>DNI</p></td>
          <td width="364"><label> 
            <input name="dniD" type="text" class="estilotextarea1" value="<?php echo"$dniD"; ?>" /input>
            </label> <label></label></td>
        </tr>
        <tr> 
          <td width="132" height="24"><p>Nombre</p></td>
          <td width="364"><label> 
            <input name="nombreProf" type="text" class="estilotextarea1" value="<?php echo"$nombreProf"; ?>" /input>
            </label> <label></label></td>
        </tr>
        <tr> 
          <td height="24"><p>Apellido</p></td>
          <td><label> 
            <input name="apellidoProf" type="text" class="estilotextarea1" value="<?php echo"$apellidoProf"; ?>"/input>
            </label></td>
        </tr>
      </table>
      <hr />
      <table width="508" >
        <tr> 
          <td height="19" colspan="4"><p>Carrera 
              <label></label>
              <label></label>
            </p></td>
        </tr>
        <tr> 
          <td width="128" height="24"><p>Código Carrera </p></td>
          <td width="368" colspan="3"><label> 
            <input name="codCarrera" type="text" class="estilotextarea1" value="<?php echo"$codCarrera"; ?>" /input>
            </label></td>
        </tr>
        <tr> 
          <td height="24"><p>Nombre</p></td>
          <td colspan="3"><label> 
            <input name="nombreCarrera" type="text" class="estilotextarea1"   value="<?php echo"$nombreCarrera"; ?>"/input>
            </label></td>
        </tr>
        
        <tr> 
          <td height="24"><p>Asignatura</p></td>
          <td colspan="3"> <input name="asignatura" type="text" class="estilotextarea1" value="<?php echo"$asignatura"; ?>"/input></td>
        </tr>
      </table>
      <hr />
      <table width="640" >
        <tr> 
          <td height="19" colspan="8"><p>Ubicación</p></td>
        </tr>
        <tr> 
          <td><p>Pasillo</p></td>
          <td> <input name="pasillo" type="text" class="estilotextarea3" value="<?php echo"$pasillo"; ?>"/input></td>
          <td><p>Estante</p></td>
          <td><input name="estante" type="text" class="estilotextarea3" value="<?php echo"$estante"; ?>"/input></td>
          <td><p>Anaquel</p></td>
          <td > <input name="anaquel" type="text" class="estilotextarea3" value="<?php echo"$anaquel"; ?>" /input></td>
          <td><p>Caja</p></td>
          <td> <input name="caja" type="text" class="estilotextarea3"  value="<?php echo"$caja"; ?>"/input></td>
        </tr>
      </table>
     
     
      <p align="center"> 
        <label> 
        <input type="submit" name="Enviar" value="Crear" class="inputBoton" ></input>
        </label>
		<label><input type="hidden" name="action" value="add" />
		<INPUT TYPE="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
        </label>
		<label>
		<input type="submit" name="Enviar" value="Imprimir" onclick="window.print();" class="inputBoton"/>
		</label>
		
      </p>
   
    </fieldset>
  </form>
  
<script type="text/javascript">
 		var frmvalidator = new Validator("alta_doc");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("numeroDoc","gt=0", "El campo número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("numeroDoc","num", "El campo número de documento sólo permite valores numéricos");
		frmvalidator.addValidation("serie","dontselect=0", "seleccione un tipo de serie documental");
		frmvalidator.addValidation("nivel2List","dontselect=0", "seleccione una institución iniciadora");
		frmvalidator.addValidation("nivel3List1","dontselect=0", "seleccione un sector Actual");
		frmvalidator.addValidation("nivel2List1","dontselect=0", "seleccione una institución Actual");
		frmvalidator.addValidation("nivel3List","dontselect=0", "seleccione un sector iniciador");

		frmvalidator.addValidation("anio","req", "El campo de anio es obligatorio");
		frmvalidator.addValidation("copias","req", "El campo de copias es obligatorio");
		frmvalidator.addValidation("copias","num", "El campo de copias debe ser numérico");
		frmvalidator.addValidation("copias","maxlen=6", "La longitud máxima del número de copias es de 6 dígitos");
		frmvalidator.addValidation("copias","gt=0", "El campo de  número de copias no puede tomar valores negativos");
		frmvalidator.addValidation("folios","req", "El campo de folios es obligatorio");
		frmvalidator.addValidation("folios","num", "El campo de folios debe ser numérico");
		frmvalidator.addValidation("folios","maxlen=6", "La longitud máxima de cantidad es de 6 dígitos");
		frmvalidator.addValidation("folios","gt=0", "El campo de  número de folios no puede tomar valores negativos");
		frmvalidator.addValidation("datepicker","req", "Seleccione una fecha");
		
		frmvalidator.addValidation("dni","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dni","gt=0", "El campo número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("numeroDoc","maxlen=8", "El campo número identificador de documento es máximo 8 digitos");

//		frmvalidator.addValidation("nombre","req", "El campo de nombre es obligatorio");
		frmvalidator.addValidation("nombreAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre del alumno");
		frmvalidator.addValidation("nombreAlumno","maxlen30", "La máxima longitud para el nombre del alumno es 30 caracteres");
		frmvalidator.addValidation("apellidoAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido del alumno");
		frmvalidator.addValidation("apellidoAlumno","maxlen=30", "La longitud máxima del Apellido del alumno es de 30 caracteres");

	//	frmvalidator.addValidation("nombre","req", "El campo de nombre es obligatorio");
		frmvalidator.addValidation("dniD","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dniD","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dniD","gt=0", "El campo número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("nombreProf","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombreProf","maxlen=30", "La máxima longitud para el nombre es 30 caracteres");
	//	frmvalidator.addValidation("documento","req", "El campo de documento es obligatorio");
		frmvalidator.addValidation("apellidoProf","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido");
		frmvalidator.addValidation("apellidoProf","maxlen=30", "La longitud máxima de un documento es de 30 caracteres");
		
		
		frmvalidator.addValidation("codCarrera","num", "El campo de codigo debe ser numérico");
		frmvalidator.addValidation("codCarrera","maxlen=5", "La longitud máxima del código de carrera es de 5 dígitos");
		frmvalidator.addValidation("codCarrera","gt=0", "El campo de código de carrera no puede tomar valores negativos");
		frmvalidator.addValidation("nombreCarrera","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre de la carrera");
		frmvalidator.addValidation("nombreCarrera","maxlen=70", "La longitud máxima del nombre de una carrera es de 70 caracteres");
		
		frmvalidator.addValidation("asignatura","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre de la asignatura");
		frmvalidator.addValidation("asignatura","maxlen=30", "La longitud máxima del nombre de una asginatura es de 30 caracteres");
		
		frmvalidator.addValidation("pasillo","alnum", "Solo se permiten caracteres alfanuméricos para el nombre del pasillo");
		frmvalidator.addValidation("pasillo","maxlen=20", "La longitud máxima del nonmbre de un pasillo es de 20 caracteres");
		frmvalidator.addValidation("pasillo","gt=0", "El campo de pasillo no puede tomar valores negativos");
		frmvalidator.addValidation("estante","alnum", "Solo se permiten caracteres alfanuméricos para el nombre del estante");
		frmvalidator.addValidation("estante","maxlen=20", "La longitud máxima del nombre de un estante es de 20 caracteres");
		frmvalidator.addValidation("estante","gt=0", "El campo de estante no puede tomar valores negativos");
		frmvalidator.addValidation("anaquel","alnum", "Solo se permiten caracteres alfanuméricos para el nombre de un anaquel");
		frmvalidator.addValidation("anaquel","maxlen=20", "La longitud máxima del nombre de un anaquel es de 20 caracteres");
		frmvalidator.addValidation("anaquel","gt=0", "El campo de anaquel no puede tomar valores negativos");
		frmvalidator.addValidation("caja","alnum", "Solo se permiten caracteres alfanuméricos para el nombre de la caja");
		frmvalidator.addValidation("caja","maxlen=20", "La longitud máxima del nombre de una caja de 20 caracteres");
		frmvalidator.addValidation("caja","gt=0", "El campo de caja no puede tomar valores negativos");
		frmvalidator.addValidation("extracto","req", "El extracto del documentos es obligatorio");
		frmvalidator.addValidation("extracto","maxlen=600", "La longitud máxima del extracto de un documento es de 600 caracteres");
	</script>
  <p> 
   <label><a href="documento.php">Volver a la Página Documento</a>
  </label>
  <blockquote><a href="#" class="uno"></a> 
    <p>&nbsp;</p>
  </blockquote>
</div>

</body>
</html>
