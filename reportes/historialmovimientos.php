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
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Reporte: Historial de movimientos</h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

 
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="historial.php" method="post"  name="historial" >
<p >&nbsp;</p>
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Ingresar datos</legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="4"><div class="ayuda">Ingrese el n&uacute;mero de Documento y el A&ntilde;o</div></td>
      </tr>
     
	   <tr>
	     <td>Serie Documental (*) </td>
	     <td ><select  id="serie" name="serie">
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
            </select></td>
	     <td >&nbsp;</td>
	     <td >&nbsp;</td>
    </tr>
	   <tr>
        <td width="120"><p>N&deg; de Documento </p></td>
         <td width="160" ><label > 
            </input>
            <input name="documento" type="text" class="estilotextarea2" id="documento" />
</label></td>
	     <td width="47" >A&ntilde;o</td>
	     <td width="343" ><select name="year"  id="year" >
           <option value="0" >Seleccionar</option>
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
         </select></td>
      </tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
      
  </fieldset>
	<p >&nbsp;</p>
	 <td align="right"><p><label><a href="reportes.php">Volver a seleccionar reporte</a>
	</form >
	<script type="text/javascript">
 		var frmvalidator = new Validator("historial");
		
		frmvalidator.EnableMsgsTogether();
		
		frmvalidator.addValidation("serie","dontselect=0", "Debe seleccionar una Serie Documental ");
		frmvalidator.addValidation("documento","alnum", "El valor del campo documento debe ser numerico");
		
		frmvalidator.addValidation("documento","req", "El campo documento es obligatorio");
		frmvalidator.addValidation("year","dontselect=0", "Debe seleccionar un año ");
	
	</script>

  
  </body>
</html>