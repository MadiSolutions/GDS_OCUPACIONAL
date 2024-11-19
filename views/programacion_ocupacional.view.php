
<?php date_default_timezone_set('America/Lima');
        $hoy=date("Y-m-d"); 
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="color:#00b3ba; font-weight: bold;">Mis Programaciones -> Ocupacional Programaciones</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <label>Seleccione la Fecha</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="fecha_detalle_inicio" id="fecha_detalle_inicio" value="<?= $hoy; ?>">
                                </td>
                                <td></td>
                                <td>
                                    <button type="button" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='#007bff';" onmouseout="this.style.backgroundColor='#00b3ba';" class="btn btn-primary" onclick="cargarTabla()">Actualizar</button>
                                </td>


                            </tr>
                        </table>
                        <br>
                        <div id="tabla_lista_programaciones"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="DeleteProgramacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="defaultModalLabel">Eliminar Programacion</h4>
            </div>
            <div class="modal-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <td>
                                <label for="prog_delete_id">Codigo</label>
                            </td>
                            <td>
                                <input type="text" name="prog_delete_id" id="prog_delete_id" class="form-control" required="required" readonly>  
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prog_delete_nombre">Nombre Paciente</label>
                            </td>
                            <td>
                                <input type="text" name="prog_delete_nombre" id="prog_delete_nombre" class="form-control" required="required" readonly>  
                            </td>
                        </tr>
                    </table>
                    <br>
                    <button type="button" class="btn btn-danger" onclick="EliminarProgramacion()">Eliminar</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Agregar Nuevo Personal a Programar</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Primeras dos tablas (Datos del Personal) alineadas a la izquierda -->
                    <div class="col-md-6">
                        <table id="tabla1" class="table table-bordered table-hover">
                            <tr>
                                <td><label for="add_tipo_documento">Tipo Doc</label></td>
                                <td>
                                    <select name="add_tipo_documento" id="add_tipo_documento" class="form-control">
                                        <option value="">Seleccione un Documento</option>
                                        <option value="DNI">DNI</option>
                                        <option value="CARNER_EXTRANJERIA">CARNET EXTRANJERIA</option>
                                        <option value="PASAPORTE">PASAPORTE</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="add_numero_documento">Num Documento</label></td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <input type="number" name="add_numero_documento" id="add_numero_documento" placeholder="Numero documento" class="form-control" required="required">
                                        <button type="button" style="background-color:#00b3ba; margin-left: 10px;" 
                                                onmouseover="this.style.backgroundColor='#007bff';" 
                                                onmouseout="this.style.backgroundColor='#00b3ba';" 
                                                class="btn btn-primary" 
                                                onclick="BuscarPaciente()">
                                            <li class="fa fa-search"></li> 
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div id="additionalData" style="display: none;">
                            <table id="tabla2" class="table table-bordered table-hover">
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <label for="">Datos de Filiación</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_nombre_completo">Nombre Completo</label></td>
                                    <td><input type="text" name="add_nombre_completo" id="add_nombre_completo" placeholder="Nombre Completo" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_sexo">Genero</label></td>
                                    <td><select name="add_sexo" id='add_sexo' class="form-control">
                                        <option value="">Seleccione un Genero</option>
                                        <option value="HOMBRE">HOMBRE</option>
                                        <option value="MUJER">MUJER</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_fecha_nacimiento">Fecha Nacimiento</label></td>
                                    <td><input type="date" name="add_fecha_nacimiento" id="add_fecha_nacimiento" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_edad">Edad</label></td>
                                    <td><input type="text" name="add_edad" id="add_edad" placeholder="Edad" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_telefono">Telefono</label></td>
                                    <td><input type="text" name="add_telefono" id="add_telefono" placeholder="Telefono" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_correo">Correo</label></td>
                                    <td><input type="email" name="add_correo" id="add_correo" placeholder="Correo de Personal" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_estado_civil">Estado Civil</label></td>
                                    <td><select name="add_estado_civil" id='add_estado_civil' class="form-control">
                                        <option value="">Seleccione Estado Civil</option>
                                        <option value="SOLTERO">SOLTERO</option>
                                        <option value="CASADO">CASADO</option>
                                        <option value="VIUDO">VIUDO</option>
                                        <option value="DIVORCIADO">DIVORCIADO</option>
                                        <option value="CONVIVIENTE">CONVIVIENTE</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_grado_instrucion">Grado Instrucción</label></td>
                                    <td><select name="add_grado_instrucion" id='add_grado_instrucion' class="form-control">
                                        <option value="">Seleccione Grado de Instrucción</option>
                                        <option value="PRIMARIA_COMPLETA">PRIMARIA COMPLETA</option>
                                        <option value="PRIMARIA_INCOMPLETA">PRIMARIA INCOMPLETA</option>
                                        <option value="SECUNDARIA_COMPLETA">SECUNDARIA COMPLETA</option>
                                        <option value="SECUNDARIA_INCOMPLETA">SECUNDARIA INCOMPLETA</option>
                                        <option value="TECNICO_COMPLETO">TÉCNICO COMPLETO</option>
                                        <option value="UNIVERSITARIO_COMPLETO">UNIVERSITARIO COMPLETO</option>
                                        <option value="TECNICO_INCOMPLETO">TÉCNICO INCOMPLETO</option>
                                        <option value="UNIVERSITARIO_INCOMPLETO">UNIVERSITARIO INCOMPLETO</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_ocupacion">Ocupación</label></td>
                                    <td><input type="text" name="add_ocupacion" id="add_ocupacion" placeholder="Ocupación" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_telefono_emergencia">Teléfono de Emergencia</label></td>
                                    <td><input type="text" name="add_telefono_emergencia" id="add_telefono_emergencia" placeholder="Teléfono de emergencia" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_nombre_contacto">Contacto de Emergencia</label></td>
                                    <td><input type="text" name="add_nombre_contacto" id="add_nombre_contacto" placeholder="Contacto de emergencia" class="form-control" required="required"></td>
                                </tr>
                                <tr>
                                    <td><label for="add_parentesco_emergencia">Parentesco de Emergencia</label></td>
                                    <td><input type="text" name="add_parentesco_emergencia" id="add_parentesco_emergencia" placeholder="Parentesco emergencia" class="form-control" required="required"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Segunda columna: Datos de Residencia y Nacimiento alineados a la derecha -->
                        <div class="col-md-6">
                            <div id="additionalData2" style="display: none;">
                            <table id="tabla3" class="table table-bordered table-hover">
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <label for="">Lugar de Residencia Actual</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_pais_residencia">Pais</label></td>
                                    <td><select name="add_pais_residencia" id="add_pais_residencia" class="form-control" onchange="cargarDepartamentos()">
                                        <option value="">Seleccione un País</option>
                                        <option value="PERU">Perú</option>
                                        <option value="ARGENTINA">Argentina</option>
                                        <option value="BOLIVIA">Bolivia</option>
                                        <option value="BRASIL">Brasil</option>
                                        <option value="CHILE">Chile</option>
                                        <option value="COLOMBIA">Colombia</option>
                                        <option value="GUYANA">Guyana</option>
                                        <option value="PARAGUAY">Paraguay</option>
                                        <option value="URUGUAY">Uruguay</option>
                                        <option value="VENEZUELA">Venezuela</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_departamento_residencia">Departamento</label></td>
                                    <td><select name="add_departamento_residencia" id="add_departamento_residencia" class="form-control" onchange="cargarProvincias()">
                                        <option value="">Seleccione un departamento</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_provincia_residencia">Provincia</label></td>
                                    <td><select name="add_provincia_residencia" id="add_provincia_residencia" class="form-control" onchange="cargarDistritos()">
                                        <option value="">Seleccione una provincia</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_distrito_residencia">Distrito</label></td>
                                    <td><select name="add_distrito_residencia" id='add_distrito_residencia' class="form-control">
                                        <option value="">Seleccione un distrito</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_direccion_residencia">Dirección</label></td>
                                    <td><input type="text" name="add_direccion_residencia" id="add_direccion_residencia" placeholder="Dirección" class="form-control" required="required"></td>
                                </tr>
                            </table>

                            <table id="tabla4" class="table table-bordered table-hover">
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <label for="">Lugar de Nacimiento</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_pais_nacimiento">Pais</label></td>
                                    <td><select name="add_pais_nacimiento" id="add_pais_nacimiento" class="form-control" onchange="cargarDepartamentosNacimiento()">
                                        <option value="">Seleccione un País</option>
                                        <option value="PERU">Perú</option>
                                        <option value="ARGENTINA">Argentina</option>
                                        <option value="BOLIVIA">Bolivia</option>
                                        <option value="BRASIL">Brasil</option>
                                        <option value="CHILE">Chile</option>
                                        <option value="COLOMBIA">Colombia</option>
                                        <option value="GUYANA">Guyana</option>
                                        <option value="PARAGUAY">Paraguay</option>
                                        <option value="URUGUAY">Uruguay</option>
                                        <option value="VENEZUELA">Venezuela</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_departamento_nacimiento">Departamento</label></td>
                                    <td><select name="add_departamento_nacimiento" id="add_departamento_nacimiento" class="form-control" onchange="cargarProvinciasNacimiento()">
                                        <option value="">Seleccione un departamento</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_provincia_nacimiento">Provincia</label></td>
                                    <td><select name="add_provincia_nacimiento" id="add_provincia_nacimiento" class="form-control" onchange="cargarDistritosNacimiento()">
                                        <option value="">Seleccione una provincia</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_distrito_nacimiento">Distrito</label></td>
                                    <td><select name="add_distrito_nacimiento" id='add_distrito_nacimiento' class="form-control">
                                        <option value="">Seleccione un distrito</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="add_direccion_nacimiento">Dirección</label></td>
                                    <td><input type="text" name="add_direccion_nacimiento" id="add_direccion_nacimiento" placeholder="Dirección" class="form-control" required="required"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='#007bff';" onmouseout="this.style.backgroundColor='#00b3ba';" class="btn btn-primary" onclick="RegistrarPaciente()">Registrar</button>
                <button type="button" class="btn btn-link waves-effect" style="background-color:#00b3ba; color:#ffffff" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="ModalDatosProgramacion" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00b3ba;">
                <h4 class="modal-title" id="defaultModalLabel" style="color:#ffff; font-weight: bold;">Datos Protocolo / Perfil</h4>
            </div>
            <div class="modal-body">
                    
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <td>
                                <label for="prog_codigo_colaborador">Codigo Colaborador</label>
                            </td>
                            <td>
                                <input type="text" name="prog_codigo_colaborador" id="prog_codigo_colaborador" class="form-control" required="required" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prog_nombre">Nombre Colaborador</label>
                            </td>
                            <td>
                                <input type="text" name="prog_nombre" id="prog_nombre" class="form-control" required="required" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prog_proyecto">Seguro</label>
                            </td>
                            <td>
                                <select name="prog_proyecto" id='prog_proyecto' class="form-control">
                                <?php 
                                    //session_start();
                                    $id_empresa=$_SESSION['id_empresa'];
                                    $query="Select id_proyecto,descripcion from ma_ocupacional_proyectos where estado=1 and id_empresa='$id_empresa'";
                                    $res = mysqli_query($con,$query);
                                    while ($row = mysqli_fetch_assoc($res)):
                                        echo "<option value=".$row['id_proyecto'].">".$row['descripcion']."</option>";
                                    endwhile;
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="prog_protocolo">Protocolo / Perfil</label>
                            </td>
                            <td>
                            <select name="prog_protocolo" id='prog_protocolo' class="form-control">
                                <?php 
                                    //session_start();
                                    $id_empresa=$_SESSION['id_empresa'];
                                    $query="Select id_protocolo,nombre from ma_ocupacional_protocolos where estado=1 and id_empresa='$id_empresa'";
                                    $res = mysqli_query($con,$query);
                                    while ($row = mysqli_fetch_assoc($res)):
                                        echo "<option value=".$row['id_protocolo'].">".$row['nombre']."</option>";
                                    endwhile;
                                ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <button type="button" style="background-color:#00b3ba; color:#ffffff" class="btn btn-primary" onclick="GuardarProgramacionPersonal()">Guardar</button>
            </div>
        </div>
    </div>
