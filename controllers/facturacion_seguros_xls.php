<?php 
    date_default_timezone_set('America/Lima');
    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename=Pre_Facturacion.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $fechaini=$_GET['fechaini'];
    $fechafin=$_GET['fechafin'];

    require_once '../db_conexion.php';
	$cn = mysqli_connect($host, $user, $pass, $db);

    $output='';
    $output.="
        <table>
            <thead>
                <tr>
                        <th>Fecha Control</th>
                        <th>Sited</th>
                        <th>Seguro</th>
                        <th>Tipo Comprobante</th>
                        <th>Total</th>           
                </tr>
            </thead>
        ";

        $query = mysqli_query($cn,"select d.num_nubefact,d.fecha_vencimiento,d.tipo_comprobante,d.fecha_colocacion,COALESCE(b.auditada,'SIN VENTA')AS auditada_farm,a.*, COALESCE(b.subtotal_farm,0)as subtotal_farm,
((((a.subtotal_admi-a.sum_cofijos)+COALESCE(b.subtotal_farm,0))*(100-a.co_pago_variable))/100) + (a.co_pago_fijo/1.18) as descuento,
(a.subtotal_admi+COALESCE(b.subtotal_farm,0))-(((((a.subtotal_admi-a.sum_cofijos)+COALESCE(b.subtotal_farm,0))*(100-a.co_pago_variable))/100) + (a.co_pago_fijo/1.18)) as subtotalsinigv,
((a.subtotal_admi+COALESCE(b.subtotal_farm,0))-(((((a.subtotal_admi-a.sum_cofijos)+COALESCE(b.subtotal_farm,0))*(100-a.co_pago_variable))/100) + (a.co_pago_fijo/1.18)))*1.18 as totalconigv,
COALESCE(d.fecha_colocacion,0) as fecha_colocacion,COALESCE(d.tipo_comprobante,0) as tipo_comprobante
from (select auditada,paciente,sited,min(fecha)as fecha,seguro,sum(precio*cantidad)as subtotal_admi,co_pago_fijo,co_pago_variable, 
SUM(CASE
        WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2612 THEN precio*cantidad
        WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2613 THEN precio*cantidad
        WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2614 THEN precio*cantidad
   		WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2615 THEN precio*cantidad
    	WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2616 THEN precio*cantidad
    	WHEN CAST(REVERSE(SUBSTRING_INDEX(REVERSE(cod_interno), '.', 1)) AS UNSIGNED) = 2017 THEN precio*cantidad
        ELSE 0
    END) AS sum_cofijos from preliquidacion where seguro <>'-' and estado=1 group by sited,paciente)as a 
left join
(select auditada,paciente,sited,min(fecha)as fecha,seguro,sum(precio*cantidad)as subtotal_farm from preliquidacion_farm where seguro <>'-' and estado=1 group by sited,paciente)as b on a.sited=b.sited
left join 
(select num_nubefact,fecha_vencimiento,sited,fecha_colocacion,tipo_comprobante from cab_facturacion_seguros where estado=1)as d
on a.sited=d.sited where (d.fecha_colocacion>='$fechaini' and d.fecha_colocacion<='$fechafin');");
        while ($row = mysqli_fetch_assoc($query)) :
            if($row['fecha_colocacion']!=0){
        
                $output.="
                    <tr>
                        <td>".$row['fecha_colocacion']."</td>
                        <td>".$row['sited']."</td>
                        <td>".$row['seguro']."</td>
                        <td>".$row['tipo_comprobante'] . ' - '.$row['num_nubefact']."</td>
                        <td>S/ ".round($row['totalconigv'],2)."</td>
                    </tr>
                ";
            }
            endwhile;

        $output.="
            </table>
            ";
        echo $output;
?>