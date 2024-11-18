<?php 
    date_default_timezone_set('America/Lima');
    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename=Lista_Reservas_Dia.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $fecha=$_GET['fecha'];

    require_once '../db_conexion.php';
	$cn = mysqli_connect($host, $user, $pass, $db);

    $output='';
    $output.="
        <table border='1'>
            <thead>
                <tr>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>ESPECIALIDAD</th>
                        <th>MEDICO</th>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>TELEFONO</th>  
                </tr>
            </thead>
        ";

        $queryparticular = mysqli_query($cn,"select * from (SELECT fecha,horario,especialidad,dni as dni_pac,nombre as nom_pac,telefono as tel_pac ,medico as med FROM citas where estado=1 and fecha='$fecha' and estado_cita!='DISPONIBLE' and especialidad!='VARIOS')as a join (select dni, nombre from usuarios where estado = 1 and tipo_user='2' group by dni)as b on a.med=b.dni order by a.horario;");
        while ($row = mysqli_fetch_assoc($queryparticular)) :
            $output.="
                <tr>
                    <td>".$row['fecha']."</td>
                    <td>".$row['horario']."</td>
                    <td>".$row['especialidad']."</td>
                    <td>".$row['nombre']."</td>
                    <td>".$row['dni_pac']."</td>
                    <td>".$row['nom_pac']."</td>
                    <td>".$row['tel_pac']."</td>
                </tr>
            ";
        endwhile;

        $output.="
            </table>
            ";
        echo $output;
?>