</div>





<script>

window.onload = function() {
    cargarTabla();
};

function EliminarProgramacion (){
    id_programacion=document.getElementById('prog_delete_id').value;
    $.ajax({
        method: "POST",
        url: 'controllers/ctrProgramacion_ocupacional.php',
        data: {
            "accion": "ELIMINAR_PROGRAMACION",
            "id_programacion": id_programacion
        }
    })
    .done(function( retorno ) {
        if(retorno==true){
            alert("Programacion Eliminada con Exito!");
            $('#DeleteProgramacionModal').modal('hide');
            cargarTabla();
        }
        if(retorno==false){
            alert("ERROR");
            cargarTabla();
        }
    }); 
}



function AbrirModalEliminacionProgramacion(id_programacion,nombre){
    $('#DeleteProgramacionModal').modal('show');
    document.getElementById('prog_delete_id').value = id_programacion;
    document.getElementById('prog_delete_nombre').value=nombre;
}

function VerModalNuevo(){
    $('#AddModal').modal('show');
    /*document.getElementById('tabla3').style.display = 'none';
    document.getElementById('tabla4').style.display = 'none';*/

}

function GuardarProgramacionPersonal(){
    id_paciente=document.getElementById('prog_codigo_colaborador').value;
    id_proyecto=document.getElementById('prog_proyecto').value;
    id_protocolo=document.getElementById('prog_protocolo').value;
    fecha=document.getElementById('fecha_detalle_inicio').value;

    $.ajax({
        method: "POST",
        url: 'controllers/ctrProgramacion_ocupacional.php',
        data: {
            "accion": "GUARDAR_PROGRAMACION",
            "id_paciente": id_paciente,
            "id_proyecto": id_proyecto,
            "id_protocolo": id_protocolo,
            "fecha":fecha
        }
    })
    .done(function( retorno ) {
        if(retorno==true){
            //alert(retorno);
            alert("Paciente Programado con Exito!");
            $('#ModalDatosProgramacion').modal('hide');
            cargarTabla();
        }
        if(retorno=='ERROR'){
            alert("ERROR");
        }
    });   

}

function RegistrarPaciente(){
    if(validarFormulario()){
        tipoDocumento = document.getElementById('add_tipo_documento').value;
        numeroDocumento = document.getElementById('add_numero_documento').value;
        nombreCompleto = document.getElementById('add_nombre_completo').value;
        sexo = document.getElementById('add_sexo').value;
        fechaNacimiento = document.getElementById('add_fecha_nacimiento').value;
        edad = document.getElementById('add_edad').value;
        telefono = document.getElementById('add_telefono').value;
        estadoCivil = document.getElementById('add_estado_civil').value;
        gradoInstruccion = document.getElementById('add_grado_instrucion').value;
        ocupacion = document.getElementById('add_ocupacion').value;
        telefonoEmergencia = document.getElementById('add_telefono_emergencia').value;
        nombreContacto = document.getElementById('add_nombre_contacto').value;
        parentescoEmergencia = document.getElementById('add_parentesco_emergencia').value;
        correo = document.getElementById('add_correo').value;

        paisResidencia = document.getElementById('add_pais_residencia').value;
        departamentoResidencia = document.getElementById('add_departamento_residencia').value;
        provinciaResidencia = document.getElementById('add_provincia_residencia').value;
        distritoResidencia = document.getElementById('add_distrito_residencia').value;
        direccionResidencia = document.getElementById('add_direccion_residencia').value;
        // Datos de lugar de nacimiento
        paisNacimiento = document.getElementById('add_pais_nacimiento').value;
        departamentoNacimiento = document.getElementById('add_departamento_nacimiento').value;
        provinciaNacimiento = document.getElementById('add_provincia_nacimiento').value;
        distritoNacimiento = document.getElementById('add_distrito_nacimiento').value;
        direccionNacimiento = document.getElementById('add_direccion_nacimiento').value;

        $.ajax({
            method: "POST",
            url: 'controllers/ctrProgramacion_ocupacional.php',
            data: {
                "accion": "GUARDAR_PACIENTE_NUEVO",
                "tipo_documento": tipoDocumento,
                "numeroDocumento": numeroDocumento,
                "nombre_completo": nombreCompleto,
                "sexo": sexo,
                "fecha_nacimiento": fechaNacimiento,
                "edad": edad,
                "telefono": telefono,
                "estado_civil": estadoCivil,
                "grado_instruccion": gradoInstruccion,
                "ocupacion": ocupacion,
                "telefono_emergencia": telefonoEmergencia,
                "nombre_contacto": nombreContacto,
                "parentesco_emergencia": parentescoEmergencia,
                "correo": correo,
                "pais_residencia": paisResidencia,
                "departamento_residencia": departamentoResidencia,
                "provincia_residencia": provinciaResidencia,
                "distrito_residencia": distritoResidencia,
                "direccion_residencia": direccionResidencia,
                "pais_nacimiento": paisNacimiento,
                "departamento_nacimiento": departamentoNacimiento,
                "provincia_nacimiento": provinciaNacimiento,
                "distrito_nacimiento": distritoNacimiento,
                "direccion_nacimiento": direccionNacimiento
            }
        })
        .done(function( retorno ) {
            
            if(retorno=='ERROR'){
                alert('ERROR AL REGISTRAR EL PACIENTE');
            }else{
                alert('Paciente Registrado!, Completar Info Medica');
                retorno=retorno.split('%');
                document.getElementById('prog_nombre').value=retorno[2];
                document.getElementById('prog_codigo_colaborador').value=retorno[1];
                $('#AddModal').modal('hide');
                $('#ModalDatosProgramacion').modal('show');
                //cargarTabla();
            }
        });  
    }
     
}

