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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>

<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<script src="../principal/js/funciones.js"></script>
<script src="../principal/js/funciones2.js"></script>
<script language="JavaScript">
function vaciar(control)
{
  control.value='';
}
</script>
<script language="javascript" src="../principal/js/fe"></script>
<script src="../principal/js/fecha.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<div class="divTitulo"> 
  <h1>&nbsp;</h1>
  <h1>Documento	
  </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<!--*****************************Formulrio de Busqueda y boton agregar*************************-->


<?php
		session_start();
			
		
	if($_SESSION["tipo"]==1 || $_SESSION["tipo"]==2 || $_SESSION["tipo"]==4)
	{  
	echo"</p>
	<form id='form1' name='form1' method='post' action=''>
  	<fieldset id='fs'  class='fieldset'>
	<legend >Nuevo</legend>
  <table width='400' class='tabla'>
    <tr>
      <td width='350' height='56'><p>Agregar nuevo Documento</P> </td>
      <td width='50'><a href='alta_documento.php' > <img src='../images/agregar.png'></a></td>
    </tr>
	<tr> 
	<td>
	
	</td>
	</tr>
  </table>
 </fieldset>
 </form>
 <p >&nbsp;</p>";
	}
	 
	 ?>
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="busqueda.php" method="post"  name="form" >
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Búsqueda Libre </legend>
<table width="691" class="tabla">
<tr><td colspan="3" align="justify"><div class="ayuda">La siguiente es una búsqueda libre, Ud. puede ingresar cualquier dato relacionado a un Documento, por ejemplo: nro. identificador de documento, sector iniciador, palabra clave en el extracto, etc.</div></td></tr>
      <tr>
        <td width="201"><p>Ingrese dato para la búsqueda </p></td>
        <td width="478"><label>
		
		
          <input name="info" type="text" class="estilotextarea1" id="info" ></input>
        </label></td>
	</tr>
	<tr>
<td align="left" colspan="2"><input type="submit" name="buscar1" value="Buscar" id="2" class="inputBoton"></input> <input type="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
</td>
</tr>
  </table>
      
       
    
  </fieldset>
  </form>
 
	<p >&nbsp;</p>
<form action="busqueda.php" method="post"  name="form2" id="form2">
<fieldset id="fs"  class="fieldset">
	<!------Busqueda avanzada----------------------------------------------------------------------------------->
<legend >Búsqueda Avanzada</legend>
<table  width="689"  id="tab1"  class="tabla">
<tr><td colspan="3"><p align="justify"><div class="ayuda">Ingrese en cada opción el dato correspondiente, este tipo de búsqueda permite que ingrese uno o más datos. </div></p></td></tr>
	<tr> 
      <td ><p>Identificador de Documento</p></td>
          <td><p> 
              <input name="numeroDoc" type="text" class="estilotextarea1" title="Corresponde al nro. identificador de un documento, por ejemplo el nro. de Expediente o el nro. identificador de una nota"></input>
	  </td> 
      <td ></td>
	  <td colspan="2" align="center">
        <input type="submit" name="Buscar2" value="Buscar" id="2" class="inputBoton"></input></td>
      <td width="21%"> 
        <input type="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
</td>	
	</tr>
	<tr>
	  <td > 
<p> A&ntilde;o </p></td>
             
      <td> <select name="anio"  id="anio" >
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
					echo "<option value='0'>seleccionar</option>";
					}			
                	
					else if($i ==$y){
					
					echo "<option value='$y' selected=selected >$y</option>";
					echo "<option value='0'>seleccionar</option>";				
					}
					
					else{
					echo "<option value='$i' >$i</option>";
					}  					
					
				}
				
  				 ?>
        </select> </td>
    </tr>
    <tr> 
         
      <td > 
