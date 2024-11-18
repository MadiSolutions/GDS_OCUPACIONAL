<?php 
    date_default_timezone_set('America/Lima');
    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename=Tareo.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $mes=$_GET['mes'];
    $ano=$_GET['ano'];

    switch($mes){
        case 'ENERO':
            $mes='01';
        break;
        case 'FEBRERO':
            $mes='02';
        break;
        case 'MARZO':
            $mes='03';
        break;
        case 'ABRIL':
            $mes='04';
        break;
        case 'MAYO':
            $mes='05';
        break;
        case 'JUNIO':
            $mes='06';
        break;
        case 'JULIO':
            $mes='07';
        break;
        case 'AGOSTO':
            $mes='08';
        break;
        case 'SETIEMBRE':
            $mes='09';
        break;
        case 'OCTUBRE':
            $mes='10';
        break;
        case 'NOVIEMBRE':
            $mes='11';
        break;
        case 'DICIEMBRE':
            $mes='12';
        break;
    }

    require_once '../db_conexion.php';
	$cn = mysqli_connect($host, $user, $pass, $db);

    $output='';
    $output.="
        <table>
            <thead>
                <tr>
                        <th>Fecha</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Marcas</th>
                        <th>Horas</th>                      
                </tr>
            </thead>
        ";

        $query = "SELECT * from tareo where fecha like '%".$ano.'-'.$mes."-%' order by dni,fecha";
        $res = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($res)) :
            $marcas=explode(',',$row['horas']);
            $output.="
                <tr>
                    <td>".$row['fecha']."</td>
                    <td>".$row['dni']."</td>
                    <td>".$row['nombre']."</td>
                    <td>".implode(' | ',$marcas)."</td>
                    <td>".$row['sum_horas']."</td>
                </tr>
            ";
        endwhile;

        $output.="
            </table>
            ";
        echo $output;
?>