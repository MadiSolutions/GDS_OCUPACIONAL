<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 style="color:#00b3ba; font-weight: bold;">Maestros -> Protocolos Ocupacional</h1>
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
                                    <th>Empresa</th>
                                    <th>Nombre Protocolo</th>
                                    <th>Descripcion Procotolo</th>
                                    <th>Lista Examenes</th>                   
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($res)) :
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_protocolo'] ?></td>
                                        <td><?php echo $row['empresa_nombre'] ?></td>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['descripcion'] ?></td>
                                        <td><button type="button" style="background-color:#00b3ba;" class="btn btn-primary" onclick="OpenModalListExamenes('<?= $row['id_protocolo']?>')"><li class="fa fa-search"></li></button></td>
                           
                        
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" style="color:#00b3ba;" data-target="#EditModal" href="javascript:void(0);" onclick="
                                              
                                                    document.getElementById('update_id_protocolo').value ='<?= $row['id_protocolo']?>';
                                                    document.getElementById('update_empresa_nombre').value ='<?= $row['empresa_nombre']?>';
                                                    document.getElementById('update_examen_detalle').value ='<?= $row['lista_examenes'] ?>';
                                                    document.getElementById('update_nombre').value ='<?= $row['nombre'] ?>';
                                                    document.getElementById('update_descripcion').value = '<?= $row['descripcion'] ?>';" title="Editar Prueba" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a data-toggle="modal" data-target="#DeleteModal" href="javascript:void(0);" onclick="
                                                    document.getElementById('delete_id_protocolo').value ='<?= $row['id_protocolo']?>';
                                                    document.getElementById('delete_nombre').value ='<?= $row['nombre']?>';"title="Eliminar Paciente" class="text-danger"> <i class="fas fa-trash"></i> </a>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Agregar Nuevo Protocolo Ocupacional</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_protocolos" id="ingresar" method="POST">

                <table id="example2" class="table table-bordered table-hover">

                <tr>
                    <td>
                    <label for="add_nombre">Nombre</label>
                    </td>
                    <td>
                    <input type="text" name="add_nombre" id="add_nombre" placeholder="Nombre" class="form-control" required="required">
                    </td>
                </tr>

                <tr>
                    <td>
                    <label for="add_descripcion">Descripcion</label>
                    </td>
                    <td>
                    <input type="text" name="add_descripcion" id="add_descripcion" placeholder="Descripcion" class="form-control" required="required">
                    </td>
                </tr>


                <tr>
                    <td>
                    <label for="add_empresa_nombre">Id Empresa</label>
                    </td>
                    <td>
                    <select name="add_empresa_nombre" id="add_empresa_nombre" class="form-control" required="required">
                            <option value="" disabled selected>Selecciona una empresa</option>
                            <?php while ($row = mysqli_fetch_assoc($res_empresas)) : ?>
                            <option value="<?php echo $row['id_empresa']; ?>"><?php echo $row['razon_social']; ?></option>
                            <?php endwhile; ?>
                    </select>
                    </td>
                </tr>

            </table>


                    <table class="table table-bordered table-hover">
                        <tr>
                        <label for="update_examenes">Examenes</label>

                            <td style="width: 180px;">
                                <input type="text" name="buscador_productos" id="buscador_productos" class="form-control inut-lg" autocomplete="off" placeholder="Buscar ..."/>
                            </td> 

                            <td style="width: 750px;">
                                <select style="border:3px solid #04467E"  id="lista_productos" name="lista_productos" class="form-control"></select>
                            </select>
                            </td>      

            
                            <td>
                                <button type="button" style="background-color:#00b3ba;" class="btn btn-success" onclick="AgregarProducto()">+</li></button>
                            </td>
                        </tr>
                    </table>
       
                    <div class="col-12" id="div_productosProtocolo"></div>
        

        
                    <input type="submit" name="add_protocolo" style="background-color:#00b3ba;" Value="Registrar" class="btn btn-primary">

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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color:#00b3ba;">

                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Editar Medico</h4>
            </div>
            <div class="modal-body">

                <form action="panel.php?modulo=ma_ocupacional_protocolos" method="POST">
                    <input type="hidden" name="update_id_protocolo" id="update_id_protocolo" value="">


            <table id="example2" class="table table-bordered table-hover" >
                <tr>
                    <td>
                    <label for="update_nombre">Nombre</label>
                    </td>
                    <td>
                    <input type="text" name="update_nombre" id="update_nombre" class="form-control" required="required">

                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="update_descripcion">Descripcion</label>
                    </td>
                    <td>
                    <input type="text" name="update_descripcion" id="update_descripcion" class="form-control" required="required">
                    </td>
                </tr>

                <tr>
                    <td>
                    <label for="update_empresa_nombre">Empresa</label>
                    </td>
                    <td>
                        <select name="update_empresa_nombre" id="update_empresa_nombre" class="form-control" required="required">
                            <option value="" disabled selected>Selecciona una empresa</option>
                            <?php while ($row = mysqli_fetch_assoc($res_empresas)) : ?>
                                <option value="<?php echo $row['id_empresa']; ?>">
                                    <?php echo $row['razon_social']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </td>
             
                </tr>

            </table>

            <table class="table table-bordered table-hover">
                <tr>
                    <td>
                    <label for="update_examen_detalle">Examenes</label>

                    </td>
                    <td>
                    <input type="text" name="update_examen_detalle" id="update_examen_detalle" class="form-control" required="required">

                    </td>
                </tr>
                        <tr>
                            <td style="width: 180px;">
                                <input type="text" name="buscador_productosR" id="buscador_productosR" class="form-control inut-lg" autocomplete="off" placeholder="Buscar ..."/>
                            </td> 
                            <td style="width: 750px;">
                                <select style="border:3px solid #04467E"  id="lista_productosR" name="lista_productosR" class="form-control"></select>
                            </td>               
                        
                            <td>
                                <button type="button" class="btn btn-success" onclick="AgregarProductoR()">+</li></button>
                            </td>
                        </tr>

                    </table>
                    
                    <div class="col-12" id="div_productosAdmisionR"></div>

                    <!-- <input type="submit" name="add_admision_ventaR" Value="Registrar" class="btn btn-success">   -->
                 
                    <input type="submit" name="update_protocolo" id="update_protocolo" style="background-color:#00b3ba;" Value="Actualizar" class="btn btn-primary">

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
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Protocolo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_protocolos" method="POST">
                    <input type="hidden" name="delete_id_protocolo" id="delete_id_protocolo" value="">
                    <div class="form-group">
                        <label>¿Seguro que deseas eliminar este item?</label>
                        <input type="text" name="delete_nombre" id="delete_nombre" class="form-control" readonly>
                    </div>

                    <input type="submit" name="delete_nombre" Value="Eliminar" class="btn btn-danger">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal para Ver Exámenes -->
