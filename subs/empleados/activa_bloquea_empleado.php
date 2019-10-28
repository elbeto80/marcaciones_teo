<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $userid = $_POST["userid"];
    $op     = $_POST["op"];

    $SQL = "update USERINFO set activo = '$op' where USERID = '$userid'";
	$ejecutar = sqlsrv_query($conexion_sql, $SQL);
	$row = sqlsrv_fetch_array($ejecutar);
	echo $op;
?>