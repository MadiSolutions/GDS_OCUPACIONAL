<?php
date_default_timezone_set('America/Lima');
require 'db_conexion.php';
$con = mysqli_connect($host, $user, $pass, $db);
//80660063

session_start();

$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];

$query="SELECT * FROM usuarios where dni='$usuario' and contra='$contrasena' and estado=1 LIMIT 1";
$consulta=mysqli_query($con,$query);

$row_cnt = $consulta->num_rows;

$array = mysqli_fetch_array($consulta);

if($row_cnt>0){
    if($array['tipo_user']==1)
    {
        $_SESSION['usuario']=$usuario;
        $_SESSION['usuario_rspl']=$usuario;
        $_SESSION['tipo_usuario']=$array['tipo_user'];
        $_SESSION['carrito'] = array();
        $_SESSION['carrito_examenes_protocolo_ocupacional'] = array();
        $_SESSION['id_empresa'] = array();

    }
    else{
        $_SESSION['usuario']=$usuario;
        $_SESSION['usuario_rspl']=$usuario;
        $_SESSION['tipo_usuario']=$array['tipo_user'];
        $_SESSION['carrito'] = array();
        $_SESSION['carrito_examenes_protocolo_ocupacional'] = array();
        $_SESSION['id_empresa'] = array();
    }
    echo 'ok';
    //header("location: index.php");
}
else
{
    echo 'Acceso Restringido';
}

?>