<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cargo
 *
 * @author ALEXIS CARATAR
 */
class Comanda {
    private  $idcomanda;
    private  $idempleado;
    private  $fecha;
    private  $estado;
    private  $reserva;
    private  $factura;
    private  $domicilio;
    private  $caja;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from comanda where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idcomanda=$vector['idcomanda'];
        $this->idempleado=$vector['idempleado'];
        $this->fecha=$vector['fecha'];
        $this->estado=$vector['estado'];
        $this->reserva=$vector['reserva'];
        $this->factura=$vector['factura'];
        $this->domicilio=$vector['domicilio'];
        $this->caja=$vector['caja'];
    }
    
    function getIdempleado() {
        return $this->idempleado;
    }

    function setIdempleado($idempleado) {
        $this->idempleado = $idempleado;
    }

        function getCaja() {
        return $this->caja;
    }

    function setCaja($caja) {
        $this->caja = $caja;
    }

        function getDomicilio() {
        return $this->domicilio;
    }

    function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    function getIdcomanda() {
        return $this->idcomanda;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEstado() {
        return $this->estado;
    }

    function getReserva() {
        return $this->reserva;
    }

    function getFactura() {
        return $this->factura;
    }

    function setIdcomanda($idcomanda) {
        $this->idcomanda = $idcomanda;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setReserva($reserva) {
        $this->reserva = $reserva;
    }

    function setFactura($factura) {
        $this->factura = $factura;
    }
    
    public function grabar($usuario){
          $cadenaSQL="select max(idcaja) from caja";
        $caja=ConectorBD::ejecutarQuery($cadenaSQL, null);
        
        $cadenaSQL="insert into comanda (idempleado,fecha,estado,reserva,factura,caja) values('$usuario',current_timestamp,'P',$this->reserva,$this->factura,{$caja[0][0]})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabarDomicilio($usuario){
          $cadenaSQL="select max(idcaja) from caja";
        $caja=ConectorBD::ejecutarQuery($cadenaSQL, null);
        $cadenaSQL="insert into comanda (idempleado,fecha,estado,domicilio,factura,caja) values($usuario,current_timestamp,'P',$this->domicilio,$this->factura,{$caja[0][0]})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
}