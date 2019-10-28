<?php 
	session_start();

	$usuario 	= trim($_POST["usuario"]);
	$clave		= base64_encode(trim($_POST["clave"]));

	if($usuario == '' or $clave == '') {
		echo "<p style='color: #BA3838;'><b>El Usuario y/o Contraseña<br>No Pueden estar Vacios</b></p>";
		exit();
	}

	include("../connectar_sql.php");

		$SQL = "SELECT * FROM USERSYSTEM where usuario = '$usuario' and clave = '$clave' and activo = '1'";
		$ejecutar = sqlsrv_query($conexion_sql, $SQL);
		if($row = sqlsrv_fetch_array($ejecutar)){
			$_SESSION["user_putiks"] 		= $usuario;
			$_SESSION["user_putiks_role"] 	= $row["role"];
			echo 'ok';
		} else {
			echo "<p style='color: #BA3838;'><b>Usuario y/o Clave Incorrecta</b></p>";
		}
	
?>

