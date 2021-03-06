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
	//$this->Image('C:\xampp\htdocs\g_f_s_actual\images\Filestore.jpg',185,5,20);
	$this->Image('../images/Filestore.jpg',185,5,20);
	$this->Ln(12.5);
 
	}
		function Footer()
		{
		// Posici�n: a 1,5 cm del final
		$this->SetY(-8);
		// Arial italic 8
		$this->SetFont('Arial','B',7);
		$this->SetTextColor(0,0,0);
		$this->SetFillColor(255,255,255);
		// N�mero de p�gina
		$this->Cell(0,10,'File Store - P�gina '.$this->PageNo().'/{nb} - Unpa Uarg','T',1,'C',0);
		//$this->Cell(0,5,"P�gina ".$this->PageNo(),'T',1,'C',0);
		
		}
		
		
	}	
	
	
	$pdf=new PDF();
	$resul = mysql_query("SELECT * FROM documento where anioCreacion=$info"); 	
	$title='Creados en el a�o '.$info.'';		
	$pdf->AliasNbPages(); //total de p�ginas
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
	
	

	//$pdf->SetFillColor(0,153,153);
	//$pdf->SetTextColor(255,255,255);
	$pdf->Cell(70);
	$pdf->SetFont('Arial','U',8);
   //	$pdf->Cell(60,10,'Creados en el a�o '.$info.'',"",0,'C', false);
	$pdf->SetFont('Arial','I',8);
	$pdf->Ln(0.5);

	while ($row=mysql_fetch_array($resul))    
	{
		
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Ln();
		$pdf->Cell(15);
		$nro=$row['numDoc'];
		//$anio=$row['anioCreacion'];
		$pdf->Cell(50,5,"Nro Documento",1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		if($nro!=0)
		{
			$pdf->Cell(110,5,"$nro","LTBR",0,"c",true);
			//$pdf->Cell(30,5,"A�o creaci�n",1,0,"C");
		}
		else
		{
			$pdf->Cell(110,5,"S/N","LTBR",0,"c",true);		
		}	
		
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);		
		$pdf->Cell(50,5,"Instituci�n y Sector iniciador",1,0,"C",true);		
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
		//$pdf->Cell(30,5,"Instituci�n inicial",1,0,"C");
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,5,"Instituci�n y Sector actual",1,0,"C",true);
		//$this->CellFitSpace(30,7, utf8_decode($fila['nombre'])
		$idSA=$row['idSectorActual'];
		$resul1 = mysql_query("SELECT nombre FROM sectoruniversitario where idSector=$idSA");
			while ($r=mysql_fetch_array($resul1))    
			{
			$SA=$r['nombre'];
			//echo $row['nombreTipo'];
			} 
		
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
		$pdf->Cell(50,5,"Ubicaci�n",1,0,"C",true);
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
	
	
	 $pdf->Output('porAnio.pdf','I');
 ?>