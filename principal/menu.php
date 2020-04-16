<?php
//error_reporting(E_PARSE);
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
<title>Documento sin t&iacute;tulo</title>
<link rel="icon" type="image/png" href="/images/mifavicon.png" />
<link rel="StyleSheet" media="screen" type="text/css" href="menu.css">
</head>
<body>
<div id="navlist">
        <ul>
		    <li><img src ="../images/menu.png"></li>
			<li><a href="principal.php" target="_top">Inicio </a></li>
            
			<?php
			//session_start();
			$oper=array(); 
			$oper=$_SESSION["operaciones"];
				
			

		
		
				
				if(in_array('Alta Documento', $oper) || in_array("Baja Documento",$oper) || in_array("Modificación Documento",$oper)|| in_array("Consulta Documento",$oper))
				{?>
					<li><a href="../documentos/documento.php" target="dcha">Documentos</a></li>
				<?php }
				
				if(in_array('Movimientos', $oper) || in_array("Baja movimiento",$oper) || in_array("Modificación movimiento",$oper))
				{?>
					<li><a href="../movimientos/movimiento.php" target="dcha">Movimientos de Documentos</a></li>
				<?php			
				}
					//if(in_array('Alta usuario', $oper) || in_array("Baja Usuario",$oper) || in_array("Modificacion Usuario",$oper))
				{?>
				
					<li><a href="../reportes/reportes.php" target="dcha">Reportes</a></li>
					
				<?php }
				
						if(in_array('Alta usuario', $oper) || in_array("Baja Usuario",$oper) || in_array("Modificación Usuario",$oper))
				{?>
					<li><a href="../usuarios/usuario.php" target="dcha">Usuarios</a></li>
				<?php }
				
				
				if(in_array('Alta Institución', $oper) || in_array("Baja Institución",$oper) || in_array("Modificación Institución",$oper))
				{?>
					<li><a href="../institucion/institucion_universitaria.php" target="dcha">Instituciones</a></li>
				<?php }
				if(in_array('Alta Sector Universitario', $oper) || in_array("Baja Sector Universitario",$oper) || in_array("Modificación Sector Universitario",$oper))
				{?>
					<li><a href="../sectores/sector.php" target="dcha">Sectores Universitarios</a></li>
				    <?php }
				if(in_array('Alta Serie Documental', $oper) || in_array("Baja Serie Documental",$oper) || in_array("Modificación Serie Documental",$oper))
				{?>
					<li><a href="../series/Series.php" target="dcha">Series Documentales</a></li>
				<?php }
				
				if(in_array('Alta Tipo Usuario', $oper) || in_array("Baja Tipo Usuario",$oper) || in_array("Modificación Tipo Usuario",$oper))
				{?>
					<li><a href="../tipoUsuario/tipo_usuario.php" target="dcha">Tipo de Usuario</a></li>
				    <?php }			
				
				
			?>
           
            <li><a href="salir.php" target="_top" >Salir</a></li>
        </ul>

</div>

<div id="Layer1"></div>
</body>
</html>