function validarFormulario() {
    var tipoDocumento = document.getElementById('add_tipo_documento').value;
    var numeroDocumento = document.getElementById('add_numero_documento').value;
    var nombreCompleto = document.getElementById('add_nombre_completo').value;
    var sexo = document.getElementById('add_sexo').value;
    var fechaNacimiento = document.getElementById('add_fecha_nacimiento').value;
    var edad = document.getElementById('add_edad').value;
    var telefono = document.getElementById('add_telefono').value;
    var estadoCivil = document.getElementById('add_estado_civil').value;
    var gradoInstruccion = document.getElementById('add_grado_instrucion').value;
    var ocupacion = document.getElementById('add_ocupacion').value;
    var telefonoEmergencia = document.getElementById('add_telefono_emergencia').value;
    var nombreContacto = document.getElementById('add_nombre_contacto').value;
    var parentescoEmergencia = document.getElementById('add_parentesco_emergencia').value;
    var correo = document.getElementById('add_correo').value;

    var paisResidencia = document.getElementById('add_pais_residencia').value;
    var direccionResidencia = document.getElementById('add_direccion_residencia').value;
    
    var paisNacimiento = document.getElementById('add_pais_nacimiento').value;
    var direccionNacimiento = document.getElementById('add_direccion_nacimiento').value;

    if (!tipoDocumento || !numeroDocumento || !nombreCompleto || !sexo || !fechaNacimiento || !edad || 
        !telefono || !estadoCivil || !gradoInstruccion || !ocupacion || !telefonoEmergencia || 
        !nombreContacto || !parentescoEmergencia || !correo ||
        !paisResidencia || !direccionResidencia || !paisNacimiento || !direccionNacimiento) {
        
        alert("Por favor, complete todos los campos obligatorios.");
        return false; 
    }
    return true;
}


function BuscarPaciente(){
    documento= document.getElementById('add_numero_documento').value;
    $.ajax({
          method: "POST",
          url: 'controllers/ctrProgramacion_ocupacional.php',
          data: {
              "accion": "BUSCAR_PACIENTE",
              "documento": documento
            }
    })
    .done(function( retorno ) {
        retorno=retorno.split('%');
        var additionalData = document.getElementById('additionalData');
        additionalData.style.display = "block";

        var additionalData2 = document.getElementById('additionalData2');
        additionalData2.style.display = "block";
        if(retorno[0]=='3'){
            alert("Sin informacion encontrada");
            document.getElementById('add_numero_documento').value='';
            document.getElementById('add_nombre_completo').value='';
        }
        if(retorno[0]=="2"){
            document.getElementById('add_nombre_completo').value=retorno[1];
        }
        if(retorno[0]=="1"){
            document.getElementById('add_tipo_documento').value=retorno[3]
            //document.getElementById('add_numero_documento').value=retorno[3]
            document.getElementById('add_nombre_completo').value=retorno[5]
            document.getElementById('add_sexo').value=retorno[6]
            document.getElementById('add_fecha_nacimiento').value=retorno[7]
            document.getElementById('add_edad').value=retorno[8]
            document.getElementById('add_telefono').value=retorno[9]
            document.getElementById('add_estado_civil').value=retorno[10]
            document.getElementById('add_grado_instrucion').value=retorno[11]
            document.getElementById('add_ocupacion').value=retorno[12]
            document.getElementById('add_telefono_emergencia').value=retorno[13]
            document.getElementById('add_nombre_contacto').value=retorno[14]
            document.getElementById('add_parentesco_emergencia').value=retorno[15]
            document.getElementById('add_correo').value=retorno[16]

            document.getElementById('add_pais_residencia').value=retorno[17]
            document.getElementById('add_departamento_residencia').value=retorno[18]
            document.getElementById('add_provincia_residencia').value=retorno[19]
            document.getElementById('add_distrito_residencia').value=retorno[20]
            document.getElementById('add_direccion_residencia').value=retorno[21]
           
            document.getElementById('add_pais_nacimiento').value=retorno[22]
            document.getElementById('add_departamento_nacimiento').value=retorno[23]
            document.getElementById('add_provincia_nacimiento').value=retorno[24]
            document.getElementById('add_distrito_nacimiento').value=retorno[25]
            document.getElementById('add_direccion_nacimiento').value=retorno[26]

            //alert("OK");
        }
    }); 
}

function cargarTabla(){
    //$('#EditModal').modal();
    fecha= document.getElementById('fecha_detalle_inicio').value;
    $.ajax({
          method: "POST",
          url: 'controllers/ctrProgramacion_ocupacional.php',
          data: {
              "accion": "LIST_TABLA_DIA",
              "fecha": fecha
            }
    })
    .done(function( retorno ) {
        $("#tabla_lista_programaciones").html(retorno);
    });     
}

// Datos de países, departamentos, provincias y distritos


