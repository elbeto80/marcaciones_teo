<?php 
	session_start();

	if(isset($_SESSION["user_putiks"])){
		header('Location: ./panel.php');
	}

	//$version = date("y").date("m").date("d").date("g").date("i").date("s");
	$version = date("W").substr("0".date("d"), -2).substr("0".date("H"), -2).substr("0".date("i"), -2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Las Putik's</title>

	<link rel="stylesheet" href="./css/bootstrap.min.css" >

	<link rel="stylesheet" type="text/css" href="./css/style_login.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		body {
			background-color: #f2f7f8;;
		}
	</style>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-12">
		        <h1 class="text-center login-title"><b>Control de Tiempos</b></h1>
		        <div class="account-wall">
		            <img class="profile-img" src="./images/logo.png" alt="">
		            <form class="form-signin" method="POST" action="/login">
		                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required autofocus autocomplete="off">
		                <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
		                <button class="btn btn-lg btn-primary btn-block" type="button" onclick="validar_login_usr()">Ingresar</button>
		            </form>
		            <div id="info_div" class="text-center"></div>
		         </div>
		    </div>
		</div>
	</div>

    <script src="./js/jquery-1.12.3.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <script src="./js/main_login.js?ver=<?=$version?>"></script>
	
</body>
</html>