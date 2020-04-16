<?php 
error_reporting(E_PARSE);
//include ("../conexion/seguridad.php");
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
<script Language="JavaScript">
if(window.history.forward(1) != null)   window.history.forward(1);
</script>
<link rel="StyleSheet" media="screen" type="text/css" href="../principal/estilo.css">

</head>
<body>
 <div class="divTitulo"> 
    <h1>&nbsp;</h1>	
    <h1>Nuevo Usuario </h1>
	<?php  
  $tipo = $_SESSION['tipo'];

  $query = "SELECT nombreTipo FROM tipousuario WHERE idTipo = $tipo";
  $tipoUser = mysql_query($query);
  $row=mysql_fetch_array($tipoUser)
   ?>
 <p align="right" class="userTitle" > <?php  $id=$_SESSION["nombre"]." Usuario: ".$row['nombreTipo'];echo $id;?></p>
  </div>
<?php 
 if (isset($_POST['Enviar'] )){
 
	$dni= $_POST['dni']; 
	$nombre = $_POST['nombre']; 
	$apellido = $_POST['apellido'];
	$tel = $_POST['tel']; 
	$mail = $_POST['mail']; 
	$userName = $_POST['userName']; 
	$password = $_POST['contra'];
	$clave = md5($password);
	$estado=$_POST['estado'];	
	$tipo=$_POST['tipo'];
	$sector= $_POST['nivel3List'];
	$institucion= $_POST['nivel2List'];
	$carga=$_POST['carga'];
	echo"<FORM  action='' method='GET'>
		<p>&nbsp;<p>
	<fieldset id='fs'  class='fieldset'>
	<legend>Mensaje</legend>";
	
	// primero se debe buscar si el dni no existe
	$resultadoDNI=mysql_query("SELECT * FROM usuarios  where `dni`='$dni'");
	$resultado=mysql_query("SELECT * FROM usuarios  where `userName`='$userName'");
	$totalDNI = mysql_num_rows($resultadoDNI);
	$total = mysql_num_rows($resultado);
	$valor=$_POST['valor'];
	//echo $dni."total registros dni ".$totalDNI;
	if($totalDNI==0)
	{
		
		if ($total==0)
		{
		
		$que='INSERT INTO usuarios (`dni`, `nombre`, `apellido`, `telefono`, `email`, `userName`, `password`, `estado`, `tipoUsuario` , `IdSec`, `idInstu` )';
	
		$que.=" VALUES ('$dni','$nombre','$apellido','$tel','$mail','$userName','$clave','$estado','$tipo','$sector', '$institucion')";	
	
		
	    $res=mysql_query($que);
 
			if($res)
			{
			echo"<p>El registro se ha guardado con éxito</p>";
			echo"<p>&nbsp;
				</fieldset>
				</form>
			</p>";
			echo " <p><a href='alta_usuario.php?'>Volver a Alta Usuario</a></label></p>";
			}
			else
			{
			echo"<p>La operación no se pudo realizar </p>";
	
			echo"<p>&nbsp;
			</fieldset>
			</form>
			</p>";
			}

		
		}//fin if mismo nombre de usuario
	
		else
		{	
		
		echo"<p>El nombre de usuario ya existe, por favor ingrese un nuevo nombre de usuario</p>";
		$valor=1;
		echo"<p>&nbsp;
		
			</fieldset>
			</form>
		</p>";
		echo " <p><a href='alta_usuario.php?info=$info&valor=1&carga=$carga&dni=$dni&nombre=$nombre&apellido=$apellido&userName=$userName&password=$password&tel=$tel&mail=$mail&estado=$estado&tipo=$tipo&sector=$sector&institucion=$institucion'>Volver a Alta Usuario</a></label></p>";
		}
   	}//fin del if dni
	else //el nro  doc existe, debe ser el mismo nombre y apellido
	{
		
		$resultadoNYA=mysql_query("SELECT * FROM usuarios  where `nombre`='$nombre' and `apellido`='$apellido' and `dni`='$dni' ");
		$totalNYA = mysql_num_rows($resultadoNYA);
		if($totalNYA!=0)//el dni corresponde al mismo usuario cargado, verificar nombre de usuario
		{
			$resultadoUsuario=mysql_query("SELECT * FROM usuarios  where `userName`='$userName'");
			$totalUsu = mysql_num_rows($resultadoUsuario);
			if($totalUsu==0)//el nombre de usuario no existe, se puede cargar el usuario
			{
				$que='INSERT INTO usuarios (`dni`, `nombre`, `apellido`, `telefono`, `email`, `userName`, `password`, `estado`, `tipoUsuario` , `IdSec`, `idInstu` )';
			
				$que.=" VALUES ('$dni','$nombre','$apellido','$tel','$mail','$userName','$clave','$estado','$tipo','$sector', '$institucion')";	
			
				
				$res=mysql_query($que);
		 
				if($res)
				{
				echo"<p>El nuevo registro ha sido ingresado con éxito</p>";
				echo"<p>&nbsp</p>";
				echo"</fieldset>";
				echo " <p><a href='alta_usuario.php?'>Volver a Alta Usuario</a></label></p>";
				echo"</form>";
				
				}
				else
				{
				echo"<p>No se pudo realizar la operación, por favor vuelva a intentarlo.</p>";
		
				echo"<p>&nbsp;
				</fieldset>
				</form>
				</p>";
				echo " <p><a href='alta_usuario.php?info=$info&valor=$valor&carga=$carga&dni=$dni&nombre=$nombre&apellido=$apellido&userName=$userName&password=$password&tel=$tel&mail=$mail&estado=$estado&tipo=$tipo&sector=$sector&institucion=$institucion'>Volver a Alta Usuario</a></label></p>";
				}

			}//fin if para carga
			else//el nombre de usuarioya existe
			{
				
				echo"<p>El nombre de usuario ya existe, por favor ingrese un nuevo nombre de usuario</p>";
				$valor=1;
				echo"<p>&nbsp;
				</fieldset>
				</form>
				</p>";
				echo " <p><a href='alta_usuario.php?id=$id&info=$info&valor=$valor&dni=$dni&nombre=$nombre&apellido=$apellido&userName=$userName&password=$password&tel=$tel&mail=$mail&estado=$estado&tipo=$tipo&sector=$sector&institucion=$institucion'>Volver a Alta Usuario</a></label></p>";
			}
			
		}
		else//no corresponde dni y nombre y apellido
		{
			
				echo"<p>El DNI ya fue ingresado, y no corresponde con los datos del usuario existente</p>";
				$valor=1;
				echo"<p>&nbsp;
				</fieldset>
				</form>
				</p>";
				echo "<p><a href='alta_usuario.php?info=$info&dni=$dni&valor=$valor&nombre=$nombre&apellido=$apellido&userName=$userName&password=$password&tel=$tel&mail=$mail&estado=$estado&tipo=$tipo&institucion=$institucion&sector=$sector'>Volver a Alta Usuario</a></p>";
		}
	
	}

echo"</fieldset></from>
	
	<p>&nbsp;</p>
 	<p><a href='usuario.php?info=$info'>Volver a la página Usuario</a></label></p>";
  
 }
 ?>
</body>
</html>