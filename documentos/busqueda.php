<?php 
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {	
    header('Location: ../principal/ingreso_sistema.php');
    exit;
	}
$oper=array(); 
$oper=$_SESSION["operaciones"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Buscar Documento</title>
<script Language="JavaScript">
function mostrar(obj) {
while(obj.nextSibling != null && obj.className != 
"tooltip")
obj = obj.nextSibling;
if(obj != null)
objj i i i .style.display = "inline";
}
function ocultar(obj) {
while(obj.nextSibling != null && obj.className != 
"tooltip")
obj = obj.nextSibling;
if(obj != null)    
objj i .style.display = "none";  
}
</script>

<link rel="stylesheet" href="../principal/table.css" type="text/css"/>	
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<style type="text/css">
.tooltip {
background-color: yellow;
border: 2px solid orange;
display: none;
position: absolute;
}
</style>
</head>
<body>
<div class="divTitulo" > 
 <h1>&nbsp;</h1>
  <h1 >Búsqueda Documento	
  </h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>

 <!-- ***************************Tabla con los registross*******************************************-->
 
 <?php

//$db=new conexion();
//pide las variables para la consulta enviados por URL
$info=$_GET["info"];
//Datos de documento
	
		$valor=$_GET["valor"];
		if (isset($_POST['buscar1'])){

		$valor=$_POST["valor"];
		
		}

	$numeroDocb=$_GET['numeroDocb'];//ya esta

	$aniob=$_GET['aniob'];//ya esta
	$serieb=$_GET['serieb'];//ya esta
	$institucionb=$_GET['institucionb'];//ya esta
	$institucionAb=$_GET['institucionAb'];//ya esta
	$sectorIniciab=$_GET['sectorIniciab'];//ya esta
	$sectorActualb=$_GET['sectorActualb'];//ya esta
	$fechab=$_GET['fechab'];
	
	$fechas=explode("/", $fechab);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fechaC=$anno."-".$mes."-".$dia;
	
	$extractob=$_GET['extractob'];	
	$dnib= $_GET['dnib']; 
	$nombreAlumnob = $_GET['nombreAlumnob']; 
	$apellidoAlumnob = $_GET['apellidoAlumnob'];
	$dniProfb=$_GET['dniProfb']; 
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
	$estadob=$_GET['estadob'];//ya esta
	
	$fechaElimb=$_GET['fechaElimb'];
	$fechase=explode("/", $fechaElimb);
			$diae = $fechase[0];
			$mese = $fechase[1];
			$annoe = $fechase[2];
	$fechaE=$annoe."-".$mese."-".$diae;
	


?>
<!--------------------------------------Busqueda libre---------------------------------------------------->
<?php

if (isset($_POST['buscar1'])){

$info=$_POST['info'];

}
?>
<!--------------------------------------Busqueda Avanzada---------------------------------------------------->
<?php 

if(isset($_POST['Buscar2'])){
	
	
	
	$numeroDocb=$_POST['numeroDoc'];
	$aniob=$_POST['anio'];	
	$serieb=$_POST['selectSerie'];
	$institucionb=$_POST['nivel2List'];
	$sectorIniciab=$_POST['nivel3List'];
	$institucionAb=$_POST['nivel2List1'];	
	$sectorActualb=$_POST['nivel3List1'];
	$fechab=$_POST['datepicker'];
	
	$fechas=explode("/", $fechab);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fechaC=$anno."-".$mes."-".$dia;
	
	$cantiCopiasb = $_POST['copias']; 
	$cantiFoliosb = $_POST['folios']; 
	$estadob=$_POST['estado'];		
	$dnib= $_POST['dni']; 
	$nombreAlumnob = $_POST['nombreAlumno']; 
	$apellidoAlumnob = $_POST['apellidoAlumno'];
	$dniProfb=$_POST['dniProf'];
	$nombreProfb = $_POST['nombreProf']; 
	$apellidoProfb = $_POST['apellidoProf'];
	$codCarrerab=$_POST['codCarrera'];
	$nomCarrerab=$_POST['nombreCarrera'];	
	$asignaturab = $_POST['asignatura']; 	
	$fechaElimb=$_POST['fechaElim'];
	
	$fechase=explode("/", $fechaElimb);
			$diae = $fechase[0];
			$mese = $fechase[1];
			$annoe = $fechase[2];
	$fechaE=$annoe."-".$mese."-".$diae;
	
	$pasillob = $_POST['pasillo'];
	$estanteb=$_POST['estante'];
	$anaquelb=$_POST['anaquel'];
	$cajab= $_POST['caja'];
}

	if(!empty($numeroDocb))
		{
			
			$condicion="where numDoc like '%".$numeroDocb."%'";
			
			if(!empty($aniob) && $anio!='seleccionar')
			{
				$condicion.=" and anioCreacion='$aniob'";
				
			}
			if(!empty($serieb) && $serieb!='seleccionar')
			{
				$condicion.=" and idSerie ='$serieb'";
			}
			if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstUni ='$institucionb'";		
			}
			if($sectorIniciab== "seleccionar" )
			{}
			else if(!empty($sectorIniciab))
			{
				$condicion.=" and idSectorIniciador ='$sectorIniciab'";
			}
			if(!empty($institucionAb) && $institucionAb!='seleccionar')
			{
				$condicion.=" and idInstUniActual ='$institucionAb'";		
			}
			
			if($sectorActualb=="seleccionar" )
			{}
			else if(!empty($sectorActualb))
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
			$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		}//cierra if nro doc
		
		else if(!empty($aniob) && $anio!='seleccionar')//empieza anio	
		{
			
			$condicion="where anioCreacion='$aniob'";
			
			
			if(!empty($serieb) && $serieb!='seleccionar')
			{
				$condicion.=" and idSerie ='$serieb'";
			}
			if(!empty($institucionb) && $institucionb!='seleccionar')
			{
				$condicion.=" and idInstUni ='$institucionb'";		
			}
			if($sectorIniciab== "seleccionar" )
			{}
			else if(!empty($sectorIniciab))
			{
				$condicion.=" and idSectorIniciador ='$sectorIniciab'";
			}
			if(!empty($institucionAb) && $institucionAb!='seleccionar')
			{
				$condicion.=" and idInstUniActual ='$institucionAb'";		
			}
			
			if($sectorActualb=="seleccionar")
			{}
			else if(!empty($sectorActualb))
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
			
		}//cierra anio
		else if(!empty($serieb)&&$serie!='seleccionar') //abre seriedoc
		{			
			
			$condicion="where idSerie='$serieb'";
			
		
			if(!empty($institucionb) &&$institucionb!='seleccionar')
			{
				
				$condicion.=" and idInstUni ='$institucionb'";		
			}
			if($sectorIniciab== "seleccionar" )
			{}
			else if(!empty($sectorIniciab))
			{
				$condicion.=" and idSectorIniciador ='$sectorIniciab'";
			}
			if(!empty($institucionAb)&& $institucionAb!='seleccionar')
			{
				
				$condicion.=" and idInstUniActual ='$institucionAb'";		
			}
			
			if($sectorActualb=="seleccionar")
			{}
			else if(!empty($sectorActualb))
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb) )
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
			
		}//cierra serie
		else if(!empty($institucionb)&&$institucionb!='seleccionar')
		{
		
			
			$condicion="where idInstUni='$institucionb'";
			
			
			 if(!empty($sectorIniciab)&&$sectorIniciab!='seleccionar')
			{
				$condicion.=" and idSectorIniciador ='$sectorIniciab'";
			}
			if(!empty($institucionAb)&&$institucionAb!='seleccionar')
			{
				$condicion.=" and idInstUniActual ='$institucionAb'";		
			}
			
			 if(!empty($sectorActualb)&&$sectorActualb!="seleccionar")
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		}//fin instu
		
		else if(!empty($sectorIniciab) && $sectorIniciab!='seleccionar')
		{	
			 "entra a la busq por sector inicial";
			$condicion=" where idSectorIniciador='$sectorIniciab'";
					
			if(!empty($institucionAb) && $institucionAb!='seleccionar')
			{
				$condicion.=" and idInstUniActual ='$institucionAb'";		
			}
			
			if($sectorActualb=="seleccionar")
			{}
			else if(!empty($sectorActualb))
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
			$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		}//cierra sector iniciador
		else if(!empty($institucionAb)&& $institucionAb!='seleccionar')
		{
			
 			$condicion=" where idInstUniActual='$institucionAb'";
						
			if(!empty($sectorActualb)&&$sectorActualb!="seleccionar")
			{
				$condicion.=" and idSectorActual ='$sectorActualb'";
			}		
					
			
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaE."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		
		}
		
		else if(!empty($sectorActualb) && $sectorActualb!='seleccionar')//abre sector actual
		{			
			
			$condicion="where idSectorActual='$sectorActualb'";
			
				
			if(!empty($fechab))
			{
				$condicion.=" and fechaCreacion like '%".$fechaC."%'";//ver si es con dd/mm/aa
			}
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
			
			
		}//cierra sector actual

		else if(!empty($fechab))
		{
			
			$condicion="where fechaCreacion='$fechaC'";
			
			
			if(!empty($cantiCopiasb))
			{
				$condicion.=" and cantidadCopias='$cantiCopiasb'";
			}
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
			$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		}
		else if(!empty($cantiCopiasb))
		{
			
			$condicion="where cantidadCopias='$cantiCopiasb'";
			if(!empty($cantiFoliosb))
			{
				$condicion.=" and cantidadFolios='$cantiFoliosb'";
			}
				$condicion.=" and estado='$estadob'";
				
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}//fin cantidad copias
		elseif(!empty($cantiFoliosb))
		{
			
			$condicion="where cantidadFolios='$cantiFoliosb'";
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($estadob))
		{	
			
						
			$condicion="where estado='$estadob'";
			if(!empty($dnib))
			{
				$condicion.=" and dniAlum='$dnib'";
			}
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
			
		}//cierra tipo usuario
		
		
		else if(!empty($dnib))		
		{
			
			$condicion="where dniAlum='$dnib'";
			
			if(!empty($nombreAlumnob))
			{
				$condicion.=" and nomAlum like '%".$nombreAlumnob."%'";
			}
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($nombreAlumnob))
		{

			$condicion="where nomAlum like '%".$nombreAlumnob."%'";
			
			if(!empty($apellidoAlumnob))
			{
				$condicion.=" and apellAlum like '%".$apellidoAlumnob."%'";
			}
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($apellidoAlumnob))
		{
			
			$condicion="where apellAlum like '%".$apellidoAlumnob."%'";
			if(!empty($dniProfb))
			{
				$condicion.=" and dniDocente='$dniProfb'";
			}
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($dniProfb))
		{
			
			
				$condicion=" where dniDocente='$dniProfb'";
			
			if(!empty($nombreProfb))
			{
				$condicion.=" and nombreDocente like '%".$nombreProfb."%'";
			}
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}		
		
		}
		else if(!empty($nombreProfb))
			{
				
				$condicion="where nombreDocente like '%".$nombreProfb."%'";
		
			if(!empty($apellidoProfb))
			{
				$condicion.=" and apellDocente like '%".$apellidoProfb."%'";
			}
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($apellidoProfb))
			{
				
				$condicion="where apellDocente like '%".$apellidoProfb."%'";
			
			if(!empty($codCarrerab))
			{
				$condicion.=" and codCarrera='$codCarrerab'";
			}
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}//fin apell docente
		
		else if(!empty($codCarrerab)) 
		{
			
				$condicion=" where codCarrera='$codCarrerab'";
			
			if(!empty($nomCarrerab))
			{
				$condicion.=" and nomCarrera like '%".$nomCarrerab."%'";
			}
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb))
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		
		}
		else if(!empty($nomCarrerab))
		{
			
			$condicion="where nomCarrera like '%".$nomCarrerab."%'";
			
			if(!empty($asignaturab))
			{
				$condicion.=" and asignatura like '%".$asignaturab."%'";
			}
			if(!empty($fechaElimb) )
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		
		
		else if(!empty($asignaturab))
		{
			
		
			$condicion="where asignatura like '%".$asignaturab."%'";
			
			if(!empty($fechaElimb) )
			{
			    $condicion.=" and fechaEliminacion='$fechaE'";
				
			}
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if (!empty($fechaElimb))
		{
			
			$condicion="where fechaEliminacion='$fechaE'";
			if(!empty($pasillob))
			{
				$condicion.=" and pasillo='$pasillob'";
			}
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($pasillob))
		{
			
			$condicion="where pasillo='$pasillob'";
			
			if(!empty($estanteb))
			{
				$condicion.=" and estante='$estanteb'";
			}
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($estanteb))
		{
			
			$condicion="where estante='$estanteb'";
			
			if(!empty($anaquelb))
			{
				$condicion.=" and anaquel='$anaquelb'";
			}
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($anaquelb))
		{
			
			$condicion="where anaquel='$anaquelb'";
			
			if(!empty($cajab))
			{
				$condicion.=" and caja='$cajab'";
			}
		}
		else if(!empty($cajab))
			{
				
				$condicion="where caja='$cajab'";
		
		    }
		
		
		
		
		
		
	

?>

<!-------------------------------------------------------------------------------------->

<?php
//La tabla solo muestra 20 registros
$registros = 6;
//pide la Pagina de los registros, que se manda por URL
$pagina = $_GET["pagina"];

if (!$pagina) { 
$inicio = 0; 
$pagina = 1; 

} 
else { 
$inicio = ($pagina - 1) * $registros; 


}

/*********************Arma la consulta correspondientes*******************/
	if(empty($info)){
		
		$resultado = mysql_query("SELECT * FROM documento  $condicion  LIMIT $inicio, $registros ");//ojo
		$resultados = mysql_query("SELECT idDocumento FROM documento $condicion"); 		
		$total_registros = mysql_num_rows($resultados);
		
	}
	else if(!empty($info)){
		

	$resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', nomAlum, apellAlum) as persona FROM documento 
 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE concat_ws(' ', nomAlum, apellAlum)='$info' and documento.estado='Activo' LIMIT $inicio, $registros ");
	$resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', nomAlum, apellAlum) as persona FROM documento 
 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE concat_ws(' ', nomAlum, apellAlum)='$info' and documento.estado='Activo' ");
	//$ejecutar_sql=mysql_query($resul);
	$cantidad=mysql_num_rows($resultados);//nombre y apell alumno
	$total_registros = mysql_num_rows($resultados);
	
	if($cantidad==0)//vemos alumno al reves
	{
		$resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', apellAlum, nomAlum) as persona FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE documento.estado='Activo' and concat_ws(' ', apellAlum,nomAlum )='$info' and documento.estado='Activo'  LIMIT $inicio, $registros ");
		$resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', apellAlum, nomAlum) as persona FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE documento.estado='Activo' and concat_ws(' ', apellAlum , nomAlum )='$info' and documento.estado='Activo' ");
		 
		$cantidad2=mysql_num_rows($resultados);//apell y nombre alumno
		$total_registros = mysql_num_rows($resultados);
	}
	if($cantidad2==0 && $cantidad==0)//va por nom y apell docentes 
	{
		
		$resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', nombreDocente , apellDocente) as persona FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE documento.estado='Activo' and concat_ws(' ', nombreDocente , apellDocente)='$info' and documento.estado='Activo' LIMIT $inicio, $registros ");
		$resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', nombreDocente , apellDocente) as persona FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE documento.estado='Activo' and concat_ws(' ', nombreDocente , apellDocente )='$info' and documento.estado='Activo'");
		$canti=mysql_num_rows($resultados);//nombre y apell docente
		$total_registros = mysql_num_rows($resultados);
			if ($canti==0 &&$cantidad2==0 && $cantidad==0 )
			{
				
				$resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
				 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
				 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
				 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
				 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ', apellDocente , nombreDocente) as persona FROM documento 
				 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
				 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE concat_ws(' ', apellDocente , nombreDocente )='$info' and documento.estado='Activo' LIMIT $inicio, $registros ");
				$resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
				 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
				 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
				 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
				 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion , concat_ws(' ' , apellDocente , nombreDocente ) as persona FROM documento 
				 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
				 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie WHERE concat_ws(' ' , apellDocente , nombreDocente  )='$info' and documento.estado='Activo' ");
				$canti2=mysql_num_rows($resultados);
				$total_registros = mysql_num_rows($resultados);
				
			}
			
		}
	if($cantidad2==0 && $cantidad==0 && $canti==0 && $canti2==0)//busqueda comun
	{
		
		
			$condicion="WHERE documento.estado='Activo' and (seriedocumental.nombre LIKE  '%".$info."%' or sectoruniversitario.nombre LIKE  '%".$info."%' or instu.nombre LIKE '%".$info."%' 
		or i.nombre LIKE '%".$info."%' or d.nombre LIKE  '%".$info."%' or documento.numDoc LIKE  '%".$info."%' and documento.numDoc!=0 or documento.anioCreacion like '%".$info."%' 
		and documento.anioCreacion!=0 or documento.fechaEliminacion = '$info' and documento.fechaEliminacion!= 0 or documento.Extracto like '%".$info."%' 
		and documento.Extracto!='' or documento.fechaCreacion like '%".$info."%' and documento.fechaCreacion!='0000-00-00'  or documento.dniAlum='$info' 
		and documento.dniAlum!=0 or documento.nomAlum like '%".$info."%' and documento.nomAlum!='' or documento.apellAlum like '%".$info."%' and documento.apellAlum!='' or documento.codCarrera='$info' and documento.codCarrera!=0 or documento.nomCarrera like '%".$info."%' 
		and documento.nomCarrera!='' or documento.cantidadCopias = '$info' and documento.cantidadCopias!=0 or documento.cantidadFolios = '$info' 
		and documento.cantidadFolios!=0 or documento.dniDocente='$info' and documento.dniDocente!=0 or documento.nombreDocente like '%".$info."%' and documento.nombreDocente!='' and documento.nombreDocente!='' 
		or documento.apellDocente like '%".$info."%' and documento.apellDocente!='' or documento.pasillo = '$info' and documento.pasillo!='' 
		or documento.estante = '$info' and documento.estante!='' or documento.anaquel = '$info' and documento.anaquel!='' or documento.caja = '$info' 
		and documento.caja!='' or documento.asignatura like '%".$info."%' and documento.asignatura!='' 
		or documento.Observaciones like '%".$info."%' and documento.Observaciones!='' or documento.estado LIKE  '%".$info."%')";

		 $resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie  $condicion LIMIT $inicio, $registros "); 
		 $resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente ,documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie $condicion"); 
		$canti3=mysql_num_rows($resultados);
		$total_registros = mysql_num_rows($resultados);
		
	}
	if($cantidad2==0 && $cantidad==0 && $canti==0 && $canti2==0 && $canti3==0)//corresponde a estado
	{
		$condicion="WHERE documento.estado LIKE  '%".$info."%'"; 

		 $resultado=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , 
		 documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , 
		 documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente , 
		 documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , 
		 documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual 
		 INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie  $condicion LIMIT $inicio, $registros "); 
		 $resultados=mysql_query("SELECT documento.idInstUni , documento.idDocumento, documento.numDoc , documento.anioCreacion , documento.idSerie , documento.idInstUniActual , documento.idSectorIniciador , documento.Extracto , documento.fechaCreacion , documento.dniAlum , documento.nomAlum , documento.apellAlum , documento.codCarrera , documento.nomCarrera , documento.cantidadCopias , documento.cantidadFolios , documento.dniDocente ,documento.nombreDocente , documento.apellDocente , documento.idSectorActual , documento.pasillo , documento.estante , documento.anaquel , documento.caja , documento.estado , documento.asignatura , documento.fechaEliminacion FROM documento 
		 INNER JOIN instu ON documento.idInstUni = instu.idInst INNER JOIN instu as i  ON i.idInst=documento.idInstUniActual  INNER JOIN sectoruniversitario ON sectoruniversitario.idSector = documento.idSectorIniciador INNER JOIN sectoruniversitario as d ON d.idSector = documento.idSectorActual INNER JOIN seriedocumental ON seriedocumental.idserie = documento.idSerie $condicion"); 
		
		$total_registros = mysql_num_rows($resultados);
	}
			

	
			
}//fin ele


$total_paginas = ceil($total_registros / $registros);
	

/***********************************Muesta la tabla con los resultados *********************************/


if(mysql_num_rows($resultado)==0)
	{
		echo
		"<FORM  action='' method='GET'>
		<p>&nbsp<p>
			<fieldset id='fs'  class='fieldset'>
				<legend>Mensaje</legend>
				<p>&nbsp<p>
				<p>No se encontraron resultados</p>
				<p>&nbsp<p>
			</fieldset>
		
		</form>
		";
		 
		
	}
	else
	{
	echo"<p>&nbsp;</p><div class='CSS_Table_Example' align= 'center''>";
	
	echo"<table width='50%' cellpadding='15'  class='CSS_Table_Example' align='center'  border='1px' cellspacing='1px'>";
		echo"<tr height='20px'><td>Nro. Doc</td><td>Año</td><td>Sector Actual</td><td>Sector Iniciador</td><td>Serie Documental</td>
		<td colspan='4'>Operaciones</td></tr>";
	}

$i=0;
while($r=mysql_fetch_array($resultado)) {
//Variable solo lectura

$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";
	
echo"<tr>";

	echo"<tr>";
		$idSectorI=$r["idSectorIniciador"];
		$idSectorA=$r["idSectorActual"];
		$idSerie=$r["idSerie"];
		$Uniactual=$r["idInstUniActual"];		
		$year=$r["anioCreacion"];		
		$documento=$r["numDoc"];
		$valor=$r["idDocumento"];
		$seriep=$r["idSerie"];

	
		$query =mysql_query("SELECT * FROM sectoruniversitario where idSector='$idSectorI'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$sectorI=$row['nombre'];

			}
		$query =mysql_query("SELECT *  FROM sectoruniversitario where idSector='$idSectorA'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
				$sectorA=$row['nombre'];
				
			}		
		$query =mysql_query("SELECT *  FROM seriedocumental where 	idserie='$idSerie'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
				$serieN=$row['nombre'];

			}	
		
		
		

		if($documento!=0)
		{
			echo"<td>".$r["numDoc"]."</td>";
		}
		else
		{
			echo"<td>S/N</td>";
		}
		
		
		if($r["anioCreacion"]!=0)
			{
			echo "<td>".$r["anioCreacion"]."</td>"; 		
			}
		else
			{
			echo "<td>S/A</td>"; 
			}	
		echo "<td>$sectorA</td>"; 
		echo "<td>$sectorI </td>"; 
		echo "<td>$serieN</td>";
		
		echo"<input type='hidden' name='valor' value=".$r["idDocumento"]." ></input>";
		echo"<input type='hidden' name='info' value='".$info."' ></input>";
		echo"<input type='hidden' name='id' value=".$r["idDocumento"]." ></input>";
		echo"<input type='hidden' name='fecha' value=".$r["fechaCreacion"]." ></input>";
		echo"<input type='hidden' name='numeroDoc' value=".$r["numDoc"]." ></input>";
		echo"<input type='hidden' name='anio' value=".$r["anioCreacion"]." ></input>";
		echo"<input type='hidden' name='extracto' value=".$r["Extracto"]." ></input>";
		echo"<input type='hidden' name='sectorInicia' value=".$r["idSectorIniciador"]." ></input>";
		echo"<input type='hidden' name='sectorActual' value=".$r["idSectorActual"]." ></input>";
		echo"<input type='hidden' name='serie' value=".$r["idSerie"]." ></input>";
		echo"<input type='hidden' name='estado' value=".$r["estado"]." ></input>";
		echo"<input type='hidden' name='institucionA' value=".$r["idInstUniActual"]." ></input>";
		echo"<input type='hidden' name='institucion' value=".$r["idInstUni"]." ></input>";
		echo"<input type='hidden' name='fecha' value=".$r["fechaCreacion"]." ></input>";
		echo"<input type='hidden' name='dni' value=".$r["dniAlum"]." ></input>";
		echo"<input type='hidden' name='nombreAlumno' value=".$r["nomAlum"]." ></input>";
		echo"<input type='hidden' name='apellidoAlumno' value=".$r["apellAlum"]." ></input>";
		echo"<input type='hidden' name='dniProf' value=".$r["dniDocente"]." ></input>";
		echo"<input type='hidden' name='nombreProf' value=".$r["nombreDocente"]." ></input>";
		echo"<input type='hidden' name='apellidoProf' value=".$r["apellDocente"]." ></input>";
		echo"<input type='hidden' name='codCarrera' value=".$r["codCarrera"]." ></input>";
		echo"<input type='hidden' name='nomCarrera' value=".$r["nomCarrera"]." ></input>";
		echo"<input type='hidden' name='cantiCopias' value=".$r["cantidadCopias"]." ></input>";
		echo"<input type='hidden' name='cantiFolios' value=".$r["cantidadFolios"]." ></input>";
		echo"<input type='hidden' name='asignatura' value=".$r["asignatura"]." ></input>";
		echo"<input type='hidden' name='pasillo' value=".$r["pasillo"]." ></input>";
		echo"<input type='hidden' name='estante' value=".$r["estante"]." ></input>";
		echo"<input type='hidden' name='anaquel' value=".$r["anaquel"]." ></input>";
		echo"<input type='hidden' name='caja' value=".$r["caja"]." ></input>";
		echo"<input type='hidden' name='fechaElim' value=".$r["fechaEliminacion"]." ></input>";
		echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
	echo"<input type='hidden' name='documento' value='".$documento."'/>";
echo"<input type='hidden' name='year' value='".$year."'/>";
echo"<input type='hidden' name='seriep' value='".$serie."'/>";
		
		$query =mysql_query("SELECT *  FROM registros where documento='$doc'");
	$movimientos = mysql_num_rows($query);
	$valor=$r["idDocumento"];
	?>
	<td rowspan="1"><input type="image" name="historial de movimientos" src="../images/url_historial.png" onclick="this.form.action='historialDoc.php'; this.form.submit()" onmouseover="mostrar(this)" onmouseout="ocultar(this)" title="Historial Documento"/></td>
	
	
	<td rowspan="1"><?php echo "<label><p><a href='pdfReporte.php?valor=$valor' target='_blank' ><img src='../images/text_page.png'></a></p></label>"; ?></td>
	
	
	<?php 
	
	
	?>
		
		<?php 
				if(in_array('Modificación Documento', $oper))
			{ ?>
		
			<td><input type="image" value="modificar" onclick="this.form.action='modificar_documento.php'; this.form.submit()"src="../images/edit.png" title="Modificar documento"/></td>
		
			<?php }		
			if(in_array('Baja Documento', $oper))
			{ ?>
			<td><input type="image" onclick="if (confirm('¿Desea confirmar la eliminación?')){ 
	  	this.form.action='eliminar_documento.php'; this.form.submit()}return false " value="eliminar" src="../images/delete.png" name="eliminar" title="Eliminar documento" > 
		</td>
			<?php
			} 
		
			
		echo "<tr><td rowspan='2'>Extracto</td>";
		$extracto=$r["Extracto"];
		if(!empty($extracto))
		{

			echo"<td colspan='8'>".substr($r["Extracto"],0,140).'...' ."</td>";

		}
		else
		{
			echo"<td colspan='8'>El presente documento no contiene extracto</td>";
		}
		
		echo"<input type='hidden' name='valor' value=".$r["idDocumento"]." ></input>";
		echo"<input type='hidden' name='info' value='".$info."' ></input>";
		echo"<input type='hidden' name='id' value=".$r["idDocumento"]." ></input>";
		echo"<input type='hidden' name='fecha' value=".$r["fechaCreacion"]." ></input>";
		echo"<input type='hidden' name='numeroDoc' value=".$r["numDoc"]." ></input>";
		echo"<input type='hidden' name='anio' value=".$r["anioCreacion"]." ></input>";
		echo"<input type='hidden' name='extracto' value=".$r["Extracto"]." ></input>";
		echo"<input type='hidden' name='sectorInicia' value=".$r["idSectorIniciador"]." ></input>";
		echo"<input type='hidden' name='sectorActual' value=".$r["idSectorActual"]." ></input>";
		echo"<input type='hidden' name='seriep' value=".$r["idSerie"]." ></input>";
		echo"<input type='hidden' name='estado' value=".$r["estado"]." ></input>";
		echo"<input type='hidden' name='institucionA' value=".$r["idInstUniActual"]." ></input>";
		echo"<input type='hidden' name='institucion' value=".$r["idInstUni"]." ></input>";
		echo"<input type='hidden' name='fecha' value=".$r["fechaCreacion"]." ></input>";
		echo"<input type='hidden' name='dni' value=".$r["dniAlum"]." ></input>";
		echo"<input type='hidden' name='nombreAlumno' value=".$r["nomAlum"]." ></input>";
		echo"<input type='hidden' name='apellidoAlumno' value=".$r["apellAlum"]." ></input>";
		echo"<input type='hidden' name='dniProf' value=".$r["dniDocente"]." ></input>";
		echo"<input type='hidden' name='nombreProf' value=".$r["nombreDocente"]." ></input>";
		echo"<input type='hidden' name='apellidoProf' value=".$r["apellDocente"]." ></input>";
		echo"<input type='hidden' name='codCarrera' value=".$r["codCarrera"]." ></input>";
		echo"<input type='hidden' name='nomCarrera' value=".$r["nomCarrera"]." ></input>";
		echo"<input type='hidden' name='cantiCopias' value=".$r["cantidadCopias"]." ></input>";
		echo"<input type='hidden' name='cantiFolios' value=".$r["cantidadFolios"]." ></input>";
		echo"<input type='hidden' name='asignatura' value=".$r["asignatura"]." ></input>";
		echo"<input type='hidden' name='pasillo' value=".$r["pasillo"]." ></input>";
		echo"<input type='hidden' name='estante' value=".$r["estante"]." ></input>";
		echo"<input type='hidden' name='anaquel' value=".$r["anaquel"]." ></input>";
		echo"<input type='hidden' name='caja' value=".$r["caja"]." ></input>";
		echo"<input type='hidden' name='fechaElim' value=".$r["fechaEliminacion"]." ></input>";
		echo"<input type='hidden' name='pagina' value='".$pagina."'/>";	
	
	
		
		
	
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='info' value='".$info."' ></input>";
		echo"<input type='hidden' name='idb' value='".$idb."' ></input>";
		echo"<input type='hidden' name='numeroDocb' value='".$numeroDocb."' ></input>";
		echo"<input type='hidden' name='aniob' value='".$aniob."' ></input>";
		echo"<input type='hidden' name='serieb' value='".$serieb."' ></input>";
		echo"<input type='hidden' name='sectorIniciab' value='".$sectorIniciab."' ></input>";
		echo"<input type='hidden' name='sectorActualb' value='".$sectorActualb."' ></input>";
		echo"<input type='hidden' name='estadob' value='".$estadob."'></input>";
		echo"<input type='hidden' name='extractob' value='".$extractob."' ></input>";
		echo"<input type='hidden' name='institucionb' value=".$institucionb." ></input>";
		echo"<input type='hidden' name='institucionAb' value=".$institucionAb." ></input>";
		echo"<input type='hidden' name='fechab' value=".$fechab." ></input>";
		
		echo"<input type='hidden' name='dnib' value=".$dnib." ></input>";
		echo"<input type='hidden' name='nombreAlumnob' value=".$nombreAlumnob." ></input>";
		echo"<input type='hidden' name='apellidoAlumnob' value=".$apellidoAlumnob." ></input>";
		echo"<input type='hidden' name='dniProfb' value=".$dniProfb." ></input>";
		echo"<input type='hidden' name='nombreProfb' value=".$nombreProfb." ></input>";
		echo"<input type='hidden' name='apellidoProfb' value=".$apellidoProfb." ></input>";
		echo"<input type='hidden' name='codCarrerab' value=".$codCarrerab." ></input>";
		echo"<input type='hidden' name='nomCarrerab' value=".$nomCarrerab." ></input>";
		echo"<input type='hidden' name='cantiCopiasb' value=".$cantiCopiasb." ></input>";
		echo"<input type='hidden' name='cantiFoliosb' value=".$cantiFoliosb." ></input>";
		echo"<input type='hidden' name='asignaturab' value=".$asignaturab." ></input>";
		echo"<input type='hidden' name='pasillob' value=".$pasillob." ></input>";
		echo"<input type='hidden' name='estanteb' value=".$estanteb." ></input>";
		echo"<input type='hidden' name='anaquelb' value=".$anaquelb." ></input>";
		echo"<input type='hidden' name='cajab' value=".$cajab." ></input>";
		echo"<input type='hidden' name='fechaElimb' value=".$fechaElimb." ></input>";
		
		echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
	
echo"</tr>";
echo "</form>";
}
echo"</table>
</div>"
;
/*********************************************************************************************************************/
echo"<p align='center'>";
/*PAGINACIO*/

if (empty($resultados) ){
echo"No se encuentran resultados";
}
else{//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) 
	{ 
		echo "<a href='busqueda.php?pagina=".($pagina-1)."&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb'>< Anterior</a> "; 
	}
//  muestra la cantidad de paginas...

	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='busqueda.php?pagina=$i&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionAb=$institucionAb&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb'>$i</a> "; 
				}
    	}
	
	}//fin if si registros en menor q 10
	 

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='busqueda.php?pagina=".($pagina+1)."&info=$info&idb=$idb&numeroDocb=$numeroDocb&aniob=$aniob&serieb=$serieb&sectorIniciab=$sectorIniciab&sectorActualb=$sectorActualb&estadob=$estadob&extractob=$extractob&institucionb=$institucionb&institucionAb=$institucionAb&fechab=$fechab&dnib=$dnib&nombreAlumnob=$nombreAlumnob&apellidoAlumnob=$apellidoAlumnob&dniProfb=$dniProfb&nombreProfb=$nombreProfb&apellidoProfb=$apellidoProfb&codCarrerab=$codCarrerab&nomCarrerab=$nomCarrerab&cantiCopiasb=$cantiCopiasb&cantiFoliosb=$cantiFoliosb&asignaturab=$asignaturab&pasillob=$pasillob&estanteb=$estanteb&anaquelb=$anaquelb&cajab=$cajab&fechaElimb=$fechaElimb'>Siguiente ></a>"; 
}}
echo"</p>";

 ?>
  <label><p><a href="documento.php">Volver a la P&aacute;gina Documento</a></p></label>  
  
</body>

</html>