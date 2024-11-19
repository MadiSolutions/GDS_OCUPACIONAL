<?php
date_default_timezone_set('America/Lima');
require 'db_conexion.php';
$con = mysqli_connect($host, $user, $pass, $db);
//80660063

session_start();

$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];

$query="SELECT * FROM ma_ocupacional_usuarios where usuario='$usuario' and contrasena='$contrasena' and estado=1 LIMIT 1";
$consulta=mysqli_query($con,$query);

$row_cnt = $consulta->num_rows;

$array = mysqli_fetch_array($consulta);

if($row_cnt>0){
    if($array['tipo_usuario']==2)
    {
        $_SESSION['id_empresa']=$array['id_empresa'];;
        $_SESSION['usuario']=$usuario;
        $_SESSION['razon_social']=$array['razon_social'];;
        $_SESSION['ruc']=$array['ruc'];
        $_SESSION['tipo_usuario']=$array['tipo_usuario'];

    }
    else{
        $_SESSION['id_empresa']=$array['id_empresa'];;
        $_SESSION['usuario']=$usuario;
        $_SESSION['razon_social']=$array['razon_social'];;
        $_SESSION['ruc']=$array['ruc'];
        $_SESSION['tipo_usuario']=$array['tipo_usuario'];
    }
    echo 'ok';
    //header("location: index.php");
}
else
{
    echo 'Acceso Restringido';
}

?>