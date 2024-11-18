<?php date_default_timezone_set('America/Lima'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="color:#00b3ba; font-weight: bold;">GDS Ocupacional -> Expediente Ocupacional <?php echo $_SESSION['fecha_ocupacional']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                    <form action="panel.php?modulo=expediente_ocupacional" method="POST">
                            <label for="update_fecha_ocupacional">Fecha: </label>
                            <input type="date" name="update_fecha_ocupacional" id="update_fecha_ocupacional" value=<?php echo $_SESSION['fecha_ocupacional'];?> >&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='#007bff';" onmouseout="this.style.backgroundColor='#00b3ba';" name="update_fecha_ocup" Value="Actualizar" class="btn btn-primary">
                    </form>
                    <br><br>

                    <?php /*if ($_SESSION['tipo_usuario']!=3 && $_SESSION['tipo_usuario']!=5 ){ ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal">Agregar Nuevo </button>
                    <?php } */?>
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead style="background-color:#00b3ba;color:#FFFFFF" >
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Subir DNI</th>
                                    <?php if($_SESSION['tipo_usuario']!=3 && $_SESSION['tipo_usuario']!=5){ ?>
                                    <th>Expediente - Medico</th>
                                    <th>Expediente - Paciente</th>
                                    <?php } ?>
                                    <?php if($_SESSION['tipo_usuario']!=3 && $_SESSION['tipo_usuario']!=5){ ?>
                                    <th>Acciones</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['dni'] .'<br>'.$row['nombre'] ?></td>
                                        <td><?php echo $row['fecha'] ?></td>
                                        <td>
                                			<button type="button" class="btn btn-default" onclick="SubirDNI(<?php echo $row['dni'] ?>)"><img src="images/logo_subir.png" width="25" /></button>
                                			<?php if (file_exists("Ocupacional/Expedientes/DNI-ADELANTE-".$row['dni'].".jpg") && file_exists("Ocupacional/Expedientes/DNI-ATRAS-".$row['dni'].".jpg")) { ?>
                                            	&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-success">OK</span>
                                            <?php } ?>
                                            <?php
                                            if (file_exists("Ocupacional/Expedientes/DNI_F-".$row['dni'].".pdf") && $_SESSION['tipo_usuario']!=3) { ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" onclick="BajarPdfDni(<?php echo $row['dni'] ?>)"><img src="images/logo_bajar.png" width="25" /></button>
                                            <?php
                                                }
                                            ?>
                                		</td>
                                        <?php if($_SESSION['tipo_usuario']!=3 && $_SESSION['tipo_usuario']!=5){ ?>
                                        <td><button type="button" class="btn btn-default" onclick="SubirExpediente(<?php echo $row['dni'] ?>)"><img src="images/logo_subir.png" width="25" /></button></td>
                                        
                                        <td> <?php
                                            if (file_exists("Ocupacional/Expedientes/EXP-F-".$row['dni'].".pdf")) { ?>
                                                <button type="button" class="btn btn-default" onclick="BajarExpedienteFinal(<?php echo $row['dni'] ?>)"><img src="images/logo_bajar.png" width="25" /></button>
                                            <?php
                                                }}
                                            ?>
                                        </td>
                                        <?php if($_SESSION['tipo_usuario']!=3 && $_SESSION['tipo_usuario']!=5){ ?>
                                        <td>
                                                    <a data-toggle="modal" style="color:#00b3ba;" data-target="#EditModal" href="javascript:void(0);" onclick="document.getElementById('update_dni').value = <?= $row['dni'] ?>;document.getElementById('update_nombre').value = '<?= $row['nombre'] ?>';document.getElementById('update_ruc_empresa').value = '<?= $row['ruc_empresa'] ?>';document.getElementById('update_empresa').value = '<?= $row['empresa'] ?>';" title="Editar Medico" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="document.getElementById('delete_dni').value = <?= $row['dni'] ?>;document.getElementById('delete_nombre').value = '<?= $row['nombre'] ?>';" title="Eliminar Expediente" class="text-danger"> <i class="fas fa-trash"></i></a>
                                                    <button type="button" onclick="GenerarExpedienteFinal(<?php echo $row['dni'] ?>)"><img src="images/logo_geninforme.png" width="25" /> </button>

                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                                </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal para Ingresar -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Agregar Nuevo Expediente Ocupacional</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=expediente_ocupacional" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="add_fecha">Fecha</label>
                        <input type="date" name="add_fecha" id="add_fecha" placeholder="Fecha" class="form-control" required="required" value=<?php echo date("Y-m-d"); ?> >
                    </div>
                    <div class="form-group">
                        <label for="add_nombre">Nombre</label>
                        <input type="text" name="add_nombre" id="add_nombre" placeholder="Nombre" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_dni">DNI</label>
                        <input type="number" name="add_dni" id="add_dni" placeholder="DNI" class="form-control" required="required" minlength="8" maxlength="8">
                    </div>



                    <div class="form-group">
                        <label for="add_ruc_empresa">RUC Empresa</label>
                        <input type="text" name="add_ruc_empresa" id="add_ruc_empresa" placeholder="RUC" class="form-control" required="required" value="-" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="add_empresa">Empresa</label>
                        <input type="text" name="add_empresa" id="add_empresa" placeholder="Empresa " class="form-control" required="required" value="-" readonly="readonly">
                    </div>
                    <input type="submit" name="add_expedienteocupacional" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Modificar -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel">Editar Medico</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=expediente_ocupacional" method="POST">
                    <div class="form-group">
                        <label for="update_dni">DNI</label>
                        <input type="text" name="update_dni" id="update_dni" class="form-control" required="required" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="update_nombre">Nombre</label>
                        <input type="text" name="update_nombre" id="update_nombre" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_ruc_empresa">RUC Empresa</label>
                        <input type="text" name="update_ruc_empresa" id="update_ruc_empresa" class="form-control" value="" required="required" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="update_empresa">Empresa</label>
                        <input type="text" name="update_empresa" id="update_empresa" class="form-control" required="required">
                    </div>
                    <input type="submit" name="update_expedienteocupacional" id="update_medico" style="background-color:#00b3ba;" Value="Actualizar" class="btn btn-primary" readonly="readonly">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" style="background-color:#00b3ba; color:#ffffff" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para subir dni -->
<div class="modal fade" id="SubidaDNI" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Subida DNI</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=expediente_ocupacional" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="dni_detalle">DNI</label> <br>
                        <input type="text" name="dni_detalle" id="dni_detalle" class="form-control" required="required" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="dni_adelante">Parte Delantera DNI</label> <br>
                        <input type="file" name="dni_adelante" id="dni_adelante">
                    </div>
                    <div class="form-group">
                        <label for="dni_atras">Parte Trasera DNI</label><br>
                        <input type="file" name="dni_atras" id="dni_atras">
                    </div>
                    <br>
                    <input type="submit" name="dni_expedienteocupacional" id="dni_expedienteocupacional" Value="Registrar" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="SubidaExpediente" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Subida DNI</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=expediente_ocupacional" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="dni_detalle_ex">DNI</label> <br>
                        <input type="text" name="dni_detalle_ex" id="dni_detalle_ex" class="form-control" required="required" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="arc_expediente">Expediente</label> <br>
                        <input type="file" name="arc_expediente" id="arc_expediente">
                    </div>
                    <br>
                    <input type="submit" name="expediente_expedienteocupacional" id="expediente_expedienteocupacional" Value="Registrar" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Expediente Ocupacional</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=expediente_ocupacional" method="POST">
                    <input type="hidden" name="delete_dni" id="delete_dni" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar este Expediente Ocupacional?</label>
                        <input type="text" name="delete_nombre" id="delete_nombre" class="form-control" readonly>
                    </div>

                    <input type="submit" name="delete_expedienteocupacional" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>

function SubirDNI(dni) {
    $('#SubidaDNI').modal();
    document.getElementById('dni_detalle').value =dni;
}

function SubirExpediente(dni) {
    $('#SubidaExpediente').modal();
    document.getElementById('dni_detalle_ex').value =dni;
}

function GenerarExpedienteFinal(dni) {
    $.ajax({
          method: "POST",
          url: 'controllers/GenerarExpedienteFinal.php',
          data: {
              "dni": dni
            }
      })
      .done(function( retorno ) {
            location.reload();
      });       
      //window.open("controllers/GenerarExpedienteFinal.php?dni="+dni)
}
function BajarExpedienteFinal(dni) {
    window.open("Ocupacional/Expedientes/EXP-F-"+dni+".pdf")
}
function BajarPdfDni(dni) {
    window.open("Ocupacional/Expedientes/DNI_F-"+dni+".pdf")
}
</script>