const data = {
    "PERU": {
        "departamentos": {
            "Moquegua": {
                "provincias": {
                    "Mariscal Nieto": ["Moquegua", "Torata", "San Cristóbal", "Carumas", "Samegua"],
                    "Ilo": ["Ilo", "El Algarrobal", "Pescadores", "Lirio"],
                    "General Sánchez Cerro": ["Omate", "Coalaque", "Puquina", "Yunga", "Chojata"]
                }
            },
            "Amazonas": {
                "provincias": {
                    "Bagua": ["Aramango", "Bagua", "Copallín", "El Parco", "Imaza", "La Peca"],   
                    "Bongará": ["Chisquilla", "Churuja", "Corosha", "Cuispes", "Florida", "Jazán", "Jumbilla", "Recta", "San Carlos", "Shipasbamba", "Valera", "Yambrasbamba"],
                    "Chachapoyas": ["Asunción", "Balsa", "Chachapoyas", "Cheto", "Chiliquín", "Chuquibamba", "Granada", "Huancas", "La Jalca", "Leimebamba", "Levanto", "Magdalena", "Mariscal Castilla", "Molinopampa", "Montevideo", "Olleros", "Quinjalca", "San Francisco de Daguas", "San Isidro de Maino", "Soloco", "Sonche"],
                    "Condorcanqui": ["El Cenepa", "Nieva", "Río Santiago"],
                    "Luya": ["Camporredondo", "Cocabamba", "Colcamar", "Conila", "Inguilpata", "Lámud", "Longuita", "Lonya Chico", "Luya", "Luya Viejo", "María", "Ocalli", "Ocumal", "Pisuquía", "Providencia", "San Cristóbal", "San Francisco del Yeso", "San Jerónimo", "San Juan de Lopecancha", "Santa Catalina", "Santo Tomás", "Tingo", "Trita"],
                    "Rodríguez de Mendoza": ["Chirimoto", "Cochamal", "Huambo", "Limabamba", "Longar", "Mariscal Benavides", "Milpuc", "Omia", "San Nicolás", "Santa Rosa", "Totora", "Vista Alegre"],
                    "Utcubamba": ["Bagua Grande", "Cajaruro", "Cumba", "El Milagro", "Jamalca", "Lonya Grande", "Yamón"]
                }
            },
            "Ancash": {
                "provincias": {
                    "Aija": ["Aija", "Coris", "Huacllán", "La Merced", "Succha"],
                    "Antonio Raymondi": ["Aczo", "Chaccho", "Chingas", "Llamellín", "Mirgas", "San Juan de Rontoy"],
                    "Asunción": ["Acochaca", "Chacas"],
                    "Bolognesi": ["Abelardo Pardo", "Antonio Raymondi", "Aquia", "Cajacay", "Canis", "Chiquián", "CólquiocE", "Huallanca", "Huasta", "Huayllacayán", "La Primavera", "Mangas", "Pacllón", "San Miguel", "Ticllos"],
                    "Carhuaz": ["Acopampa", "Amashca", "Anta", "Ataquero", "Carhuaz", "Marcará", "Pariahuanca", "San Miguel de Aco", "Shilla", "Tinco", "Yungar"],
                    "Carlos F. Fitzcarrald": ["San Luis", "San Nicolás", "Yauya"],
                    "Casma": ["Casma", "Buena Vista Alta", "Comandante Noel", "Yaután"],
                    "Corongo": ["Aco", "Bambas", "Corongo", "Cusca", "La Pampa", "Yánac", "Yupán"],
                    "Huaraz": ["Cochabamba", "Colcabamba", "Huanchay", "Huaraz", "Independencia", "Jangas", "La Libertad", "Olleros", "Pampas Grande", "Pariacoto", "Pira", "Tarica"],
                    "Huari": ["Anra", "Cajay", "Chavín de Huántar", "Huacachi", "Huacchis", "Huachis", "Huántar", "Huari", "Masin", "Paucas", "Pontó", "Rahuapampa", "Rapayán", "San Marcos", "San Pedro de Chaná", "Uco"],
                    "Huarmey": ["Cochapeti", "Culebras", "Huarmey", "Huayan", "Malvas"],
                    "Huaylas": ["Caraz", "Huallanca", "Huata", "Huaylas", "Mato", "Pamparomás", "Pueblo Libre", "Santa Cruz", "Santo Toribio", "Yuracmarca"],
                    "Mariscal Luzuriaga": ["Casca", "Eleazar Guzmán Barrón", "Fidel Olivas Escudero", "Llama", "Llumpa", "Lucma", "Musga", "Piscobamba"],
                    "Ocros": ["Acas", "Cajamarquilla", "Carhuapampa", "Cochas", "Congas", "Llipa", "Ocros", "San Cristóbal de Raján", "San Pedro", "Santiago de Chilcas"],
                    "Pallasca": ["Bolognesi", "Cabana", "Conchucos", "Huacaschuque", "Huandoval", "Lacabamba", "Llapo", "Pallasca", "Pampas", "Santa Rosa", "Tauca"],
                    "Pomabamba": ["Huayllán", "Parobamba", "Pomabamba", "Quinuabamba"],
                    "Recuay": ["Cátac", "Cotaparaco", "Huayllapampa", "Llacllín", "Marca", "Pampas Chico", "Pararín", "Recuay", "Tapacocha", "Ticapampa"],
                    "Santa": ["Chimbote", "Cáceres del Perú", "Coishco", "Macate", "Moro", "Nepeña", "Nuevo Chimbote", "Samanco", "Santa"],
                    "Sihuas": ["Acobamba", "Alfonso Ugarte", "Cashapampa", "Chingalpo", "Huayllabamba", "Quiches", "Ragash", "San Juan", "Sicsibamba", "Sihuas"],
                    "Yungay": ["Cascapara", "Mancos", "Matacoto", "Quillo", "Ranrahírca", "Shupluy", "Yanama", "Yungay"]
                }
            },
            "Arequipa": {
                "provincias": {
                    "Arequipa": ["Alto Selva Alegre", "Arequipa", "Cayma", "Cerro Colorado", "Characato", "Chiguata", "Jacobo Hunter", "José Luis Bustamante y Rivero", "La Joya", "Mariano Melgar", "Miraflores", "Mollebaya", "Paucarpata", "Pocsi", "Polobaya", "Quequeña", "Sabandía", "Sachaca", "San Juan de Siguas", "San Juan de Tarucani", "Santa Isabel de Siguas", "Santa Rita de Siguas", "Socabaya", "Tiabaya", "Uchumayo", "Vitor", "Yanahuara", "Yarabamba", "Yura"],
                    "Camaná": ["Camaná", "José María Quimper", "Mariano Nicolás Valcarcel", "Mariscal Cáceres", "Nicolás de Piérola", "Ocoña", "Quilca", "Samuel Pastor"],
                    "Caravelí": ["Acarí", "Atico", "Atiquipa", "Bella Unión", "Cahuacho", "Caravelí", "Chala", "Cháparra", "Huanuhuanu", "Jaquí", "Lomas", "Quicacha", "Yauca"],
                    "Castilla": ["Aplao", "Andahua", "Ayo", "Chachas", "Chilcaymarca", "Choco", "Huancarqui", "Machaguay", "Orcopampa", "Pampacolca", "Tipán", "Uñón", "Uraca", "Viraco"],
                    "Caylloma": ["Achoma", "Cabanaconde", "Callalli", "Caylloma", "Chivay", "Coporaque", "Huambo", "Huanca", "Ichupampa", "Lari", "Lluta", "Maca", "Madrigal", "Majes", "San Antonio de Chuca", "Sibayo", "Tapay", "Tisco", "Tuti", "Yanque"],
                    "Condesuyos": ["Andaray", "Cayarani", "Chichas", "Chuquibamba", "Iray", "Río Grande", "Salamanca", "Yanaquihua"],
                    "Islay": ["Cocachacra", "Deán Valdivia", "Islay", "Mejía", "Mollendo", "Punta de Bombón"],
                    "La Unión": ["Alca", "Charcana", "Cotahuasi", "Huaynacotas", "Pampamarca", "Puyca", "Quechualla", "Sayla", "Tauría", "Tomepampa", "Toro"]
                }
            },
            "Ayacucho": {
                "provincias": {
                    "Cangallo": ["Cangallo", "Chuschi", "Los Morochucos", "María Parado de Bellido", "Paras", "Totos"],
                    "Huamanga": ["Acocro", "Acos Vinchos", "Andrés Avelino Cáceres Dorregaray", "Ayacucho", "Carmen Alto", "Chiara", "Jesús Nazareno", "Ocros", "Pacaycasa", "Quinua", "San José de Ticllas", "San Juan Bautista", "Santiago de Pischa", "Socos", "Tambillo", "Vinchos"],
                    "Huanca Sancos": ["Carapo", "Sacsamarca", "Sancos", "Santiago de Lucanamarca"],
                    "Huanta": ["Ayahuanco", "Canayre", "Chaca", "Huamanguilla", "Huanta", "Iguaín", "Llochegua", "Luricocha", "Pucacolpa", "Santillana", "Sivia", "Uchuraccay"],
                    "La Mar": ["Anchihuay", "Anco", "Ayna", "Chilcas", "Chungui", "Luis Carranza", "Oronccoy", "Samugari", "San Miguel", "Santa Rosa", "Tambo"],
                    "Lucanas": ["Aucaras", "Cabana Sur", "Carmen Salcedo", "Chaviña", "Chipao", "Huacuas", "Laramate", "Leoncio Prado", "Llauta", "Lucanas", "Ocaña", "Otoca", "Puquio", "Saisa", "San Cristóbal", "San Juan", "San Pedro", "San Pedro de Palco", "Sancos", "Santa Ana de Huaycahuacho", "Santa Lucía"],
                    "Parinacochas": ["Coracora", "Chumpi", "Coronel Castañeda", "Pacapausa", "Pullo", "Puyusca", "San Francisco de Ravacayco", "Upahuacho"],
                    "Páucar del Sara Sara": ["Colta", "Corculla", "Lampa", "Marcabamba", "Oyolo", "Pararca", "Pauza", "San Javier de Alpabamba", "San José de Ushua", "Sara Sara"],
                    "Sucre": ["Belén", "Chalcos", "Chilcayoc", "Huacaña", "Morcolla", "Paico", "Querobamba", "San Pedro de Larcay", "San Salvador de Quije", "Santiago de Paucaray", "Soras"],
                    "Vilcashuamán": ["Alcamenca", "Apongo", "Asquipata", "Canaria", "Cayara", "Colca", "Huamanquiquia", "Huancapi", "Huancaraylla", "Huaya", "Sarhua", "Vilcanchos"],
                    "Víctor Fajardo": ["Accomarca", "Carhuanca", "Concepción", "Huambalpa", "Independencia", "Saurama", "Vilcashuamán", "Vischongo"]
                }
            },

            "Cajamarca": {
                "provincias": {
                    "Cajabamba": ["Cachachi", "Cajabamba", "Condebamba", "Sitacocha"],
                    "Cajamarca": ["Asunción", "Cajamarca", "Chetilla", "Cospán", "Jesús", "La Encañada", "Llacanora", "Los Baños del Inca", "Magdalena", "Matara", "Namora", "San Juan"],
                    "Celendín": ["Celendin", "Chumuch", "Cortegana", "Huasmin", "José Gálvez", "Jorge Chávez", "La Libertad de Pallán", "Miguel Iglesias", "Oxamarca", "Sorochuco", "Sucre", "Utco"],
                    "Chota": ["Anguía", "Chadín", "Chalamarca", "Chiguirip", "Chimban", "Choropampa", "Chota", "Cochabamba", "Conchán", "Huambos", "Lajas", "Llama", "Miracosta", "Paccha", "Pion", "Querocoto", "San Juan de Licupis", "Tacabamba", "Tocmoche"],
                    "Contumazá": ["Chilete", "Contumazá", "Cupisnique", "Guzmango", "San Benito", "Santa Cruz de Toledo", "Tantarica", "Yonán"],
                    "Cutervo": ["Callayuc", "Choros", "Cujillo", "Cutervo", "La Ramada", "Pimpingos", "Querocotillo", "San Andrés de Cutervo", "San Juan de Cutervo", "San Luis de Lucma", "Santa Cruz", "Santo Domingo de la Capilla", "Santo Tomás", "Socota", "Toribio Casanova"],
                    "Hualgayoc": ["Bambamarca", "Chugur", "Hualgayoc"],
                    "Jaén": ["Bellavista", "Chontalí", "Colasay", "Huabal", "Jaén", "Las Pirias", "Pomahuaca", "Pucará", "Sallique", "San Felipe", "San José del Alto", "Santa Rosa"],
                    "San Ignacio": ["Chirinos", "Huarango", "La Coipa", "Namballe", "San Ignacio", "San José de Lourdes", "Tabaconas"],
                    "San Marcos": ["Chancay", "Eduardo Villanueva", "Gregorio Pita", "Ichocán", "Jose Manuel Quiroz", "José Sabogal", "Pedro Gálvez"],
                    "San Miguel": ["Bolívar", "Calquis", "Catilluc", "El Prado", "La Florida", "Llapa", "Nanchoc", "Niepos", "San Gregorio", "San Miguel", "San Silvestre de Conchán", "Tongod", "Unión Agua Blanca"],
                    "San Pablo": ["San Pablo", "San Bernardino", "San Luis", "Tumbaden"],
                    "Santa Cruz": ["Andabamba", "Catache", "Chancaybaños", "La Esperanza", "Ninabamba", "Pulán", "Santa Cruz", "Saucepampa", "Sexi", "Uticyacu", "Yauyucan"]
                }
            },

            "Cusco": {
                "provincias": {
                    "Acomayo": ["Acomayo", "Acopia", "Acos", "Mosoc Llacta", "Pomacanchi", "Rondocan", "Sangarará"],
                    "Anta": ["Ancahuasi", "Anta", "Cachimayo", "Chinchaypujio", "Huarocondo", "Limatambo", "Mollepata", "Pucyura", "Zurite"],
                    "Calca": ["Calca", "Coya", "Lamay", "Lares", "Pisac", "San Salvador", "Taray", "Yanatile"],
                    "Canas": ["Checca", "Kunturkanki", "Langui", "Layo", "Pampamarca", "Quehue", "Tupac Amaru", "Yanaoca"],
                    "Canchis": ["Sicuani", "Checacupe", "Combapata", "Marangani", "Pitumarca", "San Pablo", "San Pedro", "Tinta"],
                    "Chumbivilcas": ["Capacmarca", "Chamaca", "Colquemarca", "Livitaca", "Llusco", "Quiñota", "Santo Tomás", "Velille"],
                    "Cuzco": ["Ccorca", "Cuzco", "Poroy", "San Jerónimo", "San Sebastián", "Santiago", "Saylla", "Wanchaq"],
                    "Espinar": ["Alto Pichigua", "Condoroma", "Coporaque", "Ocoruro", "Pallpata", "Pichigua", "Suyckutambo", "Yauri"],
                    "La Convención": ["Echarati", "Huayopata", "Inkawasi", "Kimbiri", "Maranura", "Megantoni", "Ocobamba", "Pichari", "Quellouno", "Santa Ana", "Santa Teresa", "Vilcabamba", "Villa Kintiarina", "Villa Virgen"],
                    "Paruro": ["Accha", "Ccapi", "Colcha", "Huanoquite", "Omacha", "Paccaritambo", "Paruro", "Pillpinto", "Yaurisque"],
                    "Paucartambo": ["Caicay", "Challabamba", "Colquepata", "Huancarani", "Kosñipata", "Paucartambo"],
                    "Quispicanchi": ["Andahuaylillas", "Camanti", "Ccarhuayo", "Ccatca", "Cusipata", "Huaro", "Lucre", "Marcapata", "Ocongate", "Oropesa", "Quiquijana", "Urcos"],
                    "Urubamba": ["Chinchero", "Huayllabamba", "Machupicchu", "Maras", "Ollantaytambo", "Urubamba", "Yucay"]
              
                }
            },
            "Huancavelica": {
                "provincias": {
                    "Acobamba": ["Acobamba", "Andabamba", "Anta", "Caja", "Marcas", "Paucará", "Pomacocha", "Rosario"],
                    "Angaraes": ["Anchonga", "Callanmarca", "Ccochaccasa", "Chincho", "Congalla", "Huanca Huanca", "Huayllay Grande", "Julcamarca", "Lircay", "San Antonio de Antaparco", "Santo Tomás de Pata", "Seclla"],
                    "Castrovirreyna": ["Arma", "Aurahuá", "Capillas", "Castrovirreyna", "Chupamarca", "Cocas", "Huachos", "Huamatambo", "Mollepampa", "San Juan", "Santa Ana", "Tantara", "Ticrapo"],
                    "Churcampa": ["Anco", "Chinchihuasi", "Churcampa", "Cosme", "El Carmen", "La Merced", "Locroja", "Pachamarca", "Paucarbamba", "San Miguel de Mayocc", "San Pedro de Coris"],
                    "Huancavelica": ["Acobambilla", "Acoria", "Ascensión", "Conayca", "Cuenca", "Huachocolpa", "Huando", "Huancavelica", "Huayllahuara", "Izcuchaca", "Laria", "Manta", "Mariscal Cáceres", "Moya", "Nuevo Occoro", "Palca", "Pilchaca", "Vilca", "Yauli"],
                    "Huaytará": ["Ayaví", "Córdova", "Huayacundo Arma", "Huaytará", "Laramarca", "Ocoyo", "Pilpichaca", "Querco", "Quito-Arma", "San Antonio de Cusicancha", "San Francisco de Sangayaico", "San Isidro", "Santiago de Chocorvos", "Santiago de Quirahuara", "Santo Domingo de Capillas", "Tambo"],
                    "Tayacaja": ["Acostambo", "Acraquía", "Ahuaycha", "Andaymarca", "Colcabamba", "Daniel Hernández", "Huachocolpa", "Huaribamba", "Ñahuimpuquio", "Pampas", "Pazos", "Pichos", "Quichuas", "Quishuar", "Roble", "Salcabamba", "Salcahuasi", "San Marcos de Rocchac", "Santiago de Tucuma", "Surcubamba", "Tintay Puncu"]
                }
            },
            "Huánuco": {
                "provincias": {
                    "Ambo": ["Ambo", "Cayna", "Colpas", "Conchamarca", "Huácar", "San Francisco", "San Rafael", "Tomay Kichwa"],
                    "Dos de Mayo": ["Chuquis", "La Unión", "Marías", "Pachas", "Quivilla", "Ripán", "Shunqui", "Sillapata", "Yanas"],
                    "Huacaybamba": ["Canchabamba", "Cochabamba", "Huacaybamba", "Pinra"],
                    "Huamalíes": ["Arancay", "Chavín de Pariarca", "Jacas Grande", "Jircán", "Llata", "Miraflores", "Monzón", "Punchao", "Puños", "Singa", "Tantamayo"],
                    "Huánuco": ["Amarilis", "Chinchao", "Churumbamba", "Huánuco", "Margos", "Pillco Marca", "Quisqui (Kichki)", "San Francisco de Cayrán", "San Pablo de Pillao", "San Pedro de Chaulán", "Santa María del Valle", "Yacus", "Yarumayo"],
                    "Lauricocha": ["Baños", "Jesús", "Jivia", "Queropalca", "Rondos", "San Francisco de Asís", "San Miguel de Cauri"],
                    "Leoncio Prado": ["Castillo Grande", "Daniel Alomía Robles", "Hermilio Valdizán", "José Crespo y Castillo", "Luyando", "Mariano Dámaso Beraun", "Pucayacu", "Pueblo Nuevo", "Rupa-Rupa", "Santo Domingo de Anda"],
                    "Marañón": ["Cholón", "Huacrachuco", "La Morada", "San Buenaventura", "Santa Rosa de Alto Yanajanca"],
                    "Pachitea": ["Chaglla", "Molino", "Panao", "Umari"],
                    "Puerto Inca": ["Codo del Pozuzo", "Honoria", "Puerto Inca", "Tournavista", "Yuyapichis"],
                    "Yarowilca": ["Aparicio Pomares", "Cáhuac", "Chacabamba", "Chavinillo", "Choras", "Jacas Chico", "Obas", "Pampamarca"]
                
                }
            },

            "Ica": {
                "provincias": {
                    "Chincha": ["Alto Larán", "Chavín", "Chincha Alta", "Chincha Baja", "El Carmen", "Grocio Prado", "Pueblo Nuevo", "San Juan de Yanac", "San Pedro de Huacarpana", "Sunampe", "Tambo de Mora"],
                    "Ica": ["Ica", "La Tinguiña", "Los Aquijes", "Ocucaje", "Pachacútec", "Parcona", "Pueblo Nuevo", "Salas", "San José de los Molinos", "San Juan Bautista", "Santiago", "Subtanjalla", "Tate", "Yauca del Rosario"],
                    "Nazca": ["Nazca", "Changuillo", "El Ingenio", "Marcona", "Vista Alegre"],
                    "Palpa": ["Llipata", "Palpa", "Río Grande", "Santa Cruz", "Tibillo"],
                    "Pisco": ["Huancano", "Humay", "Independencia", "Paracas", "Pisco", "San Andrés", "San Clemente", "Túpac Amaru Inca"]

                }
            },

            "Junín": {
                "provincias": {
                    "Chanchamayo": ["Chanchamayo", "Perené", "Pichanaqui", "San Luis de Shuaro", "San Ramón", "Vítoc"],
                    "Chupaca": ["Áhuac", "Chongos Bajo", "Chupaca", "Huáchac", "Huamancaca Chico", "San Juan de Jarpa", "San Juan de Yscos", "Tres de Diciembre", "Yanacancha"],
                    "Concepción": ["Aco", "Andamarca", "Chambara", "Cochas", "Comas", "Concepción", "Heroínas Toledo", "Manzanares", "Mariscal Castilla", "Matahuasi", "Mito", "Nueve de Julio", "Orcotuna", "San José de Quero", "Santa Rosa de Ocopa"],
                    "Huancayo": ["Carhuacallanga", "Chacapampa", "Chicche", "Chilca", "Chongos Alto", "Chupuro", "Colca", "Cullhuas", "El Tambo", "Huacrapuquio", "Hualhuas", "Huancán", "Huancayo", "Huasicancha", "Huayucachi", "Ingenio", "Pariahuanca", "Pilcomayo", "Pucará", "Quichuay", "Quilcas", "San Agustín de Cajas", "San Jerónimo de Tunán", "San Pedro de Saño", "Santo Domingo de Acobamba", "Sapallanga", "Sicaya", "Viques"],
                    "Jauja": ["Acolla", "Apata", "Ataura", "Canchayllo", "Curicaca", "El Mantaro", "Huamalí", "Huaripampa", "Huertas", "Janjaillo", "Jauja", "Julcán", "Leonor Ordóñez", "Llocllapampa", "Marco", "Masma", "Masma Chicche", "Molinos", "Monobamba", "Muqui", "Muquiyauyo", "Paca", "Paccha", "Pancán", "Parco", "Pomacancha", "Ricrán", "San Lorenzo", "San Pedro de Chunán", "Sausa", "Sincos", "Tunanmarca", "Yauli", "Yauyos"],
                    "Junín": ["Carhuamayo", "Junín", "Ondores", "Ulcumayo"],
                    "Satipo": ["Coviriali", "Llaylla", "Mazamari", "Pampa Hermosa", "Pangoa", "Río Negro", "Río Tambo", "Satipo", "Vizcatán del Ene"],
                    "Tarma": ["Acobamba", "Huaricolca", "Huasahuasi", "La Unión", "Palca", "Palcamayo", "San Pedro de Cajas", "Tapo", "Tarma"],
                    "Yauli": ["Chacapalpa", "Huayhuay", "La Oroya", "Marcapomacocha", "Morococha", "Paccha", "Santa Barbara de Carhuacayán", "Santa Rosa de Sacco", "Suitucancha", "Yauli"]
  
                }
            },
            "La Libertad": {
                "provincias": {
                    "Ascope": ["Ascope", "Casa Grande", "Chicama", "Chocope", "Magdalena de Cao", "Paiján", "Rázuri", "Santiago de Cao"],
                    "Bolívar": ["Bambamarca", "Bolívar", "Condormarca", "Longotea", "Uchumarca", "Ucuncha"],
                    "Chepén": ["Chepén", "Pacanga", "Pueblo Nuevo"],
                    "Gran Chimú": ["Cascas", "Lucma", "Marmot", "Sayapullo"],
                    "Julcán": ["Calamarca", "Carabamba", "Huaso", "Julcán"],
                    "Otuzco": ["Agallpampa", "Charat", "Huaranchal", "La Cuesta", "Mache", "Otuzco", "Paranday", "Salpo", "Sinsicap", "Usquil"],
                    "Pacasmayo": ["Guadalupe", "Jequetepeque", "Pacasmayo", "San José", "San Pedro de Lloc"],
                    "Pataz": ["Buldibuyo", "Chilia", "Huancaspata", "Huaylillas", "Huayo", "Ongón", "Parcoy", "Pataz", "Pías", "Santiago de Challas", "Taurija", "Tayabamba", "Urpay"],
                    "Sánchez Carrión": ["Chugay", "Cochorco", "Curgos", "Huamachuco", "Marcabal", "Sanagorán", "Sarín", "Sartimbamba"],
                    "Santiago de Chuco": ["Angasmarca", "Cachicadán", "Mollebamba", "Mollepata", "Quiruvilca", "Santa Cruz de Chuca", "Santiago de Chuco", "Sitabamba"],
                    "Trujillo": ["El Porvenir", "Florencia de Mora", "Huanchaco", "La Esperanza", "Laredo", "Moche", "Poroto", "Salaverry", "Simbal", "Trujillo", "Víctor Larco Herrera"],
                    "Virú": ["Chao", "Guadalupito", "Virú"]
              

                }
            },

            "Lambayeque": {
                "provincias": {
                    "Chiclayo": ["Cayaltí", "Chiclayo", "Chongoyape", "Eten", "José Leonardo Ortiz", "La Victoria", "Lagunas", "Monsefú", "Nueva Arica", "Oyotún", "Pátapo", "Picsi", "Pimentel", "Pomalca", "Pucalá", "Puerto Eten", "Reque", "Santa Rosa", "Tumán", "Zaña"],
                    "Ferreñafe": ["Cañaris", "Ferreñafe", "Incahuasi", "Manuel Antonio Mesones Muro (antes Tres Tomas)", "Pítipo", "Pueblo Nuevo"],
                    "Lambayeque": ["Chóchope", "Íllimo", "Jayanca", "Lambayeque", "Mochumí", "Mórrope", "Motupe", "Olmos", "Pacora", "Salas", "San José", "Túcume"]
                }
            },

            "Lima": {
                "provincias": {
                    "Barranca": ["Barranca", "Paramonga", "Pativilca", "Supe", "Supe Puerto"],
                    "Cajatambo": ["Cajatambo", "Copa", "Gorgor", "Huancapón", "Manás"],
                    "Canta": ["Arahuay", "Canta", "Huamantanga", "Huaros", "Lachaqui", "San Buenaventura", "Santa Rosa de Quives"],
                    "Cañete": ["Asia", "Calango", "Cerro Azul", "Chilca", "Coayllo", "Imperial", "Lunahuaná", "Mala", "Nuevo Imperial", "Pacarán", "Quilmaná", "San Antonio", "San Luis", "San Vicente de Cañete", "Santa Cruz de Flores", "Zúñiga"],
                    "Huaral": ["Atavillos Alto", "Atavillos Bajo", "Aucallama", "Chancay", "Huaral", "Ihuarí", "Lampían", "Pacaraos", "San Miguel de Acos", "Santa Cruz de Andamarca", "Sumbilca", "Veintisiete de Noviembre"],
                    "Huarochirí": ["Antioquía", "Callahuanca", "Carampoma", "Chicla", "Cuenca", "Huachupampa", "Huanza", "Huarochirí", "Lahuaytambo", "Langa", "Laraos (San Pedro de Laraos)", "Mariatana", "Matucana", "Ricardo Palma", "San Andrés de Tupicocha", "San Antonio (de Chaclla)", "San Bartolomé", "San Damián", "San Jerónimo de Surco", "San Juan de Iris", "San Juan de Tantaranche", "San Lorenzo de Quinti", "San Mateo", "San Mateo de Otao", "San Pedro de Casta", "San Pedro de Huancayre", "Sangallaya", "Santa Cruz de Cocachacra", "Santa Eulalia", "Santiago de Anchucaya", "Santiago de Tuna", "Santo Domingo de los Olleros"],
                    "Huaura": ["Ámbar", "Caleta de Carquín", "Checras", "Huacho", "Hualmay", "Huaura", "Leoncio Prado", "Paccho", "Santa Leonor", "Santa María", "Sayán", "Végueta"],
                    "Oyón": ["Andajes", "Caujul", "Cochamarca", "Naván", "Oyón", "Pachangara"],
                    "Yauyos": ["Alis", "Ayauca", "Ayavirí", "Azángaro", "Cacra", "Carania", "Catahuasi", "Chocos", "Cochas", "Colonia", "Hongos", "Huampará", "Huancaya", "Huangáscar", "Huantán", "Huáñec", "Laraos", "Lincha", "Madeán", "Miraflores", "Omas", "Putinza", "Quinches", "Quinocay", "San Joaquín", "San Pedro de Pilas", "Tanta", "Tauripampa", "Tomas", "Tupe", "Víñac", "Vitis", "Yauyos"],
                    "Lima": ["Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Cercado de Lima", "Chaclacayo", "Chorrillos", "Cieneguilla", "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince", "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana", "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo", "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis", "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa", "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo"]

                }
            },

            "Loreto": {
                "provincias": {
                    "Alto Amazonas": ["Balsapuerto", "Jeberos", "Lagunas", "Santa Cruz", "Teniente César López Rojas", "Yurimaguas"],
                    "Datem del Marañón": ["Andoas", "Barranca", "Cahuapanas", "Manseriche", "Morona", "Pastaza"],
                    "Loreto": ["Nauta", "Parinari", "Tigre", "Trompeteros", "Urarinas"],
                    "Mariscal Ramón Castilla": ["Pebas", "Ramón Castilla", "San Pablo", "Yavarí"],
                    "Maynas": ["Alto Nanay", "Belén", "Fernando Lores", "Indiana", "Iquitos", "Las Amazonas", "Mazán", "Napo", "Punchana", "San Juan Bautista", "Torres Causana"],
                    "Putumayo": ["Putumayo", "Rosa Panduro", "Teniente Manuel Clavero", "Yaguas"],
                    "Requena": ["Alto Tapiche", "Capelo", "Emilio San Martín", "Jenaro Herrera", "Maquía", "Puinahua", "Requena", "Saquena", "Soplin", "Tapiche", "Yaquerana"],
                    "Ucayali": ["Alfredo Vargas Guerra", "Contamana", "Inahuaya", "Padre Márquez", "Pampa Hermosa", "Sarayacu"]
                }
            },

            "Madre de Dios": {
                "provincias": {
                    "Manu": ["Manu", "Fitzcarrald", "Madre de Dios", "Huepetuhe"],
                    "Tahuamanu": ["Iñapari", "Iberia", "Tahuamanu"],
                    "Tambopata": ["Tambopata", "Inambari", "Las Piedras", "Laberinto"]
                }
            },
            "Moquegua": {
                "provincias": {
                    "Mariscal Nieto": ["Carumas", "Cuchumbaya", "Moquegua", "Samegua", "San Cristóbal de Calacoa", "Torata", "San Antonio"],
                    "Ilo": ["Ilo", "El Algarrobal", "Pacocha"],
                    "General Sánchez Cerro": ["Chojata", "Coalaque", "Ichuña", "La Capilla", "Lloque", "Matalaque", "Omate", "Puquina", "Quinistaquillas", "Ubinas", "Yunga"]
                }
            },
            "Pasco": {
                "provincias": {
                    "Daniel A. Carrión": ["Chacayán", "Goyllarisquizga", "Páucar", "San Pedro de Pillao", "Santa Ana de Tusi", "Tápuc", "Vilcabamba", "Yanahuanca"],
                    "Oxapampa": ["Chontabamba", "Constitución", "Huancabamba", "Oxapampa", "Palcazu", "Pozuzo", "Puerto Bermúdez", "Villa Rica"],
                    "Pasco": ["Chaupimarca", "Huachón", "Huariaca", "Huayllay", "Ninacaca", "Pallanchacra", "Paucartambo", "San Francisco de Asís de Yarusyacán", "Simón Bolívar", "Ticlacayán", "Tinyahuarco", "Vicco", "Yanacancha"]
                }
            },
            "Piura": {
                "provincias": {
                    "Ayabaca": ["Ayabaca", "Frías", "Jililí", "Lagunas", "Montero", "Pacaipampa", "Paimás", "Sapillica", "Sícchez", "Suyo"],
                    "Huancabamba": ["Canchaque", "El Carmen de la Frontera", "Huancabamba", "Huarmaca", "Lalaquiz", "San Miguel de El Faique", "Sóndor", "Sondorillo"],
                    "Morropón": ["Buenos Aires", "Chalaco", "Chulucanas", "La Matanza", "Morropón", "Salitral", "San Juan de Bigote", "Santa Catalina de Mossa", "Santo Domingo", "Yamango"],
                    "Paita": ["Amotape", "Colán", "El Arenal", "La Huaca", "Paita", "Tamarindo", "Vichayal"],
                    "Piura": ["Castilla", "Catacaos", "Cura Mori", "El Tallán", "La Arena", "La Unión", "Las Lomas", "Piura", "Tambogrande", "Veintiséis de Octubre"],
                    "Sechura": ["Bellavista de la Unión", "Bernal", "Cristo Nos Valga", "Rinconada-Llicuar", "Sechura", "Vice"],
                    "Sullana": ["Bellavista", "Ignacio Escudero", "Lancones", "Marcavelica", "Miguel Checa", "Querecotillo", "Salitral", "Sullana"],
                    "Talara": ["El Alto", "La Brea", "Lobitos", "Los Órganos", "Máncora", "Pariñas"]
                }
            },
            "Puno": {
                "provincias": {
                    "Azángaro":["Achaya", "Arapa", "Asillo", "Azángaro", "Caminaca", "Chupa", "José Domingo Choquehuanca", "Muñani", "Potoni", "Samán", "San Antón", "San José", "San Juan de Salinas", "Santiago de Pupuja", "Tirapata"],
                    "Carabaya": ["Ajoyani", "Ayapata", "Crucero", "Macusani", "Coasa", "Corani", "Ituata", "Ollachea", "San Gabán", "Usicayos"],
                    "Chucuito": ["Desaguadero", "Huacullani", "Juli", "Kelluyo", "Pisacoma", "Pomata", "Zepita"],
                    "El Collao": ["Capaso", "Conduriri", "Ilave", "Pilcuyo", "Santa Rosa"],
                    "Huancané": ["Cojata", "Huancané", "Huatasani", "Inchupalla", "Pusi", "Rosaspata", "Taraco", "Vilque Chico"],
                    "Lampa": ["Cabanilla", "Calapuja", "Lampa", "Nicasio", "Ocuviri", "Palca", "Paratía", "Pucará", "Santa Lucía", "Vilavila"],
                    "Melgar": ["Antauta", "Ayaviri", "Cupi", "Llalli", "Macari", "Nuñoa", "Orurillo", "Santa Rosa", "Umachiri"],
                    "Moho": ["Conima", "Huayrapata", "Moho", "Tilali"],
                    "Puno": ["Ácora", "Amantaní", "Atuncolla", "Capachica", "Chucuito", "Coata", "Huata", "Mañazo", "Paucarcolla", "Pichacani", "Platería", "Puno", "San Antonio", "Tiquillaca", "Vilque"],
                    "San Antonio de Putina": ["Ananea", "Pedro Vilca Apaza", "Putina", "Quilcapuncu", "Sina"],
                    "San Román": ["Cabana", "Cabanillas", "Caracoto", "Juliaca", "San Miguel"],
                    "Sandia": ["Alto Inambari", "Cuyocuyo", "Limbani", "Patambuco", "Phara", "Quiaca", "San Juan del Oro", "San Pedro de Putinapunco", "Sandia", "Yanahuaya"],
                    "Yunguyo": ["Anapia", "Copani", "Cuturapi", "Ollaraya", "Tinicachi", "Unicachi", "Yunguyo"]
                }
            },
            "San Martín": {
                "provincias": {
                    "Bellavista": ["Alto Biavo", "Bajo Biavo", "Bellavista", "Huallaga", "San Pablo", "San Rafael"],
                    "El Dorado": ["Agua Blanca", "San José de Sisa", "San Martín", "Santa Rosa", "Shatoja"],
                    "Huallaga": ["Alto Saposoa", "El Eslabón", "Piscoyacu", "Sacanche", "Saposoa", "Tingo de Saposoa"],
                    "Lamas": ["Alonso de Alvarado", "Barranquita", "Caynarachi", "Cuñunbuqui", "Lamas", "Pinto Recodo", "Rumisapa", "San Roque de Cumbaza", "Shanao", "Tabalosos", "Zapatero"],
                    "Mariscal Cáceres": ["Campanilla", "Huicungo", "Juanjuí", "Pachiza", "Pajarillo"],
                    "Moyobamba": ["Calzada", "Habana", "Jepelacio", "Moyobamba", "Soritor", "Yantalo"],
                    "Picota": ["Buenos Aires", "Caspizapa", "Picota", "Pilluana", "Pucacaca", "San Cristóbal", "San Hilarión", "Shamboyacu", "Tingo de Ponasa", "Tres Unidos"],
                    "Rioja": ["Awajún", "Elias Soplin Vargas", "Nueva Cajamarca", "Pardo Miguel", "Posic", "Rioja", "San Fernando", "Yorongos", "Yuracyacu"],
                    "San Martín": ["Alberto Leveau", "Cacatachi", "Chazuta", "Chipurana", "El Porvenir", "Huimbayoc", "Juan Guerra", "La Banda de Shilcayo", "Morales", "Papaplaya", "San Antonio", "Sauce", "Shapaja", "Tarapoto"],
                    "Tocache": ["Nuevo Progreso", "Pólvora", "Shunte", "Tocache", "Uchiza"]
                }
            },
            "Tacna": {
                "provincias": {
                    "Candarave": ["Cairani", "Camilaca", "Candarave", "Curibaya", "Huanuara", "Quilahuani"],
                    "Jorge Basadre": ["Ilabaya", "Ite", "Locumba"],
                    "Tacna": ["Alto de la Alianza", "Calana", "Ciudad Nueva", "Coronel Gregorio Albarracín Lanchipa", "Inclán", "La Yarada-Los Palos", "Pachía", "Palca", "Pocollay", "Sama", "Tacna"],
                    "Tarata": ["Estique", "Estique Pampa", "Héroes Albarracín (antes Chucatamani)", "Sitajara", "Susapaya", "Tarata", "Tarucachi", "Ticaco"]
                }
            },
            "Tumbes": {
                "provincias": {
                    "Contralmirante Villar": ["Canoas de Punta Sal", "Casitas", "Zorritos"],
                    "Tumbes": ["Corrales", "La Cruz", "Pampas de Hospital", "San Jacinto", "San Juan de la Virgen", "Tumbes"],
                    "Zarumilla": ["Aguas Verdes", "Matapalo", "Papayal", "Zarumilla"]
                }
            },
            "Ucayali": {
                "provincias": {
                    "Atalaya": ["Raimondi", "Sepahua", "Tahuanía", "Yurúa"],
                    "Coronel Portillo": ["Callería", "Campoverde", "Iparía", "Manantay", "Masisea", "Nueva Requena", "Yarinacocha"],
                    "Padre Abad": ["Alexander von Humboldt", "Curimaná", "Irázola", "Neshuya", "Padre Abad"],
                    "Purús": ["Purús"]
                }
            },


        }
    },



    "ARGENTINA": {
        "departamentos": {}
    },
    "BOLIVIA": {
        "departamentos": {}
    },
    "BRASIL": {
        "departamentos": {}
    },
    "CHILE": {
        "departamentos": {}
    },
    "COLOMBIA": {
        "departamentos": {}
    },
    "GUYANA": {
        "departamentos": {}
    },
    "PARAGUAY": {
        "departamentos": {}
    },
    "URUGUAY": {
        "departamentos": {}
    },
    "VENEZUELA": {
        "departamentos": {}
    }
};




