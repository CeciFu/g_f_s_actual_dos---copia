<?php 
	error_reporting(E_PARSE);
	include ('../conexion/funciones.php');

	session_start();
	if (!array_key_exists("user", $_SESSION)) {
    	header('Location: ../principal/ingreso_sistema.php');
    	exit;
	}
    require('fpdf17/fpdf.php');
	
	$valor=$_GET["valor"];
		
	//Datos asociados a la busqueda
	
	


	class PDF extends FPDF{
	
	function Header()
	{
    
    // Logo de la cabecera del PDF
    
	$this->Image('../images/unpa.jpg',10,5,10);
	$this->SetFont('Arial','B',11);
	
	
	global $title;
	$this->Cell(15);
	//$this->SetFillColor(0,153,153);
	//$this->SetTextColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(255,255,255);
   	$this->MultiCell(160,10,$title,'B','C', true);
	$this->Cell(30);
	
	$this->Image('../images/Filestore.jpg',185,5,20);
	$this->Ln(12.5);

	}//cierra header
		function Footer()
		{
		// Posición: a 1,5 cm del final
		$this->SetY(-8);
		// Arial italic 8
		$this->SetFont('Arial','B',7);
		$this->SetTextColor(0,0,0);
		$this->SetFillColor(255,255,255);
		// Número de página
		$this->Cell(0,10,'File Store - Página '.$this->PageNo().'/{nb} - Unpa Uarg','T',1,'C',0);
		
		}//cierra footer
		
   }//cierra class pdf
		
	
	//crea nuevo pdf
	$pdf=new PDF();
		

	$resulSerie= mysql_query("SELECT * FROM documento WHERE  idDocumento=$valor" );
	while ($rSerie=mysql_fetch_array($resulSerie)){
	$seriep=$rSerie['idSerie'];
	$year=$rSerie['anioCreacion'];
	$documento=$rSerie['numDoc'];
	}
	
	
	$resulSerie= mysql_query("SELECT * FROM seriedocumental WHERE  idserie=$seriep" );
	while ($rSerie=mysql_fetch_array($resulSerie)){
	$nombreSerie =$rSerie['nombre'];
	}
	
	
	if($documento!=0)
	{
		$title='Reporte Documento '.$documento.'/ '.$year.'';
	}
	else
	{
		$title='Reporte Documento SN/ '.$year.'';
	}
	if($year!=0)
	{
		$title='Reporte Documento '.$documento.'/ '.$year.'';
	}
	else
	{
		$title='Reporte Documento '.$documento.'/SA';
	}
	
	$pdf->SetTitle($title);
	$pdf->AliasNbPages(); //total de página}
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
/******************************************************busca el id del documento***********************************************/
	$sql = mysql_query("SELECT * FROM documento WHERE idDocumento=$valor" );
	//numDoc=$documento and  anioCreacion=$year and idSerie=$serie

