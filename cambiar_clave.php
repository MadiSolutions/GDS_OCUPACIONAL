<?php

if (isset($_POST['update_clave_usuario'])) {
    $clave_old=$_POST['clave_old'];
    $clave_new=$_POST['clave_new'];
    $clave_renew=$_POST['clave_renew'];

    $dni=$_SESSION['usuario'];
    $consulaclaveold="select * from usuarios where dni='$dni' and contra='$clave_old' and estado=1 limit 1";

    $resclaveold=mysqli_query($con,$consulaclaveold);

    $row_cnt = $resclaveold->num_rows;

    if($row_cnt>0){
        if($clave_new==$clave_renew){
            $query="update usuarios set contra='$clave_new' where estado=1 and dni='$dni'";
            $res=mysqli_query($con,$query);
            MensajeExitoso('Contraseña Cambiada');

        }else{
            MensajeError('Contraseñas Nuevas no coinciden');
        }

    }else{
        MensajeError('Contraseña Antigua Erronea');
    }
}

require('views/cambiar_clave.view.php');
