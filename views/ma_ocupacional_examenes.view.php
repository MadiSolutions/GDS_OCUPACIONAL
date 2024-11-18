<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 style="color:#00b3ba; font-weight: bold;">Maestros -> Pruebas Ocupacional</h1>
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
                    <button type="button" class="btn btn-primary" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='#007bff';" onmouseout="this.style.backgroundColor='#00b3ba';" data-toggle="modal" data-target="#AddModal">Agregar Nuevo</button>

                    <table id="example2" class="table table-bordered table-hover">
                            <thead style="background-color:#00b3ba;color:#FFFFFF" >
                                <tr>
                                    <th>ID</th>
                                    <th>Cod Interno</th>
                                    <th>Descripcion</th>
                                    <th>Costo</th>
                                    <th>Especialidad</th>                   
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_prueba'] ?></td>
                                        <td><?php echo $row['cod_interno'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td><?php echo $row['costo'] ?></td>
                                        <td><?php echo $row['especialidad'] ?></td>
                           
                        
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" style="color:#00b3ba;" data-target="#EditModal" href="javascript:void(0);" onclick="
                                              
                                                    document.getElementById('update_id_prueba').value ='<?= $row['id_prueba']?>';
                                                    document.getElementById('update_cod_interno').value ='<?= $row['cod_interno']?>';
                                                    document.getElementById('update_descripcion').value ='<?= $row['descripcion'] ?>';
                                                    document.getElementById('update_costo').value ='<?= $row['costo'] ?>';
                                                    document.getElementById('update_especialidad').value = '<?= $row['especialidad'] ?>';" title="Editar Prueba" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="
                                                    document.getElementById('delete_id_prueba').value ='<?= $row['id_prueba']?>';
                                                    document.getElementById('delete_cod_interno').value ='<?= $row['cod_interno']?>';"title="Eliminar Paciente" class="text-danger"> <i class="fas fa-trash"></i> </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
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
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Agregar Nueva Prueba Ocupacional</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_examenes" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="add_cod_interno">Cod interno</label>
                        <input type="text" name="add_cod_interno" id="add_cod_interno" placeholder="Cod_interno" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_descripcion">Descripcion</label>
                        <input type="text" name="add_descripcion" id="add_descripcion" placeholder="Descripcion" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="add_costo">Costo</label>
                        <input type="number" name="add_costo" id="add_costo" placeholder="Costo" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_especialidad">Especialidad</label><br>
                        <select name="add_especialidad" id='add_especialidad' required="required">  
                        	<option value="TRIAJE"> TRIAJE </option>  
                            <option value="TOMA_MUESTRAS"> TOMA DE MUESTRAS</option>  
                            <option value="TIPO_TOMA_MUESTRAS"> TIPO TOMA MUESTRAS </option>
                            <option value="EVA_MEDICA"> EVA_MEDICA </option>
                            <option value="OFTALMOLOGIA"> OFTALMOLOGIA </option>
                            <option value="PSICOLOGIA"> PSICOLOGIA </option>
                            <option value="ODONTOLOGIA"> ODONTOLOGIA </option>
                            <option value="RAYOS_X"> RAYOS_X </option>
                            <option value="AUDIOMETRIA"> AUDIOMETRIA </option>
                            <option value="ESPIROMETRIA"> ESPIROMETRIA </option>
                            <option value="ELECTROCARDIOGRAMA"> ELECTROCARDIOGRAMA </option>
                            <option value="PSICOSENSOMETRICO"> PSICOSENSOMETRICO </option>
                            <option value="PRUEBA_ESFUERZO"> PRUEBA_ESFUERZO </option>
                            <option value="ENTREVISTA"> ENTREVISTA </option>
                   
                        </select>  
                    </div>
        
        
                    <input type="submit" name="add_id_prueba" style="background-color:#00b3ba;" Value="Registrar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" style="background-color:#00b3ba; color:#ffffff" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Modificar -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color:#00b3ba;">

                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Editar Medico</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=ma_ocupacional_examenes" method="POST">
                    <input type="hidden" name="update_id_prueba" id="update_id_prueba" value="">
                    <div class="form-group">
                        <label for="update_cod_interno">Cod Interno</label>
                        <input type="text" name="update_cod_interno" id="update_cod_interno" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_descripcion">Descripcion</label>
                        <input type="text" name="update_descripcion" id="update_descripcion" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_costo">Costo</label>
                        <input type="number" name="update_costo" id="update_costo" class="form-control" required="required">
                    </div>
              
                    <div class="form-group">
                        <label for="update_especialidad">Especialidad</label><br>
                        <select name="update_especialidad" id='update_especialidad' required="required">  
                            <option value="TRIAJE"> TRIAJE </option>  
                            <option value="TOMA_MUESTRAS"> TOMA DE MUESTRAS</option>  
                            <option value="TIPO_TOMA_MUESTRAS"> TIPO TOMA MUESTRAS </option>
                            <option value="EVA_MEDICA"> EVA_MEDICA </option>
                            <option value="OFTALMOLOGIA"> OFTALMOLOGIA </option>
                            <option value="PSICOLOGIA"> PSICOLOGIA </option>
                            <option value="ODONTOLOGIA"> ODONTOLOGIA </option>
                            <option value="RAYOS_X"> RAYOS_X </option>
                            <option value="AUDIOMETRIA"> AUDIOMETRIA </option>
                            <option value="ESPIROMETRIA"> ESPIROMETRIA </option>
                            <option value="ELECTROCARDIOGRAMA"> ELECTROCARDIOGRAMA </option>
                            <option value="PSICOSENSOMETRICO"> PSICOSENSOMETRICO </option>
                            <option value="PRUEBA_ESFUERZO"> PRUEBA_ESFUERZO </option>
                            <option value="ENTREVISTA"> ENTREVISTA </option>

                        </select>  
                    </div>
                 
                    <input type="submit" name="update_prueba" id="update_prueba" style="background-color:#00b3ba;" Value="Actualizar" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" style="background-color:#00b3ba; color:#ffffff" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Examen</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_examenes" method="POST">
                    <input type="hidden" name="delete_id_prueba" id="delete_id_prueba" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar este item?</label>
                        <input type="text" name="delete_cod_interno" id="delete_cod_interno" class="form-control" readonly>
                    </div>

                    <input type="submit" name="delete_prueba" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>