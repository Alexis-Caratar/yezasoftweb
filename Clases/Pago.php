<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pago
 *
 * @author ALEXIS CARATAR
 */
class Pago {
    private  $idpago;
    private  $fecha;
    private  $valor;
    private  $prestamo;
    function __construct($campo,$valor) {
               if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select  idpago,fecha,valor,prestamo from pago where $campo=$valor ";
            
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }

         private function cargarvector($vector){
        $this->idpago=$vector['idpago'];
        $this->fecha=$vector['fecha'];
        $this->valor=$vector['valor'];
        $this->prestamo=$vector['prestamo'];
      
    }
        
    
    function getIdpago() {
        return $this->idpago;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getValor() {
        return $this->valor;
    }

    function getPrestamo() {
        return $this->prestamo;
    }

    function setIdpago($idpago) {
        $this->idpago = $idpago;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setPrestamo($prestamo) {
        $this->prestamo = $prestamo;
    }
    
    
    
    
    public function grabar(){
        $cadenaSQL="insert into pago(valor,fecha,prestamo) values('$this->valor','$this->fecha','$this->prestamo')";
        print_r($cadenaSQL); 
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Modificar(){
        $cadenaSQL="update pago set valor='$this->valor',fecha='$this->fecha', prestamo='$this->prestamo' where idpago=$this->idpago";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from pago where idpago='$this->idpago'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from pago";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden;
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Pago::getDatos($filtro, $orden);
    $listapagos= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Pago($datos[$i], null);
        $listapagos[$i]=$lista;
    }
    return $listapagos;
}


}
