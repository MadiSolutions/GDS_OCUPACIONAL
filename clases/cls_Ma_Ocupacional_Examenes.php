<?php
class empresas_ocupacional_examenes
{
    public $id_prueba;
    public $cod_interno;
    public $descripcion;
    public $costo;
    public $especialidad;



    function __construct($id_prueba,$cod_interno, $descripcion, $costo, $especialidad)
    {
        $this->id_prueba = $id_prueba;
        $this->cod_interno = $cod_interno;
        $this->descripcion = $descripcion;
        $this->costo = $costo;
        $this->especialidad = $especialidad;
    }



    public function Agregar($con)
    {
        $insertar = "INSERT INTO ma_ocupacional_examenes (cod_interno, descripcion, costo, especialidad, estado)
        VALUES('$this->cod_interno', '$this->descripcion', '$this->costo', '$this->especialidad','1')";
        $exe = mysqli_query($con, $insertar);
        if ($exe !== false) {
            
            MensajeExitoso("Registrado al Sistema");
        } else {
            MensajeError("No Pudo Ser Registrado al Sistema");
            //MensajeExitoso($insertar);
        }
    }

    public function Modificar($con)
    {
        $modificar = "UPDATE ma_ocupacional_examenes  SET cod_interno = '$this->cod_interno',descripcion = '$this->descripcion', costo = '$this->costo',especialidad = '$this->especialidad' WHERE id_prueba = '$this->id_prueba'";
        $exe = mysqli_query($con, $modificar);
        if ($exe !== false) {
            //MensajeExitoso($modificar);
            MensajeExitoso("Exito al Modificado");
        } else {
            MensajeError("No Pudo Ser Modificado");
        }
    }

    public function Eliminar($con)
    {
        $eliminar = "UPDATE ma_ocupacional_examenes  SET estado='0' WHERE id_prueba = '$this->id_prueba'";
        $exe = mysqli_query($con, $eliminar);
        if ($exe !== false) {
            MensajeExitoso("Eliminado del Sistema");
        } else {
            MensajeError("No Pudo Ser Eliminado");
        }
    }
}