// Función para cargar departamentos según el país seleccionado
function cargarDepartamentos() {
    const pais = document.getElementById("add_pais_residencia").value;
    const selectDepartamento = document.getElementById("add_departamento_residencia");
    const selectProvincia = document.getElementById("add_provincia_residencia");
    const selectDistrito = document.getElementById("add_distrito_residencia");

    // Limpiar los selectores
    selectDepartamento.innerHTML = '<option value="">Seleccione un departamento</option>';
    selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>';
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona país o si no es Perú, deshabilitar y ocultar los campos
    if (!pais || pais !== "PERU") {
        // Deshabilitar los selectores
        selectDepartamento.disabled = true;
        selectProvincia.disabled = true;
        selectDistrito.disabled = true;

        // Ocultar los campos
        selectDepartamento.style.display = "none";
        selectProvincia.style.display = "none";
        selectDistrito.style.display = "none";
        return;
    }

    // Si se selecciona Perú, habilitar y mostrar los campos
    selectDepartamento.disabled = false;
    selectProvincia.disabled = false;
    selectDistrito.disabled = false;

    // Mostrar los campos
    selectDepartamento.style.display = "inline-block";
    selectProvincia.style.display = "inline-block";
    selectDistrito.style.display = "inline-block";

    // Obtener los departamentos de Perú
    const departamentos = Object.keys(data[pais].departamentos);

    // Ordenar los departamentos alfabéticamente
    departamentos.sort();

    // Llenar el select de departamentos
    departamentos.forEach(departamento => {
        const option = document.createElement('option');
        option.value = departamento;
        option.textContent = departamento;
        selectDepartamento.appendChild(option);
    });
}


