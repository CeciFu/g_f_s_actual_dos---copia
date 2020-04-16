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
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Eliminar</title>
</head>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Eliminar Documento</h1>
    <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>

</div>
 
<?php
if (isset($_GET['eliminar'])){
$db= new conexion();
$id=$_GET['id'];
$numeroDoc=$_GET['numeroDoc'];
$anio=$_GET['anio'];
$serie=$_GET['serie'];
$institucion=$_GET['institucion'];
$sectorInicia=$_GET['sectorInicia'];
$sectorActual=$_GET['sectorActual'];
$fecha=$_GET['fecha'];
$extracto=$_GET['extracto'];	
$dni= $_GET['dni']; 
$nombreAlumno = $_GET['nombreAlumno']; 
$apellidoAlumno = $_GET['apellidoAlumno'];
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
$pagina = $_GET['pagina'];
$fechaElim=$_GET['fechaElim'];

//Datos asociados a la busqueda
$info=$_GET["info"];
$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];
	$extractob=$_GET['extractob'];	
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nombreCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$fechaElimb=$_GET['fechaElimb'];
	$pagina = $_GET['pagina'];
}//fin guardar
else{
//Datos del Registro elegido para modificar

$id=$_GET['id'];
$numeroDoc=$_GET['numeroDoc'];
$anio=$_GET['anio'];
$serie=$_GET['serie'];
$institucion=$_GET['institucion'];
$sectorInicia=$_GET['sectorInicia'];
$sectorActual=$_GET['sectorActual'];
$fecha=$_GET['fecha'];
$extracto=$_GET['extracto'];	
$dni= $_GET['dni']; 
$nombreAlumno = $_GET['nombreAlumno']; 
$apellidoAlumno = $_GET['apellidoAlumno'];
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
$pagina = $_GET['pagina'];


//Datos asociados a la busqueda
$info=$_GET["info"];
$numeroDocb=$_GET['numeroDocb'];
	$aniob=$_GET['aniob'];
	$serieb=$_GET['serieb'];
	$institucionb=$_GET['institucionb'];
	$sectorIniciab=$_GET['sectorIniciab'];
	$sectorActualb=$_GET['sectorActualb'];
	$fechab=$_GET['fechab'];
	$extractob=$_GET['extractob'];	
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$nombreProfb = $_GET['nombreProfb']; 
	$apellidoProfb = $_GET['apellidoProfb'];
	$codCarrerab=$_GET['codCarrerab'];
	$nomCarrerab=$_GET['nombreCarrerab'];
	$cantiCopiasb = $_GET['cantiCopiasb']; 
	$cantiFoliosb = $_GET['cantiFoliosb']; 
	$asignaturab = $_GET['asignaturab']; 
	$pasillob = $_GET['pasillob'];
	$estanteb=$_GET['estanteb'];
	$anaquelb=$_GET['anaquelb'];
	$cajab= $_GET['cajab'];
	$estadob=$_GET['estadob'];
	$fechaElimb=$_GET['fechaElimb'];
	$pagina = $_GET['pagina'];
?>
<FORM  action="eliminar_documento.php" method="GET">
&nbsp;
 <fieldset id="fs"  class="fieldset">
<legend >Mensaje </legend>
&nbsp;
    <input name="id"  type="hidden" class="estilotextarea3" id="id"  readonly value="<?php echo"$id";?>" />
	     <?php 
		 $res=mysql_query("UPDATE `documento` SET `estado`='Eliminado' , `fechaEliminacion`=now() WHERE idDocumento='$id' ");


	if($res)
	{
		echo"<p>El registro se ha eliminado con éxito</p>";
		echo"<p>&nbsp;</p>";	
	}
	else
	{
		echo"<p>La operaci&0acute;n no se pudo realizar</p>";
		echo"<p>&nbsp;
		</fieldset>
		</form>
		</p>";
		
	}

		 
		 ?>


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
<?php
}
 echo"<p>&nbsp;</p>";
 echo "<p><label><a href='busqueda.php?pagina=$pagina&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb&obsb=$obsb'>Volver a la Búsqueda</a></label></p>";

  echo " <p><label><a href='documento.php?info=$info'>Volver a la Página Documento</a></label></p>";
 ?>
</body>


</html>