<?php 
	error_reporting(E_PARSE);
	include ('../conexion/funciones.php');

	session_start();
	if (!array_key_exists("user", $_SESSION)) {
    	header('Location: ../principal/ingreso_sistema.php');
    	exit;
	}
    require('fpdf17/fpdf.php');
	
	class PDF extends FPDF{
	
	function Header()
	{
    // Logo de la cabecera del PDF
    //$this->Image('C:\xampp\htdocs\g_f_s_actual\images\unpa.jpg',10,5,10);
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
	//$this->Image('C:\xampp\htdocs\g_f_s_actual\images\Filestore.jpg',185,5,20);
	$this->Image('../images/Filestore.jpg',185,5,20);
	$this->Ln(12.5);
 
	}
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
		//$this->Cell(0,5,"Página ".$this->PageNo(),'T',1,'C',0);
		
		}
		
		
	}	
	$dia=$_GET['dia'];
	$mes=$_GET['mes'];
	$anio=$_GET['anio'];

//	$dia="12";	
	if($dia<10 ){
		switch ($dia) {
			case 1:
				$dia="01";
				break;
			case 2:
				$dia="02";
				break;
			case 3:
				$dia="03";
				break;
			case 4:
				$dia="04";
				break;
			case 5:
				$dia="05";
				break;
			case 6:
				$dia="06";
				break;
			case 7:
				$dia="07";
				break;
			case 8:
				$dia="08";
				break;
			case 9:
				$dia="09";
				break;
		}

	}
	
	if($mes<10)
	{
		switch ($mes) {
			case 1:
				$mes="01";
				break;
			case 2:
				$mes="02";
				break;
			case 3:
				$mes="03";
				break;
			case 4:
				$mes="04";
				break;
			case 5:
				$mes="05";
				break;
			case 6:
				$mes="06";
				break;
			case 7:
				$mes="07";
				break;
			case 8:
				$mes="08";
				break;
			case 9:
				$mes="09";
				break;
		}
		//$mes="03";
	}
		
	//$pdf = new PDF();
	//$pdf->AliasNbPages();
	//$pdf->AddPage();	
    //$pdf=new FPDF();
    //$pdf->AddPage();
	$pdf=new PDF();
	$title='Documentos iniciados por fecha específica';
	$pdf->AliasNbPages(); //total de páginas
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
	$like="LIKE '";
	if($anio==0)
		{
			if($dia==0 && $mes!=0)//se pregunta por mes
			{
				//echo "Entra a mes solo";
				
				$info=$like."%-".$mes."-%'";
				
				
			}
			else if($dia!=0 && $mes==0)//solo por dia
			{
				//echo "entra a dia solo";
				$info=$like."%-".$dia."'";
			}
			else if($dia!=0 && $mes!=0)
			{
				$info=$like." %-".$mes."-".$dia." ' ";
			}
			
			
		}
		else 
		{
			if($mes==0 && $dia==0)//solo año
			{
				//echo "entra a anio solo";
				$info=$like."".$anio."-%'";
			}
			else if($mes!=00 && $dia==00)//año y mes
			{
				
				$info=$like."".$anio."-".$mes."-%'";
				
			}
			else if($mes==0 && $dia!=0)//año y dia
			{
				$info=$like."".$anio."-%-".$dia."'";
			}
			else//año dia y mes
			{
				$info=$like."".$anio."-".$mes."-".$dia."'";
			}
		}

	//$pdf->Image('C:\xampp\htdocs\g_f_s_actual\images\unpa.jpg');
	
	$resul = mysql_query("SELECT * FROM documento  WHERE fechaCreacion ".$info.""); 	
	//
	//		$resul = mysql_query("SELECT * FROM documento  WHERE fechaCreacion like '%-".$mes."-%'"); 	
	
	$pdf->Cell(110,3,"",0,0,"c");	
	$pdf->SetFont('Arial','I',8);


	while ($row=mysql_fetch_array($resul))    
	{
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Ln();
		$pdf->Cell(15);
		$nro=$row['numDoc'];
		$anio=$row['anioCreacion'];
		$pdf->Cell(50,5,"Nro Documento / año creación",1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(110,5,"$nro / $anio ","LTBR",0,"c",true);
		//$pdf->Cell(30,5,"Año creación",1,0,"C");
		
		$pdf->Ln();
		$pdf->Cell(15);
		$estado=$row['estado'];
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,5,"Fecha de creación y Estado",1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$fechab=$row['fechaCreacion'];
			$fechas=explode('-', $fechab);
			$dias = $fechas[2];
			$mess = $fechas[1];
			$annos = $fechas[0];
		$pdf->Cell(110,5,"$dias-$mess-$annos"." - "."$estado","LTBR",0,"c",true);	
		//$pdf->Cell(110,5,"","LTBR",1,"c",true);		
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);		
		$pdf->Cell(50,5,"Institución y Sector iniciador",1,0,"C",true);		
		//$pdf->Cell(30,5,$row['añoCreacion'],1,0,"c");		
		$idsecInicial=$row['idSectorIniciador'];
		$resul1 = mysql_query("SELECT nombre FROM sectoruniversitario where idSector=$idsecInicial");
			while ($r=mysql_fetch_array($resul1))    
			{
			$sectorI=$r['nombre'];
			//echo $row['nombreTipo'];
			} 
		$idII=$row['idInstUni'];
		$resul1 = mysql_query("SELECT nombre FROM instu where 	idInst=$idII");
			while ($r=mysql_fetch_array($resul1))    
			{
			$II=$r['nombre'];
			//echo $row['nombreTipo'];
			} 
		//$pdf->Cell(70,5,"$II",0,0,"c");
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(110,5,"$II - $sectorI","LTBR",0,"c",true);
		$pdf->Ln();
		$pdf->Cell(15);
		//$pdf->Cell(30,5,"Institución inicial",1,0,"C");
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,5,"Institución y Sector actual",1,0,"C",true);
		//$this->CellFitSpace(30,7, utf8_decode($fila['nombre'])
		$idSA=$row['idSectorActual'];
		$resul1 = mysql_query("SELECT nombre FROM sectoruniversitario where idSector=$idSA");
			while ($r=mysql_fetch_array($resul1))    
			{
			$SA=$r['nombre'];
			//echo $row['nombreTipo'];
			} 
		//$pdf->Cell(70,5,"$SA",0,0,"c");
		//$pdf->Ln();
		//$pdf->Cell(15);
		//$pdf->Cell(30,5,"Institución actual",1,0,"C");
		$idIA=$row['idInstUniActual'];
		$resul1 = mysql_query("SELECT nombre FROM instu where idInst=$idIA");
			while ($r=mysql_fetch_array($resul1))    
			{
			$SI=$r['nombre'];
			//echo $row['nombreTipo'];
			} 
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);	
		$pdf->Cell(110,5,"$SI - $SA","LTBR",0,"c",true);
		
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);		
		$pdf->Cell(50,5,"Ubicación",1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(110,5,"Pasillo: ".$row['pasillo']." - Estante:".$row['estante']." - Anaquel:".$row['anaquel']." - Caja:".$row['caja'],"LTBR",1,"c",true);
		
		//$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(160,5,"Extracto",1,0,"C",true);
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		if(!empty($row["Extracto"]))
		{		
		$pdf->MultiCell(160,5,substr($row["Extracto"],0,110).'...',"LTBR",1,"c",true);		
		}
		else
		{
		 $pdf->MultiCell(160,5,'El presente documento no contiene extracto',"LTBR",1,"c",true);		
		}
		$pdf->Ln(1.5);
		$pdf->SetFillColor();
		
	}
	
	
	 $pdf->Output('DocFecha.pdf','I');
 ?>