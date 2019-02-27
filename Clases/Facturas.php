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
class Facturas {
    private  $idfactura;
    private  $fecha;
    private  $identificaioncliente;
    private  $cambio;
    private  $empresa;
    private  $descuento;
    private  $comanda;
    private  $total;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from empresa where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idfactura=$vector[0];
        $this->fecha=$vector[1];
        $this->identificaioncliente=$vector[2];
        $this->cambio=$vector[3];
        $this->empresa=$vector[4];
        $this->descuento=$vector[5];
        $this->comanda=$vector[6];
        $this->total=$vector[7];
    }
    
    function getTotal() {
        return $this->total;
    }

    function setTotal($total) {
        $this->total = $total;
    }

        
    function getIdfactura() {
        return $this->idfactura;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdentificaioncliente() {
        return $this->identificaioncliente;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setIdfactura($idfactura) {
        $this->idfactura = $idfactura;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setIdentificaioncliente($identificaioncliente) {
        $this->identificaioncliente = $identificaioncliente;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }
    
    function getCambio() {
        return $this->cambio;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getComanda() {
        return $this->comanda;
    }

    function setCambio($cambio) {
        $this->cambio = $cambio;
    }

    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    function setComanda($comanda) {
        $this->comanda = $comanda;
    }

        public function grabar(){
        $cadenaSQL="insert into factura (fecha,empresa) values(current_timestamp,'123')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabarDomicilio(){
        $cadenaSQL="insert into factura (fecha,identificaccioncliente,empresa) values(current_timestamp,'$this->identificaioncliente','123')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function modificar(){
        $cadenaSQL="update factura set identificacioncliente='{$this->identificaioncliente}', descuento={$this->descuento}, totalfactura={$this->total} where idfactura= ";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function modificardos(){
        $cadenaSQL="update factura set identificacioncliente='{$this->identificaioncliente}', descuento={$this->descuento}, totalfactura={$this->total  } where idfactura={$this->idfactura}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        }
}