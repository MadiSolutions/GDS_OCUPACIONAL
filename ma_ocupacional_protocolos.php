<?php
require_once 'clases/cls_Ma_Ocupacional_Protocolos.php';

$carrito_ocupacional=$_SESSION['carrito_examenes_protocolo_ocupacional'];

if (isset($_POST['update_id_protocolo'])) {
    $medico = new empresas_ocupacional_protocolos ($_POST['update_id_protocolo'],$_POST['update_empresa_nombre'], ($_POST['update_examen_detalle']), $_POST['update_nombre'], $_POST['update_descripcion']);
    $medico->Modificar($con);
} else if (isset($_POST['add_protocolo'])) {
    $protocolo = new empresas_ocupacional_protocolos ('',$_POST['add_nombre'], ($_POST['add_descripcion']), $_POST['add_empresa_nombre'], $carrito_ocupacional);
    $protocolo->Agregar($con);
} else if(isset($_POST['delete_id_protocolo'])){
    $medico = new empresas_ocupacional_protocolos ($_POST['delete_id_protocolo'], '', '', '','');
    $medico->Eliminar($con);
}

/*$query = "SELECT id_protocolo, id_empresa, cod_interno_examenes, nombre, descripcion  from ma_ocupacional_protocolos where estado='1';";*/

$query = "
    SELECT 
    p.id_protocolo, 
    p.id_empresa, 
    e.razon_social AS empresa_nombre,
    p.nombre,
    p.descripcion,
    p.cod_interno_examenes as lista_examenes
FROM ma_ocupacional_protocolos p
INNER JOIN ma_ocupacional_empresas e ON p.id_empresa = e.id_empresa
WHERE p.estado = '1';

";
$res = mysqli_query($con, $query);


$query_empresas = "SELECT id_empresa, razon_social FROM ma_ocupacional_empresas WHERE estado='1'";
$res_empresas = mysqli_query($con, $query_empresas);


require('views/ma_ocupacional_protocolos.view.php');
