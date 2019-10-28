<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $op 	= $_POST["op"];
    $usr 	= $_POST["usr"];
?>

<style>
	.margin_bajo {
		margin-bottom: 0.7em;
	}
</style>

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><?php if($op == 'new') { echo "Crear"; } else { echo "Actualizar"; } ?> Usuario</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">

		<?php
			if($op == 'new') {
		?>
			    <form>
					<div class="form-group margin_bajo">
				    	<input type="text" class="form-control" id="usuario" placeholder="Usuario" autocomplete="off">
				  	</div>
				  	<div class="form-group margin_bajo">
				    	<input type="password" class="form-control" id="clave" placeholder="Password">
				  	</div>
				  	<div class="form-group margin_bajo">
				    	<input type="password" class="form-control" id="clave_confir" placeholder="Confirmar Password">
				  	</div>
				  	<div class="form-group text-center margin_bajo">
				  		<div class="form-check-inline">
							<label class="form-check-label">
						    	<input type="radio" class="form-check-input" name="role" value="0" checked><b>Observador</b>
						  	</label>
						</div>
				    	<div class="form-check-inline">
						 	<label class="form-check-label">
						    	<input type="radio" class="form-check-input" name="role" value="1"><b>Administrador</b>
						  	</label>
						</div>
				  	</div>
				  	<div id="info_usr" class="text-center" style="margin-bottom: 0.5em; color: #CC8080; font-size: 0.8em;"></div>
				  	<button type="button" class="btn btn-success btn-block" onclick="guardar_new_usr('new')"><b>Guardar</b></button>
				  	<button type="button" class="btn btn-info btn-block" onclick="usuarios_admin()"><b>Cancelar</b></button>
				</form>
		<?php 
			} else {
				 $SQL = "select * from USERSYSTEM where usuario = '$usr'";
				$ejecutar = sqlsrv_query($conexion_sql, $SQL);
				$row = sqlsrv_fetch_array($ejecutar);
		?>
				<form>
					<div class="form-group margin_bajo">
				    	<input type="text" class="form-control" id="usuario" placeholder="Usuario" autocomplete="off" value="<?=$row['usuario']?>" readonly>
				  	</div>
				  	<div class="form-group margin_bajo">
				    	<input type="password" class="form-control" id="clave" placeholder="Password">
				  	</div>
				  	<div class="form-group margin_bajo">
				    	<input type="password" class="form-control" id="clave_confir" placeholder="Confirmar Password">
				  	</div>
				  	<div class="form-group text-center margin_bajo">
				  		<div class="form-check-inline">
							<label class="form-check-label">
						    	<input type="radio" class="form-check-input" name="role" value="0" <?php if($row["role"] == '0') { echo 'checked'; } ?> ><b>Observador</b>
						  	</label>
						</div>
				    	<div class="form-check-inline">
						 	<label class="form-check-label">
						    	<input type="radio" class="form-check-input" name="role" value="1" <?php if($row["role"] == '1') { echo 'checked'; } ?>><b>Administrador</b>
						  	</label>
						</div>
				  	</div>
				  	<div id="info_usr" class="text-center" style="margin-bottom: 0.5em; color: #CC8080; font-size: 0.8em;"></div>
				  	<button type="button" class="btn btn-success btn-block" onclick="guardar_new_usr('edit')"><b>Actualizar</b></button>
				  	<button type="button" class="btn btn-info btn-block" onclick="usuarios_admin()"><b>Cancelar</b></button>
				</form>
		<?php				
			}
		?>
	
	</div>
 </div>