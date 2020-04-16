<?php 
error_reporting(E_PARSE);
include ('../conexion/funciones.php');

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: ../principal/ingreso_sistema.php');
    exit;
}

 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tiempo de conservaci&oacute;n</title>
<link rel="stylesheet" media="screen" type="text/css" href="../principal/table.css">
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

<body>

<div class="divTitulo">
  <h1>&nbsp;</h1>
  <?php
$nivel2List=$_GET["nivel2List"];
if (isset($_POST['buscar1'])){

$nivel2List=$_POST["nivel2List"];

}
if($nivel2List==1)
{
	$nombre=' al día de la fecha';
}
else if($nivel2List==2)
{
	$nombre='para este mes';
}
else
{
	$nombre='para este año';
}

?>
  <h1>Tiempo de conservaci&oacute;n  <?php echo $nombre;?></h1>
  <?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<h1>&nbsp;</h1>
<?php
//pide las variables para la consulta enviados por URL

//Datos de Institucion busqueda


?>
<!--------------------------------------Busqueda libre---------------------------------------------------->

<!--------------------------------------Busqueda Avanzada---------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------->
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
$inicio = ($pagina - 1) * $registros; }



/*********************Arma la consulta correspondientes*******************/

//primero buscamos resultados con tiempo de conservacion en años
$resultado = mysql_query("SELECT * FROM  `documento` INNER JOIN  `seriedocumental` WHERE documento.`idSerie` = seriedocumental.idSerie 
AND seriedocumental.tipoTiempo != 'permanente' and documento.`estado`='Activo'  LIMIT $inicio, $registros ");

$resultados = mysql_query("SELECT * FROM  `documento` INNER JOIN  `seriedocumental` WHERE documento.`idSerie` = seriedocumental.idSerie 
AND seriedocumental.tipoTiempo != 'permanente' and documento.`estado`='Activo'  "); 

$total_registros = mysql_num_rows($resultados);
$cantiResultados=$total_registros ;

$total_paginas = ceil($total_registros / $registros); 
echo "cantidadddddd".$total_registros;

/***********************************Muesta la tabla con los resultados *********************************/
if(mysql_num_rows($resultado)==0)
	{
		echo"<FORM  action='' method='GET'>
			<p>&nbsp;<p>
			<fieldset id='fs'  class='fieldset'>
			<legend>Mensaje</legend>
			<p>&nbsp;</p>
			<p>No se encontraron resultados.</p>";
		echo"<p>&nbsp;</p>
			</fieldset>
			<p>&nbsp;</p>
			</form>
			";
		 
		
	}
else{

echo"<p>&nbsp;</p>";
echo"<table width='50%' class='CSS_Table_Example' align='center'  >";
echo"<tr >
		<td>Nro. Doc</td>
		<td>Fecha creaci&oacute;n</td>
		<td>Estado</td>
		<td>Tiempo de conservación</td>
		<td>Ubicaci&oacute;n actual</td>
		<td>Instituci&oacute;n y sector actual</td>		
	</tr>";
   
   }


$i=0;
while($r=mysql_fetch_array($resultado)) {
/*$fecha = time() - strtotime($r["fechaCreacion"]);
//$hoy=$r["fechaCreacion"];
//$fechaCalculada=date(“Y-m-d”,strtotime($hoy.’ – 1 year’));
$fe=$r["fechaCreacion"];
  $calculo = add(new DateInterval('P1Y'));
echo "el calculo es ".$calculo;
	$fesss=date('Y-m-d');
echo "fecha con date".$fess;
	$otrafecha= date("Y-m-d",strtotime("$fesss"));//fecha hoy
	$fechass= date("Y-m-d",strtotime("$calculo"));//fecha sumada
echo "con fecha actual en otro nro ".$otrafecha . " y la calculada es ".$fechass;		

$fecha = new DateTime($r["fechaCreacion"]);
$fecha->add(new DateInterval('P1Y'));
//echo $fecha->format('Y-m-d') . "\n";

$valor=new DateTime($fecha);

$valor2=strtotime($r["fechaCreacion"]);



echo "calculada ".$valor. " y el otro ".$valor2;
*/


$hoy=date("Y-m-d");
$fech=$r["fechaCreacion"];
echo "fecha de creación ".$fech;
$valor=$r["valorTiempo"];
if($r["tipoTiempo"]=='años')
{
	$fech=$fech."+".$valor."year";


}
else if($r["tipoTiempo"]=='meses')
{
	$fech=$fech."+".$valor."month";
}
$f_caduca = strtotime("$fech",$fech);
      $f_caduca = date("Y-m-d",$f_caduca);
      $hoy = date("Y-m-d");
      echo "Fecha en la cual caduca:".$f_caduca ;
   	  echo"Fecha de actual:".$hoy;
       $f_hoy = strtotime($hoy);
      $f_hoy = floor($f_hoy/86400);
      // Se divide entre 86400, ya que este es el número de segundos que posee un día
      $f_caduca1 = strtotime($f_caduca);
      $f_caduca1 = floor($f_caduca1/86400);
      //f_compara nos sirve para determinar cuantos días faltan para que se vuelva a habilitar el envió de correo a un
      /*$f_hoy = strtotime($hoy);
      $f_hoy = floor($f_hoy/86400);
      // Se divide entre 86400, ya que este es el número de segundos que posee un día
      $f_caduca1 = strtotime($f_caduca);
      $f_caduca1 = floor($f_caduca1/86400);
      //f_compara nos sirve para determinar cuantos días faltan para que se vuelva a habilitar el envió de correo a un determinado usuario
      $f_compara = ($f_caduca1-$f_hoy);
      print "<b>Dias que faltan para caducar:</b> ".$f_compara . "<br>";
      if ($f_compara <= 0){
         //El valor de 1 nos indica que se debe actualizar la base de DATOS
         return true;
      } else {
         return false;
      }
/*echo "hoy ".$hoy." creacion ".$fech; 
$fe = strtotime("$fech +1 year",$fech);
$hoy=new DateTime($hoy);
//$fe->add(new DateInterval('P1Y'));
$f_caduca = DATE("Y-m-d",$fe);
$f_caduca1 = strtotime($f_caduca);
$f_caduca1 = floor($f_caduca1/86400);
$interval = $fech->diff($hoy);


//echo $fech->format('Y-m-d') . "\n";
//echo $hoy->format('Y-m-d') . "\n";

//echo $interval->FORMAT('%R%a días');
echo "mi fecha x favorrr ".$f_caduca1;

//echo calculaFecha("years",1,"$hoy");
*/
$i=$i+1; 
echo "<FORM id=$i  action='#' method='GET' name='form'>";

			
			$valor=$r["idDocumento"];	
			$idSectorI=$r["idSectorIniciador"];
			$idUniIni=$r["idInstUni"];
			$idSectorA=$r["idSectorActual"];		
			$Uniactual=$r["idInstUniActual"];		
			
			
			$query =mysql_query("SELECT * FROM sectoruniversitario where idSector='$idSectorI'");
	
	 	while ($row=mysql_fetch_array($query))    
			{
			$sectorI=$row['nombre'];
			
			}
			$query=mysql_query("SELECT *  FROM sectoruniversitario where idSector='$idSectorA'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$sectorA=$row['nombre'];
					
				}		
			$query=mysql_query("SELECT *  FROM instu where idInst='$Uniactual'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$UniActual=$row['nombre'];
					
				}
			$query=mysql_query("SELECT *  FROM instu where idInst='$idUniIni'");
		
			while ($row=mysql_fetch_array($query))    
				{
					$UniInic=$row['nombre'];
					
				}
			$f_compara = ($f_caduca1-$f_hoy);
			echo "valor de diassss ".$f_compara;
			if(($f_caduca1-$f_hoy)<0)
			{
				//echo "tiene que dar negativo";
			}	
			else if($f_compara==0)//es porque hoy vence el tiempo de conservación
				{
			$doc=$r["numDoc"];
			$fechas=explode("-", $r["fechaCreacion"]);
			$dia = $fechas[2];
			$mes = $fechas[1];
			$anno = $fechas[0];
			$fechaC="$dia-"."$mes-"."$anno";
			echo "<tr>";
			echo"<td>$doc</td>";			
			echo "<td>$fechaC</td>"; 					
			echo "<td>".$r["estado"]."</td>"; 
			if($r["valorTiempo"]==1)
			{
				echo "<td>".$r["valorTiempo"]."- año</td>"; 
			}
			else
			{
				echo "<td>".$r["valorTiempo"]."-".$r["tipoTiempo"]."</td>"; 	
			}
			//echo "<td>".$r["valorTiempo"]."-".$r["tipoTiempo"]."</td>"; 
			echo "<td> P:".$r["pasillo"]."-E:".$r["estante"]."-A:".$r["anaquel"]."-C:".$r["caja"]."</td>"; 
			echo "<td>$UniActual - $sectorA</td>";			
			echo "<tr><td>Extracto</td>";
			$extracto=$r["Extracto"];
			if(!empty($extracto))
			{
	
				echo"<td colspan='7'>".substr($r["Extracto"],0,140).'...' ."</td>";
	
			}
			else
			{
				echo"<td colspan='7'>El presente documento no contiene extracto</td>";
			}

		}//fin if de tiempo
	
	
	/**********************************Datos de Busqueda**************************************************************/
	echo"<input type='hidden' name='nivel2List' value='".$nivel2List."'/>";
	
	echo"<input type='hidden' name='nivel3List' value='".$nivel3List."'/>";
	echo"<input type='hidden' name='pagina' value='".$pagina."'/>";
		
echo "</form>";
}
echo"</table>";
/*********************************************************************************************************************/

	echo"<p align='center'>";
	/*PAGINACIO*/
	echo"<p align='center'>";
	/*PAGINACIO*/
	if (empty($resultado))
	{
	//echo"No se encuentran resultados";
	}
	else{//primero muestra el link a la pagina anterior ...
	if(($pagina - 1) > 0) 
	{ 
		echo "<a href='reporteTiempo.php?pagina=".($pagina-1)."&nivel2List=$nivel2List&nivel3List=$nivel3List'>< Anterior</a> "; 
	}
//  muestra la cantidad de paginas...

	if($total_paginas >1 && $pagina<$total_paginas )
	{ 
		echo "<b>".$pagina."</b> "; 
				
		for ($i=$pagina+1; $i<=$pagina+5; $i++){ 
				
				if($i<=$total_paginas){
					echo "<a href='reporteTiempo.php?pagina=$i&nivel2List=$nivel2List&nivel3List=$nivel3List'>$i</a> "; 
				}
    	}
	
	}//fin if si registros en menor q 10
	 

if(($pagina + 1)<=$total_paginas) { 
echo " <a href='reporteTiempo.php?pagina=".($pagina+1)."&nivel2List=$nivel2List&nivel3List=$nivel3List'>Siguiente ></a>"; 
}}
echo"</p>";
	
	
	if(mysql_num_rows($resultado)!=0)
	{
	echo"<label><p>";
		echo " <a href='?nivel2List=$nivel2List&nivel3List=$nivel3List'>Crear PDF</a></p></label>"; 
	 
	
	echo " "; 
	}
 echo " <label><p><a href='tiempodeconservacion.php?info=$info'>Volver a seleccionar opci&oacute;n</a> <a> &nbsp;</a> <a> &nbsp;</a><a href='reportes.php?info=$info'>Volver a seleccionar reporte</a></p></label>";
  ?>
  <p align="center">
		<label> 
	   
		<input type="hidden" name="action" value="add" />
		</label>
	  </p>	 
</body>
</html>



