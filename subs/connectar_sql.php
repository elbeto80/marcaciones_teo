<?php 

	$serverName 	= 'W7-PC\SQL';  //Instancia del SQL Server

	$conectionInfo	= array("Database"=>'ZKAccess', "UID"=>"beto", "PWD"=>"x", "CharacterSet"=>"UTF-8");
	/*
		Datos para la conexión
		Database => Bases de datos a la q nos vamos a conectar
		UID => Usuario para conectar. Al SQL Server hay q habilitar q se puede conectar con los dos metodos
		PWD => Clave de coneción al SQL Server
	*/

	$conexion_sql 	= sqlsrv_connect($serverName, $conectionInfo);

	if(!$conexion_sql) {
		echo "<b>Conexión Fallida</b><br>";
		die( print_r(sqlsrv_errors(), true));
	} 

?>
