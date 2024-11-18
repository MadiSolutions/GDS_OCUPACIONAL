<?php
class empresas_ocupacional_protocolos
{
    public $id_protocolo;
    public $nombre_protocolo;
    public $descripcion_protocolo;
    public $id_empresa;
    public $examenes;


    function __construct($id_protocolo,$nombre_protocolo, $descripcion_protocolo, $id_empresa, $examenes)
    {
        $this->id_protocolo = $id_protocolo;
        $this->id_empresa = $id_empresa;
        $this->examenes = $examenes;
        $this->nombre_protocolo = $nombre_protocolo;
        $this->descripcion_protocolo = $descripcion_protocolo;
    }



    public function Agregar($con)
    {
        $cadenaA="INSERT INTO ma_ocupacional_protocolos(id_empresa,cod_interno_examenes,nombre,descripcion,estado) VALUES";
        $cadenaB="";
        $item = count($this->examenes);
        $lista_examenes = "";

        for($i=0;$i<$item;$i++){
            $lista_examenes =$lista_examenes.$this->examenes[$i]['producto'].',';
        }
        $lista_examenes= substr($lista_examenes,0,-1);

        $cadenaB=$cadenaB."('$this->id_empresa','$lista_examenes','$this->nombre_protocolo','$this->descripcion_protocolo','1')";
        $exe = mysqli_query($con, $cadenaA.$cadenaB);

        if ($exe !== false) {
            
            MensajeExitoso("Registrado al Sistema");
        } else {
            MensajeError("No Pudo Ser Registrado al Sistema");
            //MensajeExitoso($insertar);
        }
    }

    public function Modificar($con)
    {
        $modificar = "UPDATE ma_ocupacional_protocolos  SET id_empresa = '$this->id_empresa',cod_interno_examenes = '$this->cod_interno_examenes', nombre = '$this->nombre',descripcion = '$this->descripcion' WHERE id_protocolo = '$this->id_protocolo'";
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
        $eliminar = "UPDATE ma_ocupacional_protocolos  SET estado='0' WHERE id_protocolo = '$this->id_protocolo'";
        $exe = mysqli_query($con, $eliminar);
        if ($exe !== false) {
            MensajeExitoso("Eliminado del Sistema");
        } else {
            MensajeError("No Pudo Ser Eliminado");
        }
    }
    
}