// Función para cargar provincias según el departamento seleccionado
function cargarProvincias() {
    const pais = document.getElementById("add_pais_residencia").value;
    const departamento = document.getElementById("add_departamento_residencia").value;
    const selectProvincia = document.getElementById("add_provincia_residencia");
    const selectDistrito = document.getElementById("add_distrito_residencia");

    // Limpiar los selectores
    selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>';
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona departamento o país o si no es Perú, no hacer nada
    if (!pais || pais !== "PERU" || !departamento) return;

    // Obtener las provincias del departamento seleccionado
    const provincias = Object.keys(data[pais].departamentos[departamento].provincias);

    // Ordenar las provincias alfabéticamente
    provincias.sort();

    // Llenar el select de provincias
    provincias.forEach(provincia => {
        const option = document.createElement('option');
        option.value = provincia;
        option.textContent = provincia;
        selectProvincia.appendChild(option);
    });
}

// Función para cargar distritos según la provincia seleccionada
function cargarDistritos() {
    const pais = document.getElementById("add_pais_residencia").value;
    const departamento = document.getElementById("add_departamento_residencia").value;
    const provincia = document.getElementById("add_provincia_residencia").value;
    const selectDistrito = document.getElementById("add_distrito_residencia");

    // Limpiar el select de distritos
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona provincia, salimos de la función
    if (!pais || pais !== "PERU" || !departamento || !provincia) return;

    // Obtener los distritos de la provincia seleccionada
    const distritos = data[pais].departamentos[departamento].provincias[provincia];

    // Ordenar los distritos alfabéticamente
    distritos.sort();

    // Llenar el select de distritos
    distritos.forEach(distrito => {
        const option = document.createElement('option');
        option.value = distrito;
        option.textContent = distrito;
        selectDistrito.appendChild(option);
    });
}


