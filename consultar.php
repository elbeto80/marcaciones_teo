<?php 
	include("./subs/connectar_sql.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<table>
		<tr>
			<td>ID</td>
			<td>Nombre</td>
		</tr>

		<?php
			$SQL = "SELECT * FROM USERINFO where Badgenumber = '98699801'";
			$ejecutar = sqlsrv_query($conexion_sql, $SQL);
			if($row = sqlsrv_fetch_array($ejecutar)){
		?>

		<tr>
			<td><?php echo $row["Badgenumber"]; ?></td>
			<td><?php echo $row["Name"]; ?></td>
		</tr>

		<?php } ?>

	</table>
	
</body>
</html>