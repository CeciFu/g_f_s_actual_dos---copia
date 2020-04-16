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
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
<script Language="JavaScript" src="../principal/gen_validatorv4.js"></script>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>

</head>
<body>
<div class="divTitulo"> 
    <h1>&nbsp;</h1>
    <h1>Nuevo Movimiento</h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
  <?php
if(isset($_POST['Cargar'])){
$remito =$_POST['remito'];
$fecha1=$_REQUEST['datepicker'];
$fechas=explode("/", $fecha1);
			$dia = $fechas[0];
			$mes = $fechas[1];
			$anno = $fechas[2];
	$fecha="$anno"."$mes"."$dia";
	$fecha2="$anno"."-"."$mes"."-"."$dia";
$valor=$_POST['valor'];	
$year =$_POST['year'];
$nivel2List=$_POST['nivel2List'];//istitucion1
$nivel2List1=$_POST['nivel2List1'];//institucion2
$nivel3List=$_POST['nivel3List'];//sectorORIGEN
$nivel3List1=$_POST['nivel3List1'];//sectorDESTINO


$observaciones =$_POST['observaciones'];
$documento1=$_POST['documento1'];
$year1=$_POST['year1'];

$documento2=$_POST['documento2'];
$year2=$_POST['year2'];

$documento3=$_POST['documento3'];
$year3=$_POST['year3'];

$documento4=$_POST['documento4'];
$year4=$_POST['year4'];

$documento5=$_POST['documento5'];
$year5=$_POST['year5'];

$documento6=$_POST['documento6'];
$year6=$_POST['year6'];

$documento7=$_POST['documento7'];
$year7=$_POST['year7'];

$documento8=$_POST['documento8'];
$year8=$_POST['year8'];

$documento9=$_POST['documento9'];
$year9=$_POST['year9'];

$documento10=$_POST['documento10'];
$year10=$_POST['year10'];

$copias1=$_POST['copias1'];
$copias2=$_POST['copias2'];
$copias3=$_POST['copias3'];
$copias4=$_POST['copias4'];
$copias5=$_POST['copias5'];
$copias6=$_POST['copias6'];
$copias7=$_POST['copias7'];
$copias8=$_POST['copias8'];
$copias9=$_POST['copias9'];
$copias10=$_POST['copias10'];
$folios1=$_POST['folios1'];
$folios2=$_POST['folios2'];
$folios3=$_POST['folios3'];
$folios4=$_POST['folios4'];
$folios5=$_POST['folios5'];
$folios6=$_POST['folios6'];
$folios7=$_POST['folios7'];
$folios8=$_POST['folios8'];
$folios9=$_POST['folios9'];
$folios10=$_POST['folios10'];

$doc1=$_POST['idDoc1'];
$doc2=$_POST['idDoc2'];
$doc3=$_POST['idDoc3'];
$doc4=$_POST['idDoc4'];
$doc5=$_POST['idDoc5'];
$doc6=$_POST['idDoc6'];
$doc7=$_POST['idDoc7'];
$doc8=$_POST['idDoc8'];
$doc9=$_POST['idDoc9'];
$doc10=$_POST['idDoc10'];
}
/*************************************************************************************************************************************/

$mensaje="";
$c=0;
$sectorA=0;
$sumar=0;
/************************doc1*********/
if($doc1!=""){ //si la variable es distinta de vacio se copruebas q el documento se encuentra en el sector

$sql= mysql_query("SELECT * FROM documento WHERE  idDocumento='". $doc1 ."' and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
$row=mysql_num_rows($sql);

if ( $row == 0  ) {
$me1="!";
$sectorA=$sectorA+1;
}

$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc1 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc1=$row['cantidadFolios'];
$copiasdoc1=$row['cantidadCopias'];


/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc1 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me1="!";
$sumar=$sumar +1;
$mensajeremito1="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento1/$year1  no se encuentra confirmado." ;

 }
else  
    if ($fecha2<$fecha_aceptacion)
	{
	
	$me1="!";
	$sumar=$sumar +1;
	$mensajeremito1="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento1/$year1." ;
	}

}//fin del if N 1


