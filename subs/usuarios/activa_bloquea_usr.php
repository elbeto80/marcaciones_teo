<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $usuario = trim($_POST["usuario"]);
    $op 	 = trim($_POST["op"]);

    $SQL = "update USERSYSTEM set activo = '$op' where usuario = '$usuario'";
	$ejecutar = sqlsrv_query($conexion_sql, $SQL);
	$row = sqlsrv_fetch_array($ejecutar);
	echo $op;
?>