<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");
?>

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Usuarios</h3>
    </div>
</div>

<div class="row">
    <div class="col-12 padding0">

	    <div class="table-responsive">
	    	 <table class="table table-bordered table-striped">
	        	<thead>
	          		<tr>
			          	<th>Nombre</th>
			          	<th>Role</th>
			          	<th>Activo</th>
			          	<th>Editar</th>
			          	<th>Acciones</th>
	          		</tr>
	        	</thead>
	        	<tbody>
		        	<?php
						$SQL = "SELECT * FROM USERSYSTEM where usuario != 'ADMIN'";
						$ejecutar = sqlsrv_query($conexion_sql, $SQL);
						while($row = sqlsrv_fetch_array($ejecutar)){
					?>

					<tr>
						<td><b><?=$row["usuario"]?></b></td>
						<td>
							<?php
								if($row["role"] == '1') {
									echo "<b>Administrador</b>";
								} else {
									echo "<b>Observador</b>";
								}
							?>
						</td>
						<td>
							<?php
								if($row["activo"] == '1') {
									echo "<b>SI</b>";
								} else {
									echo "<b>NO</b>";
								}
							?>
						</td>
						<td>
							<button class="btn btn-warning btn-block btn-xs" onclick="crear_new_user('edit', '<?=$row["usuario"]?>')"><b>Editar</b></button>
						</td>
						<td>
							<?php
								if($row["activo"] == '1') {
							?>
									<button class="btn btn-block btn-danger btn-xs" onclick="enable_deseable_usr('0', '<?=$row["usuario"]?>')"><b>Bloquear</b></button>
							<?php
								} else {
							?>
									<button class="btn btn-block btn-success btn-xs" onclick="enable_deseable_usr('1', '<?=$row["usuario"]?>')"><b>Activar</b></button>
							<?php
								}	
							?>
						</td>
					</tr>

					<?php } ?>
		        </tbody>
	    	</table>
	    </div>

		<div id="info_usr"></div>
	    <div class="col-12" style="margin-top: 2em;">
	    	<button class="btn btn-info btn-block" onclick="crear_new_user('new')"><b>Crear Usuario</b></button>
	    </div>

	</div>
 </div>