<?php 
	error_reporting(E_PARSE);
	include ('../conexion/funciones.php');

	session_start();
	if (!array_key_exists("user", $_SESSION)) {
    	header('Location: ../principal/ingreso_sistema.php');
    	exit;
	}
    require('fpdf17/fpdf.php');
	$documento=$_GET["documento"];
	$year=$_GET["year"];
	$serie=$_GET["serie"];

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
   	$this->MultiCell(240,10,$title,'B','C', true);
	$this->Cell(30);
	//$this->Image('C:\xampp\htdocs\g_f_s_actual\images\Filestore.jpg',185,5,20);

	$this->Image('../images/Filestore.jpg',268,5,20);

	$this->Ln(12);

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
	$pdf=new PDF('L');
	$documento=$_GET['documento'];
	$year=$_GET['year'];
	$idu=$_GET['idu'];
	$serie=$_GET['serie'];	
	$sql = mysql_query("SELECT * FROM documento WHERE idSerie='".$serie."' and numDoc='".$documento."' and  anioCreacion='".$year."' " );
	while ($row=mysql_fetch_array($sql))  
	{
	$idDoc =$row['idDocumento'];
	
	}
	$resulSerie= mysql_query("SELECT * FROM seriedocumental WHERE  idserie='".$serie."'" );
	while ($rSerie=mysql_fetch_array($resulSerie)){
	$nombreSerie =$rSerie['nombre'];
	}
	

	$title='Historial de movimientos documento NRO: '.$documento.' / '.$year.' Serie Documental: '.$nombreSerie.' ';
	$pdf->SetTitle($title);
	$pdf->AliasNbPages(); //total de página}
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
/******************************************************busca el id del documento***********************************************/
	$resul = mysql_query("SELECT * FROM movimiento INNER JOIN registros WHERE registros.documento='". $idDoc ."' and  idRmov=idremito "); 
	

/******************************************************************************************************************************/		
		
		//$pdf->Cell(110,3,"",0,0,"c");	
		$pdf->SetFont('Arial','I',10);
		$pdf->SetFillColor(0,153,153);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(-5);		
		$pdf->Cell(28,5,"Emisor",1,0,"C",true);
		$pdf->Cell(17,5,"Emisión",1,0,"C",true);				
		$pdf->Cell(82,5,"Origen",1,0,"C",true);
		$pdf->Cell(82,5,"Destino",1,0,"C",true);
		$pdf->Cell(19,5,"Recepción",1,0,"C",true);
		$pdf->Cell(23,5,"Receptor",1,0,"C",true);
		$pdf->Cell(12,5,"Folios",1,0,"C",true);
		$pdf->Cell(23,5,"Estado",1,0,"C",true);
		//$pdf->Ln();

	while ($r=mysql_fetch_array($resul))    
	{
/***********************************************************************************/
	$pdf->Ln();
	$idMov=$r["idRmov"];
	$fecha=$r["fecha"];
	$idUsuario=$r["idUsuario"];	
	$idDocumento=$r["documento"];
	$institucion1=$r["institucion1"];
	$institucion2=$r["institucion2"];
	$idSectorOrigen=$r["idSectorOrigen"];		
	$idSectorDestino=$r["idSectorDestino"];
	$fechad=$r["fechaD"];
	$estado=$r["estador"];
	$idUReceptor=$r["idUsuarioD"];	
	$resultados1= mysql_query("SELECT * FROM usuarios WHERE  idUsuarios='". $idUsuario ."'" );
	while ($r1=mysql_fetch_array($resultados1)){
	$idu =$r1['userName'];
	}
	$resultados= mysql_query("SELECT * FROM usuarios WHERE  idUsuarios='". $idUReceptor ."'" );
	while ($r0=mysql_fetch_array($resultados)){
	$iduR =$r0['userName'];
	}
	$resultados2 = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucion1 ."'");
	while($r2=mysql_fetch_array($resultados2)) {
	$io=$r2["nombre"];
	}
	$resultados3 = mysql_query("SELECT * FROM  instu WHERE idInst='". $institucion2 ."'");
	while($r3=mysql_fetch_array($resultados3)) {
	$idn=$r3["nombre"];
	}
	$resultados4 = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorOrigen ."'");
	while($r4=mysql_fetch_array($resultados4)) {
	$so=$r4["nombre"];
	}
	$resultados5 = mysql_query("SELECT * FROM  sectoruniversitario WHERE idSector='". $idSectorDestino ."'");
	
	while($r5=mysql_fetch_array($resultados5)) {
	$sd=$r5["nombre"];
	}
	$resultados6 = mysql_query("SELECT * FROM  registros WHERE idremito='". $idMov ."'");
	while($r6=mysql_fetch_array($resultados6)) {
	$remitFolios=$r6["foliosM"];
	}
	
		$fechas=explode("-", $fecha);
				$anno= $fechas[0];
				$mes = $fechas[1];
				$dia = $fechas[2];
		$fechasD=explode("-", $fechad);
				$annod= $fechasD[0];
				$mesd = $fechasD[1];
				$diad = $fechasD[2];		
	/***********************************************************************************/		
			$pdf->Cell(-5);			
			$pdf->SetFont('Arial','I',6.5);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(28,5,"$idu","LTBR",0,"C",true);
			$pdf->Cell(17,5,"$dia-$mes-$anno","LTBR",0,"C",true);					
			$pdf->Cell(82,5,"$io - $so","LTBR",0,"C",true);
			$pdf->Cell(82,5,"$idn-$sd","LTBR",0,"C",true);
			if($estado=="Confirmado")
			{
				$pdf->Cell(19,5,"$diad-$mesd-$annod","LTBR",0,"C",true);
				$pdf->Cell(23,5,"$iduR","LTBR",0,"C",true);		
			}
			else
			{
				$pdf->Cell(19,5,"No Confirmado","LTBR",0,"C",true);
				$pdf->Cell(23,5,"No Confirmado","LTBR",0,"C",true);
			}
			$pdf->Cell(12,5,"$remitFolios","LTBR",0,"C",true);
			$pdf->Cell(23,5,"$estado","LTBR",0,"C",true);	
			
			$pdf->Ln(0.3);
			$pdf->SetFillColor();
		
	}//fin while
	   $pdf->Output('HistorialMovimientos.pdf','I');
 ?>