<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 style="color:#00b3ba; font-weight: bold;">Maestros -> Empresas Ocupacional</h1>
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
                                    <th>RUC</th>
                                    <th>Razon Social</th>
                                    <th>Nombre Contacto</th>
                                    <th>Telefono Contacto</th>
                                    <th>Correo Contacto</th>
                                    <th>Direccion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_empresa'] ?></td>
                                        <td><?php echo $row['ruc'] ?></td>
                                        <td><?php echo $row['razon_social'] ?></td>
                                        <td><?php echo $row['nom_contacto'] ?></td>
                                        <td><?php echo $row['num_contacto'] ?></td>
                                        <td><?php echo $row['correo_contacto'] ?></td>
                                        <td><?php echo $row['direccion'] ?></td>
                        
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" style="color:#00b3ba;" data-target="#EditModal" href="javascript:void(0);" onclick="
                                              
                                                    document.getElementById('update_id_empresa').value ='<?= $row['id_empresa']?>';
                                                    document.getElementById('update_ruc').value ='<?= $row['ruc']?>';
                                                    document.getElementById('update_razon_social').value ='<?= $row['razon_social'] ?>';
                                                    document.getElementById('update_nom_contacto').value ='<?= $row['nom_contacto'] ?>';
                                                    document.getElementById('update_num_contacto').value = '<?= $row['num_contacto'] ?>';
                                                    document.getElementById('update_correo_contacto').value = '<?= $row['correo_contacto'] ?>';
                                                    document.getElementById('update_direccion').value = '<?= $row['direccion'] ?>';" title="Editar Medico" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="
                                                    document.getElementById('delete_id_empresa').value ='<?= $row['id_empresa']?>';
                                                    document.getElementById('delete_razon_social').value ='<?= $row['razon_social']?>';"title="Eliminar Paciente" class="text-danger"> <i class="fas fa-trash"></i> </a>
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
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Agregar Nueva Empresa</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_empresas" id="ingresar" method="POST">
                    <div class="form-group">
                        <label for="add_ruc">RUC</label>
                        <input type="text" name="add_ruc" id="add_ruc" placeholder="ruc" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_razon_social">Razon Social</label>
                        <input type="text" name="add_razon_social" id="add_razon_social" placeholder="razon_social" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="add_direccion">Dirección Contacto</label>
                        <input type="text" name="add_direccion" id="add_direccion" placeholder="Dirección " class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_nom_contacto">Nombre Contacto</label>
                        <input type="text" name="add_nom_contacto" id="add_nom_contacto" placeholder="Nombre" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_num_contacto">Numero de Contacto</label>
                        <input type="number" name="add_num_contacto" id="add_num_contacto" placeholder="Numero" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="add_correo_contacto">Correo</label>
                        <input type="email" name="add_correo_contacto" id="add_correo_contacto" placeholder="Dirección " class="form-control" required="required">
                    </div>

           
             
        
        
                    <input type="submit" name="add_id_empresa" style="background-color:#00b3ba;" Value="Registrar" class="btn btn-primary">

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

                <form action="panel.php?modulo=ma_ocupacional_empresas" method="POST">
                    <input type="hidden" name="update_id_empresa" id="update_id_empresa" value="">
                    <div class="form-group">
                        <label for="update_ruc">RUC</label>
                        <input type="text" name="update_ruc" id="update_ruc" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label for="update_razon_social">Razon Social</label>
                        <input type="text" name="update_razon_social" id="update_razon_social" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_direccion">Dirección Contacto</label>
                        <input type="text" name="update_direccion" id="update_direccion" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_nom_contacto">Nombre Contacto</label>
                        <input type="text" name="update_nom_contacto" id="update_nom_contacto" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label for="update_num_contacto">Num Contacto</label>
                        <input type="number" name="update_num_contacto" id="update_num_contacto" class="form-control" value="" required="required">
                    </div>
                    <div class="form-group">
                        <label for="update_correo_contacto">Correo</label>
                        <input type="email" name="update_correo_contacto" id="update_correo_contacto" class="form-control" required="required">
                    </div>
                    
               
                 
                    <input type="submit" name="update_empresa" id="update_empresa" style="background-color:#00b3ba;" Value="Actualizar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Empresa</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_empresas" method="POST">
                    <input type="hidden" name="delete_id_empresa" id="delete_id_empresa" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar este item?</label>
                        <input type="text" name="delete_razon_social" id="delete_razon_social" class="form-control" readonly>
                    </div>

                    <input type="submit" name="delete_empresa" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>