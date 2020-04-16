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
<title>Reporte Documento</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>


<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>

<body>
<div class="divTitulo">	
	 <h1>&nbsp;</h1>
	<h1>Reporte Documento</h1>
	  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>

  </div>
  
  <?php 
$id=$_GET['id'];
$numeroDoc=$_GET['numeroDoc'];
$anio=$_GET['anio'];
$serie=$_GET['serie'];
$institucion=$_GET['institucion'];
$sectorInicia=$_GET['sectorInicia'];
$institucionA=$_GET['institucionA'];
$sectorActual=$_GET['sectorActual'];
$fecha=$_GET['fecha'];
$extracto=$_GET['extracto'];	
$dni= $_GET['dni']; 
$nombreAlumno = $_GET['nombreAlumno']; 
$apellidoAlumno = $_GET['apellidoAlumno'];
$dniProf=$_GET['dniProf']; 
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
$pagina=$_GET['pagina'];

//echo "valor".$institucionA;

//Datos asociados a la busqueda
$info=$_GET["info"];
$idb=$_GET['idb'];
$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];
	$institucionAb=$_GET['institucionAb'];
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
	$fechaElimb=$_GET['fechaElimb'];
	
	
  ?>

   <fieldset id="fs"  class="fieldset">
<legend >Datos</legend>
<p align="center"><u>Datos Generales </u></p>
	 <p><u>Nro. Documento:</u>	<?php 
	 if($numeroDoc!=0)
	 {
	 echo"$numeroDoc/$anio";
	 }
	 else
	 {
	 echo"sn/$anio";
	 }?></p>
	 <p><u>Fecha de Creación: </u>	<?php 	
		 // echo "primera ".$fecha;
		   $fechas = explode("-", $fecha);
		   $anno = $fechas[0];
			$mes = $fechas[1];
			$dia = $fechas[2];
			if($dia!="00" && $mes!="00" && $anio!="0000")
			{
			echo"$dia-$mes-$anno"; 
			}?>
			</p>
	 <p><u>Serie Documental: </u>  <?php
					  $query ="SELECT * FROM seriedocumental where idSerie='$serie'";

					$result = mysql_query($query);
			   
					 while ($row=mysql_fetch_array($result))    
					{
							$valorSerie=$row[nombre];				
					} 			   
					echo"$valorSerie";?></p>
	<p><u>Institución: </u> <?php
					  $query ="SELECT * FROM instu where idInst='$institucion' ";

					$result =mysql_query($query);
					  
					 while ($row=mysql_fetch_array($result))    
					{
						$valorInsti=$row['nombre'];
					}    
					echo"$valorInsti";?></p>			
					
	 <p><u>Sector Iniciador: </u> <?php
					  $query ="SELECT * FROM sectoruniversitario where idSector='$sectorInicia'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result) )    
					{
						$sectorI=$row['nombre'];
						echo $sectorI; 	}    
					?></p>
	<p><u>Institución Actual: </u> <?php
						
						
						
					  $query1 ="SELECT * FROM instu where idInst='$institucionA' ";

					$result1 =mysql_query($query1);
					  
					 while ($row1=mysql_fetch_array($result1))    
					{
						$valorInsti1=$row1['nombre'];
					}    
					echo"$valorInsti1";
					
					?></p>								
	<p><u>Sector Actual: </u> <?php
					  $query ="SELECT nombre FROM sectoruniversitario where idSector='$sectorActual'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result) )    
					{
						$sectorA=$row['nombre'];
					}    
					 echo"$sectorA";?></p>
		<p><u>Cantidad Copias: </u> <?php 
			if(!empty($cantiCopias)){
			echo "$cantiCopias";
			}
			
			?></p>			 
		<p><u>Cantidad Folios: </u> <?php 
			if(!empty($cantiFolios)){
			echo "$cantiFolios";
			}
			
			?></p>
		<p><u>Estado: </u> <?php 
			if(!empty($estado)){
			echo "$estado";
			}
			
			?></p>
		<p><u>Fecha de eliminación:</u> <?php 
			 
			$query ="SELECT fechaEliminacion FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result))    
					{
						$f=$row['fechaEliminacion'];
					 }
		  
			$fechas = explode("-", $f);
			//echo "$fechas";
			$dia = $fechas[2];
			$mes = $fechas[1];
			$anno = $fechas[0];
			
			
		  if($dia!="00" && $mes!="00" && $anio!="0000")
		  {
			
		  echo"$dia-$mes-$anno"; }
		  else
		  {
		  	echo " ";
		  }
			?></p>
		<p><u>Extracto: </u> <?php 
		  
		  $query ="SELECT Extracto FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				 
					 while ($row=mysql_fetch_array($result))    
					{ echo $row['Extracto']; }
		  ?></p>
		  <p><u>Observaciones:</u> <?php
			 $query ="SELECT Observaciones FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result))    
					{
						$valorO=$row['Observaciones'];
					 echo $valorO; }			
			?></p>
		  <p align="center"><u>Datos Alumnos </u></p>
		  <p><u>DNI: </u> <?php 
			if($dni==0){
			
			}
			else
			{
			echo"$dni";			
			}
			?></p>
												
	 <p><u>Nombre: </u> <?php
			 $query ="SELECT nomAlum FROM documento where idDocumento='$id'";

				$result = mysql_query($query);
				   
					while ($row=mysql_fetch_array($result))    
					{
					   $valorNombre=$row['nomAlum'];
					 echo $valorNombre; 
					 }			
					
			
			?></p>		
	   <p><u>Apellido: </u> <?php 
			$query ="SELECT apellAlum FROM documento where idDocumento='$id'";

				$result = mysql_query($query);
				   
					while ($row=mysql_fetch_array($result))    
					{
						$valorApell=$row['apellAlum'];
					 echo $valorApell; }
			
			?></p>
	  <p align="center"><u>Datos Profesor </u></p>
	  <p><u>Nombre: </u> <?php 
			$query ="SELECT nombreDocente FROM documento where idDocumento='$id'";

			$result = mysql_query($query);
				   
			 while ($row=mysql_fetch_array($result))    
			{
						$valorNombreD=$row['nombreDocente'];
					 echo "$valorNombreD"; 
					 }
					 
					
					
			?></p>
		<p><u>Apellido: </u> <?php 
			$query ="SELECT apellDocente FROM documento where idDocumento='$id'";

				$result = mysql_query($query);
				   
					while ($row=mysql_fetch_array($result))    
					{
						$valorApellD=$row['apellDocente'];
					 echo $valorApellD; }
					 
					  
			?></p>  
			<p><u>DNI: </u> <?php 
			$query ="SELECT dniDocente FROM documento where idDocumento='$id'";

				$result = mysql_query($query);
				   
					while ($row=mysql_fetch_array($result))    
					{
						$valorDNID=$row['dniDocente'];
					 if($valorDNID!=0)
					 {
					 	 echo $valorDNID; 
					 }
					 	 
					}
					 
					  
			?></p>  
		 <p align="center"><u>Datos Carrera</u></p>
		 <p><u>Código Carrera: </u> <?php 
			if(!empty($codCarrera)){
			echo "$codCarrera";
			}
			
			?></p>
	  	<p><u>Nombre: </u> <?php 
			$query ="SELECT nomCarrera FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result))    
					{
						$valorCarrera=$row['nomCarrera'];
					 echo $valorCarrera; }			
			?></p>
		<p><u>Asignatura: </u> <?php 
			$query ="SELECT asignatura FROM documento where idDocumento='$id'";

					$result = mysql_query($query);
				   
					 while ($row=mysql_fetch_array($result))    
					{
						$valorAsig=$row['asignatura'];
					 echo $valorAsig; }
			?></p>
		<p align="center"><u>Datos Ubicación</u></p>	
	 	<p><u>Pasillo: </u> <?php 
			if(!empty($pasillo)){
			echo "$pasillo";
			}
			
			?></p>
		<p><u>Estante: </u> <?php 
			if(!empty($estante)){
			echo "$estante";
			}
			
			?></p>
		<p><u>Anaquel: </u> <?php 
			if(!empty($anaquel)){
			echo "$anaquel";
			}
			
			?></p>
		<p><u>Caja: </u> <?php 
			if(!empty($caja)){
			echo "$caja";
			}
			
			?></p>				
	
	 
	
   
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
		echo"<input type='hidden' name='institucionb' value=".$institucionb." />";
		echo"<input type='hidden' name='institucionAb' value=".$institucionAb." />";
		echo"<input type='hidden' name='fechab' value=".$fechab." />";
		echo"<input type='hidden' name='dnib' value=".$dnib." />";
		echo"<input type='hidden' name='nombreAlumnob' value=".$nombreAlumnob." />";
		echo"<input type='hidden' name='apellidoAlumnob' value=".$apellidoAlumnob." />";
		echo"<input type='hidden' name='dniProfb' value=".$dniProfb." />";
		echo"<input type='hidden' name='nombreProfb' value=".$nombreProfb." />";
		echo"<input type='hidden' name='apellidoProfb' value=".$apellidoProfb." />";
		echo"<input type='hidden' name='codCarrerab' value=".$codCarrerab." />";
		echo"<input type='hidden' name='nomCarrerab' value=".$nomCarrerab." />";
		echo"<input type='hidden' name='cantiCopiasb' value=".$cantiCopiasb." />";
		echo"<input type='hidden' name='cantiFoliosb' value=".$cantiFoliosb." />";
		echo"<input type='hidden' name='asignaturab' value=".$asignaturab." />";
		echo"<input type='hidden' name='pasillob' value=".$pasillob." />";
		echo"<input type='hidden' name='estanteb' value=".$estanteb." />";
		echo"<input type='hidden' name='anaquelb' value=".$anaquelb." />";
		echo"<input type='hidden' name='cajab' value=".$cajab." />";
		echo"<input type='hidden' name='fechaElimb' value=".$fechaElimb." />";
				echo"<input type='hidden' name='pagina' value=".$pagina." />";
		
?>
  
  <p align="center">
		<label> 
	   <input type="submit" name="Enviar" value="Imprimir" onclick="window.print();" class="inputBoton"/>
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>
	  </form>	 
<?php
  echo "<table><td><p><label><a href='busqueda.php?pagina=$pagina&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>Volver a la Búsqueda</a></label></p></td>";
  
  
  echo "<td></td> <td></td> <td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td><td></td> <td></td>
   <td align='right'><p><label><a href='documento.php?info=$info'>Volver a la Página Documento</a>
  </label></p></td></table> ";
  ?>
</div>
</body>
</html>