/************************doc2*********/

if($doc2!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc2 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me2="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc2 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc2=$row['cantidadFolios'];
$copiasdoc2=$row['cantidadCopias'];

/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc2 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me2="!";
$sumar=$sumar +1;
$mensajeremito2="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento2/$year2  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me2="!";
	$sumar=$sumar +1;
	$mensajeremito2="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento2/$year2." ;
	}

}//fin del if N 2
/************************doc3*********/
if($doc3!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc3 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me3="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc3 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc3=$row['cantidadFolios'];
$copiasdoc3=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc3 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me3="!";

$sumar=$sumar +1;
$mensajeremito3="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento3/$year3  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me3="!";
	$sumar=$sumar +1;
	$mensajeremito3="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento3/$year3." ;
	}

}//fin del if N 3
/************************doc4*********/

if($doc4!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc4 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me4="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc4 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc4=$row['cantidadFolios'];
$copiasdoc4=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc4 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me4="!";

$sumar=$sumar +1;
$mensajeremito4="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento4/$year4  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me4="!";
	$sumar=$sumar +1;
	$mensajeremito4="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento4/$year4." ;
	}

}//fin del if N 4

/************************doc5*********/
if($doc5!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc5 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me5="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc5 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc5=$row['cantidadFolios'];
$copiasdoc5=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc5 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me5="!";

$sumar=$sumar +1;
$mensajeremito5="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento5/$year5  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me5="!";
	$sumar=$sumar +1;
	$mensajeremito5="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento5/$year5." ;
	}

}//fin del if N 5


/************************doc6*********/
if($doc6!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc6 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me6="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc6 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc6=$row['cantidadFolios'];
$copiasdoc6=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc6 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me6="!";

$sumar=$sumar +1;
$mensajeremito6="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento6/$year6  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me6="!";
	$sumar=$sumar +1;
	$mensajeremito6="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento6/$year6." ;
	}

}//fin del if N 6
/************************doc7*********/
if($doc7!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc7 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me7="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc7 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc7=$row['cantidadFolios'];
$copiasdoc7=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc7 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me7="!";

$sumar=$sumar +1;
$mensajeremito7="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento7/$year7  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me7="!";
	$sumar=$sumar +1;
	$mensajeremito7="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento7/$year7." ;
	}

}//fin del if N 7


/************************doc8*********/
if($doc8!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc8 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0  ) {
$me8="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc8 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc8=$row['cantidadFolios'];
$copiasdoc8=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc8 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me8="!";

$sumar=$sumar +1;
$mensajeremito8="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento8/$year8  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me8="!";
	$sumar=$sumar +1;
	$mensajeremito8="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento8/$year8." ;
	}

}//fin del if N 8

/************************doc9*********/
if($doc9!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc9 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if ((mysql_num_rows($sql)==0)  ) {
$me9="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc9 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc9=$row['cantidadFolios'];
$copiasdoc9=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc9 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me9="!";

$sumar=$sumar +1;
$mensajeremito9="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento9/$year9  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me9="!";
	$sumar=$sumar +1;
	$mensajeremito9="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento9/$year9." ;
	}

}//fin del if N 9