<p>Serie Documental </p></td>
          <td ><label > 
            <select name="selectSerie">
              <option value="0" selected>seleccionar</option>
              <?php
					  $query ='SELECT * FROM seriedocumental ORDER BY `nombre` ASC';

					$result = mysql_query($query);
				?>
              <?php    
   					 while ($row=mysql_fetch_array($result) )    
    				{
        				?>
              <option value=" <?php echo $row['idserie']; ?> " > <?php echo $row['nombre']; ?> 
              </option>
              <?php
    				}    
    				?>
            </select>
            </label></td>
    </tr>
        <tr> <td ><div><p>Institución inicial</p></div></td>
		<td><select name="nivel2List" id="nivel2List" onChange="return nivel2OnChange()">
		  <option value="0" selected="selected">seleccionar</option>		
  		<?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if ($nombre=='UNPA UARG'){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
		 ?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector iniciador</p></td>
		
		<td width="547"><select name="nivel3List" id="nivel3List" onchange="return nivel3OnChange()">
	  	<option value="0"> Seleccionar</option>
		<?php
		$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{   
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];			
			echo "<option value='".$id."' >".$nombre."</option>";			
		}
	   ?>
     </select>

		</td>
         </tr>
      
	  
	  <tr> <td ><div><p>Institución actual</p></div></td>
		<td><select name="nivel2List1" id="nivel2List1" onChange="return nivel2OnChange1()">
		  <option value="0" selected="selected">seleccionar</option>		
  		<?php
		$sql="SELECT idInst,nombre FROM instu ORDER BY `nombre` ASC";
		$ejecutar_sql=mysql_query($sql);
		
		/**************************************************************************/
		
		while($row=mysql_fetch_array($ejecutar_sql))
		{
			$id=$row ['idInst'];
			$nombre=$row ['nombre'];
			if ($nombre=='UNPA UARG'){
			echo "<option value='".$id."' selected='selected' >".$nombre."</option>";    } 
			else{
			echo "<option value='".$id."' >".$nombre."</option>";}
			
		}
		?>
	</select></td>		           
        </tr>
        <tr> 
		 <td ><p>Sector actual</p></td>
		
		<td width="547"><select name="nivel3List1" id="nivel3List1" onchange="return nivel3OnChange1()">
	  	<option value="0"> Seleccionar</option>
		<?php
		$sql="SELECT * FROM sectoruniversitario  `nombre` WHERE idInstu=6 ORDER BY `nombre` ASC ";
		$ejecutar_sql=mysql_query($sql);
		while($row=mysql_fetch_array($ejecutar_sql))
		{   
			$id=$row ['idSector'];
			$nombre=$row ['nombre'];			
			echo "<option value='".$id."' >".$nombre."</option>";
			
		}	
	   ?>
     </select>

		</td>
         </tr>
        <tr> 
          <td><p>Fecha</p></td>
        <td><label><input type="text" name="datepicker"  id="datepicker" onBlur="esFechaValida(this);" placeholder="dd/mm/aaaa"  title="al ingresar el valor de la fecha, el sistema le proporcionará automáticamente el formato dd/mm/aaaa, impidiéndole ingresar otro formato" onFocus="vaciar(this)"> Ej: 14/08/1999</input></label></td>
        </tr>
		 
		 <tr> 
          
      <td> 
<p>Cantidad Copias </p></td>
          <td ><label> 
            <input name="copias" type="text" class="estilotextarea1" id="copias" ></input>
            </label></td>
		</tr>
		<tr>
          
      <td > 
<p>Cantidad Folios</p></td>
          <td ><input name="folios" type="text" class="estilotextarea1" id="folios" ></input></td>
        </tr> 
		<tr> 
          <td ><p>Estado </p></td>
            <td colspan="2"><p> 
            <label> 
			   <font size="4"><select name="estado" id="estado">
                  <option value="Activo" selected="selected">Activo</option>
                  <option value="Inactivo" >Inactivo</option> 
				  <option value="Eliminado" >Eliminado</option>                
                </select></font>
              </label>
            </p></td>
        </tr>  
        <tr> 
          
      <td  > 
<p>DNI Alumno</p></td>
          <td ><label> 
            <input name="dni" type="text" class="estilotextarea1" id="dni"></input>
            </label></td>
        </tr>
        <tr> 
          
      <td  > 
<p>Nombre Alumno</p></td>
          <td ><label> 
            <input name="nombreAlumno" type="text" class="estilotextarea1" id="nombreAlumno" ></input>
            </label> </td>
        </tr>
        <tr> 
          
      <td > 
<p>Apellido Alumno</p></td>
          <td ><label> 
            <input name="apellidoAlumno" type="text" class="estilotextarea1" id="apellidoAlumno" ></input>
            </label></td>
        </tr>      
       <tr> 
          
      <td  > 
<p>DNI Docente</p></td>
          <td ><label> 
            <input name="dniProf" type="text" class="estilotextarea1" id="dniProf" ></input>
            </label> </td>
        </tr>
        <tr> 
          
      <td  > 
<p>Nombre Docente</p></td>
          <td ><label> 
            <input name="nombreProf" type="text" class="estilotextarea1" id="nombreProf" ></input>
            </label> </td>
        </tr>
        <tr> 
          
      <td  > 
<p>Apellido Docente</p></td>
          <td ><label> 
            <input name="apellidoProf" type="text" class="estilotextarea1" id="apellidoProf" ></input>
            </label></td>
        </tr>
     
        <tr> 
          
      <td   > 
