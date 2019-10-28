<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $usuario 		= trim($_POST["usuario"]);
    $clave 			= trim($_POST["clave"]);
    $clave_confir 	= trim($_POST["clave_confir"]);
    $role 			= trim($_POST["role"]);
    $op             = $_POST["op"];

    if($op == 'new') {
        if($usuario == '' or $clave == '' or $clave_confir == '') {
        	echo "<b>Debe Llenar todos los Datos</b>";
        	exit();
        }
        if($clave != $clave_confir) {
        	echo "<b>Las contraseñas deben ser Iguales</b>";
        	exit();
        }

        if(strlen($clave) < 6) {
        	echo "<b>La contraseña debe tener minimo 6 Caracteres</b>";
        	exit();	
        }
        
        $SQL = "select usuario from USERSYSTEM where usuario = '$usuario'";
    	$ejecutar = sqlsrv_query($conexion_sql, $SQL);
    	if($row = sqlsrv_fetch_array($ejecutar)) {
    		echo "<b>El Usuario ya esta Registrado</b>";
    		exit();
    	}

    	$clave = base64_encode($clave);
        $SQL = "insert into USERSYSTEM (usuario, clave, role) values ('$usuario', '$clave', '$role')";
    	$ejecutar = sqlsrv_query($conexion_sql, $SQL);
    	$row = sqlsrv_fetch_array($ejecutar);
    	echo 'ok';
    } else {
        if($clave_confir == '' and $clave == '') {
            $SQL = "update USERSYSTEM set role = '$role' where usuario = '$usuario'";
            $ejecutar = sqlsrv_query($conexion_sql, $SQL);
            $row = sqlsrv_fetch_array($ejecutar);
            echo 'ac';
        } else {
            if($clave != $clave_confir) {
                echo "<b>Las contraseñas deben ser Iguales</b>";
                exit();
            }

            if(strlen($clave) < 6) {
                echo "<b>La contraseña debe tener minimo 6 Caracteres</b>";
                exit(); 
            }
            
            $clave = base64_encode($clave);
            $SQL = "update USERSYSTEM set role = '$role', clave = '$clave' where usuario = '$usuario'";
            $ejecutar = sqlsrv_query($conexion_sql, $SQL);
            $row = sqlsrv_fetch_array($ejecutar);
            echo 'ac';
        }
    }
?>