/************************doc10*********/
if($doc10!=""){

$sql = mysql_query("SELECT *FROM documento WHERE  idDocumento='". $doc10 ."'and  idInstUniActual='". $nivel2List ."' and idSectorActual='". $nivel3List ."'"  );
if (mysql_num_rows($sql)==0 ) {
$me10="!";
$sectorA=$sectorA+1;
}
$sql = mysql_query("SELECT * FROM documento WHERE idDocumento='". $doc10 ."'");
$row=mysql_fetch_array($sql);
$foliosdoc10=$row['cantidadFolios'];
$copiasdoc10=$row['cantidadCopias'];
//echo"folios". $foliosdoc1 .",copias".  $copiasdoc1 ;
/**SI EL ULTIMOREMITO EN DONDE SE ENCUENTRA EL DOCUMENTO NO ESTA CONFIRMADO HAY ERROR**/
$sql = mysql_query("SELECT * FROM movimiento  inner join registros WHERE idRmov=idremito and documento='". $doc10 ."' ORDER BY idRmov DESC");
$row=mysql_fetch_array($sql);
$fechamov=$row['fecha'];
$fecha_aceptacion=$row['fechaD'];
$aniomov=$row['anio'];
$estador=$row['estador'];
$remitomov=$row['remito'];
if ($estador=="No confirmado"){
$me10="!";

$sumar=$sumar +1;
$mensajeremito10="El remito n° $remitomov/$aniomov en donde se encuentra el documento n° $documento10/$year10  no se encuentra confirmado." ;

 }
else  
        if ($fecha2<$fecha_aceptacion)
	{
	
	$me10="!";
	$sumar=$sumar +1;
	$mensajeremito10="Está intentando cargar una fecha anterior a la fecha de recepción ($fecha_aceptacion) del documento n° $documento10/$year10." ;
	}

}//fin del if N 10

//*********************************************DOCUMENTOS VAN AL MISMO SECTOR???************************************/
$mismo=0;
if( ($nivel2List == $nivel2List1) && ($nivel3List == $nivel3List1)){
$mismosector="El Sector de Destino no debe ser igual al Sector de Origen";
$mismo=1;
}

//********************************************DOCUMENTOS AL SECTOR DE ARCHIVOS??*****************************************************/
$archivo=0;

$sectori = mysql_query("SELECT * FROM sectoruniversitario WHERE  idSector='". $nivel3List1 ."'" );
while($r=mysql_fetch_array($sectori)) {
$nombres=$r['nombre'];
$ids=$r['idSector'];
}


if( $ids == 3){
$archivo=1;

}
//******************************************DOCUMENTOS QUE SALEN DEL SECTOR DE ARCHIVOS**************************************************//
$salen=0;

$sectori = mysql_query("SELECT * FROM sectoruniversitario WHERE  idSector='". $nivel3List ."'" );
while($r=mysql_fetch_array($sectori)) {
$nombres=$r['nombre'];
$ids=$r['idSector'];
}

if( $ids == 3){
$salen=1;
}


//***************************************+CONSULTA SI EXISTE EL REMITO********************************************************************/

$remitoigual=0;
$sql = mysql_query("SELECT remito, anio FROM movimiento WHERE  remito='". $remito ."'and  anio='". $year ."'" );
if (mysql_num_rows($sql)!= 0  || $remito=="") {
$aviso= " El número de remito ya se encuentra cargado.";
$remitoigual=1;
}

/*******************************************CONSULTA SI EL DOC ESTA EN EL AREA*****************************************************************************/

if($sectorA !=0){
$aviso2="No se pueden mover  los documentos que no se encuentran en este Sector .";
}
//***************************************EMPIEZA LA CARGA DE REMITO Y TODOS LOS REGISTROS************************************************************/
 if(($sectorA==0) && ($sumar==0)&& ($mismo==0) &&($remitoigual==0)){
 /*******************************************Busca el usuario **********************/
$sql = mysql_query("SELECT idUsuarios FROM usuarios WHERE  userName='". $usuario ."'" );

while ($row=mysql_fetch_array($sql))  
{
$idu=$row['idUsuarios'];
}


$carga='INSERT INTO movimiento (`idUsuario`,`fecha`,`anio`,`institucion1`,`institucion2`,`idSectorOrigen`,`idSectorDestino`,`remito`, `observacionO`)';
$carga.="VALUES ('$idu','$fecha','$year','$nivel2List','$nivel2List1','$nivel3List','$nivel3List1','$remito','$observaciones')";

$cargaprincipal=mysql_query($carga);

if($cargaprincipal){
$errorr=0;
}
else{

$mensajemysql="error"; 

}

/******************************************** Carga*********************************************************************************/
//if($mensajemysql!="error"){
$sql = mysql_query("SELECT idRmov  FROM movimiento WHERE  remito='". $remito ."'and  anio='". $year ."'" );

while ($row=mysql_fetch_array($sql))  
{
$idremito =$row['idRmov'];
}

if($doc1!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc1')";
$res1=mysql_query($que);

$res = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc1' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc1'");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc1'");
}
if(!empty($folios1)){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios1'  WHERE `idDocumento`='$doc1'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios1'  WHERE `idremito`='$idremito' and `documento`='$doc1'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc1'  WHERE `idremito`='$idremito' and `documento`='$doc1'");
}


