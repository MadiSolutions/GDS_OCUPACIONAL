<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$accion = $_POST['accion']; 
controlador($accion);

// Definir el controlador
function controlador($accion) {
    require_once '../db_conexion.php';  
    $cone = mysqli_connect($host, $user, $pass, $db);  

    switch ($accion) {
        case 'UPDATE_PROGRAMACION':
            $id_programacion = $_POST['id_programacion'];
            $id_proyecto = $_POST['id_proyecto'];
            $tipo_examenocupacional = $_POST['tipo_examenocupacional'];
            $tipo_colaborador = $_POST['tipo_colaborador'];
            $rptas = $_POST['rptas'];
            $list_base="";

            switch ($tipo_examenocupacional){
                case 'PREOCUPACIONAL':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,108,109,110,111,112,114,115,116,121,125,126,127,128,129,130,131,132,133,134,135,136,137,138,141,143,144,145,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,96,97,98,103,105,106,107,108,109,110,111,112,114,115,116,121,125,126,127,128,129,130,131,132,133,134,135,136,137,138,141,143,144,145,149,152";
                    }
                break;
                case 'PERIODICO':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,108,110,111,112,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,145,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,101,103,105,106,107,108,110,111,112,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,145,149,152";
                    }
                break;
                case 'RETIRO':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,97,103,105,106,107,114,116,125,126,127,131,133,134,135,141,143,144,149,152";
                    }
                break;
            }


            $query = "update ma_ocupacional_programaciones set id_proyecto = ?, examenocupacional = ?, tipo_colaborador = ?, list_adicionales = ? , list_base = ? , estado_bajada=0 where id_programacion= ?";

            $stmt = $cone->prepare($query);

            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $conn->error);
            }

            $stmt->bind_param("issssi", $id_proyecto, $tipo_examenocupacional, $tipo_colaborador,$rptas,$list_base,$id_programacion);

            if ($stmt->execute()) {
                echo true;
            } else {
                echo false;
            }
        break;
        case 'BUSCAR_PROGRAMACION_EDIT':
            $id_programacion = $_POST['id_programacion'];

            $query = "select a.*,b.descripcion from (select * from ma_ocupacional_programaciones where id_programacion='$id_programacion')as a join (select id_proyecto,descripcion from ma_ocupacional_proyectos where estado=1)as b on a.id_proyecto=b.id_proyecto;";
            $res = mysqli_query($cone, $query);

            $row_cnt = $res->num_rows;

            if($row_cnt>0){
                $array = mysqli_fetch_array($res);
                echo $array['id_proyecto'] . "%" .
                    $array['descripcion'] . "%" .
                    $array['examenocupacional'] . "%" .
                    $array['tipo_colaborador'].'%';
             }
        break;
        case 'UPDATE_PACIENTE':
            session_start();
            $id_paciente = $_POST['id_paciente'];
            $tipoDocumento = $_POST['tipo_documento'];
            $numeroDocumento = $_POST['numeroDocumento'];
            $nombreCompleto = $_POST['nombre_completo'];
            $sexo = $_POST['sexo'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];
            $estadoCivil = $_POST['estado_civil'];
            $gradoInstruccion = $_POST['grado_instruccion'];
            $ocupacion = $_POST['ocupacion'];
            $telefonoEmergencia = $_POST['telefono_emergencia'];
            $nombreContacto = $_POST['nombre_contacto'];
            $parentescoEmergencia = $_POST['parentesco_emergencia'];
            $correo = $_POST['correo'];

            $paisResidencia = $_POST['pais_residencia'];

            $departamentoResidencia = '-';
            $provinciaResidencia = '-';
            $distritoResidencia = '-';

            $departamentoResidencia = $_POST['departamento_residencia'];
            $provinciaResidencia = $_POST['provincia_residencia'];
            $distritoResidencia = $_POST['distrito_residencia'];
            $direccionResidencia = $_POST['direccion_residencia'];

            $paisNacimiento = $_POST['pais_nacimiento'];

            $departamentoNacimiento = '-';
            $provinciaNacimiento = '-';
            $distritoNacimiento = '-';

            $departamentoNacimiento = $_POST['departamento_nacimiento'];
            $provinciaNacimiento = $_POST['provincia_nacimiento'];
            $distritoNacimiento = $_POST['distrito_nacimiento'];
            $direccionNacimiento = $_POST['direccion_nacimiento'];

            $estadoBajada = 0;  // Asignado como 1, puedes cambiarlo según sea necesario
            $estado = 1;
            $id_empresa=$_SESSION['id_empresa'];
            
             $sql = "UPDATE ma_ocupacional_pacientes 
            SET tipo_documento = ?, num_documento = ?, nombre_completo = ?, genero = ?, 
                fecha_nacimiento = ?, edad = ?, telefono = ?, estado_civil = ?, grado_instruccion = ?, 
                ocupacion = ?, telefono_emergencia = ?, nombre_contacto_emergencia = ?, parentesco_emergencia = ?, correo = ?, 
                pais_residencia = ?, departamento_residencia = ?, provincia_residencia = ?, distrito_residencia = ?, direccion_residencia = ?, 
                pais_nacimiento = ?, departamento_nacimiento = ?, provincia_nacimiento = ?, distrito_nacimiento = ?, direccion_nacimiento = ?, 
                estado_bajada = ?, estado = ? 
            WHERE id_paciente = ? ";

    // Usar declaraciones preparadas para evitar inyecciones SQL
            $stmt = $cone->prepare($sql);

            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $conn->error);
            }

            $stmt->bind_param("ssssssssssssssssssssssssiii", 
        $tipoDocumento, $numeroDocumento, $nombreCompleto, $sexo, 
        $fechaNacimiento, $edad, $telefono, $estadoCivil, $gradoInstruccion, 
        $ocupacion, $telefonoEmergencia, $nombreContacto, $parentescoEmergencia, $correo, 
        $paisResidencia, $departamentoResidencia, $provinciaResidencia, $distritoResidencia, $direccionResidencia, 
        $paisNacimiento, $departamentoNacimiento, $provinciaNacimiento, $distritoNacimiento, $direccionNacimiento, 
        $estadoBajada, $estado, $id_paciente);

            if ($stmt->execute()) {
                echo 'OK';
            } else {
                echo 'ERROR';
            }
        break;
        case 'BUSCAR_PACIENTE_EDIT':
            $id_paciente = $_POST['id_paciente'];

            $query = "SELECT * FROM ma_ocupacional_pacientes WHERE id_paciente = '$id_paciente'";
            $res = mysqli_query($cone, $query);

            $row_cnt = $res->num_rows;

            if($row_cnt>0){
                $array = mysqli_fetch_array($res);
                $id_paciente = $array['id_paciente'];
                $id_empresa = $array['id_empresa'];
                $tipo_documento = $array['tipo_documento'];
                $num_documento = $array['num_documento'];
                $nombre_completo = $array['nombre_completo'];
                $genero = $array['genero'];
                $fecha_nacimiento = $array['fecha_nacimiento'];
                $edad = $array['edad'];
                $telefono = $array['telefono'];
                $estado_civil = $array['estado_civil'];
                $grado_instruccion = $array['grado_instruccion'];
                $ocupacion = $array['ocupacion'];
                $telefono_emergencia = $array['telefono_emergencia'];
                $nombre_contacto_emergencia = $array['nombre_contacto_emergencia'];
                $parentesco_emergencia = $array['parentesco_emergencia'];
                $correo = $array['correo'];
                $pais_residencia = $array['pais_residencia'];
                $departamento_residencia = $array['departamento_residencia'];
                $provincia_residencia = $array['provincia_residencia'];
                $distrito_residencia = $array['distrito_residencia'];
                $direccion_residencia = $array['direccion_residencia'];
                $pais_nacimiento = $array['pais_nacimiento'];
                $departamento_nacimiento = $array['departamento_nacimiento'];
                $provincia_nacimiento = $array['provincia_nacimiento'];
                $distrito_nacimiento = $array['distrito_nacimiento'];
                $direccion_nacimiento = $array['direccion_nacimiento'];
                $estado_bajada = $array['estado_bajada'];
                $estado = $array['estado'];

                echo $array['id_paciente'] . "%" .
                    $array['id_empresa'] . "%" .
                    $array['tipo_documento'] . "%" .
                    $array['num_documento'] . "%" .
                    $array['nombre_completo'] . "%" .
                    $array['genero'] . "%" .
                    $array['fecha_nacimiento'] . "%" .
                    $array['edad'] . "%" .
                    $array['telefono'] . "%" .
                    $array['estado_civil'] . "%" .
                    $array['grado_instruccion'] . "%" .
                    $array['ocupacion'] . "%" .
                    $array['telefono_emergencia'] . "%" .
                    $array['nombre_contacto_emergencia'] . "%" .
                    $array['parentesco_emergencia'] . "%" .
                    $array['correo'] . "%" .
                    $array['pais_residencia'] . "%" .
                    $array['departamento_residencia'] . "%" .
                    $array['provincia_residencia'] . "%" .
                    $array['distrito_residencia'] . "%" .
                    $array['direccion_residencia'] . "%" .
                    $array['pais_nacimiento'] . "%" .
                    $array['departamento_nacimiento'] . "%" .
                    $array['provincia_nacimiento'] . "%" .
                    $array['distrito_nacimiento'] . "%" .
                    $array['direccion_nacimiento'] . "%" .
                    $array['estado_bajada'] . "%" .
                    $array['estado'];

                }
        break;
        case 'ELIMINAR_PROGRAMACION':
            $id_programacion = $_POST['id_programacion'];
            $queryUpdate = "UPDATE ma_ocupacional_programaciones set estado=0,estado_bajada=0 WHERE id_programacion='$id_programacion'";
            $resUpdate = mysqli_query($cone, $queryUpdate);
            if ($resUpdate !== false) {
                echo true;
            } else {
                echo false;
            }

        break;
        case 'GUARDAR_PROGRAMACION':
            date_default_timezone_set('America/Lima');
            $hoy=date("Y-m-d"); 
            session_start();
            $id_paciente = $_POST['id_paciente'];
            $id_proyecto = $_POST['id_proyecto'];
            $tipo_examenocupacional = $_POST['tipo_examenocupacional'];
            $tipo_colaborador = $_POST['tipo_colaborador'];
            $fecha = $_POST['fecha'];
            $lista = $_POST['rptas'];
            $id_empresa=$_SESSION['id_empresa'];
            $list_base="";

            switch ($tipo_examenocupacional){
                case 'PREOCUPACIONAL':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,108,109,110,111,112,114,115,116,121,125,126,127,128,129,130,131,132,133,134,135,136,137,138,141,143,144,145,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,96,97,98,103,105,106,107,108,109,110,111,112,114,115,116,121,125,126,127,128,129,130,131,132,133,134,135,136,137,138,141,143,144,145,149,152";
                    }
                break;
                case 'PERIODICO':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,108,110,111,112,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,145,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,101,103,105,106,107,108,110,111,112,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,145,149,152";
                    }
                break;
                case 'RETIRO':
                    if($tipo_colaborador=='ADMINISTRATIVO'){
                        $list_base="92,93,94,95,96,97,98,100,103,105,106,107,114,116,125,126,127,129,130,131,132,133,134,135,136,141,143,144,149,152";
                    }
                    if($tipo_colaborador=='OPERATIVO'){
                        $list_base="92,93,94,95,97,103,105,106,107,114,116,125,126,127,131,133,134,135,141,143,144,149,152";
                    }
                break;
            }

            $sql = "INSERT INTO ma_ocupacional_programaciones (id_paciente,id_empresa,id_proyecto,examenocupacional,tipo_colaborador,list_base,list_adicionales,fecha,estado_bajada,estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

            $stmt = $cone->prepare($sql);

            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $conn->error);
            }
            $estado_bajada=0;
            $estado=1;
            //$lista=implode(',',$lista);

            $stmt->bind_param("iiisssssii", $id_paciente, $id_empresa, $id_proyecto,$tipo_examenocupacional,$tipo_colaborador, $list_base,$lista, $fecha, $estado_bajada,$estado);

            if ($stmt->execute()) {
                echo true;
            } else {
                echo 'ERROR';
            }

        break;
        case 'GUARDAR_PACIENTE_NUEVO':
            session_start();
            $id_paciente = $_POST['id_paciente'];
            $tipoDocumento = $_POST['tipo_documento'];
            $numeroDocumento = $_POST['numeroDocumento'];
            if($id_paciente!=''){
                $queryUpdate = "UPDATE ma_ocupacional_pacientes set estado=0 WHERE num_documento='$numeroDocumento'";
                $resUpdate = mysqli_query($cone, $queryUpdate);
            }
            $nombreCompleto = $_POST['nombre_completo'];
            $sexo = $_POST['sexo'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $edad = $_POST['edad'];
            $telefono = $_POST['telefono'];
            $estadoCivil = $_POST['estado_civil'];
            $gradoInstruccion = $_POST['grado_instruccion'];
            $ocupacion = $_POST['ocupacion'];
            $telefonoEmergencia = $_POST['telefono_emergencia'];
            $nombreContacto = $_POST['nombre_contacto'];
            $parentescoEmergencia = $_POST['parentesco_emergencia'];
            $correo = $_POST['correo'];

            $paisResidencia = $_POST['pais_residencia'];

            $departamentoResidencia = '-';
            $provinciaResidencia = '-';
            $distritoResidencia = '-';

            $departamentoResidencia = $_POST['departamento_residencia'];
            $provinciaResidencia = $_POST['provincia_residencia'];
            $distritoResidencia = $_POST['distrito_residencia'];
            $direccionResidencia = $_POST['direccion_residencia'];

            $paisNacimiento = $_POST['pais_nacimiento'];

            $departamentoNacimiento = '-';
            $provinciaNacimiento = '-';
            $distritoNacimiento = '-';

            $departamentoNacimiento = $_POST['departamento_nacimiento'];
            $provinciaNacimiento = $_POST['provincia_nacimiento'];
            $distritoNacimiento = $_POST['distrito_nacimiento'];
            $direccionNacimiento = $_POST['direccion_nacimiento'];

            $estadoBajada = 0;  // Asignado como 1, puedes cambiarlo según sea necesario
            $estado = 1;
            $id_empresa=$_SESSION['id_empresa'];
            
            $sql = "INSERT INTO ma_ocupacional_pacientes (
                id_empresa, tipo_documento, num_documento, nombre_completo, genero, 
                fecha_nacimiento, edad, telefono, estado_civil, grado_instruccion, 
                ocupacion, telefono_emergencia, nombre_contacto_emergencia, parentesco_emergencia, correo, 
                pais_residencia, departamento_residencia, provincia_residencia, distrito_residencia, direccion_residencia, 
                pais_nacimiento, departamento_nacimiento, provincia_nacimiento, distrito_nacimiento, direccion_nacimiento, 
                estado_bajada, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)";

    // Usar declaraciones preparadas para evitar inyecciones SQL
            $stmt = $cone->prepare($sql);

            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $conn->error);
            }

            $stmt->bind_param("issssssssssssssssssssssssii", 
            $id_empresa, $tipoDocumento, $numeroDocumento, $nombreCompleto, $sexo, 
            $fechaNacimiento, $edad, $telefono, $estadoCivil, $gradoInstruccion, 
            $ocupacion, $telefonoEmergencia, $nombreContacto, $parentescoEmergencia, $correo, 
            $paisResidencia, $departamentoResidencia, $provinciaResidencia, $distritoResidencia, $direccionResidencia, 
            $paisNacimiento, $departamentoNacimiento, $provinciaNacimiento, $distritoNacimiento, $direccionNacimiento, 
            $estadoBajada, $estado);

            if ($stmt->execute()) {
                $last_id = $cone->insert_id;
                echo 'OK%'.$last_id.'%'.$nombreCompleto;
            } else {
                echo 'ERROR';
            }

        break;
        case 'BUSCAR_PACIENTE':

            $documento = $_POST['documento'];
            $fecha = $_POST['fecha'];

            $queryAA="select a.id_programacion from (select * from ma_ocupacional_programaciones where estado=1 and fecha='$fecha')as a join (select id_paciente,num_documento from ma_ocupacional_pacientes WHERE num_documento = '$documento')as b on a.id_paciente=b.id_paciente";
            $resAA = mysqli_query($cone, $queryAA);
            $row_cntAA = $resAA->num_rows;

            if($row_cntAA>0){
                echo '4%';
            }else{
                $query = "SELECT * FROM ma_ocupacional_pacientes WHERE num_documento = '$documento'";
                $res = mysqli_query($cone, $query);

                $row_cnt = $res->num_rows;

                if($row_cnt>0){
                    $array = mysqli_fetch_array($res);
                    $id_paciente = $array['id_paciente'];
                    $id_empresa = $array['id_empresa'];
                    $tipo_documento = $array['tipo_documento'];
                    $num_documento = $array['num_documento'];
                    $nombre_completo = $array['nombre_completo'];
                    $genero = $array['genero'];
                    $fecha_nacimiento = $array['fecha_nacimiento'];
                    $edad = $array['edad'];
                    $telefono = $array['telefono'];
                    $estado_civil = $array['estado_civil'];
                    $grado_instruccion = $array['grado_instruccion'];
                    $ocupacion = $array['ocupacion'];
                    $telefono_emergencia = $array['telefono_emergencia'];
                    $nombre_contacto_emergencia = $array['nombre_contacto_emergencia'];
                    $parentesco_emergencia = $array['parentesco_emergencia'];
                    $correo = $array['correo'];
                    $pais_residencia = $array['pais_residencia'];
                    $departamento_residencia = $array['departamento_residencia'];
                    $provincia_residencia = $array['provincia_residencia'];
                    $distrito_residencia = $array['distrito_residencia'];
                    $direccion_residencia = $array['direccion_residencia'];
                    $pais_nacimiento = $array['pais_nacimiento'];
                    $departamento_nacimiento = $array['departamento_nacimiento'];
                    $provincia_nacimiento = $array['provincia_nacimiento'];
                    $distrito_nacimiento = $array['distrito_nacimiento'];
                    $direccion_nacimiento = $array['direccion_nacimiento'];
                    $estado_bajada = $array['estado_bajada'];
                    $estado = $array['estado'];

                    echo '1%'.$array['id_paciente'] . "%" .
                    $array['id_empresa'] . "%" .
                    $array['tipo_documento'] . "%" .
                    $array['num_documento'] . "%" .
                    $array['nombre_completo'] . "%" .
                    $array['genero'] . "%" .
                    $array['fecha_nacimiento'] . "%" .
                    $array['edad'] . "%" .
                    $array['telefono'] . "%" .
                    $array['estado_civil'] . "%" .
                    $array['grado_instruccion'] . "%" .
                    $array['ocupacion'] . "%" .
                    $array['telefono_emergencia'] . "%" .
                    $array['nombre_contacto_emergencia'] . "%" .
                    $array['parentesco_emergencia'] . "%" .
                    $array['correo'] . "%" .
                    $array['pais_residencia'] . "%" .
                    $array['departamento_residencia'] . "%" .
                    $array['provincia_residencia'] . "%" .
                    $array['distrito_residencia'] . "%" .
                    $array['direccion_residencia'] . "%" .
                    $array['pais_nacimiento'] . "%" .
                    $array['departamento_nacimiento'] . "%" .
                    $array['provincia_nacimiento'] . "%" .
                    $array['distrito_nacimiento'] . "%" .
                    $array['direccion_nacimiento'] . "%" .
                    $array['estado_bajada'] . "%" .
                    $array['estado'];

                }else{

                    $tokenA="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1hYXZhbG9zbHVuYUBnbWFpbC5jb20ifQ.FV507qELcLPe6QKboaz9FPWEh4YCQ1P9H-DXiU3KHLA";
                    $tokenB="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNvdmlkMTlwcm9jcmFja3MyMDIwQGdtYWlsLmNvbSJ9.gYQs3W4IaO5ua2Xhd45nHSqwuZhgHqD1vKAawZKBXsE";
                    $tokenC="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNsaW5pZnJlZTYzMEBnbWFpbC5jb20ifQ.kgQP8kMKtD3U9B-Sn9YnSypcF-5aK4JX4Q1IO9RZIyc";
                    $tokenD="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im11bmRpYWwyMHByb2NyYWNrQGdtYWlsLmNvbSJ9.8d4idpfj4i3j3uBU6F27YvnU7l6dP63u5-0L-tu2GwI";
                    $tokenE="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imx1aXNhbnRob255YWx2ZXNjQGdtYWlsLmNvbSJ9.Bixawq7IFALfGKe5YjbIwUtqjQQ9X-pgGMH_k3x7E9w";
                    $tokenF="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1hZGlzb2x1dGlvbnNncm91cEBnbWFpbC5jb20ifQ.qLBN3d1-pNoal_0hdL4xhZkiuMMRKaF654vnMSOf3kg";
                    $tokenG="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InRpY2NsaW5pY2FkZWxzdXJAZ21haWwuY29tIn0.5DrMGXgO8mzeYA8Vrkzm0VJx0fu2zNyWHJCZHmGhHZY";
                    $tokenH="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImdydXBvc3VyMDZAZ21haWwuY29tIn0.s2YL-apAHXxRjvUd-GC9ia4k77ByLBxXlA0MPNxhNDQ";
                    $tokenI="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNsaW5pY2E4Nzc1NUBnbWFpbC5jb20ifQ.F5_SRjbcL4LHNORjmOsnJ39QanE9HDiSvfNQUdv3_TM";
                    $tokenJ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImphaW1lbW9xdWVndWEyMEBnbWFpbC5jb20ifQ.FG7wdeY9J6MWDxeXzW_aumREdLQVEiiIqKt4fpC4wPc';
                    $tokenK='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNpZWxvb3F1ZXRvYWxAZ21haWwuY29tIn0.Sme-DQ5JQGAuHXU0q2uuN9SbZsEj45_Si06ujHrkQv8';
        
                    
                    $ws = "https://dniruc.apisperu.com/api/v1/dni/".$documento."?token=".$tokenA;
                    $datos = file_get_contents($ws);

                    if ($datos === FALSE) {
                        echo "3%";
                    } else {
                        $data = json_decode($datos, true); 
                        if($data['success'] == true){
                            echo "2%".$data['apellidoPaterno'].' '.$data['apellidoMaterno'].' '.$data['nombres'];
                        }
                        else{
                            echo "3%";
                        }  
                    }
                }
            }

        break;
        case 'LIST_TABLA_DIA':
            session_start();
            $fecha = $_POST['fecha']; 
            $id_empresa=$_SESSION['id_empresa'];
            $query = "select prog.id_programacion as codigo, pac.id_paciente as id_paciente,pac.num_documento as dni,pac.nombre_completo as nombre,proy.id_proyecto,proy.descripcion as desc_proyecto,prog.estado_bajada as estado_programacion,prog.examenocupacional as exa_ocupacional, prog.tipo_colaborador as tipo_colaborador
            from
            (SELECT * FROM ma_ocupacional_programaciones WHERE fecha = '$fecha' and estado=1 and id_empresa='$id_empresa')as prog 
            join 
            (select id_proyecto,descripcion from ma_ocupacional_proyectos where id_empresa='$id_empresa')as proy 
            join 
            (select id_paciente,num_documento,nombre_completo from ma_ocupacional_pacientes where estado=1 and id_empresa='$id_empresa')as pac 
            on 
            prog.id_proyecto=proy.id_proyecto and prog.id_paciente=pac.id_paciente;";
            $res = mysqli_query($cone, $query);
            $fechafinal=explode('-',$fecha);

            $row_cnt = $res->num_rows;

            if($row_cnt>0){
                echo "<h3> Programacion para el ".$fechafinal[2].'-'.$fechafinal[1].'-'.$fechafinal[0]."</h3>";
                echo "<br>";
                echo '<button type="button" class="btn btn-primary" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='."'#007bff'".';" onmouseout="this.style.backgroundColor='."'#00b3ba'".';" data-toggle="modal" data-target="#AddModal">Agregar Nuevo</button>';
                echo "<br><br>";
                echo "<table class='table table-bordered table-hover'>";
                echo '<thead style="background-color:#00b3ba;color:#FFFFFF" >';
                echo "<tr>";
                echo "<th>Codigo</th><th>Paciente</th><th>Perfil</th><th>Estado</th><th>Acciones</th>";
                echo "</tr>";
                echo '</thead>';

                while ($row = mysqli_fetch_assoc($res)) : 
                    if($row['estado_programacion']=='1'){
                        $color_alerta='success';
                        $estado_prog="PROGRAMADO";
                    }else{
                        $color_alerta='warning';
                        $estado_prog="PENDIENTE";
                    }
                    echo "<tr>";
                    echo "<td>".$row['codigo']."</td><td>".$row['dni'].'<br>'.$row['nombre'];
                    if($row['estado_programacion']=='0'){
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs" onclick="AbrirModalEdicionPaciente('."'".$row['id_paciente']."'".')"><li class="fa fa-edit"></li></button>'; 
                    }
                    echo "</td><td>".$row['desc_proyecto']."<br>".$row['exa_ocupacional'].'<br>'.$row['tipo_colaborador'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    if ($row['estado_programacion']=='1'){
                        echo '</td><td><span class="badge badge-'.$color_alerta.'">'.$estado_prog."</span></td>";
                    }else{
                        echo '<button type="button" class="btn btn-primary btn-xs" onclick="AbrirModalEdicionProgramacion('."'".$row['codigo']."','".$row['nombre']."','".$row['id_paciente']."'".')"><li class="fa fa-edit"></li></button>'; 
                        echo '</td><td><span class="badge badge-'.$color_alerta.'">'.$estado_prog."</span></td>";
                    }
                
                    if($row['estado_programacion']=='1'){
                        echo "<td></td>";
                    }else{
                        echo '<td><button type="button" class="btn btn-danger btn-xs" onclick="AbrirModalEliminacionProgramacion('."'".$row['codigo']."','".$row['nombre']."'".')"><li class="fa fa-trash"></li></button>'; 
                        echo "</td>";
                    }  
                    echo "</tr>";
                endwhile;
            }else{
                echo "<h3> Programacion para el ".$fechafinal[2].'-'.$fechafinal[1].'-'.$fechafinal[0]." vacia.</h3>";
                echo "<br>";
                echo '<button type="button" class="btn btn-primary" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='."'#007bff'".';" onmouseout="this.style.backgroundColor='."'#00b3ba'".';" data-toggle="modal" data-target="#AddModal">Agregar Nuevo</button>';
            }
            
            
            break;


        default:
            echo json_encode(array('error' => 'Acción no válida.'));
            break;
    }
}
?>



