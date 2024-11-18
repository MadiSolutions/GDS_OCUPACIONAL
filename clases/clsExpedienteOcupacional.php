<?php
class ExpedienteOcupacional
{
    public $dni;
    public $nombre;
    public $fecha;
    public $ruc_empresa;
    public $empresa;

    function __construct($dni, $nombre, $fecha, $ruc_empresa, $empresa)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->ruc_empresa = $ruc_empresa;
        $this->empresa = $empresa;
    }

    public function Agregar($con)
    {
    
    	/*$flg_usuario="select dni from usuarios where dni='$this->dni' limit 1";
        $res3=mysqli_query($con, $flg_usuario);
        $row_cnt = $res3->num_rows;
        if($row_cnt<=0){
            $insert_user="INSERT INTO usuarios (dni, nombre, direccion, telefono, correo,tipo_user,contra, estado) VALUES ('$this->dni','$this->nombre','MOQUEGUA','0','-','5','$this->dni','1')";
            mysqli_query($con, $insert_user); 
            $insert_paciente="INSERT INTO `pacientes`(`dni`, `nombre`, `direccion`, `telefono`, `correo`, `estado`) VALUES ('$this->dni','$this->nombre','MOQUEGUA','0','-','1')";
            mysqli_query($con, $insert_paciente); 
        }*/
    
        $insertar = "INSERT INTO expedienteocupacional(dni, nombre, fecha, ruc_empresa, empresa, estado)
        VALUES('$this->dni', '$this->nombre', '$this->fecha', '$this->ruc_empresa', '$this->empresa',1)";
        $exe = mysqli_query($con, $insertar);
        if ($exe !== false) {
            MensajeExitoso("Ocupacional Registrado al Sistema");
        } else {
            MensajeError("Ocupacional No Pudo Ser Registrado al Sistema");
            //MensajeExitoso($insertar);
        }
    }

    public function Modificar($con)
    {
        $modificar = "UPDATE expedienteocupacional SET nombre = '$this->nombre',ruc_empresa = '$this->ruc_empresa',empresa='$this->empresa' WHERE dni = '$this->dni'";
        $exe = mysqli_query($con, $modificar);
        if ($exe !== false) {
            //MensajeExitoso($modificar);
            MensajeExitoso("Ocupacional Modificado");
        } else {
            MensajeError("Ocupacional No Pudo Ser Modificado");
        }
    }

    public function Eliminar($con)
    {
        $eliminar = "UPDATE expedienteocupacional SET estado='0' WHERE dni = '$this->dni'";
        $exe = mysqli_query($con, $eliminar);
        if ($exe !== false) {
            MensajeExitoso("Ocupacional Eliminado del Sistema");
        } else {
            MensajeError("El Ocupacional No Pudo Ser Eliminado");
        }
    }
}