/******************************************************************************************************************************/		
		
		//$pdf->Cell(110,3,"",0,0,"c");	
						
		/*$pdf->Cell(82,5,"Origen",1,0,"C",true);
		$pdf->Cell(82,5,"Destino",1,0,"C",true);
		$pdf->Cell(19,5,"Recepción",1,0,"C",true);
		$pdf->Cell(23,5,"Receptor",1,0,"C",true);
		$pdf->Cell(12,5,"Folios",1,0,"C",true);
		$pdf->Cell(23,5,"Estado",1,0,"C",true);
		//$pdf->Ln();
		*/
	while ($r=mysql_fetch_array($sql))    
	{
/***********************************************************************************/
	$pdf->Ln();
		
	$idDocumento=$r["documento"];
	$institucionI=$r["idInstUni"];
	$institucionA=$r["idInstUniActual"];
	$idSectorOrigen=$r["idSectorIniciador"];		
	$idSectorDestino=$r["idSectorActual"];
	$fechaC=$r["fechaCreacion"];
	$copias=$r["cantidadCopias"];
	$folios=$r["cantidadFolios"];
	$extracto=$r["Extracto"];
	$observaciones=$r["Observaciones"];
	$estadoD=$r["estado"];
	$dniA=$r["dniAlum"];
	$nombreA=$r["nomAlum"];
	$apellidoA=$r["apellAlum"];
	$dniP=$r["dniDocente"];
	$nombrP=$r["nombreDocente"];
	$apellidoP=$r["apellDocente"];
	$codigoC=$r["codCarrera"];
	$nombrC=$r["nomCarrera"];
	$asignatura=$r["asignatura"];
	$pasillo=$r["pasillo"];
	$estante=$r["estante"];
	$anaquel=$r["anaquel"];
	$caja=$r["caja"];
	$fechas=explode("-", $fechaC);
			$dia = $fechas[2];
			$mes = $fechas[1];
			$anno = $fechas[0];
	$fechaA="$dia-"."$mes-"."$anno";
	


	$resultados2 = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucionI ."'");
	while($r2=mysql_fetch_array($resultados2)) {
	$II=$r2["nombre"];
	}
	$resultados3 = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucionA ."'");
	while($r3=mysql_fetch_array($resultados3)) {
	$IA=$r3["nombre"];
	}
	$resultados4 = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorOrigen ."'");
	while($r4=mysql_fetch_array($resultados4)) {
	$SO=$r4["nombre"];
	}
	$resultados5 = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorDestino ."'");
	
	while($r5=mysql_fetch_array($resultados5)) {
	$SD=$r5["nombre"];
	}
	
	
			
	/***********************************************************************************/
			
			//$pdf->Ln(0.3);
			//$pdf->SetFillColor();
		
	}//fin while
	$pdf->SetFont('Arial','I',10);
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(200,5,"Datos generales del documento",1,0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(-5);		
			$pdf->Cell(60,5,"Serie Documental",1,0,"C",true);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$nombreSerie","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();		
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);		
			$pdf->Cell(60,5,"Institución y Sector iniciador",1,0,"C",true);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$II - $SO","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);			
			$pdf->Cell(60,5,"Institución y Sector actual",1,0,"C",true);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);			
			$pdf->Cell(140,5,"$IA - $SD","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
						
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(60,5,"Fecha creación",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if($fechaA!='00-00-0000')					
			{
				$pdf->Cell(140,5,"$fechaA","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(140,5,"Sin fecha","LTBR",0,"C",true);
			}
			$pdf->Ln();
			$pdf->Ln();		
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);		
			$pdf->Cell(60,5,"Cantidad copias",1,0,"C",true);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$copias","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Cantidad folios",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$folios","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Extracto",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->MultiCell(140,5,substr($extracto,0,110).'...',"LTBR",1,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Observaciones",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->MultiCell(140,5,substr($observaciones,0,110).'...',"LTBR",1,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Estado",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$estadoD","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(200,5,"Datos Alumnos",1,0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"DNI",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if($dniA!=0)
			{
				$pdf->Cell(140,5,"$dniA","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(140,5,"","LTBR",0,"C",true);
			}	
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Nombre",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$nombreA","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Apellido",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$apellidoA","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(200,5,"Datos Profesor",1,0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"DNI",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if($dniA!=0)
			{
				$pdf->Cell(140,5,"$dniP","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(140,5,"","LTBR",0,"C",true);
			}	
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Nombre",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$nombreP","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Apellido",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$apellidoP","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(200,5,"Datos Carrera",1,0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Código",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if($dniA!=0)
			{
				$pdf->Cell(140,5,"$codigoC","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(140,5,"","LTBR",0,"C",true);
			}	
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Nombre",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$nombreC","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(60,5,"Asignatura",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(140,5,"$asignatura","LTBR",0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);
			$pdf->Cell(200,5,"Datos Ubicación",1,0,"C",true);
			$pdf->Ln();
			$pdf->Ln();
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(27,5,"Pasillo",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if(!empty($pasillo))
			{
				$pdf->Cell(27,5,"$pasillo","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(27,5,"","LTBR",0,"C",true);
			}
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(27,5,"Estante",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if(!empty($estante))
			{
				$pdf->Cell(27,5,"$estante","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(27,5,"","LTBR",0,"C",true);
			}
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(27,5,"Anaquel",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if(!empty($anaquel))
			{
				$pdf->Cell(27,5,"$anaquel","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(27,5,"","LTBR",0,"C",true);
			}
			
			$pdf->SetFillColor(0,153,153);
			$pdf->SetTextColor(255,255,255);
			$pdf->Cell(-5);				
			$pdf->Cell(27,5,"Caja",1,0,"C",true);			
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			if(!empty($caja))
			{
				$pdf->Cell(27,5,"$caja","LTBR",0,"C",true);
			}
			else
			{
				$pdf->Cell(27,5,"","LTBR",0,"C",true);
			}
			
	   $pdf->Output('ReporteCompleto.pdf','I');
 ?>