if($copias1!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias1'  WHERE `idDocumento`='$doc1'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias1'  WHERE `idremito`='$idremito' and `documento`='$doc1'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc1'  WHERE `idremito`='$idremito' and `documento`='$doc1'");
}

}

if($doc2!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc2')";
$res=mysql_query($que);
$res = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc2' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc2' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `numDoc`='$documento2' and `anioCreacion`='$year2'");
}
if($folios2!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios2'  WHERE `idDocumento`='$doc2'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios2'  WHERE `idremito`='$idremito' and `documento`='$doc2'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc2'  WHERE `idremito`='$idremito' and `documento`='$doc2'");
}

if($copias2!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias2'  WHERE `idDocumento`='$doc2'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias2'  WHERE `idremito`='$idremito' and `documento`='$doc2'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc2'  WHERE `idremito`='$idremito' and `documento`='$doc2'");
}
}

if($doc3!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc3')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc3' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc3' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc3'");
}
if($folios3!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios3'  WHERE `idDocumento`='$doc3'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios3'  WHERE `idremito`='$idremito' and `documento`='$doc3'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc3'  WHERE `idremito`='$idremito' and `documento`='$doc3'");
}
if($copias3!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias3'  WHERE `idDocumento`='$doc3'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias3'  WHERE `idremito`='$idremito' and `documento`='$doc3'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc3'  WHERE `idremito`='$idremito' and `documento`='$doc3'");
}
}

if($doc4!=""){

$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc4')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc4' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc4' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc4'");
}
if($folios4!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios4'  WHERE `idDocumento`='$doc4'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios4'  WHERE `idremito`='$idremito' and `documento`='$doc4'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc4'  WHERE `idremito`='$idremito' and `documento`='$doc4'");
}
if($copias4!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias4'  WHERE `idDocumento`='$doc4'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias4'  WHERE `idremito`='$idremito' and `documento`='$doc4'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc4'  WHERE `idremito`='$idremito' and `documento`='$doc4'");
}
}

if($doc5!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc5')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc5' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc5' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc5'");
}
if($folios5!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios5'  WHERE `idDocumento`='$doc5'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios5'  WHERE `idremito`='$idremito' and `documento`='$doc5'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc5'  WHERE `idremito`='$idremito' and `documento`='$doc5'");
}
if($copias5!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias5'  WHERE `idDocumento`='$doc5'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias5'  WHERE `idremito`='$idremito' and `documento`='$doc5'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc5'  WHERE `idremito`='$idremito' and `documento`='$doc5'");
}
}

if($doc6!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc6')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc6' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc6' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc6'");
}
if($folios6!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios6'  WHERE `idDocumento`='$doc6'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios6'  WHERE `idremito`='$idremito' and `documento`='$doc6'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc6'  WHERE `idremito`='$idremito' and `documento`='$doc6'");
}
if($copias6!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias6'  WHERE `idDocumento`='$doc6'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias6'  WHERE `idremito`='$idremito' and `documento`='$doc6'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc6'  WHERE `idremito`='$idremito' and `documento`='$doc6'");
}
}