// Función para cargar departamentos de nacimiento según el país seleccionado
function cargarDepartamentosNacimiento() {
    const pais = document.getElementById("add_pais_nacimiento").value;
    const selectDepartamento = document.getElementById("add_departamento_nacimiento");
    const selectProvincia = document.getElementById("add_provincia_nacimiento");
    const selectDistrito = document.getElementById("add_distrito_nacimiento");

    // Limpiar los selectores
    selectDepartamento.innerHTML = '<option value="">Seleccione un departamento</option>';
    selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>';
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona país o si no es Perú, deshabilitar y ocultar los campos
    if (!pais || pais !== "PERU") {
        // Deshabilitar los selectores
        selectDepartamento.disabled = true;
        selectProvincia.disabled = true;
        selectDistrito.disabled = true;

        // Ocultar los campos
        selectDepartamento.style.display = "none";
        selectProvincia.style.display = "none";
        selectDistrito.style.display = "none";
        return;
    }

    // Si se selecciona Perú, habilitar y mostrar los campos
    selectDepartamento.disabled = false;
    selectProvincia.disabled = false;
    selectDistrito.disabled = false;

    // Mostrar los campos
    selectDepartamento.style.display = "inline-block";
    selectProvincia.style.display = "inline-block";
    selectDistrito.style.display = "inline-block";

    // Obtener los departamentos de Perú
    const departamentos = Object.keys(data[pais].departamentos);

    // Ordenar los departamentos alfabéticamente
    departamentos.sort();

    // Llenar el select de departamentos
    departamentos.forEach(departamento => {
        const option = document.createElement('option');
        option.value = departamento;
        option.textContent = departamento;
        selectDepartamento.appendChild(option);
    });
}

