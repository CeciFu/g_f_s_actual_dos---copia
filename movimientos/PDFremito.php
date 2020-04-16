 <?php 
	error_reporting(E_PARSE);
	include ('../conexion/funciones.php');

	session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;}
	else{
	$usuario =$_SESSION["user"];
	$id =$_SESSION["idUsuarios"];

}
    require('fpdf17/fpdf.php');
	
	
$remito =$_GET['remito'];
$fecha = $_GET['fecha'];
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anno = $_GET['anno'];	
$year =$_GET['year'];
$nivel2List=$_GET['nivel2List'];//istitucion1
$nivel2List1=$_GET['nivel2List1'];//institucion2
$nivel3List=$_GET['nivel3List'];//sectorORIGEN
$nivel3List1=$_GET['nivel3List1'];//sectorDESTINO
$observaciones =$_GET['observaciones'];
$documento1=$_GET['documento1'];
$year1=$_GET['year1'];
$documento2=$_GET['documento2'];
$year2=$_GET['year2'];

$documento3=$_GET['documento3'];
$year3=$_GET['year3'];

$documento4=$_GET['documento4'];
$year4=$_GET['year4'];

$documento5=$_GET['documento5'];
$year5=$_GET['year5'];

$documento6=$_GET['documento6'];
$year6=$_GET['year6'];

$documento7=$_GET['documento7'];
$year7=$_GET['year7'];

$documento8=$_GET['documento8'];
$year8=$_GET['year8'];

$documento9=$_GET['documento9'];
$year9=$_GET['year9'];

$documento10=$_GET['documento10'];
$year10=$_GET['year10'];

$doc1=$_GET['doc1'];
$doc2=$_GET['doc2'];
$doc3=$_GET['doc3'];
$doc4=$_GET['doc4'];
$doc5=$_GET['doc5'];
$doc6=$_GET['doc6'];
$doc7=$_GET['doc7'];
$doc8=$_GET['doc8'];
$doc9=$_GET['doc9'];
$doc10=$_GET['doc10'];


$idremito=$_GET['idremito'];
	
	class PDF extends FPDF{
	
	function Header()
	{
    // Logo de la cabecera del PDF

   $this->Image('../images/unpa.jpg',20,5,10);

	$this->SetFont('Arial','B',7);
	$this->Cell(40);


	$this->Image('../images/Filestore.jpg',160,5,20);
	$this->SetFillColor(0,153,153);
	$this->SetTextColor(255,255,255);
   	$this->Cell(100,5,'UNIVERSIDAD NACIONAL DE LA PATAGONIA AUSTRAL',"BR",1,'C', true);
 
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
		$this->Cell(0,5,'File Store - Página '.$this->PageNo().'/{nb} - Unpa Uarg','T',1,'C',0);
		//$this->Cell(0,5,"Página ".$this->PageNo(),'T',1,'C',0);
		
		}
		
		
	}	

/********************cabecera****************************************/
	$pdf=new PDF();
	$pdf->AliasNbPages(); //total de páginas
	$pdf->SetAutoPageBreak(true,8); 
	$pdf->AddPage();
	$pdf->Cell(110,3,"",0,0,"c");	
	$pdf->SetFont('Arial','I',7);
	$pdf->Ln(8);

/*********************consultas*********************************************/

$resultados = mysql_query("SELECT nombre, apellido FROM usuarios WHERE userName ='$usuario'");
$r=mysql_fetch_array($resultados);
$nombre=$r["nombre"];
$apellido=$r["apellido"];
 

