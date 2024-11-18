<?php
$accion = $_POST['accion']; 
controlador($accion);

// Definir el controlador
function controlador($accion) {
    require_once '../db_conexion.php';  
    $cone = mysqli_connect($host, $user, $pass, $db);  

    switch ($accion) {
        case 'BUSCAR_PACIENTE':
            $documento = $_POST['documento'];
            $query = "SELECT * FROM ma_ocupacional_pacientes WHERE num_documento = '$documento'";
            $res = mysqli_query($cone, $query);

            $row_cnt = $res->num_rows;

            if($row_cnt>0){

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

                $data = json_decode($datos, true); 
                if($data['success'] == false){
                    echo "3%";
                }
                if($data['success'] == true){
                    echo "2%".$data['apellidoPaterno'].' '.$data['apellidoMaterno'].' '.$data['nombres'];
                }
            }

        break;
        case 'LIST_TABLA_DIA':
  
            $fecha = $_POST['fecha']; 
            $query = "SELECT * FROM ma_ocupacional_programaciones WHERE fecha = '$fecha' and estado=1";
            $res = mysqli_query($cone, $query);
            $fechafinal=explode('-',$fecha);

            $row_cnt = $res->num_rows;

            if($row_cnt>0){
                echo "<h3> Programacion para el ".$fechafinal[2].'-'.$fechafinal[1].'-'.$fechafinal[0]."</h3>";
                echo "<br>";
                echo '<button type="button" class="btn btn-primary" style="background-color:#00b3ba;" onmouseover="this.style.backgroundColor='."'#007bff'".';" onmouseout="this.style.backgroundColor='."'#00b3ba'".';" data-toggle="modal" data-target="#AddModal">Agregar Nuevo</button>';
                echo "<br><br>";
                echo "<table class='table table-bordered table-hover'>";
                echo '<thead style="background-color:#55B7BE;color:#FFFFFF" >';
                echo "<tr>";
                echo "<th>Codigo</th><th>Paciente</th><th>Proyecto</th><th>Protocolo</th><th></th>";
                echo "</tr>";
                echo '</thead>';

                while ($row = mysqli_fetch_assoc($res)) : 
                    echo "<tr>";
                    echo "<td>".$row['id_programacion']."</td><td>".$row['id_paciente']."</td><td>".$row['id_proyecto']."</td><td>".$row['id_protocolo']."</td><td>-</td>";
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