<div class="modal fade" id="ModalListExamenes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Ver Exámenes para Protocolo</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ma_ocupacional_protocolos" id="ver_examenes_form" method="POST">
                <input type="hidden" name="visor_id_protocolo" id="visor_id_protocolo" value="">


                <table id="example2" class="table table-bordered table-hover" >


                    <tr>
                        <td>
                        <label for="visor_empresa_nombre">Id Empresa</label>

                        </td>
                        <td>
                        <input type="text" name="visor_empresa_nombre" id="visor_empresa_nombre" required="required" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="visor_descripcion">Descripcion</label>
                        </td>
                        <td>
                        <input type="text" name="visor_descripcion" id="visor_descripcion" required="required" class="form-control" readonly>

                        </td>
                    </tr>
                </table>
 
                    <div class="col-12" id="div_detalleProtocolo"></div>

                    <!-- Botón de Enviar 
                    <input type="submit" name="add_protocolo" style="background-color:#00b3ba;" value="Registrar" class="btn btn-primary">
                    -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" style="background-color:#00b3ba; color:#ffffff" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="AddModalR" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="defaultModalLabel">Detalles Venta</h4>
            </div>
            <div class="modal-body">
                <form action="panel.php?modulo=ventas_admision" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="nombre_veR" id="nombre_veR" value="">
           

                    <label for="lista_productosR">Detalle</label>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td style="width: 180px;">
                                <input type="text" name="buscador_productosR" id="buscador_productosR" class="form-control inut-lg" autocomplete="off" placeholder="Buscar ..."/>
                            </td> 
                            <td style="width: 750px;">
                                <select style="border:3px solid #04467E"  id="lista_productosR" name="lista_productosR" class="form-control"></select>
                            </td>               
               

                            <td>
                                <button type="button" class="btn btn-success" onclick="AgregarProductoR()">+</li></button>
                            </td>
                        </tr>
                    </table>


                    <div class="col-12" id="div_productosAdmisionR"></div>
                    <input type="submit" name="add_admision_ventaR" Value="Registrar" class="btn btn-success">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>