if($doc7!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc7')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc7'");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc7' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc7'");
}
if($folios7!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios7'  WHERE `idDocumento`='$doc7'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios7'  WHERE `idremito`='$idremito' and `documento`='$doc7'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc7'  WHERE `idremito`='$idremito' and `documento`='$doc7'");
}
if($copias7!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias7'  WHERE `idDocumento`='$doc7'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias7'  WHERE `idremito`='$idremito' and `documento`='$doc7'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc7'  WHERE `idremito`='$idremito' and `documento`='$doc7'");
}
}

if($doc8!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc8')";
$res=mysql_query($que);
$sql= mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc8' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc8' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc8'");
}
if($folios8!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios8'  WHERE `idDocumento`='$doc8'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios8'  WHERE `idremito`='$idremito' and `documento`='$doc8'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc8'  WHERE `idremito`='$idremito' and `documento`='$doc8'");
}
if($copias8!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias8'  WHERE `idDocumento`='$doc8'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias8'  WHERE `idremito`='$idremito' and `documento`='$doc8'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc8'  WHERE `idremito`='$idremito' and `documento`='$doc8'");
}
}

if($doc9!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc9')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc9' ");
if($archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc9' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc9'");
}
if($folios9!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios9'  WHERE `idDocumento`='$doc9'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios9'  WHERE `idremito`='$idremito' and `documento`='$doc9'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc9'  WHERE `idremito`='$idremito' and `documento`='$doc9'");
}
if($copias9!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias9'  WHERE `idDocumento`='$doc9'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias9'  WHERE `idremito`='$idremito' and `documento`='$doc1'");
}

else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc9'  WHERE `idremito`='$idremito' and `documento`='$doc9'");
}
}