$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN instu WHERE idRmov='". $idremito ."' and movimiento.institucion1=instu.IdInst ");
while($r=mysql_fetch_array($resultados)) {
$io=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN instu WHERE idRmov='". $idremito ."' and movimiento.institucion2=instu.IdInst ");
while($r=mysql_fetch_array($resultados)) {
$id=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN sectoruniversitario WHERE idRmov='". $idremito ."' and 
movimiento.idSectorOrigen=sectoruniversitario.idSector ");
while($r=mysql_fetch_array($resultados)) {
$so=$r["nombre"];
}
$resultados = mysql_query("SELECT * FROM   movimiento  INNER JOIN sectoruniversitario WHERE idRmov='". $idremito ."' and 
movimiento.idSectorDestino=sectoruniversitario.idSector ");
while($r=mysql_fetch_array($resultados)) {
$sd=$r["nombre"];
}
/************************************************************************/

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(30,8,"Nro de Remito",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',11);

$pdf->Cell(30,8, "  $remito / $year ","LTBR",0,"L",true);


$pdf->SetFont('Arial','I',7);
$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(30,8,"Fecha",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//$pdf->Cell(100,8,"$dia/$mes/$anno","LTBR",0,"C",true);
$pdf->Cell(100,8,"$fecha","LTBR",0,"C",true);

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(30,5,"Usuario",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$apellido, $nombre","LTBR",0,"c",true);


$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(30,5,"DE:",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$io - $so","LTBR",0,"c",true);



$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();

$pdf->Cell(30,5,"A:",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$id - $sd","LTBR",0,"c",true);


$pdf->Ln();

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->cell(30,5,"Observación ",1,0,"C",true);


$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//$pdf->Cell(160,5,"","LTBR",0,"C",true);
//$pdf->Ln();
$pdf->MultiCell(160,5,"$observaciones","LTBR",1,"C",true);
$pdf->Ln();




$pdf->SetFont('Arial','I',7);

/************************************************************************************************************************************/

if($documento1!=""){

$pdf->Cell(30,5,"N° Documento",1,0,'L',false);
$pdf->Cell(20,5,"Año",1,0,'C',false);
$pdf->Cell(20,5,"N° Copias",1,0,'L',false);
$pdf->Cell(20,5,"N° Folios",1,0,'L',false);
$pdf->Cell(100,5,"Serie Documental",1,0,'L',false);

$pdf->Ln();
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento= $doc1" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento1",1,0,'L',false);
$pdf->Cell(20,5,"$year1",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);

}
$pdf->Ln();
/**********************************************************************************************************************/
if($documento2!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc2 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento2",1,0,'L',false);
$pdf->Cell(20,5,"$year2",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if( $documento3!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc3 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento3",1,0,'L',false);
$pdf->Cell(20,5,"$year3",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);

}
$pdf->Ln();

/**********************************************************************************************************************/

if($documento4!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc4 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento4",1,0,'L',false);
$pdf->Cell(20,5,"$year4",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/


if($documento5!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc5 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento5",1,0,'L',false);
$pdf->Cell(20,5,"$year5",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/
	
if($documento6!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc6 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento6",1,0,'L',false);
$pdf->Cell(20,5,"$year6",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento7!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc7 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento7",1,0,'L',false);
$pdf->Cell(20,5,"$year7",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento8!=""){

$sql = mysql_query("SELECT * FROM documento WHERE   idDocumento='". $doc1 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento8",1,0,'L',false);
$pdf->Cell(20,5,"$year8",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento9!=""){

$sql = mysql_query("SELECT * FROM documento WHERE   idDocumento='". $doc9 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento9",1,0,'L',false);
$pdf->Cell(20,5,"$year9",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento10!=""){

$sql = mysql_query("SELECT * FROM documento WHERE   idDocumento='". $doc10 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento10",1,0,'L',false);
$pdf->Cell(20,5,"$year10",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln(15);
/**********************************************************************************************************************/

$pdf->Cell(15,5,"",0,0,'R',false);
$pdf->Cell(15,5,"....................................",0,0,'C',false);
$pdf->Cell(95,5,"",0,0,'R',false);
$pdf->Cell(65,5,"....................................",0,0,'C',false);

$pdf->Ln();
$pdf->Cell(15,5,"",0,0,'R',false);
$pdf->Cell(15,5,"Firma y Aclaración",0,0,'C',false);



$pdf->Cell(95,5,"",0,0,'R',false);
$pdf->Cell(65,5,"Firma y Sello",0,1,'C',false);


$pdf->Ln();

$pdf->Cell(0,5,"- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -",0,0,'L',true);

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln(10);
$pdf->Cell(30,8,"Nro de Remito",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,8, "  $remito / $year ","LTBR",0,"L",true);


$pdf->SetFont('Arial','I',7);
$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(30,8,"Fecha",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//$pdf->Cell(100,8,"$dia/$mes/$anno","LTBR",0,"C",true);
$pdf->Cell(100,8,"$fecha","LTBR",0,"C",true);

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(30,5,"Usuario",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$apellido, $nombre","LTBR",0,"c",true);


$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();
$pdf->Cell(30,5,"DE:",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$io - $so","LTBR",0,"c",true);



$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->Ln();

$pdf->Cell(30,5,"A:",1,0,"C",true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5, "$id - $sd","LTBR",0,"c",true);


$pdf->Ln();

$pdf->SetFillColor(0,153,153);
$pdf->SetTextColor(255,255,255);
$pdf->cell(30,5,"Observación ",1,0,"C",true);


$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(160,5,"","LTBR",0,"C",true);
$pdf->Ln();
$pdf->MultiCell(190,5,"$observaciones","LTBR",1,"C",true);

$pdf->Ln();




$pdf->SetFont('Arial','I',7);

/************************************************************************************************************************************/

if($documento1!=""){

$pdf->Cell(30,5,"N° Documento",1,0,'L',false);
$pdf->Cell(20,5,"Año",1,0,'C',false);
$pdf->Cell(20,5,"N° Copias",1,0,'L',false);
$pdf->Cell(20,5,"N° Folios",1,0,'L',false);
$pdf->Cell(100,5,"Serie Documental",1,0,'L',false);

$pdf->Ln();
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc1 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento1",1,0,'L',false);
$pdf->Cell(20,5,"$year1",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);

}
$pdf->Ln();
/**********************************************************************************************************************/
if($documento2!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc2 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento2",1,0,'L',false);
$pdf->Cell(20,5,"$year2",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if( $documento3!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc3 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento3",1,0,'L',false);
$pdf->Cell(20,5,"$year3",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);

}
$pdf->Ln();

/**********************************************************************************************************************/

if($documento4!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc4 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento4",1,0,'L',false);
$pdf->Cell(20,5,"$year4",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/


if($documento5!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc5 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento5",1,0,'L',false);
$pdf->Cell(20,5,"$year5",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/
	
if($documento6!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc6 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento6",1,0,'L',false);
$pdf->Cell(20,5,"$year6",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento7!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc7 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento7",1,0,'L',false);
$pdf->Cell(20,5,"$year7",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento8!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc8 ."'" );
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento8",1,0,'L',false);
$pdf->Cell(20,5,"$year8",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento9!=""){

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc9 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento9",1,0,'L',false);
$pdf->Cell(20,5,"$year9",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln();
/**********************************************************************************************************************/

if($documento10!=""){

$sql = mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc10 ."'");
while ($row=mysql_fetch_array($sql)){

$idSerie=$row['idSerie'];
$sql1 = mysql_query("SELECT * FROM seriedocumental WHERE  idserie='". $idSerie ."'" );
while ($row1=mysql_fetch_array($sql1)){
$serie=$row1['nombre'];
}
$copias1=$row['cantidadCopias'];
$folios1=$row['cantidadFolios'];

}

$pdf->Cell(30,5,"$documento10",1,0,'L',false);
$pdf->Cell(20,5,"$year10",1,0,'L',false);
$pdf->Cell(20,5,"$copias1",1,0,'L',false);
$pdf->Cell(20,5,"$folios1",1,0,'L',false);
$pdf->Cell(100,5,"$serie",1,0,'L',false);
}
$pdf->Ln(15);
/**********************************************************************************************************************/

$pdf->Cell(15,5,"",0,0,'R',false);
$pdf->Cell(15,5,"....................................",0,0,'C',false);
$pdf->Cell(95,5,"",0,0,'R',false);
$pdf->Cell(65,5,"....................................",0,0,'C',false);

$pdf->Ln();
$pdf->Cell(15,5,"",0,0,'R',false);
$pdf->Cell(15,5,"Firma y Aclaración",0,0,'C',false);



$pdf->Cell(95,5,"",0,0,'R',false);
$pdf->Cell(65,5,"Firma y Sello",0,1,'C',false);


$nombre="$remito /"."$year";

$pdf->Output("N:$nombre.pdf",'I');
 ?>