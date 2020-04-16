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
   // $this->Image('http://170.210.92.223/asignaturas/lds/proyecto/gfs/images/unpa.jpg',30,5,13);
	//$this->Image('http://170.210.92.223/asignaturas/lds/proyecto/gfs/images/unpa.jpg',30,5,13);
	$this->SetFont('Arial','B',10);
	$this->Cell(70);
	//$this->Image('http://170.210.92.223/asignaturas/lds/proyecto/gfs/images/Filestore.jpg',170,5,20);
	//$this->Image('http://170.210.92.223/asignaturas/lds/proyecto/gfs/images/images/Filestore.jpg',170,5,20);
	//$pdf->SetFillColor(235);
	//$pdf->SetDrawColor(0,0,0);
	$this->SetFillColor(0,153,153);
	$this->SetTextColor(255,255,255);
   	$this->Cell(66,10,'Docentes por asignatura',"BR",1,'C', true);
	$this->Ln(14);
 
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
	$pdf->AliasNbPages(); //total de páginas
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
	
	//$pdf->Image('C:\xampp\htdocs\g_f_s_actual\images\unpa.jpg');
	$resul = mysql_query("SELECT * FROM documento where asignatura='$info'"); 	
		
	
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
		$pdf->Cell(110,5,"$nro / $anio ","TB",0,"c",true);
		//$pdf->Cell(30,5,"Año creación",1,0,"C");
		
		$pdf->Ln();
		$pdf->Cell(15);
		$nombre=$row['nombreDocente'];
		$apellido=$row['apellDocente'];
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);		
		$pdf->Cell(50,5,"Docente",1,0,"C",true);		
		//$pdf->Cell(30,5,$row['añoCreacion'],1,0,"c");		
		
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(110,5,"$nombre $apellido","TB",0,"c",true);
		$pdf->Ln();
		$pdf->Cell(15);
		//$pdf->Cell(30,5,"Institución inicial",1,0,"C");
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
		$pdf->Cell(110,5,"$II - $sectorI","TB",0,"c",true);
		$pdf->Ln();
		$pdf->Cell(15);
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
		$pdf->Cell(110,5,"$SI - $SA","TB",0,"c",true);
		$pdf->Ln();
		$pdf->Cell(15);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(50,5,"Asignatura",1,0,"C",true);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(255,255,255);
		$pdf->Cell(110,5,$row['asignatura'],"TB",1,"c",true);
		
		$pdf->SetFillColor();
		$pdf->Cell(190,0.5,"",1,1,"C",true);
		
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
	
	 $pdf->Output('Designados.pdf','D');
 ?>