<?php 
    session_start();

    if(!isset($_SESSION["user_putiks"])){
        header('Location: ./index.php');
    }

    include("../connectar_sql.php");

    $op = $_POST["op"];
?>

<div class="row page-titles">
    <div class="col-6 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Empleados</h3>
    </div>
    <div class="col-6 form-check text-right">
        <input type="checkbox" class="form-check-input" id="todos" name="todos" onchange="empleados_admin()" <?php if($op == true) { echo "checked"; } ?>>
        <label class="form-check-label" for="todos">Ver Todos</label>
    </div>
</div>

<div class="row">
    <div class="col-12 padding0">

        <div class="table-responsive">
             <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($op == true) {
                            $SQL = "SELECT * FROM USERINFO where Name <> 'administrador' order by name";
                        } else {
                            $SQL = "SELECT * FROM USERINFO where activo = '1' and Name <> 'administrador' order by name";
                        }
                        $ejecutar = sqlsrv_query($conexion_sql, $SQL);
                        $con=0;
                        while($row = sqlsrv_fetch_array($ejecutar)){
                            $con++;
                    ?>

                    <tr >
                        <td onclick="ver_detalle_empleado('<?=$row["USERID"]?>','<?=$row["Badgenumber"]?>','<?=$row["Name"]?>','no')">
                            <b><?=$con?></b>
                        </td>
                        <td onclick="ver_detalle_empleado('<?=$row["USERID"]?>','<?=$row["Badgenumber"]?>','<?=$row["Name"]?>','no')">
                            <b><?=$row["Badgenumber"]?></b>
                        </td>
                        <td onclick="ver_detalle_empleado('<?=$row["USERID"]?>','<?=$row["Badgenumber"]?>','<?=$row["Name"]?>','no')">
                            <b><?=$row["Name"]?></b>
                        </td>
                        <td onclick="ver_detalle_empleado('<?=$row["USERID"]?>','<?=$row["Badgenumber"]?>','<?=$row["Name"]?>','no')">
                            <b><?=$row["lastname"]?></b>
                        </td>
                        <td>
                            <?php 
                                    $SQL_activo = "select activo from USERINFO where USERID = '".$row["USERID"]."'";
                                    $ejecutar_activo = sqlsrv_query($conexion_sql, $SQL_activo);
                                    if($row_activo = sqlsrv_fetch_array($ejecutar_activo)){
                                        if($row_activo["activo"] == '1') {
                                            echo "<b>SI</b>";
                                        } else {
                                            echo "<b>NO</b>";
                                        }
                                    }
                            ?>
                        </td>
                        <td>
                            <?php 
                                $SQL_activo = "select activo from USERINFO where USERID = '".$row["USERID"]."'";
                                $ejecutar_activo = sqlsrv_query($conexion_sql, $SQL_activo);
                                if($row_activo = sqlsrv_fetch_array($ejecutar_activo)){
                                    if($row_activo["activo"] == '1') {
                            ?>
                                        <button class="btn btn-block btn-danger btn-xs" onclick="enabale_diseable_empleado('0', '<?=$row["USERID"]?>', '<?=$row["Name"]?>')"><b>Desactivar</b></button>
                            <?php 
                                    } else {
                            ?>
                                        <button class="btn btn-block btn-success btn-xs" onclick="enabale_diseable_empleado('1', '<?=$row["USERID"]?>', '<?=$row["Name"]?>')"><b>Activar</b></button>
                            <?php 
                                    }
                                }
                            ?>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div id="info_empleados"></div>

    </div>
 </div>