// Función para cargar provincias de nacimiento según el departamento de nacimiento seleccionado
function cargarProvinciasNacimiento() {
    const pais = document.getElementById("add_pais_nacimiento").value;
    const departamento = document.getElementById("add_departamento_nacimiento").value;
    const selectProvincia = document.getElementById("add_provincia_nacimiento");
    const selectDistrito = document.getElementById("add_distrito_nacimiento");

    // Limpiar los selectores
    selectProvincia.innerHTML = '<option value="">Seleccione una provincia</option>';
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona país o si no es Perú, no hacemos nada
    if (!pais || pais !== "PERU" || !departamento) return;

    // Obtener las provincias del departamento seleccionado
    const provincias = Object.keys(data[pais].departamentos[departamento].provincias);

    // Ordenar las provincias alfabéticamente
    provincias.sort();

    // Llenar el select de provincias
    provincias.forEach(provincia => {
        const option = document.createElement('option');
        option.value = provincia;
        option.textContent = provincia;
        selectProvincia.appendChild(option);
    });
}


// Función para cargar distritos de nacimiento según la provincia de nacimiento seleccionada
function cargarDistritosNacimiento() {
    const pais = document.getElementById("add_pais_nacimiento").value;
    const departamento = document.getElementById("add_departamento_nacimiento").value;
    const provincia = document.getElementById("add_provincia_nacimiento").value;
    const selectDistrito = document.getElementById("add_distrito_nacimiento");

    // Limpiar el select de distritos
    selectDistrito.innerHTML = '<option value="">Seleccione un distrito</option>';

    // Si no se selecciona provincia, salimos de la función
    if (!pais || pais !== "PERU" || !departamento || !provincia) return;

    // Obtener los distritos de la provincia seleccionada
    const distritos = data[pais].departamentos[departamento].provincias[provincia];

    // Ordenar los distritos alfabéticamente
    distritos.sort();

    // Llenar el select de distritos
    distritos.forEach(distrito => {
        const option = document.createElement('option');
        option.value = distrito;
        option.textContent = distrito;
        selectDistrito.appendChild(option);
    });
}


</script>