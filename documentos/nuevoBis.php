<?php 
error_reporting(E_PARSE);
include ('../conexion/funciones.php');
session_start();
if (!array_key_exists("user", $_SESSION)) {
  header('Location: ingresoSistema.php');
exit;}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nuevo DocumentoBis</title>
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>
<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Nuevo DocumentoBis </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>

</div>

<?php 

  
	$idDoc=$_POST['idDoc'];
	$numeroDoc=$_POST['numeroDoc'];
	$anio=$_POST['anio'];
	$serie=$_POST['serie'];
	$nivel2List=$_POST['nivel2List'];
	$nivel3List=$_POST['nivel3List'];
	$nivel2List1=$_POST['nivel2List1'];
	$nivel3List1=$_POST['nivel3List1'];
	$datepicker=$_REQUEST['datepicker'];
	$extracto=$_POST['extracto'];
	$obs=$_POST['obs'];
	$dni= $_POST['dni']; 
	$nombreAlumno = $_POST['nombreAlumno']; 
	$apellidoAlumno = $_POST['apellidoAlumno'];
	$dniD= $_POST['dniD']; 
	$nombreProf = $_POST['nombreProf']; 
	$apellidoProf = $_POST['apellidoProf'];
	$codCarrera=$_POST['codCarrera'];
	$nombreCarrera=$_POST['nombreCarrera'];
	$copias = $_POST['copias']; 
	$folios = $_POST['folios']; 
	$asignatura = $_POST['asignatura']; 
	$pasillo = $_POST['pasillo'];
	$estante=$_POST['estante'];
	$anaquel=$_POST['anaquel'];
	$caja= $_POST['caja'];
	$estado=$_POST['estado'];
	$fechas=explode("/", $datepicker);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fechaC="$anno-"."$mes-"."$dia";
	$valor1=$_POST['valor1'];
	$valor2=$_POST['valor2'];		
	//echo "extracto".$extracto;
	
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
		
			$conbis=$numeroDoc."bis";
			//veremos si esta repetido solo una vez, al final del num de doc debe decir bis
			$consulta=mysql_query("select * FROM documento where `numDoc`='$conbis' and  `idSerie`='$serie' ");
			$canti=	mysql_num_rows($consulta);
			//echo"hace la consulta para ingresaar nuevo";	
	
		
	
			if($canti==0)//esta repetido solo unas vez, se lo guarda con bis
			{
			
				
			
				$que='INSERT INTO `documento`(`idInstUni`,`numDoc`,`anioCreacion`, `idSerie`, `idSectorIniciador`, `Extracto`, `fechaCreacion`, `dniAlum`, `nomAlum`, `apellAlum`, `codCarrera`, `nomCarrera`, `cantidadCopias`, `cantidadFolios`, `dniDocente`,`nombreDocente`, `apellDocente`, `idSectorActual`, `pasillo`, `estante`, `anaquel`, `caja`, `estado`, `asignatura`,`Observaciones`,`idInstUniActual`)';
				$que.="VALUES ('$nivel2List','$conbis','$anio','$serie','$nivel3List','$extracto','$fechaC','$dni','$nombreAlumno','$apellidoAlumno','$codCarrera','$nombreCarrera','$copias','$folios','$dniD','$nombreProf','$apellidoProf','$nivel3List1','$pasillo','$estante','$anaquel','$caja','$estado','$asignatura', '$obs' , '$nivel2List1')";	
				$res=mysql_query($que) or die ("Error en la consulta a la base de datos: $que. ".mysql_error());
				  echo"<FORM  action='' method='GET'>
				<p>&nbsp;<p>
				<fieldset id='fs'  class='fieldset'>
				<legend>Mensaje</legend>";
				
					
			
			
				if($res) 
				{	echo
					"<p>&nbsp;</p>
					<p>El registro se ha guardado con &eacute;xito como número_documentoBis</p>
					<p>&nbsp;</p>";	
				}
				else
				{
					echo
					"<p>&nbsp;</p>
					<p>La operaci&oacute;n no se pudo realizar</p>
					<p>&nbsp;</p>";
				
				}
			
			
			}//cierra canti 0
			
			else
			{
			
			echo"<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>";
			 echo"<p>&nbsp;</p>";
			 $valor1=1;
			 $valor2=1;
			echo "<p>No se pudo realizar la operación. El número de Documento ya existe para esa Serie Documental.</p>";
			 echo"<p>&nbsp;</p>";
			 echo"</fieldset>";
			 echo"<p>&nbsp;</p>";
			 echo " <b><a href='alta_documento.php?info=$info&id=$id&numeroDoc=$numeroDoc&valor1=$valor1&valor2=$valor2&anio=$anio&serie=$serie&nivel3List=$nivel3List&nivel3List1=$nivel3List1&estado=$estado&extracto=$extracto&nivel2List=$nivel2List&nivel2List1=$nivel2List1&datepicker=$datepicker&dni=$dni&nombreAlumno=$nombreAlumno&apellidoAlumno=$apellidoAlumno&dniD=$dniD&nombreProf=$nombreProf&apellidoProf=$apellidoProf&codCarrera=$codCarrera&nombreCarrera=$nombreCarrera&copias=$copias&folios=$folios&asignatura=$asignatura&pasillo=$pasillo&estante=$estante&anaquel=$anaquel&caja=$caja'>Volver a cargar documento </a></b>"; 
			 //echo "<a href='alta_documento.php?info=$info&id=$id&numeroDoc=$numeroDoc&cantiCopias=$cantiCopias'>Volver a cargar documento ></a>"; 
			}//fin else que ya esta con bis 
		
	
echo"</form>";
	

 echo"<p><label><a href='documento.php'>Volver a la Página de Documento</a></label></p>";
  
 
 ?>
</body>
</html>