<p>Código Carrera </p></td>
          <td ><label> 
            <input name="codCarrera" type="text" class="estilotextarea1" id="codCarrera" ></input>
            </label></td>
        </tr>
        <tr> 
          
      <td  > 
<p>Nombre Carrera</p></td>
          <td ><label> 
            <input name="nombreCarrera" type="text" class="estilotextarea1" id="nombreCarrera" ></input>
            </label></td>
        </tr>
       
        <tr> 
          
      <td  > 
<p>Asignatura</p></td>
          <td > <input name="asignatura" type="text" class="estilotextarea1" id="asignatura" ></input></td>
        </tr>		
        
		<tr>
		
		 
      <td > 
<p>Fecha Eliminación</p></td>
		
		  <td><input type="text" name="fechaElim" id="fechaElim" onBlur="esFechaValida(this);" placeholder="dd/mm/aaaa" title="al ingresar el valor de la fecha, el sistema le proporcionará automáticamente el formato dd/mm/aaaa, impidiéndole ingresar otro formato" onFocus="vaciar(this)">Ej: 14/08/1999</input></td>
		  
       			</tr>
  </table>
		 <table width="640"  id="tab2"  class="tabla">
          <tr> 
          <td><p>Pasillo</p></td>
          <td> <input name="pasillo" id="pasillo" type="text" class="estilotextarea3" ></input></td><td></td>
          <td><p>Estante</p></td>
          <td><input name="estante" id="estante" type="text" class="estilotextarea3" ></input></td>
          <td><p>Anaquel</p></td>
          <td > <input name="anaquel" id="anaquel" type="text" class="estilotextarea3" ></input></td>
          <td><p>Caja</p></td>
          <td> <input name="caja" id="caja" type="text" class="estilotextarea3" ></input></td>
        </tr>	
        


</table>
<input type="submit" name="Buscar2" value="Buscar" id="2" class="inputBoton"></input>
<input type="reset" name="Reset" value="Limpiar" class="inputBoton"></input>
  </fieldset>
   
</form>
 <script type="text/javascript">
 		var frmvalidator = new Validator("form");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("info","req", "Debe ingresar un dato para la búsqueda libre");
		
		frmvalidator.addValidation("info","alnum_s", "Sólo se permiten caracteres alfanuméricos en el campo de búsqueda");		
	</script>
	<script type="text/javascript">
 		var frmvalidator = new Validator("form2");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("numeroDoc","maxlen=10", "El campo número identificador de documento es máximo 8 digitos");
		frmvalidator.addValidation("numeroDoc","alnum", "El campo de número de documento debe ser alfanumérico");
		frmvalidator.addValidation("numeroDoc","gt=0", "El campo de número de documento debe conetener un número positivo");
		frmvalidator.addValidation("copias","num", "El campo de copias debe ser numérico");
		frmvalidator.addValidation("copias","maxlen=6", "La longitud máxima del número de copias es de 6 dígitos");
		frmvalidator.addValidation("copias","gt=0", "El campo de  número de copias no puede tomar valores negativos");
		frmvalidator.addValidation("folios","num", "El campo de folios debe ser numérico");
		frmvalidator.addValidation("folios","maxlen=6", "La longitud máxima de cantidad es de 6 dígitos");
		frmvalidator.addValidation("folios","gt=0", "El campo de  número de folios no puede tomar valores negativos");
		
		frmvalidator.addValidation("dni","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dni","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dni","gt=0", "El campo de  número de documento no puede tomar valores negativos");
//		frmvalidator.addValidation("nombre","req", "El campo de nombre es obligatorio");
		frmvalidator.addValidation("nombreAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre del alumno");
		frmvalidator.addValidation("nombreAlumno","maxlen30", "La máxima longitud para el nombre del alumno es 30 caracteres");
		frmvalidator.addValidation("apellidoAlumno","alpha_s", "Solo se permiten caracteres alfabéticos para el apellido del alumno");
		frmvalidator.addValidation("apellidoAlumno","maxlen=30", "La longitud máxima del Apellido del alumno es de 30 caracteres");

	
		frmvalidator.addValidation("dniProf","num", "El campo de documento debe ser numérico");
		frmvalidator.addValidation("dniProf","maxlen=8", "La longitud máxima de un documento es de 8");
		frmvalidator.addValidation("dniProf","gt=0", "El campo de  número de documento no puede tomar valores negativos");
		frmvalidator.addValidation("nombreProf","alpha_s", "Solo se permiten caracteres alfabéticos para el nombre");
		frmvalidator.addValidation("nombreProf","maxlen=30", "La máxima longitud para el nombre es 30 caracteres");

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
		
	
	</script>

    <h1>&nbsp;</h1>
 <!-- ***************************Tabla con los registross*******************************************-->
 </body>
</html>