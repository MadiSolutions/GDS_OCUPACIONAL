<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 style="color:#55B7BE">Usuario -> Cambiar Clave</h1>
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
                    <a href="panel.php?modulo=inicio" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i> Volver a Inicio</a><br><p>
                    <form action="panel.php?modulo=cambiar_clave" method="POST">
                        <table>
                            <tr>
                                <td>
                                    <label for="clave_old">Constraseña Antigua </label><br>
                                    <input type="password" name="clave_old" id="clave_old" placeholder="Contraseña" required="required">
                                </td>
                                <td></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>
                                    <label for="clave_new">Contraseña Nueva</label><br>
                                    <input type="password" name="clave_new" id="clave_new" placeholder="Contraseña Nueva" required="required">
                                </td>
                                <td>
                                    <label for="clave_renew">Repita Contraseña Nueva</label><br>
                                    <input type="password" name="clave_renew" id="clave_renew" placeholder="Contraseña Nueva" required="required">
                                </td>
                            </tr>
                        </table><br>
                            <input type="submit" name="update_clave_usuario" Value="Actualizar" class="btn btn-primary">
                        </form>
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


