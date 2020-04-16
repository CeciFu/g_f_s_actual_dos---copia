<?php
error_reporting(E_PARSE);
include ("../conexion/funciones.php");

session_start();
if (!array_key_exists("user", $_SESSION)) {
    header("Location: ../principal/ingreso_sistema.php");
    exit;
}
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Areas</title>
<script language='javascript' src="../principal/gen_validatorv4.js"></script> 
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">
</head>

</script>
<script language="javascript">
function vaciar(control)
{
  control.value='';
}
function validarFecha()
{


var mes=fecha.mes.value
var anio=fecha.anio.value
var dia=fecha.dia.value

	if( (anio%4==0) && (anio%100!=0) || (anio%400==0) )
	{
		if(mes==1 || mes==3 || mes==5 || mes==7|| mes==8 || mes==10 || mes==12 )
		{
			dia=31;
			fecha.dia.length = 31;
			for(i=1 ; i<=31 ; i++)
	 		{			
	 		fecha.dia.options.text=i;
	 		}
		}
		
		if(mes==4 || mes==6 || mes==9 || mes==11)
		{
			dia=30;
			fecha.dia.length = 30;
			for(i=1 ; i<=30 ; i++)
	 		{
	 		fecha.dia.options.text=i;
	 		}
		}
		if(mes==2)
		{
			dia=29;
			fecha.dia.length = 29;
			for(i=1 ; i<=29 ; i++)
	 		{
	 		fecha.dia.options.text=i;
	 		}
		}
		

	}
	else
	{
		if(mes==1 || mes==3 || mes==5 || mes==7|| mes==8 || mes==10 || mes==12 )
		{
			dias=31;
			fecha.dia.length = 31;
			for(i=1 ; i<=31 ; i++)
	 		{
	 		fecha.dia.options.text=i;
	 		}
		}
		
		if(mes==4 || mes==6 || mes==9 || mes==11)
		{
			dias=30;
			fecha.dia.length = 30;
			for(i=1 ; i<=30 ; i++)
	 		{
	 		fecha.dia.options.text=i;
	 		}
		}
		if(mes==2)
		{
			dias=28;
			fecha.dia.length = 28;
			for(i=1 ; i<29 ; i++)
	 		{
	 		fecha.dia.options.text=i;
	 		}
		}

	}

	
	
}
</script>

<body>
<div class="divTitulo">
  <h1>&nbsp;</h1>
  <h1>Reporte: Documentos iniciados seg&uacute;n fecha espec&iacute;fica</h1>
<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
    <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
</div>
<?php
$dia = date (d);
$mes = date (n);
$anio=date(Y);
$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
if($_POST)
{
$dia=$_POST['dia'];
$mes=$_POST['mes'];
$mes=$meses[$mes-1];
$anio=$_POST['anio'];

}
?>
 
<!------Busquedas----------------------------------------------------------------------------------->	 
<form action="documentosPorFecha.php" method="post"  name="fecha" >
	<p >&nbsp;</p>
  <fieldset id="fs"  class="fieldset">
  <!------Busqueda Libre----------------------------------------------------------------------------------->
<legend >Ingresar datos</legend>
<table width="690" class="tabla">
      <tr>
        <td colspan="2"><div class="ayuda">Ingrese la fecha correspondiente </div></td>
      </tr>     
	  <tr>
	  <td > 
		<p> A&ntilde;o </p></td>
             <td> <select name="anio" onChange="validarFecha();">
			 
			<?php
			
			for($i=1950;$i<=2100;$i++)
				if($anio==$i)
				{
				?>
				<option value="<?php echo $i;?>" selected="selected"><?php echo $i; ?></option>
				<?php
				}
				else
				{
				?>
				<option value="<?php echo $i;?>"><?php echo $i; ?></option>
				<?php
			}
			?>
              </select>
   	  </td>	  
    </tr>
		 <tr>
	  <td > 
		<p> Mes </p></td>
             <td> <select name="mes" onChange="validarFecha();">

			 <?php
			
			for ($i=1; $i <=12; $i++)
				if ($mes==$i)
				{
				?>
				<option value="<?php echo $i; ?>" selected><?php echo $meses[$i-1]; ?></option>
				<?php
				}
				else
				{
				?>
				<option value="<?php echo $i; ?>"><?php echo $meses[$i-1]; ?></option>
				<?php
				}
			?>
			 </select>
   	  </td>	  
    </tr>
	 <tr>
	  <td > 
		<p> D&iacute;a </p></td>
	  <td>
	  <select name="dia" onChange="validarFecha();">
	
      <?php
	 
	  
	  if( ($anio%4==0) && ($anio%100!=0) || ($anio%400==0) )//anio biciesto
		{
			if($mes==1 || $mes==3 || $mes==5 || $mes==7|| $mes==8 || $mes==10 || $mes==12 )
			{
				for($i=1; $i<=31; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			}//fin mes
			else if($mes==4 || $mes==6 || $mes==9 || $mes==11)
			{
				for($i=1; $i<=30; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			}//fin else if
			else
			{
				for($i=1; $i<=29; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			
			}//fin else
	 }//fin anio
	 else//no es anio biciesto
	 {
	 	if($mes==1 || $mes==3 || $mes==5 || $mes==7|| $mes==8 || $mes==10 || $mes==12 )
			{
				for($i=1; $i<=31; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			}//fin mes
			else if($mes==4 || $mes==6 || $mes==9 || $mes==11)
			{
				for($i=1; $i<=30; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			}//fin else if
			else
			{
				for($i=1; $i<=28; $i++)
				{
					if ($dia==$i)
					{
						?>
						<option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
						<?php
					}
					else
					{
						?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php
					}
				}//fi  for
			
			}//fin else
	 
	 }
		
	?>
	 </select>
	  </td>	  
	  </tr>
  </table>
       <input name="buscar1" type="submit" class="inputBoton" value="Buscar" />
       
    
    </fieldset>
	<p >&nbsp;</p>
	 <td align="left"><p><label><a href="reportes.php">Volver a seleccionar reporte</a>
	</form >
	
  
  </body>
</html>
