<?php
class empresas_ocupacional
{
    public $id_empresa;
    public $ruc;
    public $razon_social;
    public $nom_contacto;
    public $num_contacto;
    public $correo_contacto;
    public $direccion;


    function __construct($id_empresa,$ruc, $razon_social, $nom_contacto, $num_contacto, $correo_contacto,$direccion)
    {
        $this->id_empresa = $id_empresa;
        $this->ruc = $ruc;
        $this->razon_social = $razon_social;
        $this->nom_contacto = $nom_contacto;
        $this->num_contacto = $num_contacto;
        $this->correo_contacto = $correo_contacto;
        $this->direccion = $direccion;

    }

    public function Agregar($con)
    {
        $insertar = "INSERT INTO ma_ocupacional_empresas(ruc, razon_social, nom_contacto, num_contacto, correo_contacto, direccion, estado)
        VALUES('$this->ruc', '$this->razon_social', '$this->nom_contacto', '$this->num_contacto', '$this->correo_contacto',  '$this->direccion','1')";
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
        $modificar = "UPDATE ma_ocupacional_empresas SET ruc = '$this->ruc',razon_social = '$this->razon_social', correo_contacto = '$this->correo_contacto', nom_contacto = '$this->nom_contacto',num_contacto = '$this->num_contacto',direccion='$this->direccion' WHERE id_empresa = '$this->id_empresa'";
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
        $eliminar = "UPDATE ma_ocupacional_empresas SET estado='0' WHERE id_empresa = '$this->id_empresa'";
        $exe = mysqli_query($con, $eliminar);
        if ($exe !== false) {
            MensajeExitoso("Eliminado del Sistema");
        } else {
            MensajeError("No Pudo Ser Eliminado");
        }
    }
}
