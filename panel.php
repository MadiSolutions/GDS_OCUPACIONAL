<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$modulo = $_REQUEST['modulo'] ?? '';

//Conexión a la Base de Datos
require_once "db_conexion.php";
$con = mysqli_connect($host, $user, $pass, $db);

require_once('views/panel-header.view.php');

require_once 'funciones.php';

if ($modulo == "inicio" || $modulo == "") {
  require_once "inicio.php";
} else {
  $ruta = $modulo . '.php';
  require_once $ruta;
}

require_once('views/panel-body.view.php');