<script>

function AgregarProductoR(){
    $('#EditModal').modal();
    $.ajax({
          method: "POST",
          url: 'controllers/Ocupacional_ctrItemProtocolo.php',
          data: {
              "accion": "LIST_DETALLE_PROTOCOLOS",
              "referencia": id_protocolo
            }
      })
      .done(function( retorno ) {
        retorno=retorno.split('%');
        $("#div_detalleProtocolo").html(retorno[2]);
        document.getElementById('visor_empresa_nombre').value =retorno[0];
        document.getElementById('visor_descripcion').value =retorno[1];

      });   
      
}





function EliminarItemAuditor(id_item,id_protocolo){
        $.ajax({
            method: "POST",
            url: 'controllers/Ocupacional_ctrItemProtocolo.php',
            data: {
                "accion": "ELIM_ITEM_PROTOCOLO",
                "id_protocolo": id_item,
            }
        })
        .done(function( retorno ) {
            ObtenerListaDetalleVenta(id_protocolo);
    });
}





function OpenModalListExamenes(id_protocolo) {
    $('#ModalListExamenes').modal();
    //document.getElementById('ventas_cod_venta').value =id_protocolo;
    $.ajax({
          method: "POST",
          url: 'controllers/Ocupacional_ctrItemProtocolo.php',
          data: {
              "accion": "LIST_DETALLE_PROTOCOLOS",
              "referencia": id_protocolo
            }
      })
      .done(function( retorno ) {
        retorno=retorno.split('%');
        $("#div_detalleProtocolo").html(retorno[2]);
        document.getElementById('visor_empresa_nombre').value =retorno[0];
        document.getElementById('visor_descripcion').value =retorno[1];

      });   
      
}





document.getElementById("buscador_productos").addEventListener("keyup",getDescripcion)

function getDescripcion() {
    let inputCP = document.getElementById("buscador_productos").value;
    let lista = document.getElementById("lista_productos");
    url="controllers/Ocupacional_BusquedaExamenesProtocolo.php"

    if(inputCP.length > 0){

    let formData= new FormData()
    formData.append("campo",inputCP)

    fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))
    } else {
        lista.style.display = 'none'
    }
}

function AgregarProducto(){

      $.ajax({
          method: "POST",
          url: 'controllers/Ocupacional_ctrItemProtocolo.php',
          data: {
          	  "accion": "ADD_PRODUCTO",
              "producto": $("#lista_productos").val()
            }
      })
      .done(function( retorno ) {
            ListarCarrito();
            document.getElementById('buscador_productos').value ='';
      });  		
}

  function ListarCarrito(){
      $.ajax({
          method: "POST",
          url: 'controllers/Ocupacional_ctrItemProtocolo.php',
          data: {
              "accion": "LIST_PRODUCTOS"
            }
      })
      .done(function( retorno ) {
            $("#div_productosProtocolo").html(retorno);
      });     
  }

  function EliminarItemF(item){
      $.ajax({
          method: "POST",
          url: 'controllers/Ocupacional_ctrItemProtocolo.php',
          data: {
              "accion": "ELIM_PRODUCTOF",
              "item": item,
            }
      })
      .done(function( retorno ) {
            ListarCarrito();
      });
}




</script>