if($doc10!=""){
$que='INSERT INTO registros (`idremito`,`documento`)';
$que.="VALUES ('$idremito','$doc10')";
$res=mysql_query($que);
$sql = mysql_query("UPDATE `documento` SET  `idInstUniActual`='$nivel2List1', `idSectorActual`='$nivel3List1'  WHERE `idDocumento`='$doc10' ");
if( $archivo==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Inactivo'  WHERE `idDocumento`='$doc10' ");
}
if($salen==1){
$res = mysql_query("UPDATE `documento` SET  `estado`='Activo'  WHERE `idDocumento`='$doc10'");
}
if($folios10!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadFolios`='$folios10'  WHERE `idDocumento`='$doc10'");
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$folios10'  WHERE `idremito`='$idremito' and `documento`='$doc10'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `foliosM`='$foliosdoc10'  WHERE `idremito`='$idremito' and `documento`='$doc10'");
}
if($copias10!=""){
$res = mysql_query("UPDATE `documento` SET  `cantidadCopias`='$copias10'  WHERE `idDocumento`='$doc10'");
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copias10'  WHERE `idremito`='$idremito' and `documento`='$doc10'");
}
else{
$res = mysql_query("UPDATE `registros` SET  `copiasM`='$copiasdoc10'  WHERE `idremito`='$idremito' and `documento`='$doc10'");
}
}

echo"<p>&nbsp;</p>";
echo"<fieldset id='fs'  class='fieldset'>";
echo"<legend>Mensaje</legend>";
echo"<p>&nbsp;</p>";
echo"<p>El registro se ha guardado con éxito.</p>";
echo"<p>&nbsp;</p>";
echo"</fieldset>";	

if($_POST['Cargar']){ 
echo " 
<script language=\"Javascript\" type=\"text/javascript\"> 
window.open('PDFremito.php?=$copias10&fecha=$fecha1&folios1=$folios1&folios2=$folios2&folios3=$folios3&folios4=$folios4&folios5=$folios5&folios6=$folios6&folios7=$folios7&folios8=$folios8&folios9=$folios9&folios10=$folios10&remito=$remito&idremito=$idremito&dia=$dia&mes=$mes&anno=$anno&year=$year&nivel2List=$nivel2List&nivel2List1=$nivel2List1&nivel3List=$nivel3List&nivel3List1=$nivel3List1&observaciones=$observaciones&documento1=$documento1&documento2=$documento2&documento3=$documento3&documento4=$documento4&documento5=$documento5&documento6=$documento6&documento7=$documento7&documento8=$documento8&documento9=$documento9&documento10=$documento10&year1=$year1&year2=$year2&year3=$year3&year4=$year4&year5=$year5&year6=$year6&year7=$year7&year8=$year8&year9=$year9&year10=$year10&doc1=$doc1&doc2=$doc2&doc3=$doc3&doc4=$doc4&doc5=$doc5&doc6=$doc6&doc7=$doc7&doc8=$doc8&doc9=$doc9&doc10=$doc10','_blank');

</script> 
"; 
}else{ 
}
echo"<p>&nbsp;</p>";
echo"<b><a href='alta_movimiento.php'>Nuevo Movimiento</a></b>";
echo"<p>&nbsp;</p>";
}//fin de carga
/************************MENSAJES DE ERROR***********************************************************************************/
else {
$valor=1;//para el control de los select cuando vuelve del error
echo"<p>&nbsp;</p>";
echo"<fieldset id='fs'  class='fieldset'>";
echo"<legend>Mensaje</legend>";
echo"<p>No se pudo realizar la operación.$aviso</p>";
echo"<p>$mensaje</p>";
echo"<p>$aviso1</p>";
echo"<p>$aviso2</p>";
echo"<p>$mismosector</p>";
echo"<p>$cargaprincipal</p>";
echo"<p>$mensajeremito1</p>";
echo"<p>$mensajeremito2</p>";
echo"<p>$mensajeremito3</p>";
echo"<p>$mensajeremito4</p>";
echo"<p>$mensajeremito5</p>";
echo"<p>$mensajeremito6</p>";
echo"<p>$mensajeremito7</p>";
echo"<p>$mensajeremito8</p>";
echo"<p>$mensajeremito9</p>";
echo"<p>$mensajeremito10</p>";
/*******************************************************************************************************************************/
echo"<p>&nbsp;</p>";
echo"</fieldset>";	
echo"<p>&nbsp;</p>";

echo"<b><a href='alta_movimiento.php?valor=$valor&folios1=$folios1&folios2=$folios2&folios3=$folios3&folios4=$folios4&folios5=$folios5&folios6=$folios6&folios7=$folios7&folios8=$folios8&folios9=$folios9&folios10=$folios10&me1=$me1&me2=$me2&me3=$me3&me4=$me4&me5=$me5&me6=$me6&me7=$me7&me8=$me8&me9=$me9&me10=$me10&remito=$remito&dia=$dia&mes=$mes&anno=$anno&year=$year&nivel2List=$nivel2List&nivel2List1=$nivel2List1&nivel3List=$nivel3List&nivel3List1=$nivel3List1&observaciones=$observaciones&documento1=$documento1&documento2=$documento2&documento3=$documento3&documento4=$documento4&documento5=$documento5&documento6=$documento6&documento7=$documento7&documento8=$documento8&documento9=$documento9&documento10=$documento10&year1=$year1&year2=$year2&year3=$year3&year4=$year4&year5=$year5&year6=$year6&year7=$year7&year8=$year8&year9=$year9&year10=$year10&copias1=$copias1&copias2=$copias2&copias3=$copias3&copias4=$copias4&copias5=$copias5&copias6=$copias6&copias7=$copias7&
copias8=$copias8&copias9=$copias9&copias10&doc1=$doc1&doc2=$doc2&doc3=$doc3&doc4=$doc4&doc5=$doc5&doc6=$doc6&doc7=$doc7&doc8=$doc8&doc9=$doc9&doc10=$doc10'> Volver a Nuevo Movimiento</a></b>";

echo"<p>&nbsp;</p>";
}

?>
<p>

 <label> <a href="movimiento.php">Volver a la página Movimiento</a></label>
</p>	 
</body>
</html>