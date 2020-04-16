<?php 
	error_reporting(E_PARSE);
	include ('../conexion/funciones.php');

	session_start();
	if (!array_key_exists("user", $_SESSION)) {
    	header('Location: ../principal/ingreso_sistema.php');
    	exit;
	}
    require('fpdf17/fpdf.php');
	$info=$_GET['info'];
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
//	$this->Image('C:\xampp\htdocs\g_f_s_actual\images\Filestore.jpg',185,5,20);
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
	$info=$_GET['info'];
	//$pdf = new PDF();
	//$pdf->AliasNbPages();
	//$pdf->AddPage();	
    //$pdf=new FPDF();
    //$pdf->AddPage();
	$pdf=new PDF();
	$title='Ingresados al archivo histórico en el año '.$info.'';
	$pdf->SetTitle($title);
	$pdf->AliasNbPages(); //total de páginas
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
	
	//$pdf->Image('C:\xampp\htdocs\g_f_s_actual\images\unpa.jpg');
	$resul = mysql_query("SELECT * FROM documento where anioCreacion=$info"); 	
		
	
	//$pdf->Cell(110,3,"",0,0,"c");	
	//$pdf->SetFont('Arial','I',8);
	$pdf->Cell(70);
	$pdf->SetFont('Arial','U',8);
   	//$pdf->Cell(60,10,'Ingresados al archivo histórico en el año '.$info.'',"",0,'C', false);
	$pdf->SetFont('Arial','I',8);
	$pdf->Ln(0.5);

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
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);		
		$pdf->Cell(50,5,"Institución y Sector iniciador",1,0,"C",true);		
		//$pdf->Cell(30,5,$row['anioCreacion'],1,0,"c");		
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
		$pdf->Cell(50,5,"Estado",1,0,"C",true);
		$estado=$row['estado'];
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);	
		$pdf->Cell(110,5,"$estado","LTBR",0,"c",true);
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,5,"Ubicación",1,0,"C",true);
		$estado=$row['estado'];
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);	
		$pdf->Cell(110,5,"Pasillo: ".$row['pasillo']." - Estante:".$row['estante']." - Anaquel:".$row['anaquel']." - Caja:".$row['caja'],"LTBR",1,"c",true);
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
	/*$r=mysql_fetch_array($resul);
	$valor=$r['idSectorIniciador'];
	$pdf->Ln();
	$pdf->Cell(30,10,"$info";
	
    $pdf->SetFont('Arial','B',12);
   	$pdf->Cell(30,10,'Nro Doc',1,'C');
	$pdf->Cell(30,10,'Año',1,'C');
	$pdf->Ln(); 
	$pdf->Cell(40,10,$info,'1','C');		
	$pdf->Cell(70,10,'nombre'.$r['idSectorIniciador'],'1','C');
   
	*/
	
	 $pdf->Output('ArchivoPorAnio.pdf','I');
 ?>