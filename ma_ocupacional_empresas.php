<?php
require_once 'clases/cls_Ma_Ocupacional_Empresas.php';

if (isset($_POST['update_id_empresa'])) {
    $medico = new empresas_ocupacional($_POST['update_id_empresa'],$_POST['update_ruc'], ($_POST['update_razon_social']), $_POST['update_nom_contacto'], $_POST['update_num_contacto'], ($_POST['update_correo_contacto']), $_POST['update_direccion']);
    $medico->Modificar($con);
} else if (isset($_POST['add_id_empresa'])) {
    $medico = new empresas_ocupacional('',$_POST['add_ruc'], ($_POST['add_razon_social']), $_POST['add_nom_contacto'], $_POST['add_num_contacto'], ($_POST['add_correo_contacto']),$_POST['add_direccion']);
    $medico->Agregar($con);
} else if(isset($_POST['delete_id_empresa'])){
    $medico = new empresas_ocupacional($_POST['delete_id_empresa'], '', '', '', '', '','');
    $medico->Eliminar($con);
}

$query = "SELECT id_empresa, ruc, razon_social, nom_contacto, num_contacto ,correo_contacto, direccion from ma_ocupacional_empresas where estado='1';";
$res = mysqli_query($con, $query);

require('views/ma_ocupacional_empresas.view.php');
