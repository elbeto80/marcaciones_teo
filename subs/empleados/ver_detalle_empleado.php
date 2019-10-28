<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $id 	= $_POST["id"];
    $cc 	= $_POST["cc"];
    $name 	= $_POST["name"];
    $op     = $_POST["op"];
    if($op == 'si') {
        $desde = $_POST["desde"];
        $hasta = $_POST["hasta"];
    }

    function saber_dia($nombredia) {
		$dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
		$fecha = $dias[date('N', strtotime($nombredia))];
		echo $fecha;
	}
?>

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Detalles <?=$name?></h3>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-6 text-center padding0">
        <label>Desde</label>
        <input type="date" name="desde" id="desde" value="<?php if($op == 'si') { echo $desde; } ?>">
    </div>
    <div class="col-6 text-center padding0">
        <label>Hasta</label>
        <input type="date" name="hasta" id="hasta"  value="<?php if($op == 'si') { echo date('Y-m-d', strtotime($_POST["hasta"]." - 0 day")); } ?>">
    </div>
    <div class="col-3"  style="padding: 0.3em 0 0.3em 0;">
        <button class="btn btn-success btn-block btn-xs" onclick="ver_detalle_empleado('<?=$id?>','<?=$cc?>','<?=$name?>','si')"><b>Filtrar</b></button>
    </div>
</div>

<div class="row">
    <div class="col-12 padding0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Dia</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($op != 'si') {
                            $desde = date("Y-m-d", strtotime($desde ."- 7 days"));
                            $hasta = date("Y-m-d");
                        }
                        for($fecha=$hasta;$fecha>=$desde;$fecha = date("Y-m-d", strtotime($fecha ."- 1 days"))){
                    ?>
                            <tr>
                                <td>
                                    <b><?=date("d/m/Y", strtotime($fecha))?></b>
                                </td>
                                <td>
                                    <b><?=saber_dia($fecha)?></b>
                                </td>
                                <td>
                                    <b>
                                        <?php 
                                                $SQL = "select top 1 USERID, convert(varchar(10), CHECKTIME, 120) as fecha, substring(convert(varchar, CHECKTIME),13,7) as hora from CHECKINOUT
                                                        where USERID = '$id' and FORMAT(CHECKTIME, 'yyyy-MM-dd') = '$fecha' and convert(char(8), CHECKTIME, 108) > '06:00'";
                                                $ejecutar = sqlsrv_query($conexion_sql, $SQL);
                                                if($row = sqlsrv_fetch_array($ejecutar)){
                                                    echo $row["hora"];
                                                    $verificar = $row["hora"];
                                                } else {

                                                    echo "";
                                                }
                                        ?>
                                    </b>
                                </td>
                                <td>
                                    <b>
                                        <?php 
                                                $fechamasdia = date("Y-m-d",strtotime($fecha."+ 1 days"));
                                                $SQL = "select top 1 * from
                                                        (
                                                            select USERID, convert(varchar(10), CHECKTIME, 120) as fecha, substring(convert(varchar, CHECKTIME),13,7) as hora, CHECKTIME from CHECKINOUT
                                                            where USERID = '$id' and FORMAT(CHECKTIME, 'yyyy-MM-dd') = '$fecha' and convert(char(8), CHECKTIME, 108) >= '06:00'
                                                            union
                                                            select USERID, convert(varchar(10), CHECKTIME, 120) as fecha, substring(convert(varchar, CHECKTIME),13,7) as hora, CHECKTIME from CHECKINOUT
                                                            where USERID = '$id' and FORMAT(CHECKTIME, 'yyyy-MM-dd') = '$fechamasdia' and convert(char(8), CHECKTIME, 108) < '06:00'
                                                        ) as F order by CHECKTIME desc";
                                                $ejecutar = sqlsrv_query($conexion_sql, $SQL);
                                                if($row = sqlsrv_fetch_array($ejecutar)){
                                                    if($verificar <> $row["hora"]) {
                                                        echo $row["hora"];
                                                    }
                                                } else {
                                                    echo "";
                                                }
                                        ?>
                                    </b>
                                </td>
                            </tr>
                    <?php                
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="info_empleados"></div>
        <div class="col-12"  style="padding: 0.3em 0 0.3em 0;">
            <form action="subs/ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
                <a href="javascript:;" id="exporta_xls" class="btn btn-block btn-success">
                    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    <b>Exportar</b>
                </a>
            </form>
        </div>
        <div class="col-12"  style="padding: 0.3em 0 0.3em 0;">
	       <button class="btn btn-primary btn-block" onclick="empleados_admin()"><b>Regresar</b></button>
        </div>

	</div>
</div>

<script>
    $("#exporta_xls").click(function(event) {
        $("#datos_a_enviar").val( $("<div>").append( $("#table1").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });
</script>