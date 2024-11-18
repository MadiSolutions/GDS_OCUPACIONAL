<?php
require_once 'clases/cls_Ma_Ocupacional_Examenes.php';

if (isset($_POST['update_id_prueba'])) {
    $medico = new empresas_ocupacional_examenes ($_POST['update_id_prueba'],$_POST['update_cod_interno'], ($_POST['update_descripcion']), $_POST['update_costo'], $_POST['update_especialidad']);
    $medico->Modificar($con);
} else if (isset($_POST['add_id_prueba'])) {
    $medico = new empresas_ocupacional_examenes ('',$_POST['add_cod_interno'], ($_POST['add_descripcion']), $_POST['add_costo'], $_POST['add_especialidad']);
    $medico->Agregar($con);
} else if(isset($_POST['delete_id_prueba'])){
    $medico = new empresas_ocupacional_examenes ($_POST['delete_id_prueba'], '', '', '','');
    $medico->Eliminar($con);
}

$query = "SELECT id_prueba, cod_interno, descripcion, costo, especialidad  from ma_ocupacional_examenes where estado='1';";
$res = mysqli_query($con, $query);

require('views/ma_ocupacional_